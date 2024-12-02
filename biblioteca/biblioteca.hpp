#ifndef BIBLIOTECA_HPP
#define BIBLIOTECA_HPP

#include <vector>
#include <string>

using namespace std;

class Usuario {
private: 
    string senha;

public:
   string nome, tipo;

    Usuario(string nome, string tipo) : nome(nome), tipo(tipo) {}
};

class Livro {
public:
    string titulo, autor;
    int ano;
    bool disponivel;

    Livro(string titulo, string autor, int ano) : titulo(titulo), autor(autor), ano(ano), disponivel(true) {}
};

class Biblioteca {
private:
    vector<Livro> livros;
    vector<Usuario> usuarios;

public:
    void cadastrarUsuario(Usuario usuario);
    void cadastrarLivro(Livro livro, Usuario usuario);
    void emprestarLivro(string titulo, Usuario usuario);
    void devolverLivro(string titulo, Usuario usuario);
    void mudarDisponibilidade(Livro livro, bool disponivel, Usuario usuario);
    void removerLivro(string titulo);
    void listarLivros();
    bool autenticarUsuario(string nome, string tipo);
};

#endif  // BIBLIOTECA_H

