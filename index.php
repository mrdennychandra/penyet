<?php
include './konfigurasi/config.php';
include './konfigurasi/function.php';
include './fragment/header.php';
include './fragment/menu.php';
$con = connect_db();
?>
<main>
    <div class="row" id="pilihmeja">
        <div class="page-header">
            <h1>Meja <small id="meja"></small></h1>
        </div>
        <select id="datameja" class="image-picker show-html">
            <option data-img-src="" 
                    data-img-alt="" 
                    value=""></option>
                    <?php
                    $query_meja = "SELECT * FROM meja WHERE tersedia=1";
                    $result_meja = execute_query($con, $query_meja);
                    while ($meja = mysqli_fetch_array($result_meja)) {
                        ?>
                <option data-img-src="<?= IMAGEPATH . '/meja/' . $meja['mejaid'] . ".png" ?>" 
                        data-img-alt="Page <?= $meja['mejaid'] ?>" 
                        value="<?= $meja['mejaid'] ?>"></option>
                        <?php
                    }
                    ?>
        </select> 

        <!-- <a href="#pilihmakanan" class="btn-lg btn-primary pull-right">Pilih Makanan</a>-->
    </div>
    <div class="row" id="pilihmakanan">
        <div class="page-header">
            <h1>Makanan</h1>
        </div>
        <select multiple="multiple" id="datamakanan" class="image-picker show-html show-labels">
            <option data-img-src="" 
                    data-img-alt="" 
                    value=""></option>
                    <?php
                    $query_makanan = "SELECT * FROM makanan";
                    $result_makanan = execute_query($con, $query_makanan);
                    while ($makanan = mysqli_fetch_array($result_makanan)) {
                        ?>
                <option data-img-src="<?= IMAGEPATH . '/menu/' . $makanan['gambar'] ?>" 
                        data-img-alt="Page <?= $makanan['nama'] ?>" 
                        value="<?= $makanan['makananid'] ?>"><?= $makanan['makananid'] . " " . $makanan['nama'] ?> (<?= $makanan['persediaan'] ?>)</option>
                        <?php
                    }
                    ?>
        </select>
    </div>

    <div class="row" id="isijumlah">
        <div class="page-header">
            <h1>Jumlah Pesanan </h1>
            <div>
                <form method="post" id="formjumlah" class="form-horizontal" action="nota.php">

                </form>
            </div>
            <button class="btn-lg btn-primary pull-right" id="btncheckout">Proses</button>
        </div>
</main>
<script type="text/javascript">
    $(function () {
        //meja
        $("#datameja").imagepicker();
        var meja;
        $("#datameja").change(function () {
            var s = $("#datameja").data("picker").selected_values();
            meja = s[0];
            $("#meja").html(meja);
        });
        //makanan
        $("#datamakanan").imagepicker({
            show_label: true
        });
        var makanan;
        $("#datamakanan").change(function () {
            var makanan = $("#datamakanan").data("picker");
            var makananids = makanan.selected_values();
            $("#formjumlah").html('<input type="hidden" name="meja" value="'+meja+'">');
            var html = '';
            for (var i = 0; i < makananids.length; i++) {
                html += '<label class="control-label col-sm-4">' + makananids[i] + '</label><div class="form-group"><input type="hidden" name="makanan[]" value="'+makananids[i]+'" size="30" required="required"><input type="text" name="jumlah[]" size="30" required="required"></div>';
            }
            $("#formjumlah").append(html);
        });
        $("#btncheckout").click(function () {
            $("#formjumlah").submit();
        });
    });
</script>
<?php include './fragment/footer.php'; ?>
