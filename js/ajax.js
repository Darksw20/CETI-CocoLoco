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
function verStock() {
    $(function(){
        $('#buscarStock').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#buscarP').keyup(function(){
            var envio = $('#buscarP').val(); //Se obtiene el valor del input

            $.ajax({
                type: 'POST', //Metodo de envio
                url: 'src/verStock.php', //Lugar a donde se envia la variable
                data: ('verStock='+envio), //Variable que recive el PHP
                success: function(resp) {
                    if(resp != "") {
                        $('#editable_table').html(resp); //Muestra la consulta en el div con el id="verDivStock"
                    }
                }
            })
        })
    })
}
function verGanciasPProducto() {
    $(function(){
        $('#transaccion').submit(function(e){
            e.preventDefault(); //Se previene el envio del formulario
        })

        $('#buscarPGanancia').keyup(function(){
            var envio = $('#buscarPGanancia').val(); //Se obtiene el valor del input

            $.ajax({
                type: 'POST', //Metodo de envio
                url: 'src/transaccion.php', //Lugar a donde se envia la variable
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