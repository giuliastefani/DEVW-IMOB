<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<h1 class="text-center mb-4">Lista de Clientes</h1>
<?php $perfil = service('session')->get('perfil'); $prefix = ($perfil === 'admin') ? 'admin/' : ''; ?>
<a href="<?= base_url($prefix . 'clientes/adicionar') ?>" class="btn btn-success">Cadastrar Novo Cliente</a>

<?php if (isset($msg) && $msg != ""): ?>
    <div class="alert alert-success mt-3"><?= $msg ?></div>
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
                    <td><?= $cliente->id ?></td>
                    <td><?= $cliente->nome ?></td>
                    <td><?= $cliente->cpf ?></td>
                    <td><?= date('d/m/Y', strtotime($cliente->data_nascimento)) ?></td>
                    <td>
                        <a href="<?= base_url($prefix . 'clientes/editar/' . $cliente->id) ?>"
                            class="btn btn-sm btn-secondary">Editar</a>
                        &nbsp;
                        <a href="<?= base_url($prefix . 'clientes/excluir/' . $cliente->id) ?>"
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
<?= $this->endSection() ?>