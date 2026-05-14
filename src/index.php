<?php
session_start();

if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    $_SESSION['user_id'] = $_COOKIE['user_id'];
    $_SESSION['username'] = $_COOKIE['username'];
}

include("includes/header.php");
?>

<head><title>Pagina de pornire</title></head>
<div class="main-wrapper text-center py-5">
    <div style="margin-top: -10px; margin-bottom: 10px;">
        <img src="uploads/pisi.png" style="width: 140px; height: auto;">
    </div>
    <h1 class="display-4 fw-bold mb-3">Biblioteca Virtuală</h1>
    <p class="lead text-muted mb-5 mx-auto" style="max-width: 600px;">
        Organizează-ți colecția de cărți, urmărește-ți progresul lecturii și creează-ți propriul raft digital.
    </p>

    <?php if(!isset($_SESSION['user_id'])): ?>
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a href="login.php" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                <i class="bi bi-box-arrow-in-right me-2"></i> Conectare
            </a>
            <a href="register.php" class="btn btn-outline-primary btn-lg rounded-pill px-5 shadow-sm">
                <i class="bi bi-person-plus me-2"></i> Creează Cont
            </a>
        </div>
    <?php else: ?>
        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
            <a href="dashboard.php" class="btn btn-primary btn-lg rounded-pill px-5 shadow">
                Mergi la Dashboard <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    <?php endif; ?>
    <div class="mt-5 pt-4 border-top">
        <h5 class="text-muted mb-3 small fw-bold text-uppercase">Bestsellers</h5>
        <div class="canvas-container" style="overflow-x: auto;">
            <canvas id="bestsellerCanvas" width="900" height="300" style="border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);"></canvas>
        </div>
    </div>
</div>

<script src="js/canvas-banner.js"></script>

<?php include("includes/footer.php"); ?>