<?php $sess = service('session'); $perfil = $sess->get('perfil'); $nome = $sess->get('nome'); ?>
<nav class="navbar navbar-expand-md navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="<?= base_url() ?>">Imobiliária</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
                <li class="nav-item"><a class="nav-link" href="<?= ($perfil === 'admin') ? base_url('admin') : base_url() ?>">Início</a></li>
                <?php if ($perfil === 'admin'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/imoveis') ?>">Gerenciar Imóveis</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('admin/visitas') ?>">Ver Visitas</a></li>
                <?php endif; ?>
                <?php if ($perfil === 'usuario'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('perfil') ?>">Meu Perfil</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('visitas') ?>">Minhas Visitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('visitas/formulario') ?>">Agendar Visita</a></li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if (!$perfil): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('login') ?>">Entrar</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('registrar') ?>">Registrar</a></li>
                <?php else: ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= esc($nome) ?></a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <?php if ($perfil === 'usuario'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('perfil') ?>">Meu Perfil</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('visitas/formulario') ?>">Agendar Visita</a></li>
                            <?php endif; ?>
                            <?php if ($perfil === 'admin'): ?>
                                <li><a class="dropdown-item" href="<?= base_url('admin/imoveis') ?>">Gerenciar Imóveis</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('admin/visitas') ?>">Ver Visitas</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= base_url('logout') ?>">Sair</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div style="height:70px;"></div>
