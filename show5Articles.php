
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
$password = "";
$db = "articleList";
$port = "3306";

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn -> connect_error){
    die("Connection failed! ". $conn->connect_error);
}

echo "Connected Successfully";



/**

$sql = "SELECT * FROM articles";
$result = $conn->query($sql);


if ($result->num_rows > 0){
    while ($row = $result->fetch_assoc()){
        echo "<tr><td>" . $row["date"] . "</td><td>" . $row["article"] .
            "<td></td>" . $row["region"] . "<td></td>" . $row["comuna"] .
            "<td></td>" . $row["commentsQuantity"] . "<td></td>" . $row["photosQuantity"] .
            "<td></td>" . $row["mail"];
    }
    echo "</table>";
}

else {
    echo "0 Results!";
}
$conn->close();
echo "Finish!"
 */
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



