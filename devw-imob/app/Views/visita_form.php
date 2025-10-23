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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('visitas') ?>">Gestão de
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
            <input type="hidden" name="id" value="<?php echo isset($visita) ? $visita->id : "" ?>">

            <div class="mb-3">
                <label for="id_cliente" class="form-label">Cliente</label>
                <?php echo $comboClientes ?>
            </div>

            <div class="mb-3">
                <label for="id_imovel" class="form-label">Imóvel</label>
                <?php echo $comboImoveis ?>
            </div>

            <div class="mb-3">
                <label for="data" class="form-label">Data e Hora da Visita</label>
                <?php
                $dataValor = '';
                if (isset($visita) && $visita->data) {
                    $dataValor = date('Y-m-d\TH:i', strtotime($visita->data));
                }
                ?>
                <input type="datetime-local" class="form-control" id="data" name="data" value="<?php echo $dataValor ?>"
                    required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
            <a href="<?php echo base_url('visitas') ?>" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</body>

</html>