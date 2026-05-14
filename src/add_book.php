<?php
include("includes/auth.php");
include("includes/db.php");
include("classes/book.php");

$book = new book($conn);

if(isset($_POST['add_book'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $status = $_POST['status'];

    if(!empty($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $target_folder = "uploads/" . $image_name;
        move_uploaded_file($image_temp, $target_folder);
    }
    else {
        $image_name = "default.png"; 
    }

    if($book->addBook($user_id, $title, $author, $status, $image_name)) {
        header("Location: dashboard.php");
        exit();
    }
    else {
        $eroare = "Eroare la salvarea cărții!";
    }
}
include("includes/header.php");
?>
<div class="main-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Adaugă o carte nouă</h1>
        <a href="dashboard.php" class="btn btn-outline-secondary btn-sm rounded-pill">
            <i class="bi bi-arrow-left"></i> Înapoi
        </a>
    </div>

    <?php if(isset($eroare)): ?>
        <div class="alert alert-danger"><?php echo $eroare; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" onsubmit="return validateBook()">
        
        <div class="mb-3">
            <label class="form-label fw-bold">Titlu carte</label>
            <input type="text" name="title" class="form-control rounded-3 shadow-sm" placeholder="Ex: Singur pe lume">
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Autor</label>
            <input type="text" name="author" class="form-control rounded-3 shadow-sm" placeholder="Ex: Hector Malot">
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold">Status lectură</label>
            <select name="status" class="form-select rounded-3 shadow-sm">
                <option value="vreau_sa_citesc">Vreau să citesc</option>
                <option value="o_citesc">O citesc</option>
                <option value="am_terminat">Am terminat-o</option>
            </select>
        </div>
        
        <div class="mb-4">
            <label class="form-label fw-bold">Imagine copertă <span class="text-muted small">(Opțional)</span></label>
            <input type="file" name="image" class="form-control rounded-3 shadow-sm">
        </div>
        
        <button type="submit" name="add_book" class="btn btn-primary w-100 rounded-pill py-2 shadow">
            <i class="bi bi-bookmark-plus"></i> Salvează în bibliotecă
        </button>
    </form>
</div>
<?php include("includes/footer.php"); ?>