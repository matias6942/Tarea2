
<!--
/**
* Created by PhpStorm.
* User: matias
* Date: 4/28/18
* Time: 11:23 PM
*/
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reciclaje - Home</title>
</head>
<body>


<h1>Esta Página es el Menú Inicial</h1>
<h2>Listado con los 5 últimos artículos Ingresados</h2>

<!--Tabla de 5 articulos-->
<?php

$host = "127.0.0.1";
$username = "client";
$password = "gYzlLqRJEQQi0j0E";
$db = "tarea2";
$port = "3306";

// Create connection
$conn = new mysqli($host, $username, $password, $db);

// Check connection
if ($conn -> connect_error){
    die("Connection Failed ". $conn->connect_error);
}

echo "Connected Successfully<br><br>";

/**
// Insert a row to the DB
$sql =  "INSERT INTO articles VALUES ('2018-11-23', 'Pantalla Plasma', 'Metropolitana', 'Santiago Centro', 2, 3, '1lzamora2009@gmail.com')";

if ($conn->query($sql) === TRUE){
    echo "Values Inserted Succesfully";
}

else{
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close Connection
$conn -> close();
echo "Connection Closed<br>";
*/


echo "Starting Query...<br><br>";

//$sql = "SELECT id, nombre, descripcion, fecha_ingreso, comuna_entrega, calle_numero, nombre_contacto, email_contacto, fono_contacto FROM articulo ORDER BY id DESC LIMIT 5";
$sql = "SELECT * FROM articulo ORDER BY id DESC LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0){

    echo "<table style=\"width: 100%\">
            <tr>
                <th>Fecha de Ingreso</th>
                <th>Artículo</th>
                <th>Región</th>
                <th>Comuna</th>
                <th>N° Comentarios</th>
                <th>N° Fotos</th>
                <th>Email de Contacto</th>
            </tr>";


    while ($row = $result->fetch_assoc()){
        echo "<tr><td>" . $row["fecha_ingreso"] . "</td><td>" . $row["nombre"] . "</td><td>" .
            //"<td></td>" . $row["region"] . "<td></td>" . $row["comuna"] .
            //"<td></td>" . $row["commentsQuantity"] . "<td></td>" . $row["photosQuantity"] .
            "</td><td>" . $row["email_contacto"] . "</td></tr>";
    }

    echo "</table>";
}

else {
    echo "0 Results!";
}

$conn->close();
echo "<br><br>Finish!"

?>


<!--
<br>
<br>
<form action="AddArticle.html">
    <input type="submit" value="Informar Nuevo Artículo">
</form>
-->

</body>

</html>



