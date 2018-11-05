<div class="container">
  <p>Tambah Kriteria</p>
  <div >
    <form class="row mb-3" action="<?= base_url('kriteria/insert') ?>" method="POST">
      <div class="col-md-3">
        <label >Nama Kriteria: </label>
        <input type="text" class="form-control" name="nm_kriteria">
      </div>
      <div class="col-md-3">
        <label >Keterangan: </label>  
        <textarea name="keterangan" class="form-control" style="height:35px"></textarea>
      </div>
      <div class="col-md-3">
        <label >Bobot: </label>  
        <select name="skala" class="form-control">
          <?php foreach ($bobot as $item) {  ?>
            <option value="<?= $item['id_skala'] ?>"><?= $item['nm_skala'] ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="col-md-3 row" style="align-items:flex-end;padding-left:30px">
        <button style="height:35px;align-items:center;justify-content:center;padding:0" class="row btn btn-primary form-control" type="submit">Tambah</button>
      </div>
    </form>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" scope="col">#</th>
        <th class="text-center" scope="col">Nama Kriteria</th>
        <th class="text-center" scope="col">Keterangan</th>
        <th class="text-center" scope="col">Bobot</th>
        <th class="text-center" scope="col">Hapus</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($items as $value) { ?>
        <tr>
          <th class="text-center" scope="row" class="id"><?= $value['id_kriteria'] ?></th>
          <td class="text-capitalized"><?= $value['nm_kriteria'] ?></td>
          <td class="text-capitalized"><?= $value['keterangan'] ?></td>
          <td><?= $value['bobot'] ?></td>
          <td class="text-center" style="cursor:pointer" class="delete"><i class="fa fa-trash fa-2x"></i></td>
        </tr>
      <?php 
        } 
      ?>
    </tbody>
  </table>
</div>
<script>
  $('i').click(function(){
    var id = $(this).closest('td').siblings('th').text();
    location.href = '<?= base_url("kriteria/delete/"); ?>'+id;
  });
</script>