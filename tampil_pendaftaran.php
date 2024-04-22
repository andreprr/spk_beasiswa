<div class="card">
  <div class="card-header bg-primary text-white border-dark"><strong>Data Pendaftaran</strong></div>
  <div class="card-body">

<a class="btn btn-primary mb-2" href="?page=pendaftaran&action=tambah">Tambah</a>
<table class="table table-bordered" id="myTable">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal</th>
        <th>Tahun</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Pendaftaran Ortu</th>
        <th>IPK</th>
        <th>Jml Saurdara</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
			<!-- letakkan proses menampilkan disini -->
            <?php
                $i=1;
                $sql = "SELECT pendaftaran.iddaftar,pendaftaran.tgldaftar,pendaftaran.tahun,pendaftaran.nim,mahasiswa.nama_mahasiswa,pendaftaran.pendapatan_ortu,pendaftaran.ipk,pendaftaran.jml_saudara 
                        FROM mahasiswa INNER JOIN pendaftaran ON mahasiswa.nim=pendaftaran.nim ORDER BY iddaftar DESC";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()) {
            ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['tgldaftar']; ?></td>
                    <td><?php echo $row['tahun']; ?></td>
                    <td><?php echo $row['nim']; ?></td>
                    <td><?php echo $row['nama_mahasiswa']; ?></td>
                    <td><?php echo $row['pendapatan_ortu']; ?></td>
                    <td><?php echo $row['ipk']; ?></td>
                    <td><?php echo $row['jml_saudara']; ?></td>
                    <td align="center">
                    <a class="btn btn-warning" href="?page=pendaftaran&action=update&id=<?php echo $row['iddaftar']; ?>">
                        <span class="fas fa-edit"></span>
                    </a>
                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=pendaftaran&action=hapus&id=<?php echo $row['iddaftar']; ?>">
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