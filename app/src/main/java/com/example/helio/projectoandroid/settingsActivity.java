package com.example.helio.projectoandroid;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

public class settingsActivity extends AppCompatActivity {
    private RadioGroup settings;
    private RadioButton button1;
    private RadioButton button2;
    private Button buttonEmail;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_settings);

        settings=(RadioGroup)findViewById(R.id.settings);
        button1=(RadioButton)findViewById(R.id.radioButton1);
        button2=(RadioButton)findViewById(R.id.radioButton2);
        buttonEmail=(Button)findViewById(R.id.button4);

        settings.setOnCheckedChangeListener(
                new RadioGroup.OnCheckedChangeListener() {

                    @Override
                    public void onCheckedChanged(RadioGroup group, int checkedId) {
                        RadioButton selectedButton= (RadioButton) findViewById(checkedId);
                       if (selectedButton.getId()==R.id.radioButton2){
                           Toast.makeText(getApplicationContext(),"Sound Off",Toast.LENGTH_SHORT).show();
                       }
                    }
                }


        );

        buttonEmail.setOnClickListener(new View.OnClickListener() {
                                           @Override
                                           public void onClick(View v) {
                                               Intent email = new Intent(Intent.ACTION_SEND);
                                               email.setType("message/rfc822");
                                               email.putExtra(Intent.EXTRA_EMAIL, new String[]{"To"}); //Receipent
                                               email.putExtra(Intent.EXTRA_SUBJECT, "Subject"); //Subject
                                               email.putExtra(Intent.EXTRA_TEXT, "Message"); //Message

                                               //Catch exception if no email clients are found
                                               try {
                                                   startActivity(Intent.createChooser(email, "Pick an Email Client!"));
                                               } catch (ActivityNotFoundException e) {
                                                   Toast.makeText(getApplicationContext(), "There are no email clients installed", Toast.LENGTH_SHORT).show();
                                               }
                                           }
                                       }
        );



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




    public void onSoundClick(View view){

        Toast.makeText(getApplicationContext(),"Sound On",Toast.LENGTH_SHORT).show();
    }


}
