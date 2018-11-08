<div class="container">
  <p class="home-title" >Normalisasi</p>

  <table class="table mt-5">
    <thead>
      <tr>
        <th class="text-center" scope="col">#</th>
        <?php foreach ($allKriteria as $kriteria) { ?>
          <th class="text-center" scope="col">
            <?= $kriteria['nm_kriteria'] ?>
            (Bobot: <?= $kriteria['bobot'] ?>%)
          </th>
        <?php } ?>
      </tr>
    </thead>
    <tbody class="table-body">
      <?php foreach ($allValue as $value) { ?>
          <tr>
            <th data-id="<?= $value['alternatifId'] ?>" class="alternatif"><?= $value['alternatif'] ?></th>
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
  var kriteria = <?= $allKriteriaJson ?>.map(el => el.id_kriteria);
  console.log(kriteria);
  $('.select').change(function(e) {
    var kriteria = $(this).closest('td').attr('data-id');
    var alternatif = $(this).closest('tr').find('th').attr('data-id');
    console.log(alternatif, kriteria);
    $(this).siblings('.btn-submit').click()
  })
</script>