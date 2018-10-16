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
$(document).ready(function(){
    function fetch_data()
    {
      $('#buscarStock').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#buscarP').keyup(function(){
            var envio = $('#buscarP').val(); //Se obtiene el valor del input

            $.ajax({
                url: 'src/verStock.php', //Lugar a donde se envia la variable
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
            url:"src/edit.php",
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
