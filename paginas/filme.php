<?php
$id = $param[1] ?? null;

// verificar se está em branco
if (empty($id)) {
?>
    <p class="alert alert-danger text-center">
        Ops! Filme inválido!
    </p>
<?php
} else {
    $arquivo = "https://api.themoviedb.org/3/movie/{$id}?api_key=" . KEY . "&language=pt-BR";

    $dados = file_get_contents($arquivo);

    $dados = json_decode($dados);

    // print_r($dados);
    $poster = IMGS . $dados->poster_path;

?>
    <div class="card">
        <div class="row">
            <div class="col-12 col-md-3">
                <img src="<?= $poster ?>" alt="<?= $dados->title ?>" class="w-100">
            </div>
            <div class="col-12 col-md-9">
                <h1 class="text-center"><?= $dados->title ?></h1>
                <p><?= $dados->overview ?></p>
            </div>
        </div>
    </div>
    <h2 class="text-center">Elenco do Filme:</h2>
    <div class="row">
        <?php
        $arquivo = "https://api.themoviedb.org/3/movie/{$id}/credits?api_key=" . KEY . "&language=pt-BR";

        $dados = file_get_contents($arquivo);

        $dados = json_decode($dados);

        foreach ($dados->cast as $personagem) {
            $foto =  IMGS . $personagem->profile_path;
        ?>
        <div class="col-12 col-md-3">
            <div class="card text-center">
                <img src="<?= $foto ?>" alt="<?= $personagem->name ?>" class="w-100">
                <p class="titulo">
                    <strong>
                        <?= $personagem->name ?>
                    </strong>
                </p>
                <p>(<?= $personagem->character ?>)</p>
                <p>
                    <a href="ator/<?= $personagem->id ?>" class="btn btn-warning">
                        Ver filmes deste ator
                    </a>
                </p>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>