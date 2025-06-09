
<?php
require "config.php";      // tu máš $conn a session_start()
require "classes/Produkty.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$produkty = new Produkty($conn);
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $produkty->pridaj($_POST['produkt_nazov'], (int)$_POST['pocet']);
        $message = $produkty->message;
    } elseif (isset($_POST['update'])) {
        $produkty->uprav((int)$_POST['id'], $_POST['produkt_nazov'], (int)$_POST['pocet']);
        $message = $produkty->message;
    }
}

if (isset($_GET['delete'])) {
    $produkty->vymaz((int)$_GET['delete']);
    header("Location: produkty.php");
    exit;
}

$result = $produkty->zobrazVsetky();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <title>Produkty | Cukráreň MAVI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- všetky tvoje linky a CSS -->
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

    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Správa produktov</h1>
                <a href="index.php">Domov</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="#">Produkty</a>
            </div>
        </div>
    </div>

    <div class="container mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-uppercase">Zoznam produktov</h3>
        </div>

        <?= $message ?>

        <div class="mb-4" style="max-width: 500px;">
            <form method="POST">
                <h5 class="mb-3">Pridať produkt</h5>
                <input type="text" name="produkt_nazov" class="form-control mb-2" placeholder="Názov produktu" required>
                <input type="number" name="pocet" class="form-control mb-2" placeholder="Počet kusov" min="0" required>
                <button type="submit" name="add" class="btn btn-primary">Pridať</button>
            </form>
        </div>

        <div class="table-responsive" style="max-width: 800px;">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Názov</th>
                        <th>Počet</th>
                        <th>Akcie</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <form method="POST">
                                <td><?= $row['id'] ?></td>
                                <td><input type="text" name="produkt_nazov" value="<?= htmlspecialchars($row['produkt_nazov']) ?>" class="form-control" required></td>
                                <td><input type="number" name="pocet" value="<?= (int)$row['pocet'] ?>" class="form-control" min="0" required></td>
                                <td>
                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                    <div class="d-flex gap-2">
                                        <button type="submit" name="update" class="btn btn-sm btn-warning">Upraviť</button>
                                        <a href="produkty.php?delete=<?= $row['id'] ?>" onclick="return confirm('Naozaj chcete odstrániť tento produkt?')" class="btn btn-sm btn-danger">Vymazať</a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include "parts/footer.php"; ?>

    <a href="#" class="btn btn-primary border-inner py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
