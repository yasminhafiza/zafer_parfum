<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar dengan Dropdown User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Zafer <span>Parfum</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="index.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="produk.php">Produk</a></li>
            <li class="nav-item"><a class="nav-link" href="tentangkami.php">Tentang Kami</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="keranjang.php"><i class="fas fa-shopping-cart fa-lg"></i> <span class="sr-only">Keranjang</span></a></li>
            <?php if(isset($_SESSION['pelanggan'])): ?>
                <li class="nav-item"><a class="nav-link" href="pelanggan/index.php"><i class="fas fa-user"></i> Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li class="nav-item"><a class="nav-link" href="daftar.php"><i class="fas fa-user-plus"></i> Daftar</a></li>
            <?php endif; ?>
        </ul>
        <!-- Search Form -->
        <form action="produk.php" method="get" class="form-inline my-2 my-lg-0 ml-3" id="search-form">
            <input type="search" name="keyword" id="search-box" class="form-control" placeholder="Search...">
            <button class="btn btn-primary my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</nav>



<script>
document.addEventListener('DOMContentLoaded', function() {
    var btnProfile = document.getElementById('btn-profile');
    var btnLogout = document.getElementById('btn-logout');
    var btnLogin = document.getElementById('btn-login');
    var dropdownUser = document.getElementById('dropdown-user');
    var searchForm = document.querySelector('.search-form');
    var searchBox = document.getElementById('search-box');
    var btnSearch = document.getElementById('btn-search');

    if (btnProfile) {
        btnProfile.addEventListener('click', function() {
            dropdownUser.style.display = (dropdownUser.style.display === 'block') ? 'none' : 'block';
        });
    }

    if (btnLogout) {
        btnLogout.addEventListener('click', function() {
            alert('Anda telah logout.');
        });
    }

    if (btnLogin) {
        btnLogin.addEventListener('click', function() {});
    }

    window.addEventListener('click', function(event) {
        if (dropdownUser && !dropdownUser.contains(event.target) && event.target !== btnProfile) {
            dropdownUser.style.display = 'none';
        }
    });

    if (btnSearch) {
        btnSearch.addEventListener('click', function(e) {
            searchForm.classList.toggle('active');
            searchBox.focus();
            e.preventDefault();
        });
    }

    if (searchBox) {
        searchBox.addEventListener('blur', function() {
            searchForm.classList.remove('active');
        });
    }
});
</script>

</body>
</html>