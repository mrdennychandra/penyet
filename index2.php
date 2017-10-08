<?php
include './konfigurasi/config.php';
include './konfigurasi/function.php';
include './fragment/header.php';
include './fragment/menu.php';
$con = connect_db();
?>
<style>
    pre { margin:1em 0; }
    select.selectpicker { display:none; /* Prevent FOUC */}
</style>
<script>
    var idx = 0;
    function hapus(idx) {
        $("#tr_" + idx).remove();
    }

    function add_content(val) {
        var explode = val.split('|');
        var value = explode[0];
        var content = '<tr id="tr_' + idx + '">';
        content += '<td>';
        content += '<input value="' + value + '" type="hidden" name="makanan[]"">';
        content += '<input value="' + val + ' "type="text" readonly name="label[]"">';
        content += '</td>';
        content += '<td>';
        content += '<input type="text" name="jumlah[]">';
        content += '</td>';
        content += '<td>';
        content += '<a href="#" onclick=\'hapus(' + idx + ')\'">hapus</a>';
        content += '</td>';
        content += '</tr>';
        $("#tabel").append(content);
    }

    $(function () {
        $("#makanan").change(function () {
            var value = $("#makanan").selectpicker('val');
            add_content(value);
            idx++;
        });
    });
</script>
<div class="container">
    <h2>Pesan Makanan</h2>
    <form class="form-horizontal"
          name="formbeli" 
          method="post" 
          id="formbeli" 
          action="nota.php">
        <div class="form-group">
            <label class="control-label col-sm-2" for="meja">Nomor Meja</label>
            <div class="col-sm-10">
                <select name="meja" id="meja" class="selectpicker">
                    <?php
                    $query = "SELECT * FROM meja WHERE tersedia=1";
                    $result = execute_query($con, $query);
                    while ($meja = mysqli_fetch_array($result)) {
                        ?>
                        <option value="<?= $meja['mejaid'] ?>"><?= $meja['nomor'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="faktur">Makanan</label>
            <div class="col-sm-10">
                <select title="Select your surfboard" class="selectpicker" id="makanan">
                    <option>Pilih...</option>
                    <?php
                    $query_makanan = "SELECT * FROM makanan";
                    $result_makanan = execute_query($con, $query_makanan);
                    while ($makanan = mysqli_fetch_array($result_makanan)) {
                        ?>
                        <option value="<?= $makanan['makananid'] ?>|<?= $makanan['nama'] ?>" data-thumbnail="<?= IMAGEPATH . '/menu/' . $makanan['gambar'] ?>"><?= $makanan['nama'] ?>(<?= $makanan['persediaan'] ?>)</option>                            <?php
                    }
                    ?>

                </select>
            </div>
        </div>
        <div class="form-group">
            <table id="tabel" class="table table-hover">
                <tr>
                    <th>Makanan</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </table>
        </div>
        <div class="form-group" style="float: right"> 
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-success" value="Bayar" id="submit" name="submit">
            </div>
        </div>
    </form>
</div>