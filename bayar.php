<!DOCTYPE html>
<html>
<head>
    <title>SPP ONLINE</title>
    <link rel="stylesheet" type="text/css" href="src/style.css">
</head>
<body>
    <br/>
    <br/>
    <header>
        <h1 class="judul">PEMBAYARAN SPP ONLINE SMK NEGERI 3 BANJARBARU</h1>
    </header>
    <div class="wrap">
        <div class="blog">
            <div class="conteudo">

                <h3>Transaksi Pembayaran SPP</h3>
                <form method="get" action="">
                    nisn: <input type="text" name="nisn" value="<?php echo isset($_GET['nisn']) ? $_GET['nisn'] : ''; ?>" />
                    <input type="hidden" id="open" name="open" value="data_pembayaran"/>
                    <input type="submit" name="cari" value="Cari Siswa" />
                </form>

                <?php
                include_once "src/koneksi.php";
                if(isset($_GET['nisn']) && $_GET['nisn']!=''){
                    // Query mengambil data siswa, kelas, dan spp berdasarkan nisn
                    $sqlSiswa = mysqli_query($koneksi, "SELECT * FROM kelas JOIN siswa ON kelas.id_kelas = siswa.id_kelas JOIN spp ON siswa.id_spp = spp.id_spp WHERE nisn='$_GET[nisn]'");
                    
                    // Gunakan variabel khusus '$dataSiswa' agar tidak bentrok
                    $dataSiswa = mysqli_fetch_array($sqlSiswa);
                    
                    // Cek apakah data siswanya ada
                    if($dataSiswa) {
                ?>
                
                <h3>Biodata Siswa</h3>
                <table>
                    <tr>
                        <td>nisn</td>
                        <td>:</td>
                        <td><?php echo $dataSiswa['nisn']; ?></td>
                    </tr>
                    <tr>
                        <td>Nama Siswa</td>
                        <td>:</td>
                        <td><?php echo $dataSiswa['nama']; ?></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td><?php echo $dataSiswa['nama_kelas']; ?></td>
                    </tr>
                </table>

                <h3>Tagihan SPP Siswa</h3>
                <table border="1" cellpadding="5" cellspacing="0">
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>No. Bayar</th>
                        <th>Tgl. Bayar</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                    </tr>

                    <?php
                    // Ambil data pembayaran berdasarkan nisn milik $dataSiswa
                    $sql = mysqli_query($koneksi, "SELECT * FROM pembayaran JOIN spp ON pembayaran.id_spp = spp.id_spp WHERE nisn='$dataSiswa[nisn]'");
                    $no = 1;
                    while($data = mysqli_fetch_array($sql)){
                        echo "<tr>
                            <td>$no</td>
                            <td>$data[bulan_tagihan]</td>
                            <td>$data[tahun_tagihan]</td>
                            <td>$data[no_bayar]</td>
                            <td>$data[tgl_pembayaran]</td>
                            <td>$data[nominal]</td>
                            <td>$data[keterangan]</td>
                        </tr>";
                        $no++;
                    }
                    ?>
                </table>

                <?php
                    } else {
                        echo "<p style='color:red;'>Data siswa dengan NISN tersebut tidak ditemukan!</p>";
                    }
                }
                ?>

            </div>
        </div>
    </div>
</body>
</html>