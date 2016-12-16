package com.example.helio.projectoandroid;

import android.app.Activity;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.Window;

public class MenuActivity extends Activity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);
    }

    public void play(View view){

        Intent playgame=new Intent(this,GameActivity.class);
        startActivity(playgame);
    }
    public void loads(View view){

        Intent loadgame=new Intent(this,loadsActivity.class);
        startActivity(loadgame);
    }
    public void settings(View view){

        Intent settings=new Intent(this,settingsActivity.class);
        startActivity(settings);
    }



}
