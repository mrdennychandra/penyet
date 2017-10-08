<?php

function connect_db() {
    $con = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME)
            or die(mysqli_connect_error());
    return $con;
}

function execute_query($con, $query) {
    $result = mysqli_query($con, $query) or die(mysqli_error($con));
    return $result;
}

function close($conn) {
    mysqli_close($conn);
}

function rp($rupiah) {
    $jadi = "Rp " . number_format($rupiah, 2, ",", ".");
    return $jadi;
}
