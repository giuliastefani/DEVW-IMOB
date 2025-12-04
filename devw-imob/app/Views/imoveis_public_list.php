<?= $this->extend('layout') ?>

<?= $this->section('content') ?>
<div class="container container-card">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0">Imóveis disponíveis</h1>
  </div>

  <?php if (empty($imoveis) || ! is_array($imoveis)): ?>
    <div class="alert alert-info">Nenhum imóvel encontrado.</div>
  <?php else: ?>
    <?php $imovelModel = model('ImovelModel'); ?>
    <div class="row g-3">
      <?php foreach ($imoveis as $imovel): ?>
        <?php
          $item = is_object($imovel) ? $imovel : (is_array($imovel) ? (object)$imovel : null);
          $id = $item->id ?? '';
          $titulo = $item ? $imovelModel->getTituloFormatado($item) : 'Sem título';
          $bairro = $item->bairro ?? '';
          $cidade = $item->cidade ?? '';
          $preco = $item->preco ?? null;
          $foto = $item->foto ?? '';
        ?>
        <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            <?php if (! empty($foto)): ?>
              <img src="<?= esc(base_url('uploads/' . $foto)) ?>" class="card-img-top" alt="<?= esc($titulo) ?>">
            <?php else: ?>
              <div class="bg-light d-flex align-items-center justify-content-center" style="height:180px;color:var(--muted);border-top-left-radius:12px;border-top-right-radius:12px;">
                Imagem indisponível
              </div>
            <?php endif; ?>

            <div class="card-body d-flex flex-column">
              <h5 class="card-title mb-1"><?= esc($titulo) ?></h5>
              <p class="card-text text-muted small mb-2"><?= esc($bairro) ?><?= $bairro && $cidade ? ', ' : '' ?><?= esc($cidade) ?></p>

              <?php if ($preco !== null && $preco !== ''): ?>
                <p class="fw-bold mb-2 mt-auto">R$ <?= number_format((float)$preco, 2, ',', '.') ?></p>
              <?php endif; ?>

              <?php if ($id !== ''): ?>
                <a href="<?= base_url('imovel/' . $id) ?>" class="btn btn-primary mt-2">Ver detalhes</a>
              <?php else: ?>
                <a class="btn btn-secondary mt-2 disabled" aria-disabled="true">Sem detalhes</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
<?= $this->endSection() ?>