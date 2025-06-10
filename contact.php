<?php
require_once "classes/Database.php";
require_once "classes/ContactMessage.php";

$db = new Database();
$conn = $db->getConnection();
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $contact = ContactMessage::fromPost($conn, $_POST);

    if ($contact->isValid()) {
        if ($contact->save()) {
            $message = "<div class='alert alert-success'>Správa bola odoslaná.</div>";
        } else {
            $message = "<div class='alert alert-danger'>Chyba pri odoslaní.</div>";
        }
    } else {
        $message = "<div class='alert alert-warning'>Vyplňte všetky polia.</div>";
    }
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cukráreň MAVI - to najlepšie pre Vás</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
</head>

<body>
    <!-- Header Start -->
   <?php  
    $file_path = "parts/header.php"; 
    if(!include($file_path)) {     
        echo"Failed to include $file_path";
    } 
    ?>
    <!-- Header End -->


    <!-- Page Header Start -->
    <div class="container-fluid bg-dark bg-img p-5 mb-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-uppercase text-white">Kontaktujte Nás</h1>
                <a href="">Domov</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Kontaktujte Nás</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container mt-3">
        <?php
            if (!empty($message)) {
                echo $message;
            }
        ?>
    </div>

    <!-- Contact Start -->
    <div class="container-fluid contact position-relative px-5" style="margin-top: 30px;">
        <div class="container">
            <div class="row g-5 mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-geo-alt fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Naša Adresa</h6>
                        <span>Mládeže 3, 953 01 Zlaté Moravce <br><br></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-envelope-open fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Email</h6>
                        <span>cukrarenmavi@gmail.com <br><br></span>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="bg-primary border-inner text-center text-white p-5">
                        <i class="bi bi-phone-vibrate fs-1 text-white"></i>
                        <h6 class="text-uppercase my-2">Zavolajte Nám</h6>
                        <span>+421 908 337 679<br><br> </span>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form method="POST" action="contact.php">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <input type="text" name="meno" class="form-control bg-light border-0 px-4" placeholder="Meno" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Email" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-12">
                                <input type="text" name="predmet" class="form-control bg-light border-0 px-4" placeholder="Predmet" style="height: 55px;" required>
                            </div>
                            <div class="col-sm-12">
                                <textarea name="sprava" class="form-control bg-light border-0 px-4 py-3" rows="4" placeholder="Vaša Správa" required></textarea>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary border-inner w-100 py-3" type="submit" name="submit">Odoslať</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


    <!-- Footer Start -->
    <?php  
    $file_path = "parts/footer.php"; 
    if(!include($file_path)) {     
        echo"Failed to include $file_path";
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
