<?php
include_once '/bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$consulta = "SELECT codigo, nombres, almacen, producto, cantidad, tipo_de_venta, tipo_de_comprobante, precio FROM registro_de_ventas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="#" />  
        <title>Registro de Ventas</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <!-- CSS personalizado --> 
        <link rel="stylesheet" href="main.css">

        <!--datables CSS básico-->
        <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
        <!--datables estilo bootstrap 4 CSS-->  
        <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">
    </head>
    
    <body> 
        <header>
    <!--         <h3 class="text-center text-light">Tutorial</h3>-->
            <h4 class="text-center text-light">Registro de <span class="badge badge-danger">VENTAS</span></h4> 
        </header>    
        
        <div class="container">
            <div class="row">
                <div class="col-lg-12">            
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
                </div>    
            </div>    
        </div>    
        <br>  
        <div class="container">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">        
                            <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                            <thead class="text-center">
                                <tr>
                                    <th>Codigo</th>
                                    <th>Nombres</th>
                                    <th>Almacen</th> 
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Tipo de Venta</th>                                
                                    <th>Tipo de Comprobante</th>  
                                    <th>Precio</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php                            
                                foreach($data as $dat) {                                                        
                                ?>
                                <tr>
                                    <td><?php echo $dat['codigo'] ?></td>
                                    <td><?php echo $dat['nombre'] ?></td>
                                    <td><?php echo $dat['Almacen'] ?></td>
                                    <td><?php echo $dat['producto'] ?></td>    
                                    <td><?php echo $dat['cantidad'] ?></td>
                                    <td><?php echo $dat['tipo_de_venta'] ?></td> 
                                    <td><?php echo $dat['tipo_de_comprobante'] ?></td>
                                    <td><?php echo $dat['precio'] ?></td>
                                    <td></td>
                                </tr>
                                <?php
                                    }
                                ?>                                
                            </tbody>        
                        </table>                    
                        </div>
                    </div>
            </div>  
        </div>    
        
<!-- Ventana Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">

                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre">
                </div>

                <div class="form-group">
                <label for="almacen" class="col-form-label">Almacen:</label>
                <input type="text" class="form-control" id="almacen">
                </div>

                <div class="form-group">
                <label for="producto" class="col-form-label">Producto:</label>
                <input type="number" class="form-control" id="producto">
                </div>

                <div class="form-group">
                <label for="cantidad" class="col-form-label">Cantidad:</label>
                <input type="number" class="form-control" id="cantidad">
                </div>

                <div class="form-group">
                <label for="nombre" class="col-form-label">Tipo de Venta:</label>
                <input type="number" class="form-control" id="tipo_de_venta">
                </div>

                <div class="form-group">
                <label for="nombre" class="col-form-label">Tipo de Venta:</label>
                <input type="text" class="form-control" id="tipo_de_venta">
                </div>

                <div class="form-group">
                <label for="nombre" class="col-form-label">Tipo de Comprobante:</label>
                <input type="text" class="form-control" id="tipo_de_comprobante">
                </div>
                
                <div class="form-group">
                <label for="precio" class="col-form-label">Precio:</label>
                <input type="number" class="form-control" id="precio">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>

        <!-- jQuery, Popper.js, Bootstrap JS -->
        <script src="jquery/jquery-3.3.1.min.js"></script>
        <script src="popper/popper.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
        <!-- datatables JS -->
        <script type="text/javascript" src="datatables/datatables.min.js"></script>    
        
        <script type="text/javascript" src="main.js"></script>  
        
        
    </body>
</html>
