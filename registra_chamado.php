<?php

$arquivo = fopen('arquivo.hd', 'a');

// MONTAGEM DO TEXTO QUE SERÁ GRAVADO NO ARQUIVO
$titulo = str_replace('#', '-', $_POST['titulo']);
$categoria = str_replace('#', '-', $_POST['categoria']);
$descrição = str_replace('#', '-', $_POST['descrição']);

$texto = $titulo . '|' . $categoria . '|' . $descrição . PHP_EOL;

//ESCRITA DO TEXTO NO ARQUIVO

fwrite($arquivo, $texto);

//FECHAMENTO DO ARQUIVO

fclose($arquivo);
header('Location: abrir_chamado.php');


?>