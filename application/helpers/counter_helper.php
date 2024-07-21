<?php defined('BASEPATH') OR exit('No direct script access allowed.');

if ( ! function_exists('count_visitor')) {
    function count_visitor()
    {
        $filecounter=(APPPATH . 'logs/counter.txt');
        $visits=file($filecounter);
        $visits[0]++;
        $file=fopen($filecounter, 'w');
        fputs($file, $visits[0]);
        fclose($file);
        return $visits[0];
    }
}
