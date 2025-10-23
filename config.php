<?php
    $dbhost="10.0.9.14";
    $dbuser="clase";
    $dbpass="clase";
    $dbname="segundamano";
    $dbtype="mysql";

    //mysql:host=10.0.9.14;dbname=segundamano
    //usuario
    //contraseña

    try{
        $db = new PDO($dbtype.':host='.$dbhost.';dbname='.$dbname, $dbuser, $dbpass);
    }catch(Exception $e){
        header("HTTP/1.0 444 Not Found");
        die("Error 444 No hay conexión a la bbdd");
    }

        define('SITE_NAME', 'REBUShop');

        define('PAGINADO', 10);

?>