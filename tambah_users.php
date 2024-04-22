<!-- letakkan proses tambah data disini -->
<?php

if(isset($_POST['simpan'])){
    // ambil data dari input
    $username=$_POST['username']; //andre
    $pass=md5($_POST['pass']); //andre123
    $level=$_POST['level'];
	
    // validasi data users
    $sql = "SELECT*FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Username sudah digunakan</strong>
            </div>
        <?php
    }else{
	//proses simpan data users
        $sql = "INSERT INTO users VALUES (Null, '$username','$pass','$level')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=users");
        }
    }
}
?>

<div class="row">
<div class="col-sm-12">
<form action="" method="POST">
    <div class="card border-dark">
        <div class="card">
            <div class="card-header bg-primary text-white border-dark"><strong>INPUT DATA USERS</strong></div>
                <div class="card-body">
                <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" class="form-control" name="username" maxlength="20" required>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="pass" maxlength="10" required>
                </div>
                <div class="form-group">
                    <label for="">Level</label>
                    <select class="form-control chosen" data-placeholder="Pilih Level" name="level">
                        <option value=""></option>
                        <option value="SuperAdmin">Super Admin</option>
                        <option value="Admin">Admin</option>

                    </select>
                </div>
                <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                <a class="btn btn-danger" href="?page=users">Batal</a>
            </div>
    </div>
</form>
</div>
</div>