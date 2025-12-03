<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<h1 class="text-center mb-4">Lista de Imóveis (Gestão)</h1>
<?php $perfil = service('session')->get('perfil'); $prefix = ($perfil === 'admin') ? 'admin/' : ''; ?>
<a href="<?= base_url($prefix . 'imoveis/adicionar') ?>" class="btn btn-success">Cadastrar Novo Imóvel</a>

<?php if (isset($msg) && $msg != ""): ?>
    <div class="alert alert-success mt-3"><?= $msg ?></div>
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
                    <td><?= $imovel->id ?></td>
                    <td><?= $imovelModel->getTituloFormatado($imovel) ?></td>
                    <td><?= $imovel->cidade ?></td>
                    <td><?= $imovel->bairro ?></td>
                    <td><?= $imovel->tipo_transacao ?></td>
                    <td>
                        <a href="<?= base_url($prefix . 'imoveis/editar/' . $imovel->id) ?>"
                            class="btn btn-sm btn-secondary">Editar</a>
                        &nbsp;
                        <a href="<?= base_url($prefix . 'imoveis/excluir/' . $imovel->id) ?>"
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
<?= $this->endSection() ?>