<h1 class="text-center">
    Últimos Filmes Cadastrados
</h1>
<div class="row">
    <?php
    //arquivo que sera executado 
    $arquivo = "https://api.themoviedb.org/3/movie/now_playing?api_key=" . KEY . "&language=pt-BR&page=1";

    // carrega os dados do arquivo da url / REcupera os dados do arquivo
    $dados = file_get_contents($arquivo);

    // transforma json para array ou objs 
    $dados = json_decode($dados);

    // print_r($dados->results);
    foreach ($dados->results as $filme) {
        // echo "<p>{$filme->title}</p>";
        $poster = IMGS.$filme->poster_path;
    ?>
        <div class="col-12 col-md-3">
            <div class="card">
                <img src="<?= $poster ?>" alt="<? $filme->title ?>" class="w-100">
                <div class="card-body text-center">
                    <p class="titulo"><strong><?=$filme->title?></strong></p>
                    <p>
                        <a href="filme/<?= $filme->id?>" class="btn btn-warning">
                            Ver detalhes
                        </a>
                    </p>
                </div>
            </div>
        </div>


    <?php
    }



    ?>

</div>