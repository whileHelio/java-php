package com.example.helio.projectoandroid.DB;

/**
 * Created by helio on 18/03/2016.
 */
import android.content.Context;
import android.content.DialogInterface;
import android.database.Cursor;
import android.database.sqlite.*;
import android.widget.ArrayAdapter;

import com.example.helio.projectoandroid.loadsActivity;
import com.example.helio.projectoandroid.DB.Queries;
public class Database extends SQLiteOpenHelper {



    public static final String DATABASE_NAME = "PICK_ME";
    public static final String DATABASE_TABLE= "SAVED_GAMES";
    public static final String ID = "_id";
    public static final String NOME = "nome"; // text view input
    public static final String DATA="data";
    public static final String CONTAGEM="contagem"; //text view Counter
    public static final String PALAVRA="palavra";
    public static final String VARIAVEL="variavel";//text view texto
    private static final String DATABASE_CREATE = " CREATE TABLE IF NOT EXISTS " + DATABASE_TABLE + " (" +
            ID + " INTEGER PRIMARY KEY, " +
            NOME+" STRING, " +
            DATA+" STRING, " +
            CONTAGEM+" STRING, " +
            PALAVRA+" STRING, "+
            VARIAVEL+" STRING" + ");";



    public Database(Context context){
        super(context,DATABASE_NAME,null,1);
      }




    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL(DATABASE_CREATE);
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {

    }





}
