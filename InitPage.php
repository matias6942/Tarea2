
<!--
/**
* Created by PhpStorm.
* User: matias
* Date: 4/28/18
* Time: 11:23 PM
*/
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset="utf-8">
    <title>Reciclaje - Home</title>
</head>
<body>


<h1>Esta Página es el Menú Inicial</h1>
<h2>Listado con los 5 últimos artículos Ingresados</h2>

<!--Tabla de 5 articulos-->
<?php

ini_set("default_charset", "UTF-8");

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

    echo "Connected Successfully to MySQL DataBase<br><br>";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

if(isset($_POST["next5Articles"])){
    $counter = $_POST["counter"];
    $counter++;
    $index = $counter*5;
    $sql = "SELECT articulo.nombre AS articulo_nombre, fecha_ingreso, region.nombre AS region_entrega,
        comuna.nombre AS comuna_entrega, email_contacto,
        (SELECT COUNT(comentario.comentario) FROM comentario) AS commentsQuantity, (SELECT COUNT(fotografia.id) FROM fotografia) AS photosQuantity
        FROM articulo, comuna, region
        WHERE articulo.comuna_id = comuna.id AND comuna.region_id = region.id
        ORDER BY articulo.id DESC LIMIT " . $index . ", 5";
    $result = queryResult($sql);
}

elseif (isset($_POST["previous5Articles"])){
    $counter = $_POST["counter"];
    $counter--;
    if ($counter < 0){
        $counter = 0;
    }
    $index = $counter*5;
    $sql = "SELECT articulo.nombre AS articulo_nombre, fecha_ingreso, region.nombre AS region_entrega,
        comuna.nombre AS comuna_entrega, email_contacto,
        (SELECT COUNT(comentario.comentario) FROM comentario) AS commentsQuantity, (SELECT COUNT(fotografia.id) FROM fotografia) AS photosQuantity
        FROM articulo, comuna, region
        WHERE articulo.comuna_id = comuna.id AND comuna.region_id = region.id
        ORDER BY articulo.id DESC LIMIT " . $index . ", 5";
    $result = queryResult($sql);
}

else{
    $sql = "SELECT articulo.nombre AS articulo_nombre, fecha_ingreso, region.nombre AS region_entrega, comuna.nombre AS comuna_entrega, email_contacto,
        (SELECT COUNT(comentario.comentario) FROM comentario) AS commentsQuantity, (SELECT COUNT(fotografia.id) FROM fotografia) AS photosQuantity
        FROM articulo, comuna, region
        WHERE articulo.comuna_id = comuna.id AND comuna.region_id = region.id
        ORDER BY articulo.id DESC LIMIT 5";
    $counter = 0;
    $result = queryResult($sql);
}

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
        $fecha = preg_split( "/[\s]+/" ,$row["fecha_ingreso"])[0];

        echo "<tr><td>" . $fecha . "</td><td>" . $row["articulo_nombre"] . "</td>" .
            "<td>" . $row["region_entrega"] . "</td><td>" . $row["comuna_entrega"] . "</td>" .
            "<td>" . $row["commentsQuantity"] . "</td><td>" . $row["photosQuantity"] . "</td>" .
            "</td><td>" . $row["email_contacto"] . "</td></tr>";
    }
    echo "</table>";
}

else {
    echo "0 Results!";
}

echo "<form action='InitPage.php' method='post'>
        <input type='hidden' name='counter' value=$counter>
        <input type='submit' name='next5Articles' value='5 Siguientes'><br>
</form>";

echo "<form action='InitPage.php' method='post'>
        <input type='hidden' name='counter' value=$counter>
        <input type='submit' name='previous5Articles' value='5 Anteriores'><br>
</form>";

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


