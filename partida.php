<div class="container" id="menu">
    <?php
    $tema = $_POST['tema'];

    include('misfunciones.php');
    $mysqli = conectaBBDD();

    ?>
    <div class="alert alert-success" role="alert">
        <!-- Te informa del tema de las preguntas -->
        El tema que has elegido es <?php echo $tema; ?>
    </div>
    <?php
    //Query
    $consulta = $mysqli->query("SELECT * FROM `preguntas` WHERE `tema` = '$tema' ORDER BY RAND() LIMIT 1");
    $r = $consulta->fetch_array();

    ?>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Marcador: Sale cada vez que respondes y te informa de tus puntos -->
                <button id="marcador" class="btn btn-block btn-warning col-12 disabled"></button>
                <button class="btn btn-warning disabled col-12">
                    <?php echo $r['enunciado']; ?>
                    <!-- Enunciado de la pregunta -->
                </button>
                <!-- opciones de respuesta -->
                <br>
                <div id="cargaRespuesta"></div>
                <br>
                <button id="opcion1" class="btn btn-primary col-12" onclick="chequeaRespuesta('1','<?php echo $r['numero']; ?>')">
                    <?php echo $r['r1']; ?>
                </button>
                <br><br>
                <button id="opcion2" class="btn btn-primary col-12" onclick="chequeaRespuesta('2','<?php echo $r['numero']; ?>');">
                    <?php echo $r['r2']; ?>
                </button>
                <br><br>
                <button id="opcion3" class="btn btn-primary col-12" onclick="chequeaRespuesta('3','<?php echo $r['numero']; ?>');">
                    <?php echo $r['r3']; ?>
                </button>
                <br><br>
                <button id="opcion4" class="btn btn-primary col-12" onclick="chequeaRespuesta('4','<?php echo $r['numero']; ?>');">
                    <?php echo $r['r4']; ?>
                </button>
                <!-- Botones para siguiente pregunta o cambiar de tema -->
                <br><br>
                <button onclick="cargaTema('<?php echo $r['tema'] ?>')" type="button" class="btn btn-secondary col-12">Siguiente</button>
                <br><br>
                <button id=vuelveAlInicio onclick="volverMenu()" type="button" class="btn btn-secondary col-12">Volver al Menu</button>
            </div>
        </div>
    </div>
</div>
<script>
    function chequeaRespuesta(_respuesta, _numeroPregunta) { //Comprueba si la respuesta es correcta
        $('#cargaRespuesta').load('chequeaRespuesta.php', {
            respuesta: _respuesta,
            numeroPregunta: _numeroPregunta
        })
    }

    function volverMenu() {
        //Vuelve al menú de los temas
        $('#menu').load('index.php #menuInicio')
    }
</script>
</div>