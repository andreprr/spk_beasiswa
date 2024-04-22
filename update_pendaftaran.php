<!-- letakkan proses update data disini -->
<?php 
$id=$_GET['id'];

if(isset($_POST['update'])){

    $pendapatan=$_POST['pendapatan'];
    $ipk=$_POST['ipk'];
    $saudara=$_POST['saudara'];

    // proses update
    $sql = "UPDATE pendaftaran SET pendapatan_ortu='$pendapatan',ipk='$ipk',jml_saudara='$saudara' WHERE iddaftar='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=pendaftaran");
    }
}
// Mengambil data dan memasukan ke data baru
$sql = "SELECT pendaftaran.iddaftar,pendaftaran.tgldaftar,pendaftaran.tahun,pendaftaran.nim,mahasiswa.nama_mahasiswa,pendaftaran.pendapatan_ortu,pendaftaran.ipk,pendaftaran.jml_saudara 
        FROM mahasiswa INNER JOIN pendaftaran ON mahasiswa.nim=pendaftaran.nim WHERE iddaftar='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE PENDAFTARAN</strong></div>
                    <div class="card-body">

                    <div class="form-group">
                        <label for="">Tahun</label>
                        <input type="text" class="form-control" value="<?php echo $row["tahun"]?>" name="tahun" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">NIM</label>
                        <input type="text" class="form-control" value="<?php echo $row["nim"]?>" name="nim" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Mahasiswa</label>
                        <input type="text" class="form-control" value="<?php echo $row["nama_mahasiswa"]?>" name="nama" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Pendapatan Orang Tua</label>
                        <input type="number" class="form-control" name="pendapatan" value="<?php echo $row["pendapatan_ortu"]?>" min="0" max="99999999" required>
                    </div>
                    <div class="form-group">
                        <label for="">IPK Terakhir</label>
                        <input type="number" class="form-control" name="ipk" value="<?php echo $row["ipk"]?>" step="0.01" value="0.00" min="0" max="4" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Saudara</label>
                        <input type="number" class="form-control" name="saudara" value="<?php echo $row["jml_saudara"]?>" min="0" max="100" required>
                    </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=pendaftaran">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>