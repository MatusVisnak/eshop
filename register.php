<?php
require_once "classes/Database.php";
require_once "classes/User.php";

$db = new Database();
$conn = $db->getConnection();
$user = new User($conn);

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $key = trim($_POST['key'] ?? '');
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($key !== 'mavicukraren2025') {
        $message = "Neplatný registračný kľúč.";
    } elseif (empty($username) || empty($password)) {
        $message = "Vyplňte všetky polia.";
    } elseif ($password !== $password_confirm) {
        $message = "Heslá sa nezhodujú.";
    } elseif ($user->exists($username)) {
        $message = "Používateľ už existuje.";
    } else {
        if ($user->register($username, $password)) {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['username'] = $username;
            header("Location: produkty.php");
            exit;
        } else {
            $message = "Chyba pri registrácii.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <title>Prihlásenie | Cukráreň MAVI</title>
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
                <h1 class="display-4 text-uppercase text-white">Registrácia</h1>
                <a href="index.php">Domov</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="#">Registrácia</a>
            </div>
        </div>
    </div>

    <h2 class="mb-4 text-center">Registrácia</h2>

    <?php if ($message): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off" class="mx-auto" style="max-width: 400px;">
        <div class="mb-3">
            <label for="key" class="form-label">Kľúč</label>
            <input type="text" class="form-control" id="key" name="key" required autofocus />
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Používateľské meno</label>
            <input type="text" class="form-control" id="username" name="username" required />
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Heslo</label>
            <input type="password" class="form-control" id="password" name="password" required />
        </div>
        <div class="mb-3">
            <label for="password_confirm" class="form-label">Potvrď heslo</label>
            <input type="password" class="form-control" id="password_confirm" name="password_confirm" required />
        </div>
        <button type="submit" class="btn btn-primary w-100">Registrovať sa</button>
    </form>

    <p class="mt-3 text-center">Už máte účet? <a href="login.php">Prihláste sa</a></p>
    
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
