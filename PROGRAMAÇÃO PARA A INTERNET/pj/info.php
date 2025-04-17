<?php
function qdbcoon(){
    $host = 'localhost';
    $user ='root';
    $pass = ''; 
    $db = 'pj'; 
    $port = 3306; 
    $charset = 'utf8mb4'; 

    $link = mysqli_connect($host, $user, $pass, $db, $port);
    if (!$link) {
        error_log(mysqli_connect_error(), 3, 'error.log');        
    }
}
qdbcoon();
?>