<?php
class book {
    private $db;
    public function __construct($conn) {
        $this->db = $conn;
    }

    public function addBook($user_id, $title, $author, $status, $image) {
        $title = mysqli_real_escape_string($this->db, $title);
        $author = mysqli_real_escape_string($this->db, $author);
        $status = mysqli_real_escape_string($this->db, $status);
        $image = mysqli_real_escape_string($this->db, $image);

        $sql = "INSERT INTO books (user_id, title, author, status, image) 
                VALUES ('$user_id', '$title', '$author', '$status', '$image')";
        
        return $this->db->query($sql);
    }

    public function deleteBook($id) {
        $id = mysqli_real_escape_string($this->db, $id);
        $sql = "DELETE FROM books WHERE id = '$id'";
        return $this->db->query($sql);
    }

    public function updateBook($id, $title, $author, $status, $image = null) {
        $title = mysqli_real_escape_string($this->db, $title);
        $author = mysqli_real_escape_string($this->db, $author);
        $status = mysqli_real_escape_string($this->db, $status);
    
        if($image) {
            $image = mysqli_real_escape_string($this->db, $image);
            $sql = "UPDATE books SET title='$title', author='$author', status='$status', image='$image' WHERE id='$id'";
        }
        else {
            $sql = "UPDATE books SET title='$title', author='$author', status='$status' WHERE id='$id'";
        }
        return $this->db->query($sql);
    }

    public function getBooks($user_id) {
        $user_id = mysqli_real_escape_string($this->db, $user_id);
        $sql = "SELECT * FROM books WHERE user_id = '$user_id'";
        return $this->db->query($sql);
    }
}
?>