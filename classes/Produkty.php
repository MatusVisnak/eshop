<?php
class Produkty {
    private mysqli $conn;
    public string $message = "";

    public function __construct(mysqli $conn) {
        $this->conn = $conn;
    }

    public function pridaj(string $nazov, int $pocet): void {
        $nazov = $this->conn->real_escape_string(trim($nazov));
        $pocet = max(0, $pocet);

        if ($nazov !== "" && $pocet >= 0) {
            $sql = "INSERT INTO produkty (produkt_nazov, pocet) VALUES ('$nazov', $pocet)";
            if ($this->conn->query($sql)) {
                $this->message = "<div class='alert alert-success'>Produkt pridaný.</div>";
            } else {
                $this->message = "<div class='alert alert-danger'>Chyba pri pridávaní produktu.</div>";
            }
        } else {
            $this->message = "<div class='alert alert-danger'>Vyplňte názov a počet ≥ 0.</div>";
        }
    }

    public function uprav(int $id, string $nazov, int $pocet): void {
        $id = max(0, $id);
        $nazov = $this->conn->real_escape_string(trim($nazov));
        $pocet = max(0, $pocet);

        if ($id > 0 && $nazov !== "" && $pocet >= 0) {
            $sql = "UPDATE produkty SET produkt_nazov='$nazov', pocet=$pocet WHERE id=$id";
            if ($this->conn->query($sql)) {
                $this->message = "<div class='alert alert-success'>Produkt upravený.</div>";
            } else {
                $this->message = "<div class='alert alert-danger'>Chyba pri úprave produktu.</div>";
            }
        } else {
            $this->message = "<div class='alert alert-danger'>Vyplňte názov a počet ≥ 0.</div>";
        }
    }

    public function vymaz(int $id): void {
        $id = max(0, $id);
        if ($id > 0) {
            $this->conn->query("DELETE FROM produkty WHERE id=$id");
        }
    }

    public function zobrazVsetky(): mysqli_result|false {
        return $this->conn->query("SELECT * FROM produkty ORDER BY id DESC");
    }
}
