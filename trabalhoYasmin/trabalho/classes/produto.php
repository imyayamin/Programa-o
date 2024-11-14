<?php

class Produto{
    private $id_produto;
    private $img_produto;
    private $nome_produto;
    private $preco_produto;
    private $valor_total;
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
    public function setid_produto($id_produto){
        $this->id_produto = $id_produto;
    }
    public function setvalor_total($valor_total){
        $this->valor_total = $valor_total;
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
    public function getid_produto(){
        return $this->id_produto;
    }
    public function getvalor_total(){
        return $this->valor_total;
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
    
    public function listarHome($url){
        
        $sql = "SELECT * FROM produto";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $retorno = '';
        $_SESSION['valor_produto'] = 0;
        if (count($result) > 0) {
            foreach ($result as $row) {
                $_SESSION['valor_produto'] += $row['preco_produto'] * $_SESSION['qtde_pedido_item'][$row['id_produto']];
                $retorno .= '<tr>
                                 <td class="product-thumbnail"><a href=""><img src="'.$url.'arquivo/'.$row['img_produto'].'" alt="'.$row['nome_produto'].'"></a></td>
                                 <td class="product-name" data-title="Product"><a href="">'.$row['nome_produto'].'</a></td>
                                 <td class="product-price" data-title="Price">R$ '.number_format($row['preco_produto'],2,',','.').'</td>
                                 <td class="product-quantity" data-title="Quantity">
                                    <div class="quantity">
                                       <form method="post" action="" class="text-center mt-4">
                                            <input type="hidden" name="id_produto" value="'.$row['id_produto'].'"/>
                                            <button type="submit" name="incrementar" class="btn btn-success">+</button>
                                            <input type="text" disabled="" name="qtde_pedido_item" value="'.$_SESSION['qtde_pedido_item'][$row['id_produto']].'" title="Qty" class="qty" size="4">
                                            <button type="submit" name="decrementar" class="btn btn-danger">-</button>
                                        </form>
                                    </div>
                                 </td>
                                 <td class="product-subtotal" data-title="Total">R$ '. number_format(($row['preco_produto']*$_SESSION['qtde_pedido_item'][$row['id_produto']]),2,',','.').'</td>
                              </tr>';
                
            }
            return $retorno;
        } else {
            echo "0 resultados<br>";
        }
    }
    
    public function listar($url){
        
        $sql = "SELECT * FROM produto";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $retorno = '';
        if (count($result) > 0) {
            foreach ($result as $row) {
                $retorno .= '<tr>
                            <td>'.$row['id_produto'].'</td>
                            <td>'.$row['nome_produto'].'</td>
                            <td>'.$row['preco_produto'].'</td>
                            <td><img width="100px" src="'.$url.'arquivo/'.$row['img_produto'].'"</td>
                            <td>
                                <a href="?opt=edi&id='.$row['id_produto'].'" type="button" class="btn btn-primary btn-sm btn-flat">Editar</a>
                                <a href="?opt=del&id='.$row['id_produto'].'" type="button" class="btn btn-danger btn-sm btn-flat">Excluir</a>
                            </td>
                        </tr>';
                
            }
            return $retorno;
        } else {
            echo "0 resultados<br>";
        }
    }
    
    public function loadEditar(){
        $sql = "SELECT * FROM produto WHERE id_produto = ".$this->id_produto;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $retorno = '';
        if (count($result) > 0) {
            foreach ($result as $row) {
                $this->img_produto = $row['img_produto'];
                $this->nome_produto = $row['nome_produto'];
                $this->preco_produto = $row['preco_produto'];
            }
        } else {
            echo "0 resultados<br>";
        }
    }
    
    public function update($img_produto){
        $sql = "UPDATE produto SET nome_produto = :nome_produto, preco_produto = :preco_produto WHERE id_produto = :id_produto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':nome_produto', $this->nome_produto);
        $stmt->bindParam(':preco_produto', $this->preco_produto);
        $stmt->bindParam(':id_produto', $this->id_produto);

        if ($stmt->execute()) {
            if($this->envioImg($img_produto)){
                $sql = "UPDATE produto SET img_produto = :img_produto WHERE id_produto = :id_produto";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindParam(':img_produto', $this->img_produto);
                $stmt->bindParam(':id_produto', $this->id_produto);
                if ($stmt->execute()) {
                    echo "produto atualizada com sucesso!<br>";
                }
            }else{
                echo "produto atualizada com sucesso!<br>";
            }
           
        } else {
            echo "produto ao atualizar obra!<br>";
        }
    }
    
    public function delete(){
        $sql = "DELETE FROM produto WHERE id_produto = :id_produto";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id_produto', $this->id_produto);

        if ($stmt->execute()) {
            echo "produto deletada com sucesso!<br>";
        } else {
            echo "Erro ao deletar obra!<br>";
        }
    }
    
    public function incremet(){
         $_SESSION['qtde_pedido_item'][$this->id_produto]++;
    }

    public function decrement(){
        if($_SESSION['qtde_pedido_item'][$this->id_produto]>0){
            $_SESSION['qtde_pedido_item'][$this->id_produto]--;
        }
    }
    
    public function total(){
        $valor_total = $_SESSION['valor_produto'] - $this->desconto();
        return number_format($valor_total,2,',','.');
    }
   
    public function desconto(){
        $desconto = $_SESSION['valor_produto'] * ($_SESSION['desconto_cupom'] / 100);
        return number_format($desconto,2,',','.');
    }
    
}
    
