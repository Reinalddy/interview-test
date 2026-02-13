<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CRM - Competency Test</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            background-color: #f5f5f5;
        }

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
        }

        .search-container {
            position: relative;
            width: 450px;
        }

        .search-container input {
            width: 100%;
            padding: 8px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }

        .top-right-icons {
            display: flex;
            gap: 18px;
            color: #777;
            font-size: 18px;
        }

        .navbar {
            background-color: #333;
            display: flex;
            height: 45px;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            padding: 0 18px;
            display: flex;
            align-items: center;
            font-size: 13.5px;
        }

        .nav-active {
            background-color: #ff6600 !important;
            font-weight: bold;
        }

        .main-wrapper {
            padding: 25px 40px;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 20px;
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
            font-size: 13px;
        }
    </style>
</head>

<body>

    <div class="top-header">
        <div class="brand">CRM</div>
        <div class="search-container"><input type="text" placeholder="Search..."></div>
        <div class="top-right-icons"><span>📄</span> <span>▦</span> <span>👤</span></div>
    </div>

    <nav class="navbar">
        <a href="index.php" class="nav-link">🏠</a>
        <a href="#" class="nav-link">Activities</a>
        <a href="#" class="nav-link">Relationships</a>
        <a href="#" class="nav-link">Transactions</a>
        <a href="#" class="nav-link">Inventory</a>
        <a href="#" class="nav-link nav-active">Settings</a>
        <a href="#" class="nav-link">Report</a>
    </nav>

    <div class="main-wrapper"></div>