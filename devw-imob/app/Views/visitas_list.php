<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Visitas Agendadas</title>
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
        <h1 class="text-center mb-4">Lista de Visitas Agendadas</h1>
        <a href="<?php echo base_url('visitas/formulario') ?>" class="btn btn-success">Agendar Nova Visita</a>

        <?php if (isset($msg) && $msg != ""): ?>
            <div class="alert alert-success mt-3"><?php echo $msg ?></div>
        <?php endif; ?>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Imóvel</th>
                    <th>Data e Hora</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($visitas)): ?>
                    <?php foreach ($visitas as $visita): ?>
                        <tr>
                            <td><?php echo $visita->id ?></td>
                            <td><?php echo $visita->nome_cliente ?></td>
                            <td><?php echo $visita->tipo_imovel . ' em ' . $visita->bairro ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($visita->data)) ?></td>
                            <td>
                                <a href="<?php echo base_url('visitas/formulario/' . $visita->id) ?>"
                                    class="btn btn-sm btn-secondary">Editar</a>
                                &nbsp;
                                <a href="<?php echo base_url('visitas/excluir/' . $visita->id) ?>"
                                    onclick="return confirm('Deseja realmente excluir este agendamento?')"
                                    class="btn btn-sm btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhuma visita agendada.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>