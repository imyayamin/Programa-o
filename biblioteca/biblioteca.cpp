#include "biblioteca.hpp"
#include <iostream>

using namespace std;

void Biblioteca::cadastrarUsuario(Usuario usuario) {
  cout << "Digite o nome do usuário: ";
  cin >> usuario.nome;
  cout << "Digite o tipo do usuário (administrador ou usuário comum): ";
  cin >> usuario.tipo;
}

 void Biblioteca::cadastrarLivro(Livro livro, Usuario usuario) {
  if (autenticarUsuario(usuario.nome, usuario.tipo) && usuario.tipo == "administrador") {
    livros.push_back(livro);
    cout << "Livro cadastrado com sucesso!" << endl;
  } else {
    cout << "Você não tem permissão para cadastrar livros!" << endl;
  }
}

void Biblioteca::emprestarLivro(std::string titulo, Usuario usuario) {
  for (auto &livro : livros) {
    if (livro.titulo == titulo && livro.disponivel) {
      livro.disponivel = false;
      cout << "Livro emprestado com sucesso!" << endl;
      return;
    }
  }
  cout << "Livro não encontrado ou não disponível!" << std::endl;
}

void Biblioteca::devolverLivro(std::string titulo, Usuario usuario) {
  for (auto &livro : livros) {
    if (livro.titulo == titulo && !livro.disponivel) {
      livro.disponivel = true;
      cout << "Livro devolvido com sucesso!" << endl;
      return;
    }
  }
  cout << "Livro não encontrado ou não emprestado!" << std::endl;
}

void Biblioteca::mudarDisponibilidade(Livro livro, bool disponivel, Usuario usuario) {
  if (autenticarUsuario(usuario.nome, usuario.tipo) &&
      usuario.tipo == "administrador") {
    for (auto &livro : livros) {
      if (livro.titulo == livro.titulo) {
        livro.disponivel = disponivel;
        cout << "Disponibilidade do livro alterada com sucesso!"<< endl;
        return;
      }
    }
    cout << "Livro não encontrado!" << endl;
  } else {
    cout
        << "Você não tem permissão para alterar a disponibilidade de livros!"
        << endl;
  }
}

void Biblioteca::removerLivro(std::string titulo) {
  for (auto it = livros.begin(); it != livros.end(); ++it) {
    if (it->titulo == titulo) {
      livros.erase(it);
      cout << "Livro removido com sucesso!" << endl;
      return;
    }
  }
  cout << "Livro não encontrado!" << endl;
}

void Biblioteca::listarLivros() {
  cout << "Livros disponíveis:" << endl;
  for (const auto &livro : livros) {
    cout << "Título: " << livro.titulo << ", Autor: " << livro.autor << ", Ano: " << livro.ano << ", Disponível: " << (livro.disponivel ? "Sim" : "Não") << endl;
  }
}

bool Biblioteca::autenticarUsuario(string nome,string tipo) {
  for (const auto &usuario : usuarios) {
    if (usuario.nome == nome && usuario.tipo == tipo) {
      return true;
    }
  }
  return false;
}
