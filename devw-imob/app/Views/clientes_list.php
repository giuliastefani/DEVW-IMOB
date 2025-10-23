<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
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
                    <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('clientes') ?>">Gestão de
                            Clientes</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo base_url('visitas') ?>">Gestão de
                            Visitas</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="padding-top: 50px;">
        <h1 class="text-center mb-4">Lista de Clientes</h1>
        <a href="<?php echo base_url('clientes/adicionar') ?>" class="btn btn-success">Cadastrar Novo Cliente</a>

        <?php if (isset($msg) && $msg != ""): ?>
            <div class="alert alert-success mt-3"><?php echo $msg ?></div>
        <?php endif; ?>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientes)): ?>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente->id ?></td>
                            <td><?php echo $cliente->nome ?></td>
                            <td><?php echo $cliente->cpf ?></td>
                            <td><?php echo date('d/m/Y', strtotime($cliente->data_nascimento)) ?></td>
                            <td>
                                <a href="<?php echo base_url('clientes/editar/' . $cliente->id) ?>"
                                    class="btn btn-sm btn-secondary">Editar</a>
                                &nbsp;
                                <a href="<?php echo base_url('clientes/excluir/' . $cliente->id) ?>"
                                    onclick="return confirm('Deseja realmente excluir este cliente?')"
                                    class="btn btn-sm btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum cliente cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>