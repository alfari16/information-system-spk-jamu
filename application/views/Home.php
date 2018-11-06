<div class="container">
  <p class="home-title" >Matriks Nilai</p>

  <table class="table mt-5">
    <thead>
      <tr>
        <th class="text-center" scope="col">#</th>
        <?php foreach ($allKriteria as $kriteria) { ?>
          <th class="text-center" scope="col">
            <?= $kriteria['nm_kriteria'] ?>
            (Bobot: <?= $kriteria['bobot'] ?>)
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
                <form action="<?= base_url('Home/edit') ?>" method="POST">
                  <select class="select form-control" name="id_skala">
                    <?php foreach ($allSkala as $skala) { ?>
                      <option value="<?= $skala['id_skala'] ?>" <?= $value['kriteria'][$kriteria['nm_kriteria']] === $skala['nm_skala'] ? 'selected' : '' ?>><?= $skala['nm_skala'] ?></option>
                    <?php } ?>
                  </select>
                  <input type="hidden" name="id_kriteria" value="<?= $kriteria['id_kriteria'] ?>">
                  <input type="hidden" name="id_alternatif" value="<?= $value['alternatifId'] ?>">
                  <input type="submit" class="hidden btn-submit">
                </form>
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