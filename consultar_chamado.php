<?php

// Inicializa a variável como array vazio para evitar o erro de "Variável indefinida"
$chamados = array();

// Tenta abrir o arquivo. O '@' suprime avisos caso o arquivo não exista.
$arquivo = @fopen('arquivo.hd', 'r');

// Verifica se o arquivo foi aberto com sucesso antes de tentar ler
if ($arquivo) {
    
    // Loop de leitura do arquivo
    while(!feof($arquivo)) {

        $registro = fgets($arquivo);
        
        // Ignora linhas vazias ou que contenham apenas espaços/quebras de linha
        if (empty(trim($registro))) {
            continue;
        }

        // Remove espaços em branco e quebras de linha do início e fim da string
        $registro = trim($registro);

        // Separa os dados usando o delimitador '|' (pipe)
        $dados = explode('|', $registro);

        //  Verifica se a linha tem o número correto de campos (3)
        if (count($dados) >= 3) {
            // Adiciona o array de dados do chamado ao array principal $chamados
            $chamados[] = $dados;
        }
        // Linhas com menos de 3 campos serão ignoradas, evitando o erro de "Chave de array indefinida"
    }

    fclose($arquivo);
}

?>  


<html>
  <head>
    <meta charset="utf-8" />
    <title> Orbit Help Desk</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <style>
      .card-consultar-chamado {
        padding: 30px 0 0 0;
        width: 100%;
        margin: 0 auto;
      }
    </style>
  </head>

  <body>

    <nav class="navbar navbar-dark bg-dark">
      <a class="navbar-brand" href="#">
        <img src="logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
          Orbit Help Desk
      </a>
        <ul class="navbar-nav">
         <li class="nav-item">
          <a class="nav-link" href="logoff.php">SAIR</a>
         </li>
     </nav>

    <div class="container">    
      <div class="row">

        <div class="card-consultar-chamado">
          <div class="card">
            <div class="card-header">
              Consulta de chamado
            </div>
            
            <div class="card-body">
            <?php foreach($chamados as $chamado ) { ?>
            
            <?php
                // Atribui os valores do array $chamado a variáveis para facilitar a leitura
                // Como a verificação de count($dados) >= 3 foi feita, esses índices são seguros
                $titulo = $chamado[0];
                $categoria = $chamado[1];
                $descricao = $chamado[2];
            ?>

            <div class="card mb-3 bg-light">
              <div class="card-body">
                <!-- Exibe os dados dinamicamente -->
                <h5 class="card-title"><?php echo $titulo; ?></h5>
                <h6 class="card-subtitle mb-2 text-muted"><?php echo $categoria; ?></h6>
                <p class="card-text"><?php echo $descricao; ?></p>
              </div>
            </div>
            <?php } ?>
              <div class="row mt-5">
                <div class="col-6">
                  <a href="home.php">
                  <button class="btn btn-lg btn-warning btn-block" type="submit">Voltar</button>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

