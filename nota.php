<?php
include './konfigurasi/config.php';
include './konfigurasi/function.php';
include './fragment/header.php';
include './fragment/menu.php';
$con = connect_db();
if (isset($_POST['makanan'])) {
    $meja = $_POST['meja'];
    //nomor nota random
    $nota = date('ymd.H:i.') . $meja;
    $tanggal = date('Y-m-d');
    //array barang
    $query_nota = "INSERT INTO nota (nomor,tanggal,mejaid) VALUES ('$nota','$tanggal','$meja')";
    execute_query($con, $query_nota);
    $notaid = mysqli_insert_id($con);
    for ($i = 0; $i < count($_POST['makanan']); $i++) {
        $makananid = $_POST['makanan'][$i];
        $jumlah = $_POST['jumlah'][$i];
        //isi tabel pesanan
        //dapatkan harga dari makanan berdasarkan makanan id
        $query_harga = "SELECT harga FROM makanan WHERE makananid='$makananid'";
        $result_harga = execute_query($con, $query_harga);
        $data_harga = mysqli_fetch_array($result_harga);
        $harga = $data_harga[0];
        $subtotal = $jumlah * $harga;
        //isi tabel pesanan,dapat subtotal
        $query_pesan = "INSERT INTO pesanan (makananid,jumlahpesan,notaid,subtotal) "
                . "VALUES ('$makananid','$jumlah','$notaid','$subtotal')";
        execute_query($con, $query_pesan);
        //update stok masakan
        $query_stok = "UPDATE makanan SET persediaan = persediaan - $jumlah WHERE makananid='$makananid'";
        execute_query($con, $query_stok);
        //update nomor meja krn sedang dipakai
        $query_meja = "UPDATE meja SET tersedia=0 WHERE mejaid='$meja'";
        execute_query($con, $query_meja);
    }
//tampilkan
    ?>
    <div class="page-header">
        <h1>Pesanan</h1>
    </div>
    <div class="row" id="nota">
        <table class="table table-bordered">
            <tr>
                <th>Nota </th>
                <td><?= $nota ?></td>
            </tr>
            <tr>
                <th>Meja </th>
                <td><?= $meja ?></td>
            </tr>
            <tr>
                <th>Tanggal </th>
                <td><?= $tanggal ?></td>
            </tr>
        </table>
        <hr>
        <table class="table table-bordered">
            <tr>
                <th>Makanan</th>
                <th>Harga Satuan</th>
                <th>Jumlah </th>
                <th>Sub Total </th>
            </tr>
            <?php
            $query = "SELECT p.*,m.nama,m.harga FROM pesanan p "
                    . "INNER JOIN nota n ON n.notaid = p.notaid " //ingat spasi disini
                    . "INNER JOIN makanan m ON m.makananid=p.makananid " //ingat spasi disini
                    . " WHERE n.notaid='$notaid'"; //atau beri spasi lagi di depan petik
            $result = execute_query($con, $query);
            $jumlah_bayar = 0;
            while ($data = mysqli_fetch_array($result)) {
                $jumlah_bayar += $data['harga'] * $data['jumlahpesan'];
                ?>
                <tr>
                    <td><?= $data['nama'] ?></td>
                    <td><?= rp($data['harga']) ?></td>
                    <td><?= $data['jumlahpesan'] ?></td>
                    <td><?= rp($data['jumlahpesan'] * $data['harga']) ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <h1>
            Total Bayar : <?= rp($jumlah_bayar) ?>
        </h1>
    </div>
    <?php
}
?>
