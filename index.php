<?php include 'template/header.php' ?> <!--Encabezado-->

<?php //Consulta para la base de datos, pidiendo los datos de la tabla productos
include_once "model/conexion.php"; 
//Inclusión del formulario de conexión a la base de datos
$sentencia = $bd->query("select * from productos ORDER BY id ASC;"); 
//A la variable $sentencia se le asigna el Query o consulta a la base de datos.
$productos = $sentencia->fetchAll(PDO::FETCH_OBJ); 
//A la variable $productos se le asigna la variable $sentencia, quien está funcionando como array (de los productos) armado a través de la función fetchALL.
//fetchAll: devuelve un array que contiene todas las filas de tabla productos.
?>
<div class="container mt-5 ">
<!--div contenedor de los dos formularios (Lista de productos y edición de datos) y los mensajes de alerta.-->

    <div class="row justify-content-center">
    <!--div con clase de fila (row) donde se encontrará los dos formularios (Lista de productos y edición de datos)-->

        <div class="col-md-7">
        <!--div que contiene la primera columna (mensajes de alerta y Lista de productos)-->

               <!--inicio de alertas-->

            <!--Alerta de falta de datos en el formulario-->
            <?php if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'falta') {  ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Llena todos los campos del formulario!</strong> Debes llenar todos los campos del formulario para poder registrar los productos exitosamente.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!--Alerta de exito de registro -->
            <?php if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'registrado') { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Registro exitoso!</strong> El producto se registró exitosamente ;)
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!--Alerta de control de modulos -->
            <?php if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'error') {  ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> Vuelve a intentarlo ;)
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!--Alerta-Mensaje de edición de datos-->
            <?php if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'editado') { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Tabla actualizada</strong> Sus datos se actualizaron con éxito ;)
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!--Alerta-Mensaje de eliminación de datos-->
            <?php if (isset($_GET['mensaje']) and $_GET['mensaje'] == 'eliminado') { ?>
                  <!--Condición: si la variabe 'mensaje' es igual al 'eliminado' entonces se ejecutará la alerta-mensaje -->

                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      <!--div que contiene la alerta de datos eliminados-->
                    <strong>Eliminado!</strong> Sus datos se eliminaron con éxito.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <!--fin de alertas-->
            <br><br>
            <!--Inicio Tabla de productos-->
            <div class="card p-3 mb-2 bg-dark text-white">
                <div class="card-header">
                    <h5 class="text-center"> Lista de productos </h5>
                </div>
                <div class="p-4">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover align-middle">
                            <thead>
                                <tr>
                                <!--Columnas o encabezado de la tabla de la lista de productos-->
                                    <th scope="col">#</th>
                                    <th scope="col">Categoría</th>
                                    <th scope="col">Producto</th>
                                    <th scope="col">Precio x unidad</th>
                                    <th scope="col">Cant. Disponible</th>
                                    <th scope="col">Código</th>
                                    <th scope="col" colspan="2">Opciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                                <?php
                                foreach ($productos as $dato) { 
                                //Asignación de $productos a la variable $dato, con el fin de imprimir los datos de la base de datos en la tabla
                                ?>
                                    <tr>
                                    <!--Filas de la tabla (datos de la tabla productos de la base de datos bdproyecto)-->
                                        <th scope="row"> <?php echo $dato->id; ?> </th>
                                        <td> <?php echo $dato->categoria; ?> </td>
                                        <td> <?php echo $dato->producto; ?> </td>
                                        <td> <?php echo $dato->precio; ?> $</td>
                                        <td> <?php echo $dato->cantidad; ?> </td>
                                        <td> <?php echo $dato->codigo; ?> </td>

                                        <td><a onclick="return confirm('Editar: ¿Estas seguro de modificar los datos este producto?');" 
                                        class="text-warning" href="editar.php?id=<?php echo $dato->id; ?>"> 
                                        <i class="bi bi-pencil-square"></i> </a></td>

                                        <td><a onclick="return confirm('Eliminar: ¿Estas seguro de eliminar este producto?');" 
                                        class="text-danger" href="eliminar.php?id=<?php echo $dato->id; ?>"> 
                                        <i class="bi bi-trash"></i> </a></td>
                                        <!--echo $dato->categoria; = Asignación del dato de la tabla produtos a la variable $dato-->
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--Fin de Tabla de productos-->

        <!--Inicio Tabla de ingreso de datos-->
        <div class="col-md-4 ">
            <br><br>
            <div class="card p-3 mb-2 bg-secondary text-white ">
                <div class="card-header">
                    <h5 class="text-center"> Ingresar datos </h5>
                </div>
                <form class="p-4" method="POST" action="registrar.php">
                    <div class="mb-3">
                        <label class="form-label fs-6">Categoría:</label>
                        <input type="text" class="form-control" name="txtcategoria" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-6">Producto:</label>
                        <input type="text" class="form-control" name="txtproducto" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-6">Precio x unidad:</label>
                        <input type="text" class="form-control" name="txtprecio" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-6">Cantidad disponible:</label>
                        <input type="number" class="form-control" name="txtcantidad" autofocus required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fs-6">Código:</label>
                        <input type="text" class="form-control" name="txtcodigo" autofocus required>
                    </div>
                    <div class="d-grid">
                        <input type="hidden" name="oculto" value="1">
                        <input type="submit" class="btn btn-success fs-5" value="Registrar">
                    </div>
                </form>
            </div>
        </div>
        <!--Fin Tabla de ingreso de datos-->
    </div>
</div>
<br><br> <br><br>
<?php include 'template/footer.php' ?>