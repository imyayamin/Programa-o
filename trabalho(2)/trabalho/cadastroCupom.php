<?php 
require_once('inc/topo.php');
require_once('inc/conexao.php');
require_once('classes/cupom.php');

//$_SESSION['logado'] = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cupom = new Cupom($conn);
    
    $cupom->setNome($_POST['nome']);
    $cupom->setValor($_POST['valor']);

    $cupom->insert();
    
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
                                 <label>Nome</label>
                                 <input type="text" required="" name="nome" id="nome" class="form-control" value="">
                              </div>
                              <div class="form-group">
                                 <label>Valor</label>
                                 <input type="text" required="" name="valor" id="valor" class="form-control" value="">
                              </div>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-fill-out btn-block" name="register">Cadastre-se</button>
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