<?php
include '../konfigurasi/config.php';
include '../konfigurasi/function.php';
include '../fragment/header.php';
include '../fragment/menu.php';
$con = connect_db();
?>
<script type="text/javascript">
    $(function () {
        $('input.datepicker').each(function () {
            var datepicker = $(this);
            datepicker.bootstrapDatePicker(datepicker.data());
        });
    });
</script>
<main>
    <form method="post" class="form-horizontal">
        <div class="form-group">
            <label class="control-label col-sm-4" for="tgllahir">Tanggal:</label>
            <div class="col-sm-6">
                <input type="text" name="tanggal" id="tanggal" 
                       class="form-control datepicker" 
                       data-date-format="DD-MM-YYYY"
                       required="required"/>
            </div>
            <div class="col-sm-2">
                <input type="submit" class="btn btn-success" value="Cari" id="submit" name="submit">
            </div>
        </div>

    </form>
    <div class="row" id="divcetak">
        <h2>Laporan Penjualan</h2>
        <table class="table table-striped">
            <tr>
                <th>Tanggal</th>
                <th>Makanan</th>
                <th>Penjualan</th>
            </tr>
            <?php
            $where = "";
            $filter = "";
            if(isset($_POST['submit'])){
                if(!empty($_POST['tanggal'])){
                    $tanggal = $_POST['tanggal'];
                    $filter = " tanggal = '$tanggal'";
                }
            }
            if($filter != ""){
                $where = " WHERE ";
            }
           
            $query = "SELECT DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal, "
                    . "subtotal,m.nama FROM pesanan p "
                    . "INNER JOIN makanan m ON m.makananid=p.makananid "//ingat spasi disini
                    . "INNER JOIN nota n ON n.notaid = p.notaid $where $filter"; //ingat spasi disini
            $result = execute_query($con, $query);
            $total = 0;
            while ($data = mysqli_fetch_array($result)) {
                $total += $data['subtotal'];
                ?>
                <tr>
                    <td><?= $data['tanggal'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= rp($data['subtotal']) ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <h3 class="pull-right">
            Total : <?= rp($total) ?>
        </h3>
    </div>
    <button class="btn btn-primary" id="btncetak" onclick="printJS('divcetak', 'html')">Cetak</button>
</main>
