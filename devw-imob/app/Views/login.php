<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Entrar</h3>
            </div>
            <div class="card-body">
                <?php echo csrf_field(); ?>
                
                <?php if (isset($msg) && $msg != ""): ?>
                    <div class="alert alert-danger"><?= esc($msg) ?></div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Informe seu usuário" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe sua senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Entrar</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0">Ainda não tem conta? <a href="<?= base_url('registrar') ?>">Registre-se aqui</a></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>