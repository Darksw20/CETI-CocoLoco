<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../css/bootstrap 4/bootstrap.css">
    <link rel="stylesheet" href="../css/bootstrap 4/adicional.css">
    <link href="../css/uikit.css" rel="stylesheet" type="text/css" />
    <link href="../css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="../js/ajax.js" charset="utf-8"></script>
  </head>
  <body>


    <?php

    //fetch_cart.php

    session_start();

    $total_price = 0;
    $total_item = 0;

    $output = '
      <div class="container" style = "padding-top: 3rem;">
        <div class="card shadow-lg">
        <div class="card-header bg-primary">
          <h4 class="card-title text-light">Tu orden de pago prro :v</h4>
        </div>
          <div class="card-body">
            <div class="table-responsive" id="order_table">
            	<table class="table">
            		<tr>
                    <th scope="col">Nombre del producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Total</th>
                </tr>
    ';
    if(!empty($_SESSION["shopping_cart"])){
    	foreach($_SESSION["shopping_cart"] as $keys => $values){
    		$output .= '
    		<tr>
    			<td>'.$values["product_name"].'</td>
    			<td>'.$values["product_quantity"].'</td>
    			<td align="right">$ '.$values["product_price"].'</td>
    			<td align="right">$ '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>
    		</tr>
    		';
    		$total_price = $total_price + ($values["product_quantity"] * $values["product_price"]);
    		$total_item = $total_item + 1;
    	}
    	$output .= '
    	    <tr>
            <td colspan="3" align="right" class"text-succes">Total</td>
            <td align="right">$ '.number_format($total_price, 2).'</td>
          </tr>
    	';
    }
    else{
    	$output .= '
        <tr>
        	<td align="center">
        		¡Tu carrito está vacio!
        	</td>
        </tr>
        ';
    }
    $output .= '   </table>
                  </div>
                </div>
                <div class="card-footer">
                  <div class = "row justify-content-end">
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-success">Paga prro</button>
                      <a href="departamentos.php" class="btn btn-primary">Seguir comprando</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>';
    $data = array(
    	'cart_details'		=>	$output,
    	'total_price'		=>	'$' . number_format($total_price, 2),
    	'total_item'		=>	$total_item
    );

    echo $output;


    ?>

    <div id="popover_content_wrapper" style="display: none">
    </div>

  </body>
</html>
