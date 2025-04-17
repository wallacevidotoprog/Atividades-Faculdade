<?php
function print_melhor_negocio ($montante_1, $preco_1, $montante_2, $preco_2){
     $por_montante_1 = $preco_1 / $montante_1; 
     $por_montante_2 = $preco_2 / $montante_2; 
     
     if ($por_montante_1 < $por_montante_2) 
     print ("0 primeiro negécio é melhor!<BR>"); 
    else print ("0 segundo negocio é melhor!<BR>"); 
}
$litros_1 = 1.0;

$preco_1 = 1.59;

$litros_2 = 1.5;

$preco_2 = 2.09; 
print_melhor_negocio($litros_1, $preco_1, $litros_2, $preco_2);
?>