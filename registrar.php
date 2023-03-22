<?php
    if(empty($_POST["oculto"]) || empty($_POST["txtcategoria"]) || empty($_POST["txtproducto"]) || 
    empty($_POST["txtprecio"]) || empty($_POST["txtcantidad"]) || empty($_POST["txtcodigo"]))
    {
        header('Location: index.php?mensaje=falta');
        exit();
    }
    include_once 'model/conexion.php';
    $categoria = $_POST["txtcategoria"];
    $producto = $_POST["txtproducto"];
    $precio = $_POST["txtprecio"];
    $cantidad = $_POST["txtcantidad"];
    $codigo = $_POST["txtcodigo"];
    $sentencia = $bd->prepare("INSERT INTO productos(categoria, producto, precio, cantidad, codigo) VALUES (?,?,?,?,?);");
    $resultado = $sentencia->execute([$categoria, $producto, $precio, $cantidad, $codigo]);

    if ($resultado == TRUE) {
        header('Location: index.php?mensaje=registrado');
    } else {
        header('Location: index.php?mensaje=error');
        exit;
    }
