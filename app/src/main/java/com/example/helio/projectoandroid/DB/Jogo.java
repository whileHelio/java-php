package com.example.helio.projectoandroid.DB;

import android.database.sqlite.SQLiteDatabase;
import android.widget.EditText;

import com.example.helio.projectoandroid.GameActivity;
import com.example.helio.projectoandroid.Nivel2Activity;

import java.io.Serializable;
import java.util.Date;

/**
 * Created by helio on 20/03/2016.
 */
public class Jogo implements Serializable {
    private int id;
    private String nome;
    private String data;
    private String contagem;
    private String palavra;
    private String variavel;
    private Nivel2Activity palavraNivel2;






    public long getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getData() {
        return data;
    }

    public void setData(String data) {
        this.data = data;
    }

    public String getContagem() {
        return contagem;
    }

    public void setContagem(String contagem) {
        this.contagem = contagem;
    }

    public String getPalavra() {
        return palavra;
    }

    public void setPalavra(String palavra) {
        this.palavra = palavra;
    }

    public String getVariavel() {
        return variavel;
    }

    public void setVariavel(String variavel) {
        this.variavel = variavel;
    }




    @Override
    public String toString(){
        return nome+"\n"+data; // aqui e para mudar depois para data

    }


}
