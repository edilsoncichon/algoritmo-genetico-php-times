<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alg. Génetico - Melhor Time</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
    <h3>Definição do melhor time</h3>
    <form action="domain/calculo.php" method="post">
        <label for=""> Quantos jogadores deseja avaliar?
            <select name="qtdJogadores">
                <?php
                for ($i=11; $i<=18; $i++)
                    echo "<option value=$i>$i</option>";
                ?>
            </select>
        </label>
        <br><hr>
        <button type="submit">Calcular</button>
    </form>

    <div class="resultado">
        <?php

            for ($i=0; $i<100000000;$i++)
                continue;

            if ( isset($jogs) )
                var_dump($jogs);
        ?>
    </div>
</div>
<?php
    $segundos = (mktime() - $_SERVER['REQUEST_TIME']);
    echo 'Tempo de processamento: ' . $segundos . ' segundos.';
?>
</body>
</html>

