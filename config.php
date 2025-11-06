<?php
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="mi-base-de-datos";
    $dbtype="mysql";
    $dbport=3306;

    try{
        $db = new PDO($dbtype.':host='.$dbhost.';dbname='.$dbname.';port='.$dbport, $dbuser, $dbpass);
    }catch(Exception $e){
        header("HTTP/1.0 444 Not Found");
        die("Error 444 No hay conexión a la bbdd");
    }

    
    define('SITE_NAME', 'REBUShop');
    define('PHONE', '622173633');

    define('PAGINADO', 8);
?>