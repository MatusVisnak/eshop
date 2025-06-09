<?php
class ContactMessage {
    public function __construct(
        private mysqli $conn,
        private string $meno,
        private string $email,
        private string $predmet,
        private string $sprava
    ) {}

    public static function fromPost(mysqli $conn, array $data): ContactMessage {
        return new ContactMessage(
            $conn,
            $conn->real_escape_string($data['meno']),
            $conn->real_escape_string($data['email']),
            $conn->real_escape_string($data['predmet']),
            $conn->real_escape_string($data['sprava'])
        );
    }

    public function isValid(): bool {
        return $this->meno && $this->email && $this->predmet && $this->sprava;
    }

    public function save(): bool {
        $sql = "INSERT INTO kontakty (meno, email, predmet, sprava)
                VALUES ('$this->meno', '$this->email', '$this->predmet', '$this->sprava')";
        return $this->conn->query($sql);
    }
}
