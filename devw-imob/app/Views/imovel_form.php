<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titulo ?></title>
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
        <h1 class="text-center mb-4"><?php echo $titulo ?></h1>

        <?php if ($msg != ""): ?>
            <p class="alert alert-info"><?php echo $msg ?></p>
        <?php endif; ?>

        <?php if (isset($erros) && !empty($erros)): ?>
            <ul style="color:red;" class="alert alert-danger">
                <?php foreach ($erros as $erro): ?>
                    <li><?php echo $erro ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="id" value="<?php echo isset($imovel) ? $imovel->id : "" ?>">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" class="form-control" id="cidade" name="cidade"
                        value="<?php echo isset($imovel) ? $imovel->cidade : "" ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" class="form-control" id="bairro" name="bairro"
                        value="<?php echo isset($imovel) ? $imovel->bairro : "" ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-9 mb-3">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" class="form-control" id="rua" name="rua"
                        value="<?php echo isset($imovel) ? $imovel->rua : "" ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" class="form-control" id="numero" name="numero"
                        value="<?php echo isset($imovel) ? $imovel->numero : "" ?>" required>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tipo_imovel" class="form-label">Tipo do Imóvel</label>
                    <?php echo $comboTipoImovel ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="tipo_transacao" class="form-label">Tipo de Transação</label>
                    <?php echo $comboTransacao ?>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="metros_quadrados" class="form-label">Metros Quadrados (m²)</label>
                    <input type="number" class="form-control" id="metros_quadrados" name="metros_quadrados"
                        value="<?php echo isset($imovel) ? $imovel->metros_quadrados : "" ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="quantidade_quartos" class="form-label">Qtd. Quartos</label>
                    <input type="number" class="form-control" id="quantidade_quartos" name="quantidade_quartos"
                        value="<?php echo isset($imovel) ? $imovel->quantidade_quartos : "" ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantidade_banheiros" class="form-label">Qtd. Banheiros</label>
                    <input type="number" class="form-control" id="quantidade_banheiros" name="quantidade_banheiros"
                        value="<?php echo isset($imovel) ? $imovel->quantidade_banheiros : "" ?>" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?php echo base_url('imoveis') ?>" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>