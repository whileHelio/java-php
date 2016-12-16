package com.example.helio.projectoandroid;

import android.app.AlertDialog;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.ContextMenu;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.database.sqlite.*;
import android.database.SQLException;

import com.example.helio.projectoandroid.DB.Database;
import com.example.helio.projectoandroid.DB.Jogo;
import com.example.helio.projectoandroid.DB.Queries;
import com.example.helio.projectoandroid.GameActivity;

public class loadsActivity extends AppCompatActivity implements View.OnClickListener, AdapterView.OnItemClickListener {
    private ListView lstSaves;
    private Database database;
    private Queries getArraySaves;
    private SQLiteDatabase conn;
    private ArrayAdapter<Jogo> SavedGames;
    private Jogo jogo;
    private String[] palavrasVer;
    private String[] palavrasNl2;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_loads);
        lstSaves= (ListView)findViewById(R.id.listView);
        lstSaves.setOnItemClickListener(this);
        registerForContextMenu(lstSaves);

        palavrasVer=new String[]{"reddit", "programming", "fruit", "donut"};
        palavrasNl2=new String[]{"otorrinolaringo", "progrmadorsenior", "utilizacao", "berlinde"};

        try {
            jogo=new Jogo();
            database = new Database(this);
            conn = database.getWritableDatabase();
            getArraySaves=new Queries(conn);
            // getArraySaves.testeInserirContacto();
            SavedGames= getArraySaves.getSaves(this);
            lstSaves.setAdapter(SavedGames); //linha para passar a informaçao da tabela para a listView


        }catch (SQLException ex){
            AlertDialog.Builder alert=new AlertDialog.Builder(this);
            alert.setMessage("Conexao invalida"+ ex.getMessage());// ao meter o ex.getMessage estamos informar o tipo de erro e onde aconteceu
            alert.setNeutralButton("ok",null);
            alert.show();
        }
    }
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.home, menu);
        return true;
    }
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case R.id.inicio:
                startActivity(new Intent(this, MenuActivity.class));
                return true;
            default:
                return super.onOptionsItemSelected(item);
        }
    }

    public void onClick(View v){

        Intent it= new Intent(this,Jogo.class);
        startActivityForResult(it, 0);
    }

    @Override
    protected void onActivityResult(int requestCode,int resultCode,Intent data){
        SavedGames= getArraySaves.getSaves(this);

        lstSaves.setAdapter(SavedGames);

    }

    @Override
    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
        for (int k = 0; k < palavrasVer.length; k++) {


            if (GameActivity.randomWord==null) {
                Jogo jogo = SavedGames.getItem(position);
                Intent it = new Intent((getApplicationContext()), Nivel2Activity.class);
                it.putExtra("JOGO", jogo);
                startActivityForResult(it, 0);

            } else{
                Jogo jogo = SavedGames.getItem(position);
                Intent it = new Intent((getApplicationContext()), GameActivity.class);
                it.putExtra("JOGO", jogo);
                startActivityForResult(it, 0);

            }
        }

    }






}
