<!-- letakkan proses tambah data disini -->
<?php

if(isset($_POST['simpan'])){
    // ambil data dari input
    $nim=$_POST['nim'];
    $nama=$_POST['nama'];
    $alamat=$_POST['alamat'];
    $telp=$_POST['telp'];
	
    // validasi
    $sql = "SELECT*FROM mahasiswa WHERE nim='$nim'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>NIM sudah digunakan</strong>
            </div>
        <?php
    }else{
	//proses simpan
        $sql = "INSERT INTO mahasiswa VALUES ('$nim','$nama','$alamat','$telp')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=mahasiswa");
        }
    }
}
?>

<div class="row">
<div class="col-sm-12">
<form action="" method="POST">
<div class="card border-dark">
<div class="card">
<div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA MAHASISWA</strong></div>
	<div class="card-body">
	<div class="form-group">
        <label for="">NIM</label>
        <input type="text" class="form-control" name="nim" maxlength="10" required>
    </div>
	<div class="form-group">
        <label for="">Nama Mahasiswa</label>
        <input type="text" class="form-control" name="nama" maxlength="100" required>
    </div>
	<div class="form-group">
        <label for="">Alamat</label>
        <input type="text" class="form-control" name="alamat" maxlength="100" required>
    </div>
	<div class="form-group">
        <label for="">No. Telepon</label>
        <input type="text" class="form-control" name="telp" maxlength="15" required>
    </div>

   <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
   <a class="btn btn-danger" href="?page=mahasiswa">Batal</a>

</div>
</div>
</form>
</div>
</div>