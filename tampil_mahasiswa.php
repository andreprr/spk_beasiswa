<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Mahasiswa</strong></div>
  <div class="card-body">

<a class="btn btn-primary mb-2" href="?page=mahasiswa&action=tambah">Tambah</a>
<table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th>NIM</th>
        <th>Nama Mahasiswa</th>
        <th>Alamat</th>
        <th>No. Telepon</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
			<!-- letakkan proses menampilkan disini -->
            <?php
                $sql = "SELECT*FROM mahasiswa ORDER BY nim ASC";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
            ?>
                <tr>
                <td><?php echo $row['nim']; ?></td>
                <td><?php echo $row['nama_mahasiswa']; ?></td>
                <td><?php echo $row['alamat']; ?></td>
                <td><?php echo $row['telp']; ?></td>
                <td>
                    <a class="btn btn-warning" href="?page=mahasiswa&action=update&nim=<?php echo $row['nim']; ?>">
                        <span class="fas fa-edit"></span>
                    </a>
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=mahasiswa&action=hapus&nim=<?php echo $row['nim']; ?>">
                        <span class="fas fa-times"></span>
                    </a>
                    </td>
                </tr>
            <?php
                }
                $conn->close();
            ?>
   </tbody>
</table>
</div>
</div>