<?php include 'template/header.php' ?> 
<?php
    if(!isset($_GET['id'])){
        header('Location: index.php?mensaje=error');
        exit();
    }
    include_once 'model/conexion.php';
    $id = $_GET['id'];

    $sentencia = $bd->prepare("select * from productos where id = ?");
    $sentencia->execute([$id]);
    $categoria = $sentencia->fetch(PDO::FETCH_OBJ);

?>
<div class="container mt-5 ">
    <div class="row justify-content-center ">
        <div class="col-md-4">
        <div class="card p-3 mb-2 bg-secondary text-white">
                <div class="card-header text-center fs-4">
                    Editar datos
                </div>
                <form class="p-4" method="POST" action="editarproceso.php">
        <div class="mb-3">
            <label class="form-label fs-5">Categoría: </label>
            <input type="text" class="form-control" name="txtcategoria" required value="<?php echo $categoria->categoria;?>">
        </div>

        <div class="mb-3">
            <label class="form-label fs-5">Producto: </label>
            <input type="text" class="form-control" name="txtproducto" required value="<?php echo $categoria->producto;?>">
        </div>
        <div class="mb-3">
            <label class="form-label fs-5">Precio x unidad: </label>
            <input type="text" class="form-control" name="txtprecio" required value="<?php echo $categoria->precio . " $" ;?>">
        </div>
        <div class="mb-3">
            <label class="form-label fs-5">Cantidad disponible: </label>
            <input type="number" class="form-control" name="txtcantidad" required value="<?php echo $categoria->cantidad;?>">
        </div>
        <div class="mb-3">
            <label class="form-label fs-5">Código: </label>
            <input type="text" class="form-control" name="txtcodigo" required value="<?php echo $categoria->codigo;?>">
        </div>
        <div class="d-grid">
            <input type="hidden" name="id" value="<?php echo $categoria->id;?>">
            <input type="submit" class="btn btn-primary fs-5" value="Editar">
        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br><br><br><br><br><br>


<?php include 'template/footer.php' ?> 