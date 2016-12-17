<!doctype html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Alg. Génetico & PHP</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="view/ajax.js"></script>
</head>
<body>
    <div class="container">
        <div class="jumbotron">
            <h2>Algoritmo Genético - Seleção de time</h2>
            <hr>
            <form action="domain/calculo.php" method="post">
                <label for=""> Quantos jogadores serão convocados?
                    <select name="qtdJogadores" class="form-control">
                        <?php
                        for ($i=11; $i<=18; $i++)
                            echo "<option value=$i>$i</option>";
                        ?>
                    </select>
                </label>
                <hr>
                <button id="start" class="btn btn-primary btn-lg" role="button" type="button">Calcular</button>
            </form>

            <div id="loading"></div>

            <div id="resultado" style="display: none">

                <h2>Resultado</h2>

                <strong>Nota:</strong>
                <div id="nota"></div>

                <h3>Formação do time:</h3>

                <strong>Goleiro</strong>
                <div id="goleiro"></div>

                <strong>Zagueiro</strong>
                <div id="zagueiro"></div>

                <strong>Zagueiro</strong>
                <div id="zagueiro2"></div>

                <strong>Lateral</strong>
                <div id="lateral"></div>

                <strong>Lateral</strong>
                <div id="lateral2"></div>

                <strong>Volante</strong>
                <div id="volante"></div>

                <strong>Volante</strong>
                <div id="volante2"></div>

                <strong>Meia</strong>
                <div id="meia"></div>

                <strong>Meia</strong>
                <div id="meia2"></div>

                <strong>Atacante</strong>
                <div id="atacante"></div>

                <strong>Atacante</strong>
                <div id="atacante2"></div>
                <hr>
                <strong>Tempo de processamento:</strong>
                <div id="tempo"></div>
            </div>
        </div>
    </div>
</body>
</html>
