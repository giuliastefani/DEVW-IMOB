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

<form method="post">
    <input type="hidden" name="id" value="<?= isset($imovel) ? $imovel->id : "" ?>">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade"
                value="<?= isset($imovel) ? $imovel->cidade : "" ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro"
                value="<?= isset($imovel) ? $imovel->bairro : "" ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9 mb-3">
            <label for="rua" class="form-label">Rua</label>
            <input type="text" class="form-control" id="rua" name="rua"
                value="<?= isset($imovel) ? $imovel->rua : "" ?>" required>
        </div>
        <div class="col-md-3 mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" class="form-control" id="numero" name="numero"
                value="<?= isset($imovel) ? $imovel->numero : "" ?>" required>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="tipo_imovel" class="form-label">Tipo do Imóvel</label>
            <?= $comboTipoImovel ?>
        </div>
        <div class="col-md-4 mb-3">
            <label for="tipo_transacao" class="form-label">Tipo de Transação</label>
            <?= $comboTransacao ?>
        </div>
        <div class="col-md-4 mb-3">
            <label for="metros_quadrados" class="form-label">Metros Quadrados (m²)</label>
            <input type="number" class="form-control" id="metros_quadrados" name="metros_quadrados"
                value="<?= isset($imovel) ? $imovel->metros_quadrados : "" ?>" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="quantidade_quartos" class="form-label">Qtd. Quartos</label>
            <input type="number" class="form-control" id="quantidade_quartos" name="quantidade_quartos"
                value="<?= isset($imovel) ? $imovel->quantidade_quartos : "" ?>" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="quantidade_banheiros" class="form-label">Qtd. Banheiros</label>
            <input type="number" class="form-control" id="quantidade_banheiros" name="quantidade_banheiros"
                value="<?= isset($imovel) ? $imovel->quantidade_banheiros : "" ?>" required>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
    <?php $perfil = service('session')->get('perfil'); ?>
    <a href="<?= ($perfil === 'admin') ? base_url('admin/imoveis') : base_url() ?>" class="btn btn-secondary">Voltar</a>
</form>
<?= $this->endSection() ?>