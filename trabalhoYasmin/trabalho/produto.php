<?php 
require_once('inc/topo.php');
require_once('inc/conexao.php');
require_once('classes/produto.php');

//$_SESSION['logado'] = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $produto = new Produto($conn);
    $produto->setnome_produto($_POST['nome_produto']);
    $produto->setpreco_produto($_POST['preco_produto']);
    
    if($_REQUEST['opt'] === 'edi'){
        $id_produto = $_REQUEST['id'];
        $produto->setid_produto($id_produto);
        $produto->update('img_produto');
    }else{
        $produto->insert('img_produto');
    }
    
    

    
}
$produto = new Produto($conn);
if($_REQUEST['opt'] === 'edi'){
    $id = $_REQUEST['id'];
    $produto->setid_produto($id);
    $produto->loadEditar();
  
    $nome_produto =  $produto->getnome_produto();
    $preco_produto =  $produto->getpreco_produto();
    $img_produto =  $produto->getimg_produto();
}

if($_REQUEST['opt'] === 'del'){
    $id = $_REQUEST['id'];
    $produto->setid_produto($id);
    $produto->delete();
}




?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        td {
            color: #555;
        }

        caption {
            caption-side: top;
            font-size: 18px;
            padding: 10px;
            color: #444;
        }
    </style>
      <div class="main_content">
         <div class="login_register_wrap section">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-6 col-md-10">
                     <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                           <form action="" method="post" name="form" enctype="multipart/form-data">
                              <div class="form-group">
                                  <?php if($img_produto){?>
                                <img width="100px;" src="<?=$url?>arquivo/<?=$img_produto?>" />
                                  <?php }?>
                                <br>
                                 <label>Imagem</label>
                                 <input type="file"  name="img_produto" id="img_produto" class="form-control" value="">
                              </div>
                               <div class="form-group">
                                 <label>Nome</label>
                                 <input type="text" required="" name="nome_produto" id="nome_produto" class="form-control" value="<?=$nome_produto?>">
                              </div>
                               <div class="form-group">
                                 <label>Preço</label>
                                 <input type="text" required="" name="preco_produto" id="preco_produto" class="form-control" value="<?=$preco_produto?>">
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-fill-out btn-block" name="register">Cadastrar</button>
                              </div>
                           </form>
                         </div>
                     </div>
                  </div>
               </div>
                
                 <table>
                    <caption>Produtos:</caption>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Imagem</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?=$produto->listar($url);?>
                    </tbody>
                </table>
            </div>
         </div>
      </div>

      
    </body>
</html>