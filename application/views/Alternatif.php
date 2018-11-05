<div class="container">
  <div >

    <form class="row mb-3" action="<?= base_url('alternatif/insert') ?>" method="POST">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-6">
            <label >Nama Jamu: </label>
            <input type="text" class="form-control" name="nm_alternatif">
          </div>
          <div class="col-md-6">
            <label >Keterangan: </label>  
            <textarea name="keterangan" class="form-control" style="height:35px"></textarea>
          </div>
        </div>
      </div>
      <div class="col-md-3 row" style="align-items:flex-end;padding-left:30px">
        <button style="height:35px;align-items:center;justify-content:center;padding:0" class="row btn btn-primary form-control" type="submit">Tambah</button>
      </div>
    </form>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th class="text-center" scope="col">ID</th>
        <th class="text-center" scope="col">Nama Jamu</th>
        <th class="text-center" scope="col">Keterangan</th>
        <th class="text-center" scope="col">Hapus</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($items as $item) { ?>
        <tr>
          <th class="text-center" scope="row" class="id"><?= $item["id_alt"] ?></th>
          <td class="text-capitalized"><?= $item["nm_alternatif"] ?></td>
          <td><?= $item["keterangan"] ?></td>
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
    location.href = '<?= base_url("alternatif/delete/"); ?>'+id;
  });
</script>