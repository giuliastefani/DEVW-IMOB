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
    <?php
    $visitaId = '';
    if (isset($visita)) {
        if (is_object($visita) && isset($visita->id)) {
            $visitaId = $visita->id;
        } elseif (is_array($visita) && isset($visita['id'])) {
            $visitaId = $visita['id'];
        }
    }
    ?>
    <input type="hidden" name="id" value="<?= esc($visitaId) ?>">

    <div class="mb-3">
        <label for="id_cliente" class="form-label">Cliente</label>
        <?php
        $usuarioId = service('session')->get('usuario_id');
        if ($usuarioId) {
            $clienteModel = model('ClienteModel');
            $clienteLogado = $clienteModel->where('usuario_id', $usuarioId)->first();
            if ($clienteLogado) {
                echo '<div class="form-control">' . esc($clienteLogado->nome) . ' (CPF: ' . esc($clienteLogado->cpf) . ')</div>';
                echo '<input type="hidden" name="id_cliente" value="' . esc($clienteLogado->id) . '">';
            } else {
                echo $comboClientes;
            }
        } else {
            echo $comboClientes;
        }
        ?>
    </div>

    <div class="mb-3">
        <label for="id_imovel" class="form-label">Imóvel</label>
        <?= $comboImoveis ?>
    </div>

    <div class="mb-3">
        <label for="data" class="form-label">Data e Hora da Visita</label>
        <?php
        $dataValor = '';
        if (isset($visita)) {
            if (is_object($visita) && isset($visita->data) && $visita->data) {
                $dataValor = date('Y-m-d\TH:i', strtotime($visita->data));
            } elseif (is_array($visita) && ! empty($visita['data'])) {
                $dataValor = date('Y-m-d\TH:i', strtotime($visita['data']));
            }
        }
        ?>
        <input type="datetime-local" class="form-control" id="data" name="data" value="<?= $dataValor ?>"
            required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Agendamento</button>
    <?php $perfil = service('session')->get('perfil'); ?>
    <a href="<?= ($perfil === 'admin') ? base_url('admin/visitas') : base_url('visitas') ?>" class="btn btn-secondary">Voltar</a>
</form>
<?= $this->endSection() ?>