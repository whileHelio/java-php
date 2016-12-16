package com.example.helio.projectoandroid.DB;

import android.content.ContentValues;
import android.content.Context;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.support.v7.app.AppCompatActivity;
import android.widget.ArrayAdapter;
import android.widget.EditText;

import com.example.helio.projectoandroid.GameActivity;

import java.text.SimpleDateFormat;
import java.util.Date;

public class Queries extends AppCompatActivity {

    public GameActivity Counter;
    private Database database1;
    public SQLiteDatabase conn;




    public  Queries(SQLiteDatabase conn){
        this.conn=conn;
    }

    public void inserir(Jogo jogo){

        ContentValues values= new ContentValues();
        //values.put("_id", jogo.getId());
        values.put("nome", jogo.getNome());
        values.put("data", getCurrentDate());
        values.put("contagem",jogo.getContagem());
        values.put("palavra",jogo.getPalavra());
        values.put("variavel",jogo.getVariavel());
        conn.insertOrThrow("SAVED_GAMES", null, values);
    }

    public  void delete(long id){

        conn.delete("SAVED_GAMES", "_id" + " = ?", new String[]{String.valueOf(id)});

    }


    public ArrayAdapter<Jogo> getSaves(Context context){
        ArrayAdapter<Jogo> SavesArray= new ArrayAdapter<Jogo>(context, android.R.layout.simple_list_item_1);

        Cursor cursor1= conn.rawQuery("SELECT * FROM  SAVED_GAMES ORDER BY data DESC",
                null);
        if(cursor1.getCount()>0){
            cursor1.moveToFirst();
            do {

                Jogo jogo= new Jogo();
                jogo.setId(cursor1.getInt(cursor1.getColumnIndex("_id")));
                jogo.setNome(cursor1.getString(cursor1.getColumnIndex("nome")));
                jogo.setData(cursor1.getString(cursor1.getColumnIndex("data")));
                jogo.setContagem(cursor1.getString(cursor1.getColumnIndex("contagem")));
                jogo.setPalavra(cursor1.getString(cursor1.getColumnIndex("palavra")));
                jogo.setVariavel(cursor1.getString(cursor1.getColumnIndex("variavel")));
                SavesArray.add(jogo);

                //SavesArray.add(data);
            }while (cursor1.moveToNext());


        }

        return SavesArray;

    }

    private String getCurrentDate() {
        SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        return sdf.format(new Date());
    }


}
