<?php include 'views/layout/header.php'; ?>

<div class="content-header">
    <h1>Users</h1>
    <div class="breadcrumb">User > List</div>
</div>

<a href="?action=add" class="btn-blue">New User</a>

<div style="background: white; border: 1px solid #ddd; margin-top: 15px; border-radius: 4px;">
    <table style="width: 100%; border-collapse: collapse;">
        <thead style="background: #fafafa; border-bottom: 2px solid #eee;">
            <tr>
                <th style="padding:12px; text-align:left;">ID</th>
                <th style="padding:12px; text-align:left;">Nama</th>
                <th style="padding:12px; text-align:left;">Tanggal Lahir</th>
                <th style="padding:12px; text-align:left;">Jabatan</th>
                <th style="padding:12px; text-align:left;">Kota</th>
                <th style="padding:12px; text-align:left;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $row): ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding:12px;">
                        <?= $row['id'] ?>
                    </td>
                    <td style="padding:12px;"><b>
                            <?= $row['nama_karyawan'] ?>
                        </b></td>
                    <td style="padding:12px;">
                        <?= date('d/m/Y', strtotime($row['tanggal_lahir'])) ?>
                    </td>
                    <td style="padding:12px;">
                        <?= $row['nama_jabatan'] ?>
                    </td>
                    <td style="padding:12px;">
                        <?= $row['nama_kota'] ?>
                    </td>
                    <td style="padding:12px;">
                        <a href="?action=edit&id=<?= $row['id'] ?>" style="color: blue; text-decoration:none;">Edit</a> |
                        <a href="?action=delete&id=<?= $row['id'] ?>" style="color: red; text-decoration:none;"
                            onclick="return confirm('Hapus?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div style="margin-top:20px; font-size:12px;">
    <b>Fungsi No. 5:</b> Selisih 13/01/1980 ke hari ini: <b>
        <?= $selisih_demo ?>
    </b>
</div>

</div>
</body>

</html>