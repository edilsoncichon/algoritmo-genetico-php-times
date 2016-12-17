<?php
/**
 * @author: Edilson Cichon <edilsoncichon_hotmail_com>| 2016
 *
 */

/**
 * Leitura do arquivo de jogadores.
 * @param int $qtdJogadores
 * @return array
 */
function lerArquivoJogadores($qtdJogadores)
{
    $arrayFileJogadores = file('../dados/NotasJogadoresCaracteristicas.txt');
    $jogadoresAvaliar = [];
    foreach ($arrayFileJogadores as $index => $dadosJogadorStr) {
        if ($index < $qtdJogadores) {
            $j = explode('	', $dadosJogadorStr);
            $jogadoresAvaliar[] = new Jogador($j[0], $j[1], $j[2], $j[3], $j[4]);
        }
    }
    return $jogadoresAvaliar;
}

/**
 * Leitura do arquivo de Posições.
 * @return array
 */
function lerArquivoPosicoes()
{
    $arrayFilePosicoes = file('../dados/caracteristicasPosicoes.txt');
    $posicoes = [];
    foreach ($arrayFilePosicoes as $index => $dadosPosicaoStr) {
        $p = explode( '|', normalizarStr($dadosPosicaoStr) );
        $nome = strtolower($p[0]);
        $posicoes[$nome] = new Posicao($nome, $p[1], $p[2], $p[3], $p[4]);
    }
    return $posicoes;
}

/**
 * Forma a população inicial de forma aleatória.
 * @param array $jogadores
 * @param array $posicoes
 * @return Populacao
 */
function formarPopulacaoInicial(array $jogadores, array $posicoes)
{
    $populacao = new Populacao();
    for ($i = 0; $i < 100 ; $i++) {
        $time = new Time($posicoes);
        formarTimeAleatorio($jogadores, $time);
        $populacao->setTime($time);
    }
    return $populacao;
}

function formarTimeAleatorio(array $jogadores, Time $time)
{
    $convocados = [];
    foreach ($time->getJogadores() as $index => $posicao) {

        //escolhe um jogador que ainda não foi convocado.
        $jogadorRandom = -1;
        while ( true ) {
            $jogadorRandom = ''.rand(0, count($jogadores)-1);
            if ( array_search($jogadorRandom, $convocados) === false )
                break;
        }
        $time->setJogador($index, $jogadores[$jogadorRandom]);
        $convocados[] = $jogadorRandom;
    }
    $time->calcularNotaTime();
}

/**
 * Encontra dois indivíduos (times) 'mais qualificados' para realizem o cruzamento.
 * Obs.: Utiliza a técnica da 'Roleta' para selecionar.
 * @param Populacao $populacao
 * @return array
 */
function selecionarTimesCruzar(Populacao $populacao)
{
    $somaNotas = 0.0;
    $acumulado = 0.0;
    $trechos = [];
    $selecionados = [];

    //ordena os times para dividir em trechos.
    $populacao->ordenarPorNota();

    //Organiza as notas dos times em trechos dinâmicamente.
    foreach ($populacao->getTimes() as $index => $time) {
        $trechos[$index] = ($acumulado += $time->getNota());

        // aproveita o loop e soma as notas.
        $somaNotas += $time->getNota();
    }

    for ($i = 0; $i < 2; $i++) { // seleciona dois times
        $trechoSorteado = rand(0, $somaNotas);

        //Procura o time que se enquadra no trecho sorteado.
        foreach ($trechos as $index => $valorTrecho) {
            if ($trechoSorteado < $valorTrecho) {
                $selecionados[] = $populacao->getTimes()[$index];
                break;
            }
        }
    }
    return $selecionados;
}

/**
 * Realiza o processo de cruzamento e mutação entre dois Times selecionados.
 *
 * @param array $selecionados Times
 * @param Populacao $descendentes
 */
function cruzarMutarJogadores(array $selecionados, Populacao $descendentes)
{
    //efetua corte e mescla os dois times,
    //procura e troca os jogadores repetidos,
    //faz a mutação,
    //adiciona os jogadores numa instância de time,
    //e adiciona nos descendentes.
    $jogadores3 = array_merge_recursive(
        $selecionados[0]->getMetadeJogadores(true),
        $selecionados[1]->getMetadeJogadores(false)
    );
    $jogadores4 = array_merge_recursive(
        $selecionados[1]->getMetadeJogadores(true),
        $selecionados[0]->getMetadeJogadores(false)
    );

    $jogadores3 = substituirRepetidos($jogadores3, $selecionados[0]);
    $jogadores4 = substituirRepetidos($jogadores4, $selecionados[1]);

    $jogadores3 = fazerMutacao($jogadores3);
    $jogadores4 = fazerMutacao($jogadores4);

    $posicoes = $selecionados[0]->getPosicoes();
    $time3 = jogadores4Time($jogadores3, $posicoes);
    $time4 = jogadores4Time($jogadores4, $posicoes);

    $descendentes->setTime($time3);
    $descendentes->setTime($time4);
}

/**
 * Verifica na lista de jogadores se o jogador informado está em outra posição.
 *
 * @param array $timeFilho
 * @param Time $timePai1
 * @return array
 */
function substituirRepetidos(array $timeFilho, Time $timePai1)
{
    $jogadoresFilho = [];
    $posicoesRepetidas = [];
    //1 Verifica se houve repetição...
    //2 Se sim, armazena as posições repetidas da segunda metade
    foreach ($timeFilho as $index => $posicao) {
        $nomeJ = $posicao['jogador']->getNome();

        if ( array_search($nomeJ, $jogadoresFilho) === false )
            $jogadoresFilho[] = $nomeJ;
        else
            $posicoesRepetidas[] = $index;
    }

    //3 Procura na segunda metade do pai elementos para substituir que não estejam no filho.
    //4 Faz a substituição.
    if ( count($posicoesRepetidas) > 0 ) {

        $jogsPai = $timePai1->getJogadores();
        foreach ($posicoesRepetidas as $posRepetida) {

            foreach ($jogsPai as $i => $jogPai) {
                $nomeJ = $jogPai['jogador']->getNome();
                if ( array_search($nomeJ, $jogadoresFilho) === false ) {
                    $timeFilho[$posRepetida] = $jogPai;
                    unset($jogsPai[$i]);
                    break;
                }
            }
        }
    }

    return $timeFilho;
}

/**
 * Recebe um array de Jogadores e os adiciona num Time.
 * @param array $jogadores
 * @param array $posicoes
 * @return Time
 * @throws Exception
 */
function jogadores4Time(array $jogadores, array $posicoes)
{
    $time = new Time($posicoes);

    //adiciona os jogadores em posições no time.
    //calcula a nota do time após os jogadores alocados nas posições.
    foreach ($jogadores as $i => $jogador) {
        $time->setJogador($i, $jogador['jogador']);
    }
    $time->calcularNotaTime();
    return $time;
}

/**
 * Decide se a mutação será feita ou não, e faz a mesma.
 *
 * @param array $jogadores
 * @return array
 */
function fazerMutacao(array $jogadores)
{
    $vaiMutar = rand(1, 100);

    if ( $vaiMutar > 20 )
        return $jogadores;

    $pos1 = rand(0, 10);
    $pos2 = rand(0, 10);
    while ($pos1 == $pos2)
        $pos2 = rand(0, 10);

    $jogPos1 = $jogadores[$pos1];
    $jogPos2 = $jogadores[$pos2];
    $jogadores[$pos1] = $jogPos2;
    $jogadores[$pos2] = $jogPos1;
    return $jogadores;
}
