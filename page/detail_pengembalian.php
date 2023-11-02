<?php
$id_peminjaman = $_GET['id_peminjaman'];
if(empty($id_peminjaman)){
    ?>
        <script type="text/javascript">
            window.location.href="?=pengembalian";
        </script>
    <?php
}
$hari = date('d-m-Y');
$d_peminjaman = "SELECT *, detail_pinjam.jumlah as jml FROM detail_pinjam left join peminjaman on peminjaman.id_peminjaman = detail_pinjam.id_peminjaman
left join inventaris on inventaris.id_inventaris = detail_pinjam.id_inventaris left join pegawai on pegawai.id_pegawai = peminjaman.id_pegawai WHERE peminjaman.id_peminjaman = '$id_peminjaman'";
$d_query = mysqli_query($koneksi, $d_peminjaman);
$data = mysqli_fetch_array($d_query);


?>

<div class="col-lg-6">
    <div class="panel panel-primary">
        <div class="panel-heading">konfirmasi pengembalian inventaris</div>
        <div class=panel-body>
            <form action="" method="post" >
                <div class="form-group">
                    <label for="">kode peminjaman</label>
                    <input type="text" name="id_peminjaman" class="form-control" value="<?= $data['id_peminjaman'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">tanggal peminjaman</label>
                    <input type="text" name="tgl_pinjam" class="form-control" value="<?= $hari ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">nama peminjam</label>
                    <input type="text" name="nama_pegawai" class="form-control" value="<?= $data['nama_pegawai'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">nama barang</label>
                    <input type="text" name="nama" class="form-control" value="<?= $data['nama']?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">jumlah barang</label>
                    <input type="number" name="jml" class="form-control" value="<?= $data['jml'] ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">tanggal pengembalian</label>
                    <input type="date" class="form-control" name="tgl_kembali" >
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-md" type="submit" name="simpan" >simpan</button>
                    <a href="?p=pengembalian" class="btn btn-default  btn-md">kembali</a>
                </div>
            </form>
        </div>
<?php
if(isset($_POST['simpan'])){
    $tgl_kembali = $_POST['tgl_kembali'];

    $sql_pengembalian = "UPDATE peminjaman SET tanggal_kembali = '$tgl_kembali', status_peminjaman='2' WHERE id_peminjaman= '$id_peminjaman'";
    $q_pengembalian = mysqli_query($koneksi, $sql_pengembalian);

    if($q_pengembalian){
        ?>
            <script type="text/javascript" >
                window.location.href="?p=pengembalian";
            </script>
        <?php
    }else{
        ?>
            <div class="alert alert-danger" >
                Barang Gagal untuk diupdate!
            </div>
        <?php
    }
}
?>

    </div>
</div>