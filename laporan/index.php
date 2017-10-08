<?php
include '../konfigurasi/config.php';
include '../konfigurasi/function.php';
include '../fragment/header.php';
include '../fragment/menu.php';
$con = connect_db();
?>
<main>
    <div class="row" id="divcetak">
        <h2>Laporan Penjualan</h2>
        <table class="table table-striped">
            <tr>
                <th>Tanggal</th>
                <th>Makanan</th>
                <th>Penjualan</th>
            </tr>
            <?php
            $query = "SELECT DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal, "
                    . "subtotal,m.nama FROM pesanan p "
                    . "INNER JOIN makanan m ON m.makananid=p.makananid "//ingat spasi disini
                    . "INNER JOIN nota n ON n.notaid = p.notaid "; //ingat spasi disini
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
