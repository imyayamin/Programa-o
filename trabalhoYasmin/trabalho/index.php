<?php require_once('inc/topo.php');
require_once('inc/conexao.php');
require_once('classes/produto.php');
require_once('classes/cupom.php');

session_start();
error_reporting(0);

$produto = new Produto($conn);
$cupom = new Cupom($conn);

$_SESSION['product-name'] = 'Placa de Vídeo Asus Dual NVIDIA GeForce RTX 2070 EVO V2 OC Edition, 8GB, GDDR6';


$cupom10 = 'CUPOM10';
$cupom20 = 'CUPOM20';
//unset($_SESSION['qtde_pedido_item']);
//echo '<pre>';
//print_r($_SESSION['qtde_pedido_item']);
//die;
if (!isset($_SESSION['qtde_pedido_item'])) {
    $_SESSION['qtde_pedido_item'] = 1;
    $_SESSION['product-price'] = 2949.90;
    $_SESSION['cupom_uso'] = 0;
    $_SESSION['qtde_pedido_item'] = array();
}

// Verifica se o botão de incremento ou decremento foi clicado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['cupom']) {
        $cupom->setnome_cupom($_POST['cupom']);
        $cupom->loadCupom();
        $_SESSION['desconto_cupom'] = $cupom->getdesconto_cupom();     
    }else if (isset($_POST['incrementar'])) {
        $produto->setid_produto($_POST['id_produto']);
        $produto->incremet();
    } elseif (isset($_POST['decrementar'])) {
        if($_SESSION['qtde_pedido_item'] > 1){
            $produto->setid_produto($_POST['id_produto']);
            $produto->decrement();
        }
    }
}

if(isset($_REQUEST['deletar']) && $_REQUEST['deletar'] === 'ok'){
    unset($_SESSION['qtde_pedido_item']);
    unset($_SESSION['product-price']);
    unset($_SESSION['product-name']);
    unset($_SESSION['cupom_uso']);
}
?>
     
      <div class="main_content">
         <div class="section">
            <div class="container">
               <div class="row">
                  <div class="col-12">
                     <div class="table-responsive shop_cart_table">
                        <table class="table">
                           <thead>
                              <tr>
                                 <th class="product-thumbnail"></th>
                                 <th class="product-name">Produto</th>
                                 <th class="product-price">Preço</th>
                                 <th class="product-quantity">Quantidade</th>
                                 <th class="product-subtotal">Subtotal</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?=$produto->listarHome($url)?>
                               
                               <tr>
                                   <td class="product-name"></td>
                                   <td class="product-name"></td>
                                   <td class="product-name"></td>
                                   <td class="product-name">Desconto</td>
                                   <td class="product-name">R$ <?=$produto->desconto();?></td>
                               </tr>
                               <tr>
                                   <td class="product-name"></td>
                                   <td class="product-name"></td>
                                   <td class="product-name"></td>
                                   <td class="product-name">Total</td>
                                   <td class="product-name">R$ <?=$produto->total();?></td>
                               </tr>
                           </tbody>
                           <tfoot>
                              <tr>
                                 <td colspan="6" class="px-0">
                                    <div class="row no-gutters align-items-center">
                                       <div class="col-lg-12 col-md-12 mb-12 mb-md-12">
                                          <div class="coupon field_form input-group">
                                             <form method="post" action="" class="text-center mt-4">
                                                <input type="text" name="cupom" value="" class="form-control form-control-sm" placeholder="Código do cupom">
                                                <div class="input-group-append">
                                                   <button class="btn btn-fill-out btn-sm" type="submit">Aplicar cupom</button>
                                                </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>
                                 </td>
                              </tr>
                           </tfoot>
                        </table>
                         <a href="http://localhost/ifc/trabalho/login.php" class="btn btn-fill-out">Concluir compra</a>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-12">
                     <div class="medium_divider"></div>
                     <div class="divider center_icon"><i class="ti-shopping-cart-full"></i></div>
                     <div class="medium_divider"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     </body>
</html>