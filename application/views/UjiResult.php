<div class="container">
  <p class="home-title" >Hasil Uji</p>

  <table class="table mt-5">
    <thead>
      <tr>
        <th class="text-center" scope="col">Rank</th>
        <th class="text-center" scope="col">Nama</th>
        <?php foreach ($allKriteria as $kriteria) { ?>
          <th class="text-center" scope="col">
            <?= $kriteria['nm_kriteria'] ?>
          </th>
        <?php } ?>
      </tr>
    </thead>
    <tbody class="table-body">
      <?php 
      $idx = 1;
      foreach ($allValue as $value) { ?>
          <tr>
            <th><?= $idx++ ?></th>
            <td data-id="<?= $value['alternatifId'] ?>" class="alternatif"><?= $value['alternatif'] ?></th>
            <?php foreach ($allKriteria as $kriteria) { ?>
              <td class="text-center" scope="col" data-id="<?= $kriteria['id_kriteria'] ?>">
                <?= $value['kriteria'][$kriteria['nm_kriteria']] ?>
              </td>
            <?php } ?>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script>
  $('#home').removeClass('active')
</script>