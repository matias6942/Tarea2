<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 5/7/18
 * Time: 6:02 AM
 */


/**
 * Creates a connection to apache web server and returns the result of a query.
 *
 * @param string $sql [required] SQL Query
 * @return Query Result
 *
 */

function queryResult($sql){

    $host = "127.0.0.1";
    $username = "client";
    $password = "gYzlLqRJEQQi0j0E";
    $db = "tarea2";

// Create connection
    $conn = new mysqli($host, $username, $password, $db);
    mysqli_set_charset($conn,"utf8");

// Check connection
    if ($conn -> connect_error){
        die("Connection Failed: ". $conn->connect_error);
    }

    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

/**
 * Delete spaces at the begining and at the end, delete backslashes
 * and prevents Cross-site Scripting attacks.
 * @param $data User Input
 * @return string Sanitized User Input
 */

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


?>