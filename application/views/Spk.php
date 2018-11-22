<div class="container">
  <p class="home-title" >SPK - Weighted Product</p>

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
        <th class="text-center" scope="col">Vektor S</th>
        <th class="text-center" scope="col">Vektor V</th>
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
              <?= $value['vektorS'] ?>
            </td>
            <td class="text-center" scope="col" data-id="<?= $kriteria['id_kriteria'] ?>">
              <?= $value['vektorV'] ?>
            </td>
            <td class="text-center rank-class" scope="col" data-id="<?= $value['alternatifId'] ?>">
              
            </td>
          </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script>
  let rank = 1, before = null;
  const arr = JSON.parse(`<?= $allValueJson; ?>`)
    .sort((a, b) => b.vektorV - a.vektorV)
    .map(el => {
      if(before && el.vektorV < before) rank++;
      before = el.vektorV;
      return {
        ...el,
        rank: rank
      }
    })
    ;
  console.log(arr);
  $('.rank-class').each(function(idx, val){
    const id = $(this).attr('data-id');
    let find = arr.find(el => el.alternatifId === id ).rank
    $(this).text(find)
  })
</script>