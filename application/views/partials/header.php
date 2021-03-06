<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SPK Jamu</title>
  <meta name="description" content="SI - SPK Jamu">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/main.css" />
  <link rel="icon shortcut" href="./assets/icon/favicon.png">
  <script src="<?php echo base_url()?>js/jquery.min.js" type="text/javascript"></script>
</head>
<body class="flex-wrap">
  <nav class="static mb-5">
    <div class="container">
      <div class="flex-wrap">
        <h1 class="blog-title">
          SPK Jamu
        </h1>
        <div class="link-wrapper">
          <ul class="link">
            <li id="home">
              <a href="<?php echo base_url()?>">Matrix</a>
            </li>
            <li id="uji">
              <a href="<?php echo base_url('uji')?>">Uji</a>
            </li>
            <li id="spk">
              <a href="<?php echo base_url('spk')?>">SPK - WP</a>
            </li>
            <li id="normalisasi">
              <a href="<?php echo base_url('normalisasi')?>">Normalisasi</a>
            </li>
            <li id="alternatif">
              <a href="<?php echo base_url('alternatif')?>">Alternatif</a>
            </li>
            <li id="kriteria">
              <a href="<?php echo base_url('kriteria')?>">Kriteria</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <div class="v-spacer">
  <script>
    var raw = location.href.split('/');
    var url = raw[raw.length-1];
    var activated=false;
    $('.link').children('li').each(function(index,val){
      var text = $(val).attr('id');
      console.log(text, url);
      if(url === text) {
        $(val).addClass('active');
        activated=true;
      };
    });
    if(!activated) $('#home').addClass('active');

  </script>