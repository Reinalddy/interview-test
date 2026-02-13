<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
    }

    /* Top Header */
    .top-header {
        display: flex;
        justify-content: space-between;
        padding: 10px 20px;
        align-items: center;
    }

    .search-bar input {
        padding: 5px;
        width: 300px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    /* Main Navbar */
    .navbar {
        background-color: #333;
        display: flex;
        align-items: stretch;
    }

    .nav-item {
        color: white;
        padding: 15px 20px;
        text-decoration: none;
        font-size: 14px;
    }

    .nav-item:hover {
        background-color: #444;
    }

    .nav-item.active {
        background-color: #ff6600;
        font-weight: bold;
    }

    /* Orange highlight */

    /* Dropdown Mockup */
    .dropdown-content {
        position: absolute;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        border-bottom: 1px solid #eee;
    }
</style>

<div class="top-header">
    <div class="logo"><strong>CRM</strong></div>
    <div class="search-bar"><input type="text" placeholder="Search..."></div>
    <div class="user-icons">📄 ▦ 👤</div>
</div>

<div class="navbar">
    <a href="#" class="nav-item">🏠</a>
    <a href="#" class="nav-item">Activities</a>
    <a href="#" class="nav-item">Relationships</a>
    <a href="#" class="nav-item">Transactions</a>
    <a href="#" class="nav-item">Inventory</a>
    <div style="position: relative;">
        <a href="#" class="nav-item active">Settings</a>
        <div class="dropdown-content">
            <a href="#">Users</a>
            <a href="#">Roles</a>
            <a href="#">Employee</a>
        </div>
    </div>
    <a href="#" class="nav-item">Report</a>
</div>