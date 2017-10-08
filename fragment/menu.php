<?php
//mendapatkan uri segment (divisi,karyawan,users) utk css active pada menu
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$folder = $uri_segments[2];
?>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Waroeng Tenda</a>
        </div>
        
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?= $folder == 'index.php' ? 'class="active"' : '' ?>><a href="<?= BASEPATH ?>/index.php">Home <span class="sr-only">(current)</span></a></li>
                <li <?= $folder == 'laporan' ? 'class="active"' : '' ?>><a href="<?= BASEPATH ?>/laporan">Laporan</a></li>
            </ul>
        </div>
        
    </div>
</nav>