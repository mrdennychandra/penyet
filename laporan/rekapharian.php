<?php
include '../konfigurasi/config.php';
include '../konfigurasi/function.php';
include '../fragment/header.php';
include '../fragment/menu.php';
$con = connect_db();
?>
<main>
    <h2>Laporan Penjualan</h2>
    <table class="table table-striped">
        <tr>
            <th>Tanggal</th>
            <th>Jumlah Nota</th>
            <th>Penjualan</th>
        </tr>
        <?php
        $query = "SELECT DATE_FORMAT(tanggal,'%d-%m-%Y') AS tanggal, "
                . "(SELECT COUNT(notaid) FROM nota WHERE nota.`notaid` = n.notaid) AS jumlahnota, "//ingat spasi disini
                . "SUM(subtotal) AS subtotaltanggal FROM pesanan p "//ingat spasi disini
                . "INNER JOIN nota n ON n.notaid = p.notaid "//ingat spasi disini
                . "GROUP BY n.tanggal";
        $result = execute_query($con, $query); 
        $total = 0;
        while ($data = mysqli_fetch_array($result)) {
            $total += $data['subtotaltanggal'];
            ?>
         <tr>
            <td><?= $data['tanggal'] ?></td>
            <td><?= $data['jumlahnota'] ?></td>
            <td><?= rp($data['subtotaltanggal']) ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
    <h3 class="pull-right">
        Total : <?= rp($total) ?>
    </h3>
</main>
