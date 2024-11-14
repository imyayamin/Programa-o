<?php 
require_once('inc/topo.php');
require_once('inc/conexao.php');
require_once('classes/produto.php');

//$_SESSION['logado'] = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $produto = new Produto($conn);
    $produto->setnome_produto($_POST['nome_produto']);
    $produto->setpreco_produto($_POST['preco_produto']);
    $produto->insert('img_produto');

    
}
?>
      <div class="main_content">
         <div class="login_register_wrap section">
            <div class="container">
               <div class="row justify-content-center">
                  <div class="col-xl-6 col-md-10">
                     <div class="login_wrap">
                        <div class="padding_eight_all bg-white">
                           <form action="" method="post" name="form" enctype="multipart/form-data">
                              <div class="form-group">
                                 <label>Imagem</label>
                                 <input type="file" required="" name="img_produto" id="img_produto" class="form-control" value="">
                              </div>
                               <div class="form-group">
                                 <label>Nome</label>
                                 <input type="text" required="" name="nome_produto" id="nome_produto" class="form-control" value="">
                              </div>
                               <div class="form-group">
                                 <label>Preço</label>
                                 <input type="text" required="" name="preco_produto" id="preco_produto" class="form-control" value="">
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-fill-out btn-block" name="register">Cadastrar</button>
                              </div>
                           </form>
                         </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
    </body>
</html>