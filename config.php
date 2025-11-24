<?php
    $dbhost="localhost";
    $dbuser="root";
    $dbpass="";
    $dbname="segundamano";
    $dbtype="mysql";
    $dbport=3306;

    try{
        $db = new PDO($dbtype.':host='.$dbhost.';dbname='.$dbname.';port='.$dbport, $dbuser, $dbpass);
    }catch(Exception $e){
        // header("HTTP/1.0 444 No ecncontrado"); // Comentamos esto
        die("Error Real: " . $e->getMessage()); // ¡Mostramos el mensaje del sistema!
    }

    
    define('SITE_NAME', 'REBUShop');
    define('PHONE', '622173633');

    define('PAGINADO', 8);
?>