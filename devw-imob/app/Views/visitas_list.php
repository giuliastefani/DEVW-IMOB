<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<h1 class="text-center mb-4">Lista de Visitas Agendadas</h1>
<?php $perfil = service('session')->get('perfil'); $prefix = ($perfil === 'admin') ? 'admin/' : ''; ?>
<?php if ($perfil !== 'admin'): ?>
    <a href="<?= base_url($prefix . 'visitas/formulario') ?>" class="btn btn-success">Agendar Nova Visita</a>
<?php endif; ?>

<?php if (isset($msg) && $msg != ""): ?>
    <div class="alert alert-success mt-3"><?= $msg ?></div>
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
                    <td><?= $visita->id ?></td>
                    <td><?= $visita->nome_cliente ?></td>
                    <td><?= $visita->tipo_imovel . ' em ' . $visita->bairro ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($visita->data)) ?></td>
                    <td class="text-end">
                        <?php if (service('session')->get('perfil') !== 'admin'): ?>
                            <a href="<?= base_url($prefix . 'visitas/editar/' . $visita->id) ?>" class="btn btn-sm btn-warning">
                                Editar
                            </a>
                        <?php endif; ?>

                        <?php ?>
                        <a href="<?= base_url((service('session')->get('perfil') === 'admin' ? 'admin/visitas/excluir/' : 'visitas/excluir/') . $visita->id) ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Deseja realmente excluir?')">
                            Excluir
                        </a>
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
<?= $this->endSection() ?>