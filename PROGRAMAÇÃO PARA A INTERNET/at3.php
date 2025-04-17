<?php
function add_algum_extra(&$string) {
    $string .= ' e algo extra.'; // Note o operador de concatenação (.)
}

$str = 'Esta é uma string';
echo 'antes:>'.$str;
add_algum_extra($str);
echo '|depois:>'.$str; // Saída: 'Esta é uma string e algo extra.'