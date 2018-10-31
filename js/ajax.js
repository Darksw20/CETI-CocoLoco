function cerrarMsg() {
    $(function(){
        $('#msg').click(function(){
            $('#msg').hide();
        })
    })
}
function buscarProv() {
    $(function(){
        $('#buscar-proveedor').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#deleteProv').keyup(function(){
            var envio = $('#deleteProv').val(); //Se obtiene el valor del input

            $.ajax({
                type: 'POST', //Metodo de envio
                url: 'src/eliminarUser.php', //Lugar a donde se envia la variable
                data: ('buscarProveedor='+envio), //Variable que recive el PHP
                success: function(resp) {
                    if(resp != "") {
                        $('#ver-buscarProv').html(resp); //Muestra la consulta en el div con el id="ver-buscar"
                    }
                }
            })
        })
    })
}
function buscarUser() {
    $(function(){
        $('#buscar-usuario').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#deleteUser').keyup(function(){
            var envio = $('#deleteUser').val(); //Se obtiene el valor del input

            $.ajax({
                type: 'POST', //Metodo de envio
                url: 'src/eliminarUser.php', //Lugar a donde se envia la variable
                data: ('buscarUser='+envio), //Variable que recive el PHP
                success: function(resp) {
                    if(resp != "") {
                        $('#ver-buscarUser').html(resp); //Muestra la consulta en el div con el id="ver-buscar"
                    }
                }
            })
        })
    })
}
function btnDelProv() {
    var conf = $('#btnDel').val();

    $.ajax({
        type: 'POST',
        url: 'src/eliminarUser.php',
        data: ('btnDel='+conf),
        success: function(resp) {
            if(resp != "") {
                $('#ver-buscarProv').html(resp); //Muestra la consulta en el div con el id="ver-buscar"
            }
        }
    })
}
function btnDelUser() {
    var conf = $('#btnDel').val();

    $.ajax({
        type: 'POST',
        url: 'src/eliminarUser.php',
        data: ('btnDel='+conf),
        success: function(resp) {
            if(resp != "") {
                $('#ver-buscarUser').html(resp); //Muestra la consulta en el div con el id="ver-buscar"
            }
        }
    })
}

//modificarStockAdmin
$(document).ready(function(){
    function fetch_data()
    {
      $('#buscarStock').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#buscarP').keyup(function(){
            var envio = $('#buscarP').val(); //Se obtiene el valor del input

            $.ajax({
                url: 'src/verStockAdmin.php', //Lugar a donde se envia la variable
                method: "POST",
                data: ('verStock='+envio), //Variable que recive el PHP
                success: function(resp) {
                    if(resp != "") {
                        $('#live_data').html(resp); //Muestra la consulta en el div con el id="verDivStock"
                    }
                }
            })
        })

    }
    fetch_data();
	function edit_data(id, text, column_name)
    {
        $.ajax({
            url:"src/editAdmin.php",
            method:"POST",
            data:{id:id, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
      				$('#result').html("<div class='alert alert-success'>"+data+"</div>");
            }
        });
    }
    $(document).on('blur', '.Product_Name', function(){
        var id = $(this).data("id1");
        var Product_Name = $(this).text();
        edit_data(id, Product_Name, "Product_Name");
    });
    $(document).on('blur', '.Lot', function(){
        var id = $(this).data("id2");
        var Lot = $(this).text();
        edit_data(id,Lot, "Lot");
    });
    $(document).on('blur', '.Rate', function(){
        var id = $(this).data("id3");
        var Rate = $(this).text();
        edit_data(id,Rate, "Rate");
    });
    $(document).on('blur', '.Product_Description', function(){
        var id = $(this).data("id4");
        var Product_Description = $(this).text();
        edit_data(id,Product_Description, "Product_Description");
    });
    $(document).on('blur', '.Class', function(){
        var id = $(this).data("id5");
        var Class = $(this).text();
        edit_data(id,Class, "Class");
    });
    $(document).on('blur', '.User_User_Name', function(){
        var id = $(this).data("id6");
        var User_User_Name = $(this).text();
        edit_data(id,User_User_Name, "User_User_Name");
    });
});
//modificarStockAdmin

//modificarStockProveedor
$(document).ready(function(){
    function fetch_data()
    {
      $('#buscarStockProv').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#buscarProdProveedor').keyup(function(){
            var envio = $('#buscarProdProveedor').val(); //Se obtiene el valor del input

            $.ajax({
                url: 'src/verStockProveedor.php', //Lugar a donde se envia la variable
                method: "POST",
                data: ('verStock='+envio), //Variable que recive el PHP
                success: function(resp) {
                    if(resp != "") {
                        $('#live_data_prov').html(resp); //Muestra la consulta en el div con el id="verDivStock"
                    }
                }
            })
        })

    }
    fetch_data();
	function edit_data(id, text, column_name)
    {
        $.ajax({
            url:"src/editProveedor.php",
            method:"POST",
            data:{id:id, text:text, column_name:column_name},
            dataType:"text",
            success:function(data){
                //alert(data);
      				$('#result_prov').html("<div class='alert alert-success'>"+data+"</div>");
            }
        });
    }
    $(document).on('blur', '.Product_Name', function(){
        var id = $(this).data("id1");
        var Product_Name = $(this).text();
        edit_data(id, Product_Name, "Product_Name");
    });
    $(document).on('blur', '.Rate', function(){
        var id = $(this).data("id3");
        var Rate = $(this).text();
        edit_data(id,Rate, "Rate");
    });
    $(document).on('blur', '.Product_Description', function(){
        var id = $(this).data("id4");
        var Product_Description = $(this).text();
        edit_data(id,Product_Description, "Product_Description");
    });
    $(document).on('blur', '.Class', function(){
        var id = $(this).data("id5");
        var Class = $(this).text();
        edit_data(id,Class, "Class");
    });
    $(document).on('blur', '.SubClass', function(){
        var id = $(this).data("id2");
        var Lot = $(this).text();
        edit_data(id,SubClass, "SubClass");
    });
    $(document).on('blur', '.User_User_Name', function(){
        var id = $(this).data("id6");
        var User_User_Name = $(this).text();
        edit_data(id,User_User_Name, "User_User_Name");
    });
});
//modificarStockProveedor

function verGanciasPProducto() {
    $(function(){
        $('#transaccion').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#buscarPGanancia').keyup(function(){
            var envio = $('#buscarPGanancia').val(); //Se obtiene el valor del input

            $.ajax({
                type: 'POST', //Metodo de envio
                url: 'src/transacciones.php', //Lugar a donde se envia la variable
                data: ('verTrans='+envio), //Variable que recive el PHP
                success: function(resp) {
                    if(resp != "") {
                        $('#editable_tableTransaccion').html(resp); //Muestra la consulta en el div con el id="verDivStock"
                    }
                }
            })
        })
    })
}
//onScroll
$(document).ready(function() {

  var limit = 12;
  var start = 0;
  var action = 'inactive';

  function load_country_data(limit, start) {
    $.ajax({
      url: "src/fetch.php",
      type: "POST",
      data: {
        limit: limit,
        start: start
      },
      cache: false,
      success: function(data) {
        $('#load_data').append(data);
        if (data == '') {
          $('#load_data_message').html("<button type='button' class='btn btn-info'>No Data Found</button>");
          action = 'active';
        } else {
          $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait....</button>");
          action = 'inactive';
        }
      }
    });
  }

  if (action == 'inactive') {
    action = 'active';
    load_country_data(limit, start);
  }

  $(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() > $("#load_data").height() && action == 'inactive') {
      action = 'active';
      start = start + limit;
      setTimeout(function() {
        load_country_data(limit, start);
      }, 1000);
    }
  });


});
//onScroll

//carrito
$(document).ready(function(){

	load_cart_data();

	function load_cart_data()
	{
		$.ajax({
			url:"src/fetch_cart.php",
			method:"POST",
			dataType:"json",
			success:function(data)
			{
				$('#cart_details').html(data.cart_details);
				$('.total_price').text(data.total_price);
				$('.badge').text(data.total_item);
			}
		});
	}

	$('#cart-popover').popover({
		html : true,
        container: 'body',
        content:function(){
        	return $('#popover_content_wrapper').html();
        }
	});

	$(document).on('click', '.add_to_cart', function(){
		var product_id = $(this).attr("id");
		var product_name = $('#name'+product_id+'').val();
		var product_price = $('#price'+product_id+'').val();
		var product_quantity = $('#quantity'+product_id).val();
		var action = "add";
		if(product_quantity > 0)
		{
			$.ajax({
				url:"src/action.php",
				method:"POST",
				data:{product_id:product_id, product_name:product_name, product_price:product_price, product_quantity:product_quantity, action:action},
				success:function(data)
				{
					load_cart_data();
				}
			});
		}
		else
		{
		}
	});

	$(document).on('click', '.delete', function(){
		var product_id = $(this).attr("id");
		var action = 'remove';
		if(confirm("Estas seguro de querer eliminar este producto?"))
		{
			$.ajax({
				url:"src/action.php",
				method:"POST",
				data:{product_id:product_id, action:action},
				success:function()
				{
					load_cart_data();
					$('#cart-popover').popover('hide');
				}
			})
		}
		else
		{
			return false;
		}
	});

	$(document).on('click', '#clear_cart', function(){
		var action = 'empty';
		$.ajax({
			url:"src/action.php",
			method:"POST",
			data:{action:action},
			success:function()
			{
				load_cart_data();
				$('#cart-popover').popover('hide');
				alert("Tu carrito se ha vaciado");
			}
		});
	});

});
//carrito

//yocho
function myFunction() {
  document.getElementById("myForm").reset();
}

function buscarProd() {
    $(function(){
        $('#buscarDelProducto').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })


        $('#buscarDelProd').keyup(function(){
            var envio = $('#buscarDelProd').val();
            $.ajax({
                method: "POST", //Metodo de envio
                url: 'src/eliminarProducto.php',
                data: ('findProd=' + envio), //Variable que recive el PHP
                success: function(resp) {
                    if(resp != "") {
                        $('#ver-resultadoDelProd').html(resp); //Muestra la consulta en el div con el id="ver-resultadoProd"
                    }
                }
            })
        })
    })
}

//Agregar producto Inicio
function btnAddProd() {
    $('#addProdBtn').click(function(e){
        e.preventDefault(); //Se previene el envio del formulario
    })

    var form = document.querySelector('form');

    var request = new XMLHttpRequest();
    var formData = new FormData(form);

    var aux = $('#catProd').val();
    var aux2 = $('#subcatProd').val();
    var v3 = '';
    var v4 = '';
    if(aux == 'newCat') {
        v3 = $('#otherCat').val();
    } else {
        v3 = $('#catProd').val();
    }
    if(aux2 == 'newSubCat') {
        v4 = $('#otherSubCat').val();
    } else {
        v4 = $('#subcatProd').val();
    }

    var v1 = $('#nameProd').val();
    var v2 = $('#priceProd').val();
    var v5 = $('#descriptProd').val();
    var v6 = $('#provProd').val();

    formData.append('nameProd', v1);
    formData.append('priceProd', v2);
    formData.append('catProd', v3);
    formData.append('subcatProd', v4);
    formData.append('descriptProd', v5);
    formData.append('provProd', v6);

    request.open('post', 'src/agregarProducto.php', true);
    request.send(formData);
    request.onreadystatechange = function() {
        if (this.readyState === 4 || this.status === 200){
            $('#result').html(request.responseText);
            //$('#ver-resultadoAddProd').html(request.responseText);
        }
    };
}

function optionfnt(varDiv) {
    var valor = document.getElementById("catProd").value;
    var valor2 = document.getElementById("subcatProd").value;
    div = document.getElementById(varDiv);
    if(varDiv == "ver-otcat") {
      if(valor == "newCat") {
        div.style.display = "block";
      } else {
        div.style.display = "none";
      }
    } else {
      if(valor2 == "newSubCat") {
        div.style.display = "block";
      } else {
        div.style.display = "none";
      }
    }
}
//yocho

//buscador Benja
//Funcion para obtener datos de productos
function obtener_registros(stocktaking){
//definir de donde tomar datos y como ("espesificaciones")
$.ajax({
  url : 'src/consulta.php',
  type : 'POST',
  dataType : 'html',
  data : { stocktaking: stocktaking },
  })
//pasar los datos
.done(function(resultado){
  $("#load_data").html(resultado);//impresion en el section de html
})
}
//realizar la busqueda con el id busqueda desde el input
$(document).on('keyup', '#busqueda', function(){
var valorBusqueda=$(this).val();
if (valorBusqueda!=""){
  obtener_registros(valorBusqueda);
}
else{
    obtener_registros();
  }
});

//Pedro Miguel Elguera Mora
//Como evitar doble sesion


setInterval('sesiondoble()',5000); //ejecuto la funcion cada 5 segundos


// de manera asincrona mando a ejutar un codigo php donde revisa los tados de la variable de sesion
//el nombre de usuario y el Id_de la sesion correspondan, si no es asi entonces significa que alguien 
//mas ya inicio sesion y es necesario cerrar la sesion
function sesiondoble(){
    
    $.ajax({        
        url : 'src/doblesesion.php',
        type : 'POST',
        dataType : 'html',
        success:function(data)
				{
					if(data=='false'){
                        alert ('Tu sesion a Caducado');  
                        location.href ="src/proces-unlgn.php";
                    }
				}
    })
}


//buscador Benja


//PANEL ADMIN

//PANEL ADMIN
