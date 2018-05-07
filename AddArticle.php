<!DOCTYPE HTML>
<html lang="es">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset="utf-8">
    <title>Reciclaje - Agregar</title>
    <style>
        .error {
            color: #FF0000;}
    </style>
</head>
<body>
<script src="ValidationScripts.js"></script>
<h1>Ingrese un Nuevo Artículo</h1>

<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 5/6/18
 * Time: 11:59 PM
 */

include 'phpFunctions.php';

$nombreArticuloErr = $descripcionArticuloErr = $regionErr = $comunaErr =
$calleErr = $nombreContactoErr = $emailErr = $fonoErr = "";

$nombreArticulo = $descripcionArticulo = $region = $comuna = $calle =
    $nombreContacto = $email = $fono = "";


if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $bFormIsFine = false;

    $bnombreArticuloIsFine = false;
    $bdescripcionIsFine = true;
    $regionIsFine = false;
    $bcomunaIsFine = false;
    $bcalleIsFine = false;
    $bnombreContactoIsFine = false;
    $bemailIsFine = false;
    $fonoIsFine = true;

    if (empty($_POST["nombre-articulo"])){
        $nombreArticuloErr = "Ingrese un nombre para el artículo!";
    } else{
        $nombreArticulo = test_input($_POST["nombre-articulo"]);
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñüÜ ]*$/", $nombreArticulo)){
            $nombreArticuloErr = "Solo se permiten letras y espacios en blanco!";
        } else{
            $bnombreArticuloIsFine = true;

        }
    }

    if (empty($_POST["descripcion-articulo"])){
        $descripcionArticulo = "";
    } else{
        $descripcionArticulo = test_input($_POST["descripcion-articulo"]);
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñüÜ0-9 ]*$/", $descripcionArticulo)){
            $bdescripcionIsFine = false;
            $descripcionArticuloErr = "Solo se permiten letras, números y espacios en blanco!";
        }
    }

    if (empty($_POST["region-articulo"])){
        $regionErr = "Seleccione una Región!";
    } else{
        $region = test_input($_POST["region-articulo"]);
        $regionIsFine = true;
    }

    if (empty($_POST["comuna-articulo"])){
        $comunaErr = "Seleccione una Comuna!";
    } else{
        $comuna = test_input($_POST["comuna-articulo"]);
        $bcomunaIsFine = true;
    }

    if (empty($_POST["calle-articulo"])){
        $calleErr = "Ingrese Calle y Número!";
    } else{
        $calle = test_input($_POST["calle-articulo"]);
        if (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñüÜ0-9 ]*$/", $calle)){
            $calleErr = "Solo se permiten letras, números y espacios en blanco!";
        } else{
            $bcalleIsFine = true;
        }
    }

    if (empty($_POST["nombre-contacto"])){
        $nombreContactoErr = "Ingrese un Nombre de Contacto!";
    } else{
        $nombreContacto = test_input($_POST["nombre-contacto"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $nombreContacto)){
            $nombreContactoErr = "Solo se permiten letras y espacios en blanco!";
        } else{
            $bnombreContactoIsFine = true;
        }
    }

    if (empty($_POST["email-contacto"])){
        $emailErr = "Ingrese un Email!";
    } else{
        $email = test_input($_POST["email-contacto"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailErr = "Ingrese un Email Válido!";
        } else{
            $bemailIsFine = true;
        }
    }

    if (empty($_POST["fono-contacto"])){
        $fono = "";
    } else{
        $fono = test_input($_POST["fono-contacto"]);
        $codePosition = strpos($fono, "+56");
        $subNumber = substr($fono, intval($codePosition)+3);
        $bIsChileanNumber = $codePosition == 0 && strlen($subNumber) == 9;
        if (!$bIsChileanNumber){
            $fonoErr = "Sólo se validan los Fonos de Contacto que sigan el formato +56 XXX XXX XXX";
            $fonoIsFine = false;
        }
    }

    $bFormIsFine = $bnombreArticuloIsFine && $bdescripcionIsFine &&
        $regionIsFine && $bcomunaIsFine && $bcalleIsFine &&
        $bnombreContactoIsFine && $bemailIsFine && $fonoIsFine;

    if ($bFormIsFine){

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

        // Prepare and Bind
        $stmt1 = $conn->prepare("INSERT INTO articulo (nombre, descripcion, fecha_ingreso, 
        comuna_entrega, calle_numero, nombre_contacto, email_contacto, fono_contacto) VALUES (?,?,?,?,?,?,?,?)");
        //date("Y-m-d")
        //$stmt1->bind_param("ssssssss", $nombreArticulo, $descripcionArticulo, "2018-03-11", $comuna,
          //  $calle, $nombreContacto, $email, $fono);

        $stmt1->bind_param("ssssssss", $nombre, $descripcion, $fecha_ingreso, $comuna_entrega,
            $calle_numero, $nombre_contacto, $email_contacto, $fono_contacto);

        $nombre = $nombreArticulo;
        $descripcion = $descripcionArticulo;
        $fecha_ingreso = date("Y-m-d");
        $comuna_entrega = $comuna;
        $calle_numero = $calle;
        $nombre_contacto = $nombreContacto;
        $email_contacto = $email;
        $fono_contacto = $fono;

        $stmt1->execute();
        $stmt1->close();
        $conn->close();
        echo "Inserción Realizada! :D :D!";

    }
}
?>

<form name="AddArticleForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"
      onsubmit="return FormValidation(NameValidation(),DescriptionValidation(),ValidatePhoto(), StreetNumberValidation(),
      ValidateSelection(), ValidateContactName(), ValidateEmail(), ValidatePhone())">

    Nombre del Artículo:<br>
    <input name="nombre-articulo" type="text" size="40" maxlength="80" minlength="2" value="<?php echo $nombreArticulo;?>">
    <span class="error">* <?php echo $nombreArticuloErr;?></span>
    <br><br>

    Descripción:<br>
    <textarea name="descripcion-articulo" rows="10" cols="50" maxlength="1000" value="<?php echo $descripcionArticulo;?>"></textarea>
    <span class="error"> <?php echo $descripcionArticuloErr;?></span>
    <br><br>

    Fotografías:<br>
    <input type="file" name="foto-articulo[1]" accept="image/*"><button onclick="AddNewPhoto(); return false;">Agregar otra Fotografía</button>
    <input type="file" name="foto-articulo[2]" accept="image/*" style="display: none"><br>
    <input type="file" name="foto-articulo[3]" accept="image/*" style="display: none"><br>
    <input type="file" name="foto-articulo[4]" accept="image/*" style="display: none"><br>
    <input type="file" name="foto-articulo[5]" accept="image/*" style="display: none"><br><br>

    Región y Comuna de Entrega:<br>
    <select name="region-articulo" id="regiones"></select>
    <span class="error">* <?php echo $regionErr;?></span>

    <select name="comuna-articulo" id="comunas"></select>
    <span class="error">* <?php echo $comunaErr;?></span><br><br>

    Calle y Número:<br>
    <input name="calle-articulo" type="text" size="60" maxlength="150">
    <span class="error">* <?php echo $calleErr;?></span><br><br>

    Nombre de Contacto:<br>
    <input name="nombre-contacto" type="text" size="60" maxlength="200">
    <span class="error">* <?php echo $nombreContactoErr;?></span><br><br>

    Email de Contacto:<br>
    <input name="email-contacto" type="text" size="40" maxlength="100">
    <span class="error">* <?php echo $emailErr;?></span><br><br>

    Fono de Contacto:<br>
    <input name="fono-contacto" type="text" size="20" maxlength="20">
    <span class="error"> <?php echo $fonoErr;?></span><br><br>

    <br><br><input type="submit" name="Ingresar Este Artículo"><br><br>
</form>

<?php
echo $nombreArticulo;
echo "<br>";
echo $descripcionArticulo;
echo "<br>";
echo $region;
echo "<br>";
echo $comuna;
echo "<br>";
echo $calle;
echo "<br>";
echo $nombreContacto;
echo "<br>";
echo $email;
echo "<br>";
echo $fono;
?>

</body>
</html>











