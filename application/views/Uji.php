<div class="container">
  <p class="home-title" >Uji Kriteria</p>
  <form action="<?= base_url('uji/kirim') ?>" method="POST">
    <?php foreach ($kriteria as $item) { ?>
      <div class="row mb-2">
        <div class="col-6">
          <?= $item['nm_kriteria'] ?>
        </div>
        <div class="col-6">
          <select name="<?= $item['id_kriteria'] ?>" class="form-control">
            <?php foreach ($skala as $value) { ?>
              <option value="<?= $value['id_skala'] ?>"><?= $value['nm_skala'] ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
    <?php } ?>
    <button class="btn btn-primary form-control mt-4">Uji</button>
  </form>
</div>