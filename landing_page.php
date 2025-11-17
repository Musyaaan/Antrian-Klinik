<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="foto/logo.png" type="image/png">
    <title>Klinik</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 5%;
            background: rgba(255, 255, 255, 0.95);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: clamp(16px, 3vw, 24px);
            font-weight: bold;
            color: #2c5f8d;
        }

        .logo-icon {
            width: clamp(40px, 8vw, 60px);
            height: clamp(40px, 8vw, 60px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            object-fit: cover;
        }

        .nav-links {
            display: flex;
            list-style: none;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
            transition: color 0.3s;
            font-size: clamp(14px, 2vw, 16px);
        }

        .nav-links a:hover {
            color: #667eea;
        }

        .phone-btn {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: transform 0.3s;
            font-size: clamp(14px, 2vw, 16px);
        }

        .phone-btn:hover {
            transform: translateY(-2px);
            background: #5568d3;
        }

        .menu-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
        }

        .menu-toggle span {
            width: 25px;
            height: 3px;
            background: #333;
            border-radius: 3px;
            transition: 0.3s;
        }

        /* Hero Section */
        .hero {
            padding: clamp(100px, 20vw, 150px) 5% clamp(80px, 15vw, 150px);
            margin-top: 70px;
            background-image: url('foto/background2.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            display: grid;
            grid-template-columns: 1fr;
            align-items: center;
            position: relative;
            min-height: 500px;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.45);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 600px;
            color: white;
        }

        .hero-content h1 {
            font-size: clamp(28px, 6vw, 52px);
            font-weight: 700;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .hero-content h1 span {
            color: #8fb3ff;
            display: block;
        }

        .hero-content p {
            font-size: clamp(16px, 2.5vw, 18px);
            margin-bottom: 30px;
            line-height: 1.8;
        }

        .btn-primary {
            background: #667eea;
            color: white;
            padding: clamp(12px, 2vw, 15px) clamp(25px, 4vw, 35px);
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            display: inline-block;
            font-size: clamp(14px, 2vw, 16px);
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-3px);
        }

        /* Features Section */
        .features {
            padding: clamp(50px, 10vw, 80px) 5%;
            background: white;
            text-align: center;
        }

        .section-title {
            font-size: clamp(24px, 5vw, 36px);
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .section-subtitle {
            color: #666;
            margin-bottom: 50px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            font-size: clamp(14px, 2vw, 16px);
            padding: 0 20px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: clamp(20px, 3vw, 30px);
            margin-top: 50px;
        }

        .feature-card {
            background: #f8f9fa;
            padding: clamp(30px, 5vw, 40px) clamp(20px, 3vw, 30px);
            border-radius: 20px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: clamp(60px, 10vw, 70px);
            height: clamp(60px, 10vw, 70px);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: clamp(28px, 5vw, 32px);
        }

        .feature-card h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: clamp(18px, 3vw, 22px);
        }

        .feature-card p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: clamp(14px, 2vw, 16px);
        }

        .learn-more {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            transition: gap 0.3s;
            font-size: clamp(14px, 2vw, 16px);
        }

        .learn-more:hover {
            gap: 10px;
        }

        /* Partners Section */
        .partners {
            padding: clamp(40px, 8vw, 60px) 5%;
            background: #95a5a6;
            text-align: center;
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: clamp(20px, 4vw, 40px);
            align-items: center;
            opacity: 0.7;
        }

        .partner-logo {
            font-size: clamp(18px, 3vw, 24px);
            color: white;
            font-weight: 600;
        }

        /* Services Section */
        .services {
            padding: clamp(50px, 10vw, 80px) 5%;
            background: white;
        }

        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: clamp(20px, 3vw, 30px);
            max-width: 1200px;
            margin: 0 auto;
        }

        .service-card {
            background: #f8f9fa;
            padding: clamp(25px, 4vw, 35px);
            border-radius: 20px;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .service-card:hover {
            background: linear-gradient(135deg, #e0f2f7 0%, #cfe9f3 100%);
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .service-icon {
            width: clamp(50px, 8vw, 60px);
            height: clamp(50px, 8vw, 60px);
            background: white;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            font-size: clamp(24px, 4vw, 28px);
        }

        .service-card h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: clamp(18px, 3vw, 20px);
        }

        .service-card p {
            color: #666;
            margin-bottom: 20px;
            line-height: 1.6;
            font-size: clamp(14px, 2vw, 16px);
        }

        /* Footer */
        .footer {
            background: #2c3e50;
            color: white;
            padding: clamp(25px, 5vw, 30px) 5%;
            text-align: center;
        }

        .footer p {
            margin: 10px 0;
            font-size: clamp(14px, 2vw, 16px);
        }

        /* Tablet - Medium devices */
        @media (max-width: 1024px) {
            .hero {
                background-attachment: scroll;
            }

            .features-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }
        }

        /* Mobile - Small devices */
        @media (max-width: 768px) {
            .navbar {
                padding: 12px 5%;
            }

            .menu-toggle {
                display: flex;
                z-index: 1001;
            }

            .nav-links {
                position: fixed;
                left: -100%;
                top: 60px;
                flex-direction: column;
                background: white;
                width: 100%;
                text-align: center;
                transition: 0.3s;
                box-shadow: 0 10px 27px rgba(0, 0, 0, 0.05);
                padding: 20px 0;
                gap: 10px;
            }

            .nav-links.active {
                left: 0;
            }

            .nav-links li {
                width: 100%;
                padding: 10px 0;
            }

            .phone-btn {
                width: fit-content;
                margin: 0 auto;
            }

            .hero {
                margin-top: 60px;
                min-height: 400px;
                padding: 80px 5% 60px;
                background-position: center center;
            }

            .hero-content {
                text-align: center;
                margin: 0 auto;
            }

            .features-grid,
            .services-grid {
                grid-template-columns: 1fr;
            }

            .partners-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Extra Small Mobile */
        @media (max-width: 480px) {
            .navbar {
                padding: 10px 4%;
            }

            .hero {
                padding: 60px 4% 50px;
                min-height: 350px;
            }

            .features,
            .services {
                padding: 40px 4%;
            }

            .feature-card,
            .service-card {
                padding: 25px 20px;
            }

            .partners {
                padding: 30px 4%;
            }

            .footer {
                padding: 25px 4%;
            }
        }

        /* Large Screens */
        @media (min-width: 1400px) {
            .hero,
            .features,
            .services,
            .partners,
            .footer {
                padding-left: calc((100% - 1300px) / 2);
                padding-right: calc((100% - 1300px) / 2);
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <img src="foto/logo.png" alt="Logo Klinik" class="logo-icon">
            <span>Klinik Lorem, ipsum.</span>
        </div>
        <div class="menu-toggle" onclick="toggleMenu()">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <ul class="nav-links" id="navLinks">
            <li><a href="#beranda" onclick="closeMenu()">Beranda</a></li>
            <li><a href="#layanan" onclick="closeMenu()">Layanan</a></li>
            <li><a href="#kontak" onclick="closeMenu()">Kontak</a></li>
            <li><a href="login.php" class="phone-btn">Login</a></li>
        </ul>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>
                Selamat Datang di <span>Klinik Lorem, ipsum dolor.</span>
            </h1>
            <p>
                Klinik modern dengan pelayanan profesional dan fasilitas lengkap.
            </p>
            <a href="#" class="btn-primary">Daftar Sekarang</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="layanan">
        <h2 class="section-title">Apa Yang Anda Cari?</h2>
        <p class="section-subtitle">
            Kami menyediakan berbagai layanan kesehatan yang lengkap untuk memenuhi kebutuhan Anda dan keluarga
        </p>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🏥</div>
                <h3>Layanan Kesehatan</h3>
                <p>Layanan kesehatan berkualitas dengan standar medis terbaik untuk keluarga Anda</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">🏛️</div>
                <h3>Klinik Terpercaya</h3>
                <p>Klinik dengan reputasi terbaik dan dipercaya oleh ribuan pasien</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>

            <div class="feature-card">
                <div class="feature-icon">👨‍⚕️</div>
                <h3>Ahli Medis</h3>
                <p>Tim medis profesional dan berpengalaman siap melayani Anda</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners">
        <div class="partners-grid">
            <div class="partner-logo">🏥 BPJS</div>
            <div class="partner-logo">🏥 KEMENKES</div>
            <div class="partner-logo">🏥 IDI</div>
            <div class="partner-logo">🏥 PERSI</div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🏥</div>
                <h3>Poli Umum</h3>
                <p>Pelayanan kesehatan umum untuk berbagai keluhan dan pemeriksaan rutin</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>

            <div class="service-card">
                <div class="service-icon">👶</div>
                <h3>Poli Anak</h3>
                <p>Layanan kesehatan khusus untuk bayi dan anak dengan dokter spesialis</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>

            <div class="service-card">
                <div class="service-icon">🦴</div>
                <h3>Poli Gigi</h3>
                <p>Perawatan kesehatan gigi dan mulut lengkap dengan peralatan modern</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>

            <div class="service-card">
                <div class="service-icon">💉</div>
                <h3>Poli Gizi</h3>
                <p>Penyuluhan dan konsultasi gizi untuk hidup sehat dan seimbang</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>

            <div class="service-card">
                <div class="service-icon">👶</div>
                <h3>Poli MCU</h3>
                <p>Medical Check Up (MCU) lengkap untuk memastikan kesehatan Anda secara menyeluruh</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>

            <div class="service-card">
                <div class="service-icon">👂</div>
                <h3>Poli THT</h3>
                <p>Pemeriksaan dan perawatan kesehatan telinga, hidung, dan tenggorokan</p>
                <a href="#" class="learn-more">Pelajari Lebih →</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="kontak">
        <p><strong>Klinik</strong></p>
        <p>Jl. Kesehatan No. 123, Jakarta Pusat</p>
        <p>Telepon: (021) 1234-5678 | Email: info@klinik.com</p>
        <p style="margin-top: 20px; color: #95a5a6;">© 2025 Klinik. All Rights Reserved.</p>
    </footer>

    <script>
        function toggleMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.toggle('active');
        }

        function closeMenu() {
            const navLinks = document.getElementById('navLinks');
            navLinks.classList.remove('active');
        }

        // Close menu when clicking outside
        document.addEventListener('click', function (event) {
            const navLinks = document.getElementById('navLinks');
            const menuToggle = document.querySelector('.menu-toggle');
            const navbar = document.querySelector('.navbar');

            if (!navbar.contains(event.target)) {
                navLinks.classList.remove('active');
            }
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>
</body>

</html>