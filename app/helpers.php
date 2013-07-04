<?php

function preencode($string)
{
    $string = htmlentities($string);
    $string = str_replace('{b', '{{', $string);
    $string = str_replace('b}', '}}', $string);
    return $string;
}