<!-- letakkan proses update data disini -->
<?php 

$id=$_GET['id'];

if(isset($_POST['update'])){

    $level=$_POST['level'];

    // proses update
    $sql = "UPDATE users SET level='$level' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=users");
    }
}

// Mengambil data dan memasukan ke data

$sql = "SELECT * FROM users WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>


<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
                <div class="card border-dark">
                    <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE USERS</strong></div>
                    <div class="card-body">

                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" value="<?php echo $row["username"]?>"  readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Level</label>
                        <select class="form-control chosen" data-placeholder="Pilih Level" name="level">
                            <option value="<?php echo $row["level"]?>"><?php echo $row["level"]?></option>
                            <option value="SuperAdmin">Super Admin</option>
                            <option value="Admin">Admin</option>
                    </select>
                    </div>

                    <input class="btn btn-primary" type="submit" name="update" value="Update">
                    <a class="btn btn-danger" href="?page=users">Batal</a>

                </div>
            </div>
        </form>
    </div>
</div>