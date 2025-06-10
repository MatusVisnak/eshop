<?php
require_once "classes/Database.php";
require_once "classes/Produkty.php";

$db = new Database();
$conn = $db->getConnection();

$produkty = new Produkty($conn);
$vsetkyProdukty = $produkty->zobrazVsetky();
?>

<!DOCTYPE html>
<html lang="sk">

<head>
    <meta charset="utf-8">
    <title>Cukráreň MAVI - to najlepšie pre Vás</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="cukráreň, zákusky, dezerty" name="keywords">
    <meta content="Zákusky z cukrárne MAVI" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Prípadné malé úpravy */
        .zakusok-item .bg-dark {
            min-height: 120px;
        }
    </style>
</head>

<body>

    <!-- Header Start -->
    <?php
    $file_path = "parts/header.php";
    if (!include($file_path)) {
        echo "Failed to include $file_path";
    }
    ?>
    <!-- Header End -->

    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Naše Zákusky</h1>
                <a href="">Domov</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Zákusky</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Produkty Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="section-title position-relative text-center mx-auto mb-5 pb-3" style="max-width: 600px;">
                <h2 class="text-primary font-secondary">Sladké Dobroty</h2>
                <h1 class="display-4 text-uppercase">Naša aktuálna ponuka na predajni</h1>
            </div>
            <div class="row g-5">
                <?php if ($vsetkyProdukty && $vsetkyProdukty->num_rows > 0): ?>
                    <?php while ($row = $vsetkyProdukty->fetch_assoc()): ?>
                        <?php $imgPath = "imgzak/zakusok" . intval($row['id']) . ".jpg"; ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="zakusok-item">
                                <div class="position-relative overflow-hidden">
                                    <?php if (file_exists($imgPath)): ?>
                                        <img class="img-fluid w-100" src="<?php echo htmlspecialchars($imgPath); ?>" alt="<?php echo htmlspecialchars($row['produkt_nazov']); ?>">
                                    <?php else: ?>
                                        <div style="width:100%; height:250px; background:#eee; display:flex; align-items:center; justify-content:center; color:#999;">
                                            Obrázok chýba
                                        </div>
                                    <?php endif; ?>
                                    <div class="team-overlay w-100 h-100 position-absolute top-50 start-50 translate-middle d-flex align-items-center justify-content-center" style="pointer-events:none;">
                                        <!-- Tu môžeš pridať nejaké ikony alebo efekty, ak chceš -->
                                    </div>
                                </div>
                                <div class="bg-dark border-inner text-center p-4">
                                    <h4 class="text-uppercase text-primary"><?php echo htmlspecialchars($row['produkt_nazov']); ?></h4>
                                    <p class="text-white m-0">Počet: <?php echo intval($row['pocet']); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p>Žiadne zákusky v databáze.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Produkty End -->

    <!-- Footer Start -->
    <?php
    $file_path = "parts/footer.php";
    if (!include($file_path)) {
        echo "Failed to include $file_path";
    }
    ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
