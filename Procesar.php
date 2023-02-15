<?php
require "Coders.php";
require "Songs.php";

$conn_coders = new Coders();
$conn_songs = new Songs();

?>

<!doctype html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!--css para usar Bootstrap-->
        <link rel="stylesheet"
              href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Popders</title>
    </head>
    <body style="background: antiquewhite">

        <div class="container mt-3">
            <ul>
        <?php
            if(isset($_POST["guardar"])){
                // Cuando se pulsa el botón guardar del formulario entra por esta rama
                echo "<p class='text-success mt-2 font-weight-bold'>¡SE HA ACCEDIDO DESDE EL FORMULARIO!</p>";

                // Debe comprobarse que las variables vienen informadas
                $coder = isset($_POST["coder"])? $_POST["coder"]:null;
                $titulo = isset($_POST["titulo"])? $_POST["titulo"]:null;
                $artist= isset($_POST["artist"])? $_POST["artist"]:null;
                $genre= isset($_POST["genre"])? $_POST["genre"]:null;
                $url= isset($_POST["url"])? $_POST["url"]:null;

                if (is_null($coder) || is_null($titulo) || is_null($artist)) {
                    echo "<p class='text-danger mt-2 font-weight-bold'>¡CAMPOS SIN INFORMAR!</p>";
                }

                // Comprueba si existe el usuario que va a añadir una canción
                $idCoder = $conn_coders->existeCoder($coder);
                

                if ($idCoder) {
                    // Si ya existe no se hace nada
                    echo "<p class='text-success'>-- El coder {$idCoder}:{$coder} ya existe en la BD</p>";
                    $seguir = true;
                }else {
                    // Si no existe se añade a la BD
                    echo "<p class='text-danger'>-- El coder {$coder} no existe en la BD: ";

                    $seguir = $conn_coders->addRow($coder);
                    if ($seguir) {
                        echo " <span class='text-success'>Se ha añadido a {$coder} a la BD</span></p>";
                        // Recuperar el id del nuevo usuario para poder añadir la canción
                        $idCoder = $conn_coders->existeCoder($coder);
                    }else {
                        echo " <span class='text-danger'>Error al crear el coder {$coder}</span></p>";
                    }
                }
                
               
                // Si el usuario es correcto se añade la canción
                if ($seguir) {
                    $fecha = date("Y-m-d H:i:s");
                    $status = 1;
                    // Añadir canción
                    $insertarCancion = $conn_songs->addRow2($idCoder, $titulo, $artist, $genre, $url, $fecha, $status);
                    if ($insertarCancion) {
                        echo "<p class='text-success'>-- {$coder} ha añadido {$titulo} de {$artist}</p>";
                    } else {
                        echo "<p class='text-danger'>-- {$coder} NO HA PODIDO añadir {$titulo} de {$artist}</p>";
                    }
                }

            }
            else {
                // Si accedemos al archivo sin pasar por el formulario
                echo "<p class='text-danger mt-2 font-weight-bold'>¡¡NO SE HA ACCEDIDO DESDE EL FORMULARIO!!</p>";
            }

        ?>
        <button type='button' class='btn btn-info mr-3' onclick='location.href="FormNuevaCancion.html"'>Volver</button>
        </ul>
        </div>
    </body>
</html>