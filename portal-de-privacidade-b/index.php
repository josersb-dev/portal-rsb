<?php
// URL que você quer ler
$url = 'https://www.rsb.org.br/portal-de-privacidade';

// Tenta ler o conteúdo da URL
$conteudo = @file_get_contents($url);

// Verifica se a leitura foi bem-sucedida
if ($conteudo === FALSE) {
    echo 'Não foi possível acessar o conteúdo da URL.';
} else {
    // Exibe o conteúdo
    echo $conteudo;
}
?>
