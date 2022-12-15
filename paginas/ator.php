<?php
    $id = $param[1] ?? null;
    if(empty($id)){
        ?>
            <p class="alert alert-danger text-center">
                Não há nada para você aqui!
            </p>
        <?php
    } else {
        $arquivo = "https://api.themoviedb.org/3/person/{$id}?api_key=".KEY."&language=pt-BR";
        
        $dados = file_get_contents($arquivo);

        $dados = json_decode($dados);
        
        $perfil = IMGS.$dados->profile_path;

        ?>
        <div class="card">
            <div class="row">
                <div class="col-12 col-md-3">
                    <img src="<?=$perfil?>" alt="<?=$dados->name?>">
                </div>
                <div class="col-12 col-md-9">
                    <h1><?=$dados->name?></h1>
                    
                    <p class="titulo">
                        <strong>Data de nascimento:</strong>
                        <?= $dados->birthday?>
                    </p>
                    <p><strong>Biografia:</strong></p>

                    <p><?=$dados->biography?></p>
                </div>
            </div>
        </div>
        <h2>Outros Filmes do Mesmo Ator</h2>
            <?php
                $arquivo = "https://api.themoviedb.org/3/person/{$id}/movie_credits?api_key=".KEY."&language=pt-BR";

                $dados = file_get_contents($arquivo);

                $dados = json_decode($dados);

                foreach ($dados->cast as $filme) {
                    $foto = IMGS.$filme->poster_path;   
                    ?>
                    <div class="col-12 col-md-3">
                        <div class="card text-center">
                            <img src="<?= $foto ?>" alt="<?= $filme->title ?>" class="w-100">
                            <p class="titulo">
                                <strong>
                                    <?= $filme->title ?>
                                </strong>
                            </p>
                            <p>
                                <a href="filme/<?= $filme->id ?>" class="btn btn-warning">
                                    Ver filme
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php             
                }
                
            ?>

<?php
    }
?>