<?php

class Cupom {

    private $idcupom;

    private $nome;

    private $valor;

    private $conn;

    public function __construct ($connp){

        $this->conn = $connp;

    }

    public function setidcupom ($idcupom){

        $this->idcupom = $idcupom;

    }
    public function setNome ($nome){

        $this->nome = $nome;

    }
    public function setValor ($valor){

        $this->valor = $valor;

    }



    public function getidcupom ($idcupom){


       return $this->idcupom = $idcupom;

    }
    public function getnome ($nome){

       return $this->nome = $nome;

    }
    public function getvalor ($valor){

        return $this->valor = $valor;

    }

    public function insert(){
        $sql = "INSERT INTO cupom (nome, valor) VALUES (:nome, :valor)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':valor', $this->valor);
        if ($stmt->execute()) {
            echo "Nova cupom inserida com sucesso!<br>";
            $_SESSION['logado'] = true;
        } else {
            echo "Erro ao inserir cupom!<br>";
        }
    }

}


?>
