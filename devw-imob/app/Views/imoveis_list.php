<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Imóveis (Gestão)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark container">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo base_url() ?>">Imobiliária</a>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item"><a class="nav-link active" href="<?php echo base_url('imoveis') ?>">Gestão de
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
        <h1 class="text-center mb-4">Lista de Imóveis (Gestão)</h1>
        <a href="<?php echo base_url('imoveis/adicionar') ?>" class="btn btn-success">Cadastrar Novo Imóvel</a>

        <?php if (isset($msg) && $msg != ""): ?>
            <div class="alert alert-success mt-3"><?php echo $msg ?></div>
        <?php endif; ?>

        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título (Tipo/Quartos)</th>
                    <th>Cidade</th>
                    <th>Bairro</th>
                    <th>Transação</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($imoveis)): ?>
                    <?php foreach ($imoveis as $imovel): ?>
                        <tr>
                            <td><?php echo $imovel->id ?></td>
                            <td><?php echo $imovelModel->getTituloFormatado($imovel) ?></td>
                            <td><?php echo $imovel->cidade ?></td>
                            <td><?php echo $imovel->bairro ?></td>
                            <td><?php echo $imovel->tipo_transacao ?></td>
                            <td>
                                <a href="<?php echo base_url('imoveis/editar/' . $imovel->id) ?>"
                                    class="btn btn-sm btn-secondary">Editar</a>
                                &nbsp;
                                <a href="<?php echo base_url('imoveis/excluir/' . $imovel->id) ?>"
                                    onclick="return confirm('Deseja realmente excluir este imóvel?')"
                                    class="btn btn-sm btn-danger">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum imóvel cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>