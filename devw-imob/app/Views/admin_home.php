<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="text-center">
    <h1>Painel de Administração</h1>
    <p class="lead">Bem-vindo ao painel de controle.</p>
    <hr>
    <div class="row mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gerenciar Imóveis</h5>
                    <p class="card-text">Cadastre, edite ou remova imóveis.</p>
                    <a href="<?= base_url('admin/imoveis') ?>" class="btn btn-primary">Ir para Imóveis</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Ver Visitas</h5>
                    <p class="card-text">Visualize todos os agendamentos de visitas.</p>
                    <a href="<?= base_url('admin/visitas') ?>" class="btn btn-primary">Ir para Visitas</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
