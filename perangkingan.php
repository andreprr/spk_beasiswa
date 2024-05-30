<?php

if(isset($_POST['proses'])){
    
    // mengambil data dari input
    $tahun=$_POST['tahun'];

    // Mengambil data dari pendaftaran
    $sql = "SELECT * FROM pendaftaran WHERE tahun=$tahun";
    $result = $conn->query($sql);

    // mencari nilai max dan min
    if($result->num_rows > 0){
        $sql = "SELECT min(pendapatan_ortu) as mpendapatan, max(ipk) as mipk, max(jml_saudara) as msaudara FROM pendaftaran WHERE tahun=$tahun"; 
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        //mengambil nilai max dan min
        $mpendapatan = $row["mpendapatan"];
        $mipk = $row["mipk"];
        $msaudara = $row["msaudara"];

        //proses normalisasi
        $sql = "SELECT*FROM pendaftaran WHERE tahun=$tahun";
        $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {

                    // mengambil data pendaftaran
                    $iddaftar = $row["iddaftar"];
                    $pendapatan = $row["pendapatan_ortu"];
                    $ipk = $row["ipk"];
                    $saudara = $row["jml_saudara"];
                    
                    // menghapus data perangkingan yang lama
                    $sql = "DELETE FROM perangkingan WHERE iddaftar='$iddaftar'";
                    $conn->query($sql);

                    // hitung normalisasi
                    $npendapatan = $mpendapatan / $pendapatan;
                    $nipk = $mipk / $mipk;
                    $nsaudara = $saudara / $msaudara;

                    // hitung nilai preferensi
                    $preferensi = ($npendapatan*0.5)+($nipk*0.3)+($nsaudara*0.2);

                    // simpan data perangkingan
                    $sql = "INSERT INTO perangkingan VALUES (Null, '$iddaftar','$npendapatan','$nipk','$nsaudara','$preferensi')";
                    if ($conn->query($sql) === TRUE) {
                        header("Location:?page=perangkingan&thn=$tahun");
                    }
                    
        }
    }else{
        ?>
            <div class="alert alert-danger alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Data tidak ditemukan</strong>
            </div>
        <?php
    }
}



?>

<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Perangkingan</strong></div>
  <div class="card-body">

    <form action="" method="POST">
    <div class="form-group">
        <label for="">Tahun</label>
        <select class="form-control chosen" data-placeholder="Pilih Tahun" name="tahun">
        <option value="<?php echo $_GET['thn'];?>"><?php echo $_GET['thn'];?></option>
        <?php 
            for($x=date("Y");$x>=2015;$x--){
        ?>
        <option value="<?php echo $x; ?>"><?php echo $x; ?></option>
        <?php 
            }
        ?>
        </select>
    </div>
        <input class="btn btn-primary mb-2" type="submit" name="proses" value="Proses">
    </form>

    <table class="table table-bordered" id="myTable">
        <thead>
        <tr>
            <th>No.</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Pendapatan</th>
            <th>IPK</th>
            <th>Saudara</th>
            <th>Preferensi</th>
        </tr>
        </thead>
    <tbody>
			<!-- letakkan proses menampilkan disini -->
            <?php
                $i=1;
                $sql = "SELECT*FROM vperangkingan ORDER BY preferensi DESC";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
            ?>
                <tr>
                <td><?php echo $i++; ?></td>
                <td><?php echo $row['nim']; ?></td>
                <td><?php echo $row['nama_mahasiswa']; ?></td>
                <td><?php echo $row['n_pendapatan']; ?></td>
                <td><?php echo $row['n_ipk']; ?></td>
                <td><?php echo $row['n_saudara']; ?></td>
                <td><?php echo $row['preferensi']; ?></td>
                </tr>
            <?php
                }
                $conn->close();
            ?>
   </tbody>
</table>
</div>
</div>