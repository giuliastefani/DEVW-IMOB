<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Imóvel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark container">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url() ?>">Imobiliária</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('imoveis') ?>">Gestão de
                            Imóveis</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('clientes') ?>">Gestão de
                            Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('visitas') ?>">Gestão de
                            Visitas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="padding-top: 50px;">
        <div class="card">
            <div class="card-header">
                <h1><?php echo $imovelModel->getTituloFormatado($imovel) ?></h1>
            </div>
            <div class="card-body">
                <h5 class="card-title">Localização</h5>
                <p class="card-text">
                    <?php echo $imovel->rua ?>, <?php echo $imovel->numero ?> <br>
                    <?php echo $imovel->bairro ?> - <?php echo $imovel->cidade ?>
                </p>

                <hr>

                <h5 class="card-title">Detalhes</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Tipo:</b> <?php echo $imovel->tipo_imovel ?></li>
                    <li class="list-group-item"><b>Transação:</b> <?php echo $imovel->tipo_transacao ?></li>
                    <li class="list-group-item"><b>Quartos:</b> <?php echo $imovel->quantidade_quartos ?></li>
                    <li class="list-group-item"><b>Banheiros:</b> <?php echo $imovel->quantidade_banheiros ?></li>
                    <li class="list-group-item"><b>Área:</b> <?php echo $imovel->metros_quadrados ?> m²</li>
                </ul>
            </div>
            <div class="card-footer">
                <a href="<?php echo base_url('/') ?>" class="btn btn-secondary">Voltar para a lista</a>
            </div>
        </div>
    </div>
</body>

</html>