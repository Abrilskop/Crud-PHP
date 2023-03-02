$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
        "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Editar</button><button class='btn btn-danger btnBorrar'>Borrar</button></div></div>"  
        }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    codigo = parseInt(fila.find('td:eq(0)').text());
    nombres = fila.find('td:eq(1)').text();
    almacen = fila.find('td:eq(2)').text();
    producto = fila.find('td:eq(3)').text();
    cantidad = parseInt(fila.find('td:eq(4)').text());
    tipo_de_venta = fila.find('td:eq(5)').text();
    tipo_de_comprobante = fila.find('td:eq(6)').text();
    precio = parseInt(fila.find('td:eq(7)').text());

    $("#nombre").val(nombres);
    $("#almacen").val(almacen);
    $("#producto").val(producto);
    $("#cantidad").val(cantidad);
    $("#tipo_de_venta").val(tipo_de_venta);
    $("#tipo_de_comprobante").val(tipo_de_comprobante);
    $("#precio").val(precio);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    nombres = $.trim($("#nombres").val());
    almacen = $.trim($("#almacen").val());
    producto = $.trim($("#producto").val());
    cantidad = $.trim($("#cantidad").val()); 
    tipo_de_venta = $.trim($("#tipo_de_venta").val());
    tipo_de_comprobante = $.trim($("#tipo_de_venta").val()); 
    precio = $.trim($("#precio").val());    
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {nombres:nombres, codigo:codigo, almacen:almacen, producto:producto, cantidad:cantidad, tipo_de_venta:tipo_de_venta, tipo_decomprobante:tipo_de_comprobante, precio:precio},
        success: function(data){  
            console.log(data);
            codigo = data[0].codigo;            
            nombres = data[0].nombres;
            almacen = data[0].almacen;
            producto = data[0].producto;
            cantidad = data[0].cantidad;
            tipo_de_venta = data[0].tipo_de_venta;
            tipo_de_comprobante = data[0].tipo_de_comprobante;
            precio = data[0].precio;
            if(opcion == 1){tablaPersonas.row.add([codigo,nombres,almacen,cantidad, producto,tipo_de_venta,tipo_de_comprobante,precio]).draw();}
            else{tablaPersonas.row(fila).data([codigo,nombres,almacen,cantidad, producto,tipo_de_venta,tipo_de_comprobante,precio]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
    
});    
    
});