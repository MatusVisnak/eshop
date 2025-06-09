<?php
class User {
    public function __construct(private mysqli $conn) {}

    public function login(string $username, string $password): bool {
        $username = $this->conn->real_escape_string($username);
        $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }

        return false;
    }

    public function register(string $username, string $password): bool {
        $username = $this->conn->real_escape_string($username);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$passwordHash')";
        return $this->conn->query($sql);
    }

    public function exists(string $username): bool {
        $username = $this->conn->real_escape_string($username);
        $result = $this->conn->query("SELECT id FROM users WHERE username='$username' LIMIT 1");
        return $result->num_rows > 0;
    }
}
