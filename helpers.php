<?php
/**
 * @author: Edilson Cichon | 2016
 */

if ( !function_exists('dd') ) {
    /**
     * Debuga qualquer estrutura de dados (array, object, primitivo...).
     * @param $think
     */
    function dd($think)
    {
        print_r($think);
        die();
    }
}

if ( !function_exists('normalizaStr') ) {
    /**
     * Normaliza a string.
     * @param string $string
     * @return string
     */
    function normalizarStr($string)
    {
        return str_replace('||', '|', str_replace("\t", '|', $string));
    }
}
