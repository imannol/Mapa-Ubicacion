<?php
session_start();
require_once("conexao.php");

?>



<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <title></title>
</head>
    <body>
                
        <form method="POST" action="insertar.php">

                Nombre marcador: <input type="text" name="n" /><br/><br/>
                Direccion: <input type="text" name="a" /><br/><br/>
                Latitud:<input type="text" name="lat">
                Longitud:<input type="text" name="lng">
                Tipo:<input type="text" name="type">
                <br/><br/>
                <input type="submit">
        </form>
            <?php
                if(isset($_SESSION['marcadorOK'])){
                    echo $_SESSION['marcadorOK'];
                    unset($_SESSION['marcadorOK']);
                }
                if(isset($_SESSION['marcadorError'])){
                    echo $_SESSION['marcadorError'];
                    unset($_SESSION['marcadorError']);
                }
            ?>
     </body>       
 </html>
 <?php
 
if(isset($_POST['n']))
{
    if(isset($_POST['n'])  && isset($_POST['lat']) && !empty($_POST['lat']) && isset($_POST['lng']) && !empty($_POST['lng'])){ 
        $nombre = $_POST['n'];
        $direccion = $_POST['a'];
        $latitud = $_POST['lat'];
        $longitud = $_POST['lng'];
        $tipo = $_POST['type'];

        mysqli_query($mysqli, "INSERT INTO markers (name, address, lat, lng, type)
        VALUES ('".$nombre."', '".$direccion."', '".$latitud."','".$longitud."','".$tipo."')");

        $_SESSION['marcadorOK'] = "Marcador creado correctamente";
        header("Location: insertar.php");
    } else {
        $_SESSION['marcadorError'] = "<span style='color:red;'>Rellena todos los campos por favor.</span>";
        header("Location: insertar.php");
    }
}
mysqli_close($mysqli);
?>                    
               
