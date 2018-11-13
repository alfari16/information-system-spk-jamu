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
        <th class="text-center" scope="col">Total * Bobot</th>
        <th class="text-center" scope="col">Ranking</th>
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
            <td class="text-center" scope="col" data-id="<?= $kriteria['id_kriteria'] ?>">
              <?= $value['total'] ?>
            </td>
            <td class="text-center rank-class" scope="col" data-id="<?= $value['alternatifId'] ?>">
              
            </td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script>
  const arr = JSON.parse(`<?= $allValueJson; ?>`).sort((a,b) => b.total-a.total);
  console.log(arr);
  $('.rank-class').each(function(idx, val){
    const id = $(this).attr('data-id');
    let find = arr.findIndex(el => el.alternatifId === id )+1
    $(this).text(find)
  })
</script>