<!-- TO ESTABLISH CONNECTION TO THE DATABASE -->

<?php
    $serverName = "DESKTOP-89AMREU\SQLEXPRESS";
    $connectionOptions = array(
        "Database" => "dbKadugo",
        "Uid" => "",
        "PWD" => ""
    );

    $conn = sqlsrv_connect($serverName, $connectionOptions);

    if(!$conn){
        die(print_r(sqlsrv_errors(), true));
    }
?>