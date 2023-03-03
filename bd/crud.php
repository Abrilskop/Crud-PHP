<?php
    include_once 'conexion.php';
    $objeto = new Conexion();
    $conexion = $objeto->Conectar();

    // Recepción de los datos enviados mediante POST desde el JS   

    $nombres = (isset($_POST['nombres'])) ? $_POST['nombres'] : '';
    $almnacen = (isset($_POST['almacen'])) ? $_POST['almacen'] : '';
    $cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
    $opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
    $codigo = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';
    $tipo_de_venta = (isset($_POST['tipo_de_venta'])) ? $_POST['tipo_de_venta'] : '';
    $tipo_de_comprobante = (isset($_POST['tipo_de_comprobante'])) ? $_POST['tipo_de_comprobante'] : '';
    $precio = (isset($_POST['precio'])) ? $_POST['cprecio'] : '';
    $producto = (isset($_POST['codigo'])) ? $_POST['codigo'] : '';

    switch($opcion){
        case 1: //alta
            $consulta = "INSERT INTO personas (nombres,almacen,cantidad, producto,tipo_de_venta,tipo_de_comprobante,precio) VALUES('$nombres', '$almacen', '$cantidad', '$producto', '$tipo_de_venta','$tipo_de_comprobante','$precio' ) ";			
            $resultado = $conexion->prepare($consulta);
            $resultado->execute(); 

            $consulta = "SELECT codigo,nombres,almacen,cantidad, producto,tipo_de_venta,tipo_de_comprobante,precio FROM personas ORDER BY codigo DESC LIMIT 1";
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 2: //modificación
            $consulta = "UPDATE personas SET nombres='$nombres', almacen='$almacen', cantidad='$cantidad', producto='$producto', tipo_de_venta='$tipo_de_venta', tipo_de_comprobante='$tipo_de_comprobante', precio='$precio' WHERE codigo='$codigo' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();        
            
            $consulta = "SELECT codigo,nombres,almacen,cantidad, producto,tipo_de_venta,tipo_de_comprobante,precio FROM personas WHERE codigo='$codigo' ";       
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();
            $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
            break;        
        case 3://baja
            $consulta = "DELETE FROM personas WHERE codigo='$codigo' ";		
            $resultado = $conexion->prepare($consulta);
            $resultado->execute();                           
            break;        
    }

    print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
    $conexion = NULL;
?>