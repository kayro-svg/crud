<?php
$passwd = "";
$usuario = "root";
$bdproyecto = "bdproyecto";
try{
    $bd = new PDO (
        'mysql:host=localhost; 
        dbname='.$bdproyecto, 
        $usuario, 
        $passwd, 
        array(PDO:: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );

} catch (Exception $e){
    echo "Ocurrió un problema al realizar la conexión: " . $e->getMessage();
}
?>