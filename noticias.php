<?php include 'includes/header.php'; ?>

<?php
$apiKey = 'a187b902e634422286496e318a0d9e8a';

$query = urlencode(
    '(autismo OR "tea" OR neurodivergencia) AND (estatisticas OR casos OR dados OR informacao OR pesquisa OR inclusao)'
);

$host = "newsapi.org";
$path = "/v2/everything?q={$query}&language=pt&sortBy=relevance&pageSize=20&apiKey={$apiKey}";

$contextOptions = [
    "ssl" => [
        "verify_peer" => false,
        "verify_peer_name" => false
    ]
];

$context = stream_context_create($contextOptions);

$fp = @stream_socket_client(
    "ssl://{$host}:443",
    $errno,
    $errstr,
    10,
    STREAM_CLIENT_CONNECT,
    $context
);

$response = "";

if ($fp) {
    $out = "GET {$path} HTTP/1.1\r\n";
    $out .= "Host: {$host}\r\n";
    $out .= "User-Agent: MeuSiteNoticias/1.0\r\n";
    $out .= "Connection: Close\r\n\r\n";

    fwrite($fp, $out);

    while (!feof($fp)) {
        $response .= fgets($fp, 1024);
    }

    fclose($fp);

    if (strpos($response, "\r\n\r\n") !== false) {
        list($headers, $body) = explode("\r\n\r\n", $response, 2);
        $dadosAPI = json_decode($body, true);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias - ForTEA</title>

    <style>
        .noticias-pagina {
            background: #f7f9fc;
            color: #374151;
            padding-bottom: 50px;
        }

        .noticias-pagina .titulo-noticias {
            text-align: center;
            padding: 45px 20px 35px;
        }

        .noticias-pagina .titulo-noticias h1 {
            color: #21479B;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .noticias-pagina .titulo-noticias p {
            color: #6b7280;
            font-size: 1rem;
        }

        .noticias-pagina .container-noticias {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .noticias-pagina .feed {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        .noticias-pagina .noticia-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            flex-direction: column;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .noticias-pagina .noticia-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.08);
        }

        .noticias-pagina .noticia-img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background: #eaf2ff;
        }

        .noticias-pagina .noticia-conteudo {
            padding: 20px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .noticias-pagina .noticia-card h3 {
            margin-bottom: 10px;
            line-height: 1.4;
            font-size: 1.1rem;
        }

        .noticias-pagina .noticia-card h3 a {
            color: #21479B;
            text-decoration: none;
        }

        .noticias-pagina .noticia-card h3 a:hover {
            color: #3467EB;
        }

        .noticias-pagina .noticia-card p {
            color: #4b5563;
            font-size: 0.92rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .noticias-pagina .card-footer {
            border-top: 1px solid #edf2f7;
            padding-top: 12px;
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .noticias-pagina .fonte-tag {
            background: #eaf2ff;
            color: #21479B;
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .noticias-pagina .data-tag {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .noticias-pagina .erro-painel {
            color: #c0392b;
            background: #fdf2f2;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            grid-column: 1 / -1;
        }

        @media (max-width: 600px) {
            .noticias-pagina .titulo-noticias {
                padding: 35px 15px 25px;
            }

            .noticias-pagina .titulo-noticias h1 {
                font-size: 1.8rem;
            }

            .noticias-pagina .feed {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <main class="noticias-pagina">

        <section class="titulo-noticias">
            <h1>TEA em foco</h1>
            <p>Acesse notícias atuais, pesquisas e novidades sobre autismo, inclusão e neurodiversidade, reunidas para manter você informado sobre os principais assuntos e avanços na área.</p>
        </section>

        <div class="container-noticias">
            <div class="feed">

                <?php
                if ($fp && isset($dadosAPI['status']) && $dadosAPI['status'] === 'ok') {

                    if (!empty($dadosAPI['articles'])) {

                        foreach ($dadosAPI['articles'] as $artigo) {

                            if (empty($artigo['title']) || empty($artigo['url'])) {
                                continue;
                            }

                            $textoCompleto = strtolower(
                                $artigo['title'] . ' ' . ($artigo['description'] ?? '')
                            );

                            if (
                                !str_contains($textoCompleto, 'autis') &&
                                !str_contains($textoCompleto, 'tea') &&
                                !str_contains($textoCompleto, 'neurodiverg')
                            ) {
                                continue;
                            }

                            $descricao = !empty($artigo['description'])
                                ? $artigo['description']
                                : 'Clique para ler a notícia completa.';

                            if (strlen($descricao) > 160) {
                                $descricao = substr($descricao, 0, 157) . '...';
                            }

                            $fonte = !empty($artigo['source']['name'])
                                ? $artigo['source']['name']
                                : 'Portal';

                            $imagem = !empty($artigo['urlToImage'])
                                ? $artigo['urlToImage']
                                : 'https://images.unsplash.com/photo-1559757175-0eb30cd8c063?auto=format&fit=crop&w=800&q=80';

                            $dataPublicacao = !empty($artigo['publishedAt'])
                                ? date('d/m/Y', strtotime($artigo['publishedAt']))
                                : '';

                            echo '<article class="noticia-card">';

                            echo '<img 
                                    src="' . htmlspecialchars($imagem) . '" 
                                    class="noticia-img" 
                                    alt="Imagem da notícia"
                                  >';

                            echo '<div class="noticia-conteudo">';

                            echo '<h3>
                                    <a href="' . htmlspecialchars($artigo['url']) . '" target="_blank">
                                        ' . htmlspecialchars($artigo['title']) . '
                                    </a>
                                  </h3>';

                            echo '<p>' . htmlspecialchars($descricao) . '</p>';

                            echo '<div class="card-footer">';

                            echo '<span class="fonte-tag">'
                                . htmlspecialchars($fonte) .
                                '</span>';

                            echo '<span class="data-tag">'
                                . htmlspecialchars($dataPublicacao) .
                                '</span>';

                            echo '</div>';

                            echo '</div>';
                            echo '</article>';
                        }

                    } else {

                        echo '<p style="text-align:center; color:#777; grid-column:1 / -1;">
                                Nenhuma notícia encontrada.
                              </p>';
                    }

                } else {

                    echo '<div class="erro-painel">
                            ❌ Não foi possível carregar as notícias.
                          </div>';
                }
                ?>

            </div>
        </div>

    </main>

</body>

</html>

<?php include 'includes/footer.php'; ?>