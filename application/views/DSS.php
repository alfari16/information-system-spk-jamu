<div class="container">
  <p class="home-title" >Masukan kriteria jamu</p>
  <form action="<?= base_url() ?>" method="GET" name="form_kriteria" class="form">
    <div class="row">
      <?php foreach ($allKriteria as $kriteria => $value) { ?>
        <div class="col-md-<?= $kriteriaSize ?>">
          <label><?= $kriteria ?></label>
          <select name="<?= $kriteria ?>" class="form-control" value>
            <?php foreach ($value as $val) { ?>
              <option value="<?= $val['nilai_kriteria_raw'] ?>"><?= $val['nilai_kriteria'] ?></option>
            <?php } ?>
          </select>
        </div>
      <?php } ?>
    </div>
    <button class="btn btn-primary mt-3 form-control">Submit</button>
  </form>
</div>