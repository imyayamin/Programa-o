<?php

class Produto{
    private $img_produto;
    private $nome_produto;
    private $preco_produto;
    private $conn;
    
    public function __construct($connp) {
        $this->conn = $connp;
   //     var_dump($conn);
    }
    
    public function setimg_produto($img_produto){
        $this->img_produto = $img_produto;
    }
    public function setnome_produto($nome_produto){
        $this->nome_produto = $nome_produto;
    }
    public function setpreco_produto($preco_produto){
        $this->preco_produto = $preco_produto;
    }
    
    public function getimg_produto(){
        return $this->img_produto;
    }
    
    public function getnome_produto(){
        return $this->nome_produto;
    }
    
    public function getpreco_produto(){
        return $this->preco_produto;
    }
    
    public function insert($img_produto){
        if($this->envioImg($img_produto)){
            $sql = "INSERT INTO produto (img_produto, nome_produto, preco_produto) VALUES (:img_produto, :nome_produto, :preco_produto)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':img_produto', $this->img_produto);
            $stmt->bindParam(':nome_produto', $this->nome_produto);
            $stmt->bindParam(':preco_produto', $this->preco_produto);
            if ($stmt->execute()) {
                echo "Produto inserido com sucesso!<br>";
            } else {
                echo "Erro ao inserir Produto!<br>";
            }
        }
        
    }
    
    private function envioImg($img_produto){
        if($_FILES[$img_produto]["size"] > 0){
            $nomefile = $_FILES[$img_produto]["name"];
            $dir_produto = "arquivo/".$nomefile;

            if(move_uploaded_file($_FILES[$img_produto]["tmp_name"], $dir_produto)){
               $this->setimg_produto($nomefile);
               return true;
            }else{
                return false;
            }
        }
    }
    
    
    
    
    
    
}
    
