$(document).ready(function(){

    //--------------------- SELECCIONAR FOTO PRODUCTO ---------------------
    $("#foto").on("change",function(){
        var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
            if(uploadFoto !='')
            {
                var type = foto[0].type;
                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();
                        
                    }
              }else{
                alert("No selecciono foto");
                $("#img").remove();
              }              
    });

    $('.delPhoto').click(function(){
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();
        if($("#foto_actual") $$ $("#foto_remove")){
            $("#foto_remove").val('img_producto.jpg');
        }
    });



//--------------------- AGREGAR PRODUCTOS CON MODAL ---------------------

    $('.del_product').click(function(e){
        e.preventDefault(); //PREVIENE LAS ACCIONES
        var producto = $(this).attr('product'); //NOS PERMITE ACCEDER A LOS DIFERENTES ATRIBUTOS DE ESE ELEMENTO
        //alert(producto);
        var action = 'infoProducto';
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: {action:action,producto:producto},    
            success: function(response){
                //console.log(response);
                if(response != 'error'){
                    var info = JSON.parse(response);
                    //console.log(info);
                    //$('#producto_id').val(info.codproducto);
                    //$('.nameProducto').html(info.producto);

                    $('.bodyModal').html('<form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct(); ">'+
                                            '<h1><i class="fa-solid fa-dog fa-3x"></i> <br> Agregar Producto</h1>'+
                                            '<br>'+
                                            '<h2 class="nameProducto">'+info.producto+'</h2><br>'+
                                            '<input type="float" name="cantidad" id="textCantidad" placeholder="Cantidad del Producto" required><br>'+
                                            '<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required>'+
                                            '<input type="hidden" name="action" value="addProducto" required>'+
                                            '<div class="alert alertAddProduct"></div>'+
                                            '<button type="submit" class="btn_save"><i class="far fa-save"></i> Agregar</button>'+
                                            '<a href="#" class="btn_ok closeModal" onclick="closeModal();"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</a>'+
                                          '</form>');
                }
            },
            error: function(error){
                console.log(error);
            }
        });
            $('.modal').fadeIn();
        });
});

function sendDataProduct(){
    $('.alertAddProduct').html('');
    //alert("Enviar Datos");

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: $('#form_add_product').serialize(),    
        success: function(response){
            //console.log(response);
            if(response == 'error'){
                $('.alertAddProduct').html('<p style="color: pink;">Error al agregar el Producto</p>');
            }else{
                var info = JSON.parse(response);
                $('.row'+info.producto_id+' .celExistencia').html(info.nueva_existencia);   
                $('#textCantidad').val('');
                $('.alertAddProduct').html('<p>Producto agregado existosamente</p>');
            }
        },
        error: function(error){
            console.log(error);
        }
    });    
}



function closeModal(){
    $('#alertAddProduct').html();
    $('#textCantidad').val('');
    $('.modal').fadeOut();
}