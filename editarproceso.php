<?php

    print_r($_POST);

    if(!isset($_POST['id'])){
        header('Location: index.php?mensaje=error'); 
    }

    include 'model/conexion.php';
    $id = $_POST['id'];
    $categoria = $_POST['txtcategoria'];
    $producto = $_POST['txtproducto'];
    $precio = $_POST['txtprecio'];
    $cantidad = $_POST['txtcantidad'];
    $codigo = $_POST['txtcodigo'];

    $sentencia = $bd->prepare("UPDATE productos SET categoria = ?, producto = ?, precio = ?, cantidad = ?, codigo = ? where id = ?;");
    $resultado= $sentencia->execute([$categoria,$producto,$precio,$cantidad,$codigo,$id]);

    if ($resultado == TRUE) {
        header('Location: index.php?mensaje=editado');
    } else {
        header('Location: index.php?mensaje=error');
    }
    
?>