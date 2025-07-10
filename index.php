<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Marketplace Fashion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="src/style3.css">
</head>
<body>
    <header>
        <h1>Anre Fashion</h1>
        <p>Pilihan Lengkap, Harga Bersahabat, Gaya Tanpa Batas!</p>
    </header>
    <nav>
        <a href="#Beranda">Beranda</a>
        <a href="#Produk">Produk</a>
        <a href="#Promo">Promo</a>
        <a href="TaskFormEmployee.php">Tentang Kami</a>
        <button class="btn" style="padding: 10px 20px; margin: 0;"><a href="logout.php">Logout</a></button>
    </nav>
    <div class="container">
        <section class="hero">
            <div class="hero-text">
                <h1>Tren Fashion Terbaru</h1>
                <p>Belanja pakaian, sepatu, dan aksesoris kekinian dengan harga terbaik. Dapatkan promo menarik setiap hari!</p>
                <button class="btn-hero">Belanja Sekarang</button>
            </div>
            <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80" alt="Fashion Hero">
        </section>
        <h2 style="margin-bottom:18px;">Produk Pilihan</h2>
        <div class="products">
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1609695813802-3c443be34359?q=80&w=1886&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Dress">
                <h3>Summer Dress</h3>
                <p>Dress wanita motif floral, nyaman dipakai.</p>
                <div class="price">Rp 199.000</div>
                <button class="btn">Beli</button>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1518621888950-386251586966?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Jaket Pria">
                <h3>Jaket Denim Pria</h3>
                <p>Jaket denim klasik, cocok untuk segala suasana.</p>
                <div class="price">Rp 249.000</div>
                <button class="btn">Beli</button>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1600269452121-4f2416e55c28?q=80&w=1965&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sneakers">
                <h3>Sneakers Putih</h3>
                <p>Sneakers unisex, nyaman dan stylish.</p>
                <div class="price">Rp 299.000</div>
                <button class="btn">Beli</button>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1583623733237-4d5764a9dc82?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tas">
                <h3>Tas Selempang</h3>
                <p>Tas selempang kulit sintetis, trendi dan praktis.</p>
                <div class="price">Rp 159.000</div>
                <button class="btn">Beli</button>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1609695813802-3c443be34359?q=80&w=1886&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Dress">
                <h3>Summer Dress</h3>
                <p>Dress wanita motif floral, nyaman dipakai.</p>
                <div class="price">Rp 199.000</div>
                <button class="btn">Beli</button>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1518621888950-386251586966?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Jaket Pria">
                <h3>Jaket Denim Pria</h3>
                <p>Jaket denim klasik, cocok untuk segala suasana.</p>
                <div class="price">Rp 249.000</div>
                <button class="btn">Beli</button>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1600269452121-4f2416e55c28?q=80&w=1965&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Sneakers">
                <h3>Sneakers Putih</h3>
                <p>Sneakers unisex, nyaman dan stylish.</p>
                <div class="price">Rp 299.000</div>
                <button class="btn">Beli</button>
            </div>
            <div class="product-card">
                <img src="https://images.unsplash.com/photo-1583623733237-4d5764a9dc82?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Tas">
                <h3>Tas Selempang</h3>
                <p>Tas selempang kulit sintetis, trendi dan praktis.</p>
                <div class="price">Rp 159.000</div>
                <button class="btn">Beli</button>
            </div>

        </div>
    </div>

    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <strong>Anre Fashion</strong><br>
                &copy; 2025 THEGODCOD | Fachrul Arifin (24533850) - Fundamental Web.<br>
                All rights reserved.
            </div>
            <div class="footer-social">
                <span>Follow us:</span>
                <a href="https://instagram.com/fachrularf" target="_blank" title="Instagram">
                    <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/instagram.svg" alt="Instagram" style="width:24px;height:24px;vertical-align:middle;">
                </a>
                <a href="https://facebook.com/fachrularf" target="_blank" title="Facebook">
                    <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/facebook.svg" alt="Facebook" style="width:24px;height:24px;vertical-align:middle;">
                </a>
                <a href="https://twitter.com/fachrularf" target="_blank" title="Twitter">
                    <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/twitter.svg" alt="Twitter" style="width:24px;height:24px;vertical-align:middle;">
                </a>
            </div>
        </div>
    </footer>
</body>
</html>