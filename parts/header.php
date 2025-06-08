<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark shadow-sm py-3 py-lg-0 px-3 px-lg-0">
    <a href="index.php" class="navbar-brand d-block d-lg-none">
        <h1 class="m-0 text-uppercase text-white">
            <i class="fa fa-birthday-cake fs-1 text-primary me-3"></i>Cukráreň MAVI
        </h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto mx-lg-auto py-0">
            <a href="index.php" class="nav-item nav-link active">Domov</a>
            <a href="about.php" class="nav-item nav-link">O nás</a>
            <a href="menu.php" class="nav-item nav-link">Menu a ceny</a>
            <a href="team.php" class="nav-item nav-link">Pekári</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Stránky</a>
                <div class="dropdown-menu m-0">
                    <a href="service.php" class="dropdown-item">Naše služby</a>
                    <a href="testimonial.php" class="dropdown-item">Recenzie</a>
                </div>
            </div>

            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="nav-item nav-link text-white">
                    <i class="bi bi-person-fill"></i> <?= htmlspecialchars($_SESSION['username']) ?>
                </span>
                <a href="produkty.php" class="nav-item nav-link">Produkty</a>           
                <a href="logout.php" class="nav-item nav-link">Odhlásiť sa</a>

            <?php else: ?>
                <a href="contact.php" class="nav-item nav-link">Kontaktujte nás</a>
                <a href="login.php" class="nav-item nav-link">Prihlásenie</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<!-- Navbar End -->
