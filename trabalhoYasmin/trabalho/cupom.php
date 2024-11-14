<?php 
require_once('inc/topo.php');
require_once('inc/conexao.php');
require_once('classes/cupom.php');

//$_SESSION['logado'] = false;
//$_SESSION['logado'] = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cupom = new Cupom($conn);
    $cupom->setnome_cupom($_POST['nome_cupom']);
    $cupom->setqtde_uso_cupom($_POST['qtde_uso_cupom']);
    $cupom->setdesconto_cupom($_POST['desconto_cupom']);
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
                                 <input type="text" required="" name="nome_cupom" id="nome_cupom" class="form-control" value="">
                              </div>
                              <div class="form-group">
                                 <label>Quantidade de uso</label>
                                 <select name="qtde_uso_cupom" id="qtde_uso_cupom" class="form-control">
                                     <?php for($i = 1; $i<=10; $i++){
                                         echo  '<option value="'.$i.'">'.$i.'</option>';
                                     }
                                     ?>
                                  </select>
                              </div>
                              <div class="form-group">
                                 <label>Desonto (%)</label>
                                 <input type="text" required="" name="desconto_cupom" id="desconto_cupom" class="form-control" value="">
                              </div>
                             
                              <div class="form-group">
                                 <button type="submit" class="btn btn-fill-out btn-block" name="register">Salvar</button>
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