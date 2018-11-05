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
            <th class="alternatif"><?= $value['alternatif'] ?></th>
            <?php foreach ($allKriteria as $kriteria) { ?>
              <td class="text-center" scope="col">
                <?= isset($value['kriteria'][$kriteria['nm_kriteria']])?$value['kriteria'][$kriteria['nm_kriteria']]:null ?>
              </td>
            <?php } ?>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<script>
  $('[style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;"]').hide();
  $('.alternatif').each(function(idx, el){
    var text = $(el).text().trim();
    if(!text) $(el).closest('tr').hide();
  });
</script>