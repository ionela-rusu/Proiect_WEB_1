<?php
include("includes/auth.php"); 
include("includes/db.php");
include("classes/book.php");

if(isset($_GET['id'])) {
    $book = new book($conn);
    
    if($book->deleteBook($_GET['id'])) {
        header("Location: dashboard.php");
        exit(); 
    }
}
?>