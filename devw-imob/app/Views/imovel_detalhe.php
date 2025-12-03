<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h1><?= $imovelModel->getTituloFormatado($imovel) ?></h1>
    </div>
    <div class="card-body">
        <h5 class="card-title">Localização</h5>
        <p class="card-text">
            <?= $imovel->rua ?>, <?= $imovel->numero ?> <br>
            <?= $imovel->bairro ?> - <?= $imovel->cidade ?>
        </p>

        <hr>

        <h5 class="card-title">Detalhes</h5>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Tipo:</b> <?= $imovel->tipo_imovel ?></li>
            <li class="list-group-item"><b>Transação:</b> <?= $imovel->tipo_transacao ?></li>
            <li class="list-group-item"><b>Quartos:</b> <?= $imovel->quantidade_quartos ?></li>
            <li class="list-group-item"><b>Banheiros:</b> <?= $imovel->quantidade_banheiros ?></li>
            <li class="list-group-item"><b>Área:</b> <?= $imovel->metros_quadrados ?> m²</li>
        </ul>
    </div>
    <div class="card-footer">
        <a href="<?= base_url('/') ?>" class="btn btn-secondary">Voltar para a lista</a>
        <?php
        $perfil = service('session')->get('perfil');
        $usuarioId = service('session')->get('usuario_id');
        ?>
        <?php if ($perfil !== 'admin'): ?>
            <?php if (! $usuarioId): ?>
                <a href="<?= base_url('login') ?>" class="btn btn-primary">Entrar</a>
                <a href="<?= base_url('registrar') ?>" class="btn btn-outline-primary">Registrar</a>
            <?php else: ?>
                <a href="<?= base_url('visitas/formulario?imovel_id=' . (isset($imovel->id) ? $imovel->id : '')) ?>" class="btn btn-success">Agendar Visita</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>