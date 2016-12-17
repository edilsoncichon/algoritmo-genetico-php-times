<?php
/**
 * @author: Edilson Cichon <edilsoncichon_hotmail_com>| 2016
 *
 */

require_once '../bootstrap.php';

$qtdJogadores = $_GET['qtdJogadores'];

$jogs = lerArquivoJogadores($qtdJogadores);
$poss = lerArquivoPosicoes();

//Montagem dos times..
$populacaoInicial = formarPopulacaoInicial($jogs, $poss);
$populacao = $populacaoInicial;

for ($i = 0; $i < 5000; $i++) {
    $descendentes = new Populacao();
    $contCruzamentos = count($populacao->getTimes()) / 2;

    while ($contCruzamentos > 0) {

        //Selecionar times pra cruzamento (Roleta)
        //Faz o cruzamento e a mutação..
        $selecionados = selecionarTimesCruzar($populacao);
        cruzarMutarJogadores($selecionados, $descendentes);
        $contCruzamentos--;
    }
    //Adiciona os descendentes na População,
    //Remove os 100 piores times,
    //Continua o processo evolutivo.
    foreach ($descendentes->getTimes() as $time)
        $populacao->setTime($time);
    $populacao->ordenarPorNota(true);
    $populacao->descartar100Piores();
}

$time = $populacao->getTimes()[99];
$dadosRetornar['nota'] = $time->getNota();

foreach ($time->getJogadores() as $i => $jogador)
    $dadosRetornar['jogadores'][] = $jogador['jogador']->getNome();

$dadosRetornar['tempoProcessamento'] = (mktime() - $_SERVER['REQUEST_TIME']);

echo json_encode($dadosRetornar);
