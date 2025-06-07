<?php
session_start();
require "config.php";

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if (empty($username) || empty($password)) {
        $message = "Vyplňte všetky polia.";
    } elseif ($password !== $password_confirm) {
        $message = "Heslá sa nezhodujú.";
    } else {
        // Overenie, či užívateľ existuje
        $sql_check = "SELECT id FROM users WHERE username='$username' LIMIT 1";
        $result = $conn->query($sql_check);
        if ($result->num_rows > 0) {
            $message = "Používateľ už existuje.";
        } else {
            // Vloženie nového používateľa s hashovaným heslom
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql_insert = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
            if ($conn->query($sql_insert) === TRUE) {
                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['username'] = $username;
                header("Location: produkty.php"); // presmerovanie po registrácii
                exit;
            } else {
                $message = "Chyba pri registrácii: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8" />
    <title>Registrácia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-5" style="max-width: 400px;">

    <h2 class="mb-4">Registrácia</h2>

    <?php if ($message): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="POST" autocomplete="off">
        <div class="mb-3">
            <label for="username" class="form-label">Používateľské meno</label>
            <input type="text" class="form-control" id="username" name="username" required autofocus />
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

    <p class="mt-3">Už máte účet? <a href="login.php">Prihláste sa</a></p>

</body>
</html>
