<?php
class user {
    private $db;
    public function __construct($conn){
        $this->db = $conn;
    }

    public function register($username, $email, $password) {
        $username = mysqli_real_escape_string($this->db, $username);
        $email = mysqli_real_escape_string($this->db, $email);
        $password = password_hash($password, PASSWORD_DEFAULT);

        $verificare = "SELECT * FROM users WHERE username='$username' OR email='$email'";
        $rez_verif = $this->db->query($verificare);

        if($rez_verif->num_rows > 0) {
            return "existent";
        } else {
            $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
            if($this->db->query($sql)) {
                return "succes";
            } else {
                return "eroare";
            }
        }
    }

    public function login($username, $password, $remember) {
        $username = mysqli_real_escape_string($this->db, $username);

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $this->db->query($sql);

        if($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if(password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];

                if($remember) {
                    setcookie("user_id", $row['id'], time() + (30 * 24 * 60 * 60), "/");
                    setcookie("username", $row['username'], time() + (30 * 24 * 60 * 60), "/");
                }
                return true;
            }
        }
        return false;
    }
}
?>