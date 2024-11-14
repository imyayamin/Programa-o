<?php

class Cliente{
    
    private $id_cliente;
    private $nome_cliente;
    private $sobrenome_cliente;
    private $cpf_cliente;
    private $fone_cliente;
    private $whats_cliente;
    private $email_cliente;
    private $cliente_senha;
    private $conn;
    
    public function __construct($connp) {
        $this->conn = $connp;
   //     var_dump($conn);
    }
    
//    Setters
    public function setid_cliente($id_cliente){
        $this->id_cliente = $id_cliente;
    }
    
    public function setnome_cliente($nome_cliente){
        $this->nome_cliente = $nome_cliente;
    }
    
    public function setsobrenome_cliente($sobrenome_cliente){
        $this->sobrenome_cliente = $sobrenome_cliente;
    }
    
    public function setcpf_cliente($cpf_cliente){
        $this->cpf_cliente = $cpf_cliente;
    }
    
    public function setfone_cliente($fone_cliente){
        $this->fone_cliente = $fone_cliente;
    }
    
    public function setwhats_cliente($whats_cliente){
        $this->whats_cliente = $whats_cliente;
    }
    
    public function setemail_cliente($email_cliente){
        $this->email_cliente = $email_cliente;
    }
    
    public function setcliente_senha($cliente_senha){
        $this->cliente_senha = base64_encode($cliente_senha);
    }
    
    
//    Getters
    public function getid_cliente(){
        return $this->id_cliente;
    }
    
    public function getnome_cliente(){
        return $this->nome_cliente;
    }
    
    public function getsobrenome_cliente(){
        return $this->sobrenome_cliente;
    }
    
    public function getcpf_cliente(){
        return $this->cpf_cliente;
    }
    
    public function getfone_cliente(){
        return $this->fone_cliente;
    }
    
    public function getwhats_cliente(){
        return $this->whats_cliente;
    }
    
    public function getemail_cliente(){
        return $this->email_cliente;
    }
    
    public function getcliente_senha(){
        return base64_decode($this->cliente_senha);
    }
    
    
    public function insert(){
        $sql = "INSERT INTO cliente (nome_cliente, sobrenome_cliente, cpf_cliente, fone_cliente, whats_cliente, email_cliente, cliente_senha) VALUES (:nome_cliente, :sobrenome_cliente, :cpf_cliente, :fone_cliente, :whats_cliente, :email_cliente, :cliente_senha)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_cliente', $this->nome_cliente);
        $stmt->bindParam(':sobrenome_cliente', $this->sobrenome_cliente);
        $stmt->bindParam(':cpf_cliente', $this->cpf_cliente);
        $stmt->bindParam(':fone_cliente', $this->fone_cliente);
        $stmt->bindParam(':whats_cliente', $this->whats_cliente);
        $stmt->bindParam(':email_cliente', $this->email_cliente);
        $stmt->bindParam(':cliente_senha', $this->cliente_senha);
        if ($stmt->execute()) {
            echo "Nova obra inserida com sucesso!<br>";
            $_SESSION['logado'] = true;
        } else {
            echo "Erro ao inserir obra!<br>";
        }
    }
    
    public function logar(){
        $sql = "SELECT id_cliente FROM cliente WHERE email_cliente = '$this->email_cliente' AND cliente_senha = '$this->cliente_senha'";
      
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $_SESSION['logado'] = true;
            header('location: finalizar.php');;
        } else {
            echo "Usuário ou senha incorreto!";
        }
        
    }
   
    
    
}

