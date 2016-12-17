<?php
/**
 * @author: Edilson Cichon | 2016
 */

/**
 * Classes do projeto.
 */
$classes = [
    'domain' => [
        'Jogador',
        'Posicao',
        'Time',
        'Populacao',
    ]];
foreach ($classes as $dir => $classesDir) {
    foreach ($classesDir as $class) {
        require $dir . '/' . $class . '.php';
    }
}

/**
 * Arquivos e funções do algoritimo genético.
 */
require 'domain/functions.php';

/**
 * Arquivos e funções de utilidade geral.
 */
require 'helpers.php';
