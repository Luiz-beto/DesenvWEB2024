<?php

$disciplinas = array(
    "Segunda-feira" => "Engenharia de Software 2",
    "Terça-feira" => "Banco de Dados 2",
    "Quarta-feira" => "Administração de Sistemas de Informação",
    "Quinta-feira" => "Programação Web I",
    "Sexta-feira" => " Rede de Computadores"
);

$professores = array(
    "Segunda-feira" => "Prof. Jullian",
    "Terça-feira" => "Prof. Marco",
    "Quarta-feira" => "Prof. Sandro",
    "Quinta-feira" => "Prof. Cleber",
    "Sexta-feira" => "Prof. Fabiano"
);

for ($i = 0; $i < 5; $i++) {
    $dia = array_keys($disciplinas)[$i]; 
    $disciplina = $disciplinas[$dia]; 
    $professor = $professores[$dia]; 

    echo "Disciplina " . $disciplina . ", professor " . $professor . ".<br>";
}

?>
