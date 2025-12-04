<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<h1 class="text-center mb-4"><?= $titulo ?></h1>

<?php if ($msg != ""): ?>
    <p class="alert alert-info"><?= $msg ?></p>
<?php endif; ?>

<?php if (isset($erros) && !empty($erros)): ?>
    <ul style="color:red;" class="alert alert-danger">
        <?php foreach ($erros as $erro): ?>
            <li><?= $erro ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="post" action="<?php 
    $perfil = service('session')->get('perfil'); 
    $isEditingProfile = ($titulo === 'Meu Perfil');
    echo ($isEditingProfile) ? base_url('perfil/editar') : base_url('admin/clientes/editar');
?>">
    <?php if ($isEditingProfile): ?>
        <input type="hidden" name="_method" value="PUT">
    <?php endif; ?>
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= isset($cliente) ? $cliente->id : "" ?>">

    <div class="mb-3">
        <label for="nome" class="form-label">Nome Completo</label>
        <input type="text" class="form-control" id="nome" name="nome"
            value="<?= isset($cliente) ? $cliente->nome : "" ?>" required>
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF (somente números)</label>
        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="11"
            value="<?= isset($cliente) ? $cliente->cpf : "" ?>" required>
    </div>

    <div class="mb-3">
        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"
            value="<?= isset($cliente) ? $cliente->data_nascimento : "" ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <?php $perfil = service('session')->get('perfil'); ?>
    <a href="<?= ($perfil === 'admin') ? base_url('admin/clientes') : base_url() ?>" class="btn btn-secondary">Voltar</a>
</form>
<?= $this->endSection() ?>