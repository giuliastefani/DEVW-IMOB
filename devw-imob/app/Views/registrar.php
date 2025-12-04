<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Registrar Novo Usuário</h3>
            </div>
            <div class="card-body">
                <?php echo csrf_field(); ?>
                
                <?php if (isset($msg) && $msg != ""): ?>
                    <div class="alert alert-success"><?= esc($msg) ?></div>
                <?php endif; ?>

                <?php if (isset($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="post">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome completo" required>
                    </div>

                    <div class="mb-3">
                        <label for="usuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Escolha um usuário" required>
                    </div>

                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Crie uma senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
                </form>
            </div>
            <div class="card-footer text-center">
                <p class="mb-0">Já tem conta? <a href="<?= base_url('login') ?>">Entre aqui</a></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>