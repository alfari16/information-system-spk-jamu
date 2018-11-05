<form class="mb-3" action="<?= base_url('Kriteria/insert') ?>" method="POST">
    <div class="row">
      <div class="col-md-6">
        <label >Nama Kriteria: </label>
        <input type="text" class="form-control" name="nama_kriteria">
      </div>
      <div class="col-md-6">
        <label >Bobot: </label>
        <input type="number" class="form-control" name="bobot">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-md-4">
        <label >Nilai kriteria 1: </label>  
        <input type="text" name="nilai1" class="form-control">
      </div>
      <div class="col-md-4">
        <label >Nilai kriteria 2: </label>  
        <input type="text" name="nilai2" class="form-control">
      </div>
      <div class="col-md-4">
        <label >Nilai kriteria 3: </label>  
        <input type="text" name="nilai3" class="form-control">
      </div>
    </div>
    <button style="height:35px;align-items:center;justify-content:center;padding:0" class="btn btn-primary form-control mt-3 mb-4" type="submit">Tambah</button>
  </form>

<div class="container">
  <table class="table mt-5">
    <thead>
      <tr>
        <th class="text-center" scope="col">#</th>
        <th class="text-center" scope="col">Nama Jamu</th>
        <th class="text-center" scope="col">Keterangan</th>
      </tr>
    </thead>
    <tbody class="table-body">
      
    </tbody>
  </table>
  <p class="text-warning">*Urutan jamu berdasarkan prioritas</p>
</div>

<script>
  $(document).ready(function(){
    const template = (jamu, index) => `
      <tr>
        <th class="text-center" scope="row" class="id">${index}</th>
        <td class="text-capitalized">${jamu.nama_jamu.trim()}</td>
        <td>${jamu.keterangan}</td>
      </tr>
    ` 
    const arrOrigin = <?= $encode ?>;
    const sub = <?= $subKriteria ?>;
    console.log('ALTERNATIF ',arrOrigin);
    console.log('KRITERIA ', sub);

    function cloneArr(){
      const newArr = [];
      arrOrigin.forEach(el => {
        newArr.push({...el});
      })
      return newArr;
    }

    function order(){
      $('tbody').empty();
      const arr = cloneArr();
      $('.form select').each((idx, select) => {
        const attr = $(select).attr('name').toLowerCase();
        
        const val = $(select).val();
        arr.forEach(element => {
          console.log('attr ', element[attr]);
          element[attr] = sub.find(el => el.id === element[attr]).nilai_kriteria_raw;
          const total = element[attr] = Math.abs(element[attr]-val);
          if(!element['total']) element['total'] = 0;
          element['total'] += total;
        });
      })
      arr.sort((a,b) => a.total - b.total)
      console.log('arr', arr);
      arr.forEach((element,idx) => {
        $('.table-body').append(template(element, idx+1));
        // console.log(element,idx);
      });
    }

    order();

    $('.form').submit(function(e){
      e.preventDefault();
      order();
    })
  })
</script>