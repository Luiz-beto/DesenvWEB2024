<?php 
    require_once("funcoes.php");
    define("notas", array(6, 8, 10, 7));
    define("aulas", array(0, 1, 0, 0, 1, 0, 0, 1, 0, 0));
    
    $mediaNotas = calculaMediaNotas();
    $frequencia = calculaFrequencia();

    exibeMensagem("Média de Notas: " . $mediaNotas . "<br>" .
                  "Status Nota: " . verificaStatusNotas($mediaNotas) . "<br>" . 
                  "Frequencia: " . $frequencia . "<br>" .
                  "Status Frequencia: " . verificaStatusFrequencia($frequencia) . "<br>");
?>