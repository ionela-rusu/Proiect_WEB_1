<?php
include("includes/auth.php");
include("includes/db.php");
include("classes/book.php");

$book = new book($conn);

if(!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}
$id_carte = $_GET['id'];

$res = $conn->query("SELECT * FROM books WHERE id = '$id_carte'");
$cartea = $res->fetch_assoc();

if(isset($_POST['edit_book'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $status = $_POST['status'];
    $nume_imagine = null;

    if(!empty($_FILES['image']['name'])) {
        $nume_imagine = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $nume_imagine);
    }

    if($book->updateBook($id_carte, $title, $author, $status, $nume_imagine)) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Eroare la actualizare!";
    }
}
include("includes/header.php");
?>
<div class="main-wrapper" style="max-width: 700px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 fw-bold"><i class="bi bi-pencil-square me-2"></i>Editează Cartea</h1>
        <a href="dashboard.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
            <i class="bi bi-x-circle"></i> Anulează
        </a>
    </div>

    <?php if(isset($eroare)): ?>
        <div class="alert alert-danger rounded-pill"><?php echo $eroare; ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" onsubmit="return validateBook()">
        
        <div class="mb-3">
            <label class="form-label fw-bold small">Titlu</label>
            <input type="text" name="title" class="form-control rounded-3 shadow-sm" value="<?php echo $cartea['title']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold small">Autor</label>
            <input type="text" name="author" class="form-control rounded-3 shadow-sm" value="<?php echo $cartea['author']; ?>" required>
        </div>
        
        <div class="mb-3">
            <label class="form-label fw-bold small">Status</label>
            <select name="status" class="form-select rounded-3 shadow-sm">
                <option value="vreau_sa_citesc" <?php if($cartea['status'] == 'vreau_sa_citesc') echo 'selected'; ?>>Vreau să citesc</option>
                <option value="o_citesc" <?php if($cartea['status'] == 'o_citesc') echo 'selected'; ?>>O citesc</option>
                <option value="am_terminat" <?php if($cartea['status'] == 'am_terminat') echo 'selected'; ?>>Am terminat-o</option>
            </select>
        </div>
        
        <div class="row align-items-center mb-4">
            <div class="col-auto">
                <p class="mb-1 small fw-bold">Imagine actuală:</p>
                <img src="uploads/<?php echo $cartea['image']; ?>" class="rounded shadow-sm" style="width: 60px; height: 80px; object-fit: cover;">
            </div>
            <div class="col">
                <label class="form-label fw-bold small">Schimbă imaginea (Optional)</label>
                <input type="file" name="image" class="form-control rounded-3 shadow-sm">
            </div>
        </div>
        
        <button type="submit" name="edit_book" class="btn btn-primary w-100 rounded-pill py-2 shadow fw-bold">
            <i class="bi bi-check2-circle"></i> SALVEAZĂ MODIFICĂRILE
        </button>
    </form>
</div>

<?php include("includes/footer.php"); ?>