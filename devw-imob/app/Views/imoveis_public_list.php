<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imobiliária - Nossos Imóveis</title>
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
        <h1 class="text-center mb-4">Nossos Imóveis Disponíveis</h1>

        <div class="list-group">
            <?php if (!empty($imoveis)): ?>
                <?php foreach ($imoveis as $imovel): ?>
                    <?php
                    $titulo = $imovelModel->getTituloFormatado($imovel) .
                        ' em ' . $imovel->bairro . ', ' . $imovel->cidade .
                        ' (Para ' . $imovel->tipo_transacao . ')';
                    ?>
                    <a href="<?php echo base_url('imovel/' . $imovel->id) ?>" class="list-group-item list-group-item-action">
                        <?php echo $titulo ?>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Nenhum imóvel cadastrado no momento.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>