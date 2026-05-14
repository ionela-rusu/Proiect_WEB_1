<?php
session_start();
include("includes/db.php");
include("classes/user.php");

$user = new user($conn);

if(isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']);

    if($user->login($username, $password, $remember)) {
        header("Location: dashboard.php");
        exit();
    }
    else {
        $eroare = "Date incorecte!";
    }
}
include("includes/header.php");
?>

<html>
    <head><title>Login</title></head>
    <body>
        <div class="main-wrapper" style="max-width: 500px;">
            <div class="text-center mb-4">
                <i class="bi bi-person-circle" style="font-size: 3rem; color: #2040df;"></i>
                <h2 class="fw-bold">Autentificare</h2>
                <p class="text-muted">Introdu datele tale pentru a accesa biblioteca</p>
            </div>

            <?php if(isset($eroare)): ?>
            <div class="alert alert-danger alert-dismissible fade show rounded-pill py-2 px-4" role="alert">
                <small><i class="bi bi-exclamation-triangle-fill"></i> <?php echo $eroare; ?></small>
            </div>
            <?php endif; ?>

            <form id="loginForm" method="POST" onsubmit="return validateLogin()">
        
                <div class="mb-3">
                    <label class="form-label small fw-bold">Utilizator</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill text-muted">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" name="username" class="form-control border-start-0 rounded-end-pill shadow-sm" placeholder="Username" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Parolă</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 rounded-start-pill text-muted">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" name="password" class="form-control border-start-0 rounded-end-pill shadow-sm" placeholder="Parola" required>
                    </div>
                </div>

                <div class="form-check mb-4 ms-2">
                    <input class="form-check-input" type="checkbox" name="remember" id="rememberCheck">
                    <label class="form-check-label small" for="rememberCheck">Vreau să rămân conectat</label>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow-sm mb-3">LOGARE</button>
            </form>

            <div class="text-center mt-4">
                <p class="small">Nu ai cont? <a href="register.php" class="text-decoration-none fw-bold" style="color: #f0389a;">Înregistrează-te</a></p>
            </div>
        </div>
        <?php include("includes/footer.php"); ?>
    </body>
</html>