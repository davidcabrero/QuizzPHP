<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZ PHP</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <?php
    include('misfunciones.php');
    $mysqli = conectaBBDD();

    $respuesta = $_POST['respuesta'];
    $numeroPregunta = $_POST['numeroPregunta'];

    //Query mal hecha
    //  $consulta = $mysqli -> query("SELECT * FROM `preguntas` WHERE numero = '$numeroPregunta'");
    //  $r = $consulta -> fetch_array();

    //Query correcta
    $consulta = $mysqli->prepare("SELECT correcta FROM `preguntas` WHERE numero = ? ");
    $consulta2 = $mysqli->prepare("SELECT * FROM `preguntas` WHERE numero = ? ");
    $consulta->bind_param("s", $numeroPregunta);
    $consulta->execute();
    $consulta->store_result();
    $consulta->bind_result($correcta);
    $consulta->fetch();

    $mysqli = conectaBBDD();

    if ($correcta == $respuesta) { //En el caso de acertar
    ?>
        <div class="row">
            <button class="btn btn-block btn-success disabled">Has Acertado!</button>
        </div>
        <script>
            marcador++; //Se suma 1 punto al marcador
        </script>
    <?php
    } else { //En el caso de fallar
    ?>
        <div class="row">
            <button class="btn btn-block btn-danger disabled"><b>Has Fallado, la correcta era la opción <?php echo $correcta; ?></b></button>
        </div>
        <script>
            marcador--; //Se resta 1 punto al marcador
        </script>
        <?php
        //Si fallas, se pone roja la opción correcta    
        if ($correcta == 1) {
        ?>
            <script>
                document.getElementById('opcion1').classList.add('btn-danger');
            </Script>
        <?php
        }
        if ($correcta == 2) {
        ?>
            <script>
                document.getElementById('opcion2').classList.add('btn-danger');
            </Script>
        <?php
        }
        if ($correcta == 3) {
        ?>
            <script>
                document.getElementById('opcion3').classList.add('btn-danger');
            </Script>
        <?php
        }
        if ($correcta == 4) {
        ?>
            <script>
                document.getElementById('opcion4').classList.add('btn-danger');
            </Script>
        <?php
        }
    }
    //Al responder, se deshabilitan todas las opciones, menos la opción elegida.
    if ($respuesta == 1) {
        ?>
        <script>
            document.getElementById("opcion2").disabled = true;
            document.getElementById("opcion3").disabled = true;
            document.getElementById("opcion4").disabled = true;
        </Script>
    <?php
    }
    if ($respuesta == 2) {
    ?>
        <script>
            document.getElementById("opcion1").disabled = true;
            document.getElementById("opcion3").disabled = true;
            document.getElementById("opcion4").disabled = true;
        </Script>
    <?php
    }
    if ($respuesta == 3) {
    ?>
        <script>
            document.getElementById("opcion1").disabled = true;
            document.getElementById("opcion2").disabled = true;
            document.getElementById("opcion4").disabled = true;
        </Script>
    <?php
    }
    if ($respuesta == 4) {
    ?>
        <script>
            document.getElementById("opcion1").disabled = true;
            document.getElementById("opcion2").disabled = true;
            document.getElementById("opcion3").disabled = true;
        </Script>
    <?php
    }
    ?>
    <script>
        document.getElementById('marcador').innerText = marcador; //Se añade el nuevo marcador
    </script>
</body>

</html>