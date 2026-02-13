<?php include 'views/layout/header.php'; ?>

<div class="content-header">
    <h1><?= isset($edit_data) ? 'Edit User' : 'New User' ?></h1>
    <div class="breadcrumb">User > Form</div>
</div>

<div style="background: white; padding: 25px; border: 1px solid #ddd; border-radius: 4px; max-width: 500px;">
    <form method="POST">
        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; font-size:13px;">Nama Karyawan</label>
            <input type="text" name="nama" value="<?= $edit_data['nama_karyawan'] ?? '' ?>"
                style="width:100%; padding:8px; border:1px solid #ddd;" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; font-size:13px;">Tanggal Lahir</label>
            <input type="date" name="tgl_lahir" value="<?= $edit_data['tanggal_lahir'] ?? '' ?>"
                style="width:100%; padding:8px; border:1px solid #ddd;" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; font-size:13px;">Jabatan</label>
            <select name="jabatan" style="width:100%; padding:8px;">
                <option value="1" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 1) ? 'selected' : '' ?>>HRD
                </option>
                <option value="2" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 2) ? 'selected' : '' ?>>Accounting
                </option>
                <option value="3" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 3) ? 'selected' : '' ?>>Direktur
                </option>
                <option value="4" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 4) ? 'selected' : '' ?>>Sales
                </option>
            </select>
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:bold; font-size:13px;">Kota Asal</label>
            <select name="kota" style="width:100%; padding:8px;">
                <option value="1" <?= (isset($edit_data) && $edit_data['id_kota'] == 1) ? 'selected' : '' ?>>Manado
                </option>
                <option value="2" <?= (isset($edit_data) && $edit_data['id_kota'] == 2) ? 'selected' : '' ?>>Jakarta
                </option>
                <option value="3" <?= (isset($edit_data) && $edit_data['id_kota'] == 3) ? 'selected' : '' ?>>Surabaya
                </option>
            </select>
        </div>
        <button type="submit" class="btn-blue"><?= isset($edit_data) ? 'Update Data' : 'Save Data' ?></button>
        <a href="index.php" style="margin-left:10px; color:#666; font-size:13px; text-decoration:none;">Cancel</a>
    </form>
</div>