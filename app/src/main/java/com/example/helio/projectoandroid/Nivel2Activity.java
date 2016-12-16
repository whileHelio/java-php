package com.example.helio.projectoandroid;


import android.app.AlertDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.database.SQLException;
import android.database.sqlite.SQLiteDatabase;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;
import java.util.Random;
import com.example.helio.projectoandroid.DB.Queries;
import com.example.helio.projectoandroid.DB.Database;
import com.example.helio.projectoandroid.DB.Jogo;

public class Nivel2Activity extends AppCompatActivity {
    private TextView Counter;
    private EditText letra;
    public static TextView texto;
    private int amountOfGuesses;
    private EditText input;
    private String kappa;
    private Button botao;
    private char[] randomWordToGuess;
    private char[] playerGuess;
    private String StringPlayerGuess;
    private String palavraVisor;
    private char[] charPalavraVisor;
    private  AlertDialog.Builder winAlert;
    private  AlertDialog.Builder lostAlert;
    private Database database;
    private SQLiteDatabase conn;
    private Queries getArraySaves;
    private Jogo jogo;
    private Button botaoPalavra;
    private EditText  palavraEscrita;
    public static String[] guessesNivel2;
    public String randomWordNivel2;




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_game);


        Counter = (TextView) findViewById(R.id.textCounter);
        letra = (EditText) findViewById(R.id.editLetter);
        texto = (TextView) findViewById(R.id.textLetter);
        botao = (Button) findViewById(R.id.button);
        botaoPalavra=(Button) findViewById(R.id.buttonPalavra);
        palavraEscrita=(EditText)findViewById(R.id.editPalavra);

        Bundle bundle= getIntent().getExtras();

        if((bundle != null)&&(bundle.containsKey("JOGO"))){
            jogo=(Jogo)bundle.getSerializable("JOGO");

            preencheDados();
            randomWordNivel2=StringPlayerGuess;
            randomWordToGuess=randomWordNivel2.toCharArray();
            palavraVisor=texto.getText().toString();
            charPalavraVisor=palavraVisor.toCharArray();
            amountOfGuesses = randomWordToGuess.length;

            botaoPalavra.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    if (randomWordNivel2.equals(palavraEscrita.getText().toString())) {
                        showAlertWin();}
                }
            });

            botao.setOnClickListener(new View.OnClickListener() {
                int k =Integer.parseInt(Counter.getText().toString()) ;

                public void onClick(View v) {

                    boolean wordIsGuessed = false;
                    int tries = 0;

                    for (int i = 0; i < charPalavraVisor.length; i++) {
                        texto.setText("");
                    }
                    String letraFinal = letra.getText().toString();
                    char letraFinal1 = letraFinal.charAt(0);
                    if (randomWordNivel2.indexOf(letraFinal1) == -1) {
                        k--;
                        kappa = Integer.toString(k);
                        Counter.setText(kappa);
                        Context context = getApplicationContext();
                        int text = R.string.deNovoLetra;
                        int duration = Toast.LENGTH_SHORT;

                        Toast toast = Toast.makeText(context, text, duration);
                        toast.show();
                    }
                    while (!wordIsGuessed && tries != amountOfGuesses) {
                        tries++;
                        for (int i = 0; i < randomWordToGuess.length; i++) {
                            if (randomWordToGuess[i] == letraFinal1) {
                                charPalavraVisor[i] = letraFinal1;
                            }
                        }
                        if (isTheWordGuessed(charPalavraVisor)) {
                            wordIsGuessed = true;
                            showAlertWin();
                        }
                    }
                    for (int i = 0; i < charPalavraVisor.length; i++) {

                        texto.append(charPalavraVisor[i]+"");
                    }
                    if(k==0){
                        showAlertLost();
                    }
                }
            });

        }else {
            guessesNivel2 = new String[]{"banana", "animal", "relogio", "berlinde"};
            randomWordNivel2 = guessesNivel2[new Random().nextInt(guessesNivel2.length)];
            randomWordToGuess = randomWordNivel2.toCharArray();
            amountOfGuesses = randomWordToGuess.length;
            playerGuess = new char[randomWordToGuess.length];
            //System.out.println(playerGuess);

            for (int i = 0; i < playerGuess.length; i++) {
                playerGuess[i] = '_';
                texto.append(playerGuess[i] + "");
                System.out.println(playerGuess[i]);
            }

            String numeros = Integer.toString(amountOfGuesses);
            Counter.setText(numeros);

            botaoPalavra.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    if (randomWordNivel2.equals(palavraEscrita.getText().toString())) {
                        showAlertWin();}
                }
            });

            botao.setOnClickListener(new View.OnClickListener() {
                int k = amountOfGuesses;

                public void onClick(View v) {
                    boolean wordIsGuessed = false;
                    int tries = 0;

                    for (int i = 0; i < playerGuess.length; i++) {
                        texto.setText("");
                    }
                    String letraFinal = letra.getText().toString();
                    char letraFinal1 = letraFinal.charAt(0);
                    if (randomWordNivel2.indexOf(letraFinal1) == -1) {
                        k--;
                        kappa = Integer.toString(k);
                        Counter.setText(kappa);
                        Context context = getApplicationContext();
                        int text = R.string.deNovoLetra;
                        int duration = Toast.LENGTH_SHORT;

                        Toast toast = Toast.makeText(context, text, duration);
                        toast.show();
                    }

                    while (!wordIsGuessed && tries != amountOfGuesses) {

                        tries++;
                        System.out.println(tries);

                        for (int i = 0; i < randomWordToGuess.length; i++) {

                            if (randomWordToGuess[i] == letraFinal1) {
                                playerGuess[i] = letraFinal1;
                            }
                        }
                        if (isTheWordGuessed(playerGuess)) {
                            wordIsGuessed = true;
                            showAlertWin();
                        }
                    }
                    for (int i = 0; i < playerGuess.length; i++) {
                        texto.append(playerGuess[i] + "");
                    }
                    if(k==0){
                        showAlertLost();
                    }
                }
            });
        }

        try {

            database = new Database(this);
            conn = database.getWritableDatabase();
            getArraySaves = new Queries(conn);

        } catch (SQLException ex) {
            AlertDialog.Builder alert = new AlertDialog.Builder(this);
            alert.setMessage("Conexao invalida" + ex.getMessage());// ao meter o ex.getMessage estamos informar o tipo de erro e onde aconteceu
            alert.setNeutralButton("ok", null);
            alert.show();
        }
    }

    public static boolean isTheWordGuessed(char[] array) {
        for (int i = 0; i < array.length; i++) {
            if (array[i] == '_') {
                return false;
            }
        }
        return true;
    }

    public void  showAlertLost(){
        lostAlert= new AlertDialog.Builder(this);
        lostAlert.setCancelable(false);
        lostAlert.setTitle("Você Perdeu").create();

        lostAlert.setPositiveButton("Tentar de Novo", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                nivelintent(Nivel2Activity.class);
            }
        });

        lostAlert.setNegativeButton("Menu", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                menuInicio();
            }
        });
        lostAlert.show();
    }

    public void showAlertWin() {
        winAlert = new AlertDialog.Builder(this);
        winAlert.setCancelable(false);
        winAlert.setTitle("Voce Ganhou!").create();



        winAlert.setNegativeButton("Menu", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                menuInicio();
            }
        });

        winAlert.show();
    }

    public void nivelintent(Class activity) {
        Intent nivel = new Intent(this, activity);
        startActivity(nivel);
    }

    public void menuInicio() {
        Intent menu = new Intent(this, MenuActivity.class);
        startActivity(menu);

    }

    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.home, menu);
        getMenuInflater().inflate(R.menu.menu_geral, menu);
        return true;
    }

    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.inicio:
                startActivity(new Intent(this, MenuActivity.class));
                return true;
            case R.id.Load:
                startActivity(new Intent(this, loadsActivity.class));
                return true;
            case R.id.Saves:
                alertSave();
                return true;
            case R.id.eliminar:
                delete1();
                finish();
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }
    private void delete1(){
        try{

            getArraySaves.delete(jogo.getId());
            Intent menuAc = new Intent(this,MenuActivity.class);
            startActivity(menuAc);
            Context context = getApplicationContext();
            CharSequence text = "Jogo Eliminado";
            int duration = Toast.LENGTH_SHORT;

            Toast toast = Toast.makeText(context, text, duration);
            toast.show();
        }catch (SQLException ex){
            AlertDialog.Builder alert=new AlertDialog.Builder(this);
            alert.setMessage("delete invalido "+ ex.getMessage());// ao meter o ex.getMessage estamos informar o tipo de erro e onde aconteceu
            alert.setNeutralButton("ok",null);
            alert.show();
        }
    }
    public void alertSave() {
        database = new Database(this);
        conn = database.getWritableDatabase();
        jogo = new Jogo();
        AlertDialog.Builder saveDialog = new AlertDialog.Builder(this);
        saveDialog.setTitle(R.string.savesGame);
        saveDialog.setMessage(R.string.nomeJogo);
        input = new EditText(this);
        LinearLayout.LayoutParams lp = new LinearLayout.LayoutParams(
                LinearLayout.LayoutParams.MATCH_PARENT,
                LinearLayout.LayoutParams.MATCH_PARENT);
        input.setLayoutParams(lp);
        saveDialog.setView(input);
        saveDialog.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                inserir();
            }
        });
        saveDialog.show();
    }

    private void preencheDados(){
        Counter.setText(jogo.getContagem());
        texto.setText(jogo.getPalavra());
        StringPlayerGuess=jogo.getVariavel();
    }

    private void inserir() {
        try {
            jogo = new Jogo();

            jogo.setNome(input.getText().toString());
            jogo.setContagem(Counter.getText().toString());
            jogo.setPalavra(texto.getText().toString());
            jogo.setVariavel(randomWordNivel2);

            getArraySaves.inserir(jogo);
            Context context = getApplicationContext();
            CharSequence text = "Jogo Gravado";
            int duration = Toast.LENGTH_SHORT;

            Toast toast = Toast.makeText(context, text, duration);
            toast.show();

        } catch (Exception ex) {
            AlertDialog.Builder alert = new AlertDialog.Builder(this);
            alert.setMessage("Conexao invalida" + ex.getMessage());
            alert.show();
        }
    }

}
