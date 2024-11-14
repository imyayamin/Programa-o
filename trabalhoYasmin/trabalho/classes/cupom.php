<?php


class Cupom{
    private $conn;
    private $nome_cupom;
    private $qtde_uso_cupom;
    private $desconto_cupom;
    
    public function __construct($connp) {
        $this->conn = $connp;
    }
    
//    Setter
    public function setnome_cupom($nome_cupom){
        $this->nome_cupom = $nome_cupom;
    }
    public function setqtde_uso_cupom($qtde_uso_cupom){
        $this->qtde_uso_cupom = $qtde_uso_cupom;
    }
    public function setdesconto_cupom($desconto_cupom){
        $this->desconto_cupom = $desconto_cupom;
    }
    
    
//    Getters
    public function getnome_cupom(){
        return $this->nome_cupom;
    }
    public function getqtde_uso_cupom(){
        return $this->qtde_uso_cupom;
    }
    public function getdesconto_cupom(){
        return $this->desconto_cupom;
    }
    
    
    public function loadCupom(){
        $sql = "SELECT * FROM cupom WHERE nome_cupom = '".$this->nome_cupom."'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $retorno = '';
        if (count($result) > 0) {
            foreach ($result as $row) {
                $this->desconto_cupom = $row['desconto_cupom'];
            }
        } else {
            echo "0 resultados<br>";
        }
    }
    
    public function insert(){
        $sql = "INSERT INTO cupom (nome_cupom, qtde_uso_cupom, desconto_cupom ) VALUES (:nome_cupom, :qtde_uso_cupom, :desconto_cupom)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_cupom', $this->nome_cupom);
        $stmt->bindParam(':qtde_uso_cupom', $this->qtde_uso_cupom);
        $stmt->bindParam(':desconto_cupom', $this->desconto_cupom);
        if ($stmt->execute()) {
            echo "Cupom inserido com sucesso!<br>";
        } else {
            echo "Erro ao inserir cupom!<br>";
        }
    }
}