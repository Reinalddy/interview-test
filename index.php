<?php
/**
 * SOFTWARE ENGINEER COMPETENCY TEST - SEFAS GROUP
 * Name: Reinalddy
 * Requirements: MVC, CRUD, Date Function, Navbar UI Identical
 */

// --- 1. DATABASE CONNECTION ---
$host = 'localhost';
$db = 'db_sefas_karyawan';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

// --- 2. HELPER FUNCTION: DATE DIFFERENCE (Soal No. 5) ---
function hitungSelisihTanggal($tgl1, $tgl2)
{
    $date1 = DateTime::createFromFormat('d/m/Y', $tgl1);
    $date2 = DateTime::createFromFormat('d/m/Y', $tgl2);
    if (!$date1 || !$date2)
        return "Format dd/mm/yyyy diperlukan";
    return $date1->diff($date2)->format('%a hari');
}

// --- 3. MODEL & CONTROLLER LOGIC ---
$action = $_GET['action'] ?? 'list';
$edit_data = null;

// Handle CRUD Post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['save_new'])) {
        $sql = "INSERT INTO tr_karyawan (nama_karyawan, tanggal_lahir, id_jabatan, id_kota) VALUES (?,?,?,?)";
        $pdo->prepare($sql)->execute([$_POST['nama'], $_POST['tgl_lahir'], $_POST['jabatan'], $_POST['kota']]);
    } elseif (isset($_POST['save_edit'])) {
        $sql = "UPDATE tr_karyawan SET nama_karyawan=?, tanggal_lahir=?, id_jabatan=?, id_kota=? WHERE id=?";
        $pdo->prepare($sql)->execute([$_POST['nama'], $_POST['tgl_lahir'], $_POST['jabatan'], $_POST['kota'], $_POST['id']]);
    }
    header("Location: index.php");
    exit;
}

// Handle Delete
if ($action == 'delete' && isset($_GET['id'])) {
    $pdo->prepare("DELETE FROM tr_karyawan WHERE id = ?")->execute([$_GET['id']]);
    header("Location: index.php");
    exit;
}

// Handle Edit Fetch
if ($action == 'edit' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM tr_karyawan WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    $edit_data = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Fetch All Data for Table
$data = $pdo->query("SELECT k.*, j.nama_jabatan, kt.nama_kota FROM tr_karyawan k 
                     JOIN ms_jabatan j ON k.id_jabatan = j.id_jabatan 
                     JOIN ms_kota kt ON k.id_kota = kt.id_kota")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CRM System - Competency Test</title>
    <style>
        /* CSS RESET & BASE */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
            color: #333;
        }

        /* 1. TOP HEADER (WHITE) */
        .top-header {
            background: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 20px;
            height: 50px;
            border-bottom: 1px solid #ddd;
        }

        .brand {
            font-weight: bold;
            font-size: 20px;
            letter-spacing: 1px;
        }

        .search-container {
            position: relative;
            width: 450px;
        }

        .search-container input {
            width: 100%;
            padding: 8px 35px 8px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            outline: none;
            background-color: #fff;
        }

        .search-container i {
            position: absolute;
            right: 12px;
            top: 10px;
            color: #888;
        }

        .top-right-icons {
            display: flex;
            gap: 18px;
            color: #777;
            font-size: 18px;
            align-items: center;
        }

        /* 2. NAVBAR (DARK) */
        .navbar {
            background-color: #333333;
            display: flex;
            align-items: stretch;
            height: 45px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 0 18px;
            display: flex;
            align-items: center;
            font-size: 13.5px;
            transition: 0.2s;
        }

        .nav-link:hover {
            background-color: #444;
        }

        .nav-active {
            background-color: #ff6600 !important;
            font-weight: bold;
        }

        .dropdown {
            position: relative;
            display: flex;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 45px;
            left: 0;
            background: white;
            min-width: 180px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 1000;
            border: 1px solid #ddd;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            color: #333;
            padding: 12px 15px;
            text-decoration: none;
            display: block;
            font-size: 13px;
            border-bottom: 1px solid #eee;
        }

        .dropdown-menu a:hover {
            background: #f9f9f9;
        }

        /* 3. CONTENT AREA */
        .main-wrapper {
            padding: 25px 40px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 20px;
        }

        .content-header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: normal;
        }

        .breadcrumb {
            font-size: 12px;
            color: #888;
        }

        .btn-blue {
            background-color: #007bff;
            color: white;
            padding: 10px 18px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 13px;
        }

        .btn-blue:hover {
            background-color: #0069d9;
        }

        /* TABLE STYLING */
        .card-table {
            background: white;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 15px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #fafafa;
            padding: 12px 15px;
            text-align: left;
            font-size: 13px;
            border-bottom: 2px solid #eee;
        }

        td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        .action-link {
            text-decoration: none;
            font-size: 13px;
        }

        /* FORM STYLING */
        .form-box {
            background: white;
            padding: 25px;
            border-radius: 4px;
            border: 1px solid #ddd;
            max-width: 600px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            font-size: 13px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>

    <div class="top-header">
        <div class="brand">CRM</div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
        </div>
        <div class="top-right-icons">
            <span>📄</span> <span>▦</span> <span>👤</span>
        </div>
    </div>

    <nav class="navbar">
        <a href="index.php" class="nav-link">🏠</a>
        <a href="#" class="nav-link">Activities</a>
        <a href="#" class="nav-link">Relationships</a>
        <a href="#" class="nav-link">Transactions</a>
        <a href="#" class="nav-link">Inventory</a>
        <div class="dropdown">
            <a href="#" class="nav-link nav-active">Settings</a>
            <div class="dropdown-menu">
                <a href="index.php">Users</a>
                <a href="#">Roles</a>
                <a href="#">Employee</a>
            </div>
        </div>
        <a href="#" class="nav-link">Report</a>
    </nav>

    <div class="main-wrapper">

        <?php if ($action == 'add' || $action == 'edit'): ?>
            <div class="content-header">
                <h1><?= ($action == 'add') ? 'New User' : 'Edit User' ?></h1>
                <div class="breadcrumb">User > Form</div>
            </div>

            <div class="form-box">
                <form method="POST">
                    <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" name="nama" value="<?= $edit_data['nama_karyawan'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir (YYYY-MM-DD)</label>
                        <input type="date" name="tgl_lahir" value="<?= $edit_data['tanggal_lahir'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select name="jabatan">
                            <option value="1" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 1) ? 'selected' : '' ?>>HRD
                            </option>
                            <option value="2" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 2) ? 'selected' : '' ?>>
                                Accounting</option>
                            <option value="3" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 3) ? 'selected' : '' ?>>
                                Direktur</option>
                            <option value="4" <?= (isset($edit_data) && $edit_data['id_jabatan'] == 4) ? 'selected' : '' ?>>
                                Sales</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Kota Asal</label>
                        <select name="kota">
                            <option value="1" <?= (isset($edit_data) && $edit_data['id_kota'] == 1) ? 'selected' : '' ?>>Manado
                            </option>
                            <option value="2" <?= (isset($edit_data) && $edit_data['id_kota'] == 2) ? 'selected' : '' ?>>
                                Jakarta</option>
                            <option value="3" <?= (isset($edit_data) && $edit_data['id_kota'] == 3) ? 'selected' : '' ?>>
                                Surabaya</option>
                        </select>
                    </div>
                    <button type="submit" name="<?= ($action == 'add') ? 'save_new' : 'save_edit' ?>" class="btn-blue">Save
                        Changes</button>
                    <a href="index.php" style="margin-left:10px; color:#666; font-size:13px;">Cancel</a>
                </form>
            </div>

        <?php else: ?>
            <div class="content-header">
                <h1>Users</h1>
                <div class="breadcrumb">User > List</div>
            </div>

            <a href="?action=add" class="btn-blue">New User</a>

            <div class="card-table">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 50px;">ID</th>
                            <th>Nama</th>
                            <th>Tanggal Lahir</th>
                            <th>Jabatan</th>
                            <th>Kota</th>
                            <th style="width: 120px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><b><?= $row['nama_karyawan'] ?></b></td>
                                <td><?= date('d/m/Y', strtotime($row['tanggal_lahir'])) ?></td>
                                <td><?= $row['nama_jabatan'] ?></td>
                                <td><?= $row['nama_kota'] ?></td>
                                <td class="action-link">
                                    <a href="?action=edit&id=<?= $row['id'] ?>" style="color: blue;">Edit</a> |
                                    <a href="?action=delete&id=<?= $row['id'] ?>" style="color: red;"
                                        onclick="return confirm('Hapus data?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div style="margin-top:20px; font-size:12px; color:#555;">
                <b>Fungsi No. 5:</b> Selisih 13/01/1980 ke hari ini:
                <span
                    style="color: #ff6600; font-weight:bold;"><?= hitungSelisihTanggal('13/01/1980', date('d/m/Y')) ?></span>
            </div>
        <?php endif; ?>

    </div>

</body>

</html>