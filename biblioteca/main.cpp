#include "biblioteca.hpp"
#include <iostream>

using namespace std;

int main() {
    Biblioteca biblioteca;

    cout << "Bem-vindo ao sistema de biblioteca!" << endl;
    cout << "Você é um administrador? (1- Sim, 2- Não)" << endl;

    int escolha;
    cin >> escolha;

    switch (escolha) {
        case 1: {
            Usuario usuarioAdministrador("Administrador", "administrador");
            biblioteca.cadastrarUsuario(usuarioAdministrador);

            cout << "Opções de administrador:" << endl;
            cout << "1. Cadastrar livro" << endl;
            cout << "2. Remover livro" << endl;
            cout << "3. Mudar disponibilidade de livro" << endl;
            cout << "4. Listar livros" << endl;

            int opcao;
            cin >> opcao;

            switch (opcao) {
                case 1: {
                    Livro livro("Novo livro", "Autor", 2022);
                    biblioteca.cadastrarLivro(livro, usuarioAdministrador);
                    break;
                }
                case 2: {
                    string titulo;
                    cout << "Digite o título do livro a remover: ";
                    cin >> titulo;
                    biblioteca.removerLivro(titulo);
                    break;
                }
                case 3: {
                    Livro livro("Livro existente", "Autor", 2020);
                    bool disponivel;
                    cout << "Digite a nova disponibilidade do livro (0 - Não, 1 - Sim): ";
                     cin >> disponivel;
                    biblioteca.mudarDisponibilidade(livro, disponivel, usuarioAdministrador);
                    break;
                }
                case 4: {
                    biblioteca.listarLivros();
                    break;
                }
                default:
                    cout << "Opção inválida!" << endl;
            }
            break;
        }
        case 2: {
            Usuario usuarioComum("Usuário comum", "comum");
            biblioteca.cadastrarUsuario(usuarioComum);

            cout << "Opções de usuário comum:" << endl;
            cout << "1. Emprestar livro" << endl;
            cout << "2. Devolver livro" << endl;
            cout << "3. Listar livros" << endl;

            int opcao;
            cin >> opcao;

            switch (opcao) {
                case 1: {
                    string titulo;
                    cout << "Digite o título do livro a emprestar: ";
                    cin >> titulo;
                    biblioteca.emprestarLivro(titulo, usuarioComum);
                    break;
                }
                case 2: {
                    string titulo;
                    cout << "Digite o título do livro a devolver: ";
                    cin >> titulo;
                    biblioteca.devolverLivro(titulo, usuarioComum);
                    break;
                }
                case 3: {
                    biblioteca.listarLivros();
                    break;
                }
                default:
                    cout << "Opção inválida!" << endl;
            }
            break;
        }
        default:
            cout << "Opção inválida!" << endl;
    }

    return 0;
}