<?php
require_once "classes/Database.php";
require_once "classes/User.php";

$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

if (isset($_SESSION['user_id'])) {
    header("Location: produkty.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($user->login($_POST['username'], $_POST['password'])) {
        header("Location: produkty.php");
        exit;
    } else {
        $error = "Nesprávne prihlasovacie údaje.";
    }
}
?>


<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <title>Cukráreň MAVI - to najlepšie pre Vás</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="img/favicon.ico" rel="icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Oswald:wght@500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include "parts/header.php"; ?>

    <!-- Page Header -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Prihlásenie</h1>
                <a href="index.php">Domov</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="#">Prihlásenie</a>
            </div>
        </div>
    </div>

    <!-- Login Form -->
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
                <div class="bg-light p-4 rounded shadow">
                    <h4 class="mb-4 text-center">Prihlásenie pre zamestnancov MAVI</h4>
                    <form method="POST" action="login.php">
                        <div class="form-group mb-3">
                            <label for="username">Používateľ</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Zadajte používateľské meno" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Heslo</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Zadajte heslo" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Prihlásiť sa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include "parts/footer.php"; ?>

    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- Skripty -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
