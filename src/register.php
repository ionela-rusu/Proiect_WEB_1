<?php
session_start();
include("includes/db.php");
include("classes/user.php");

$user = new user($conn);

if(!isset($_SESSION['nr1'])){
    $_SESSION['nr1'] = rand(1,9);
    $_SESSION['nr2'] = rand(1,9);
}

$mesaj = "";
$tip_mesaj = "";

if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $rezultat = $_SESSION['nr1'] + $_SESSION['nr2'];

    if($_POST['captcha'] != $rezultat){
        $mesaj = "Captcha greșit! Mai încearcă o dată.";
        $tip_mesaj = "danger";
    }
    else {
        $raspuns = $user->register($username, $email, $password);

        if($raspuns == "existent") {
            $mesaj = "Username-ul sau email-ul este deja folosit!";
            $tip_mesaj = "danger";
        } 
        elseif($raspuns == "succes") {
            $_SESSION['nr1'] = rand(1,9);
            $_SESSION['nr2'] = rand(1,9);
            $mesaj = "Cont creat cu succes! Te poți loga.";
            $tip_mesaj = "success";
        } 
        else {
            $mesaj = "Eroare la înregistrare!";
            $tip_mesaj = "danger";
        }
    }
}
include("includes/header.php");
?>

<html>
    <head><title>Inregistrare</title></head>
    <body>
        <div class="main-wrapper" style="max-width: 550px;">
            <div class="text-center mb-4">
                <i class="bi bi-person-plus" style="font-size: 3rem; color: #2040df;"></i>
                <h2 class="fw-bold">Cont Nou</h2>
                <p class="text-muted">Alătură-te comunității noastre de cititori</p>
            </div>

            <?php if($mesaj != ""): ?>
            <div class="alert alert-<?php echo $tip_mesaj; ?> alert-dismissible fade show rounded-pill px-4" role="alert">
                <small><?php echo $mesaj; ?></small>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>

            <form method="POST" onsubmit="return validateRegister()">
            <div class="mb-3">
                <label class="form-label small fw-bold">Utilizator</label>
                <input type="text" name="username" class="form-control rounded-pill shadow-sm px-3" placeholder="Alege un username" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Adresă Email</label>
                <input type="email" name="email" class="form-control rounded-pill shadow-sm px-3" placeholder="exemplu@email.com" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Parolă</label>
                <input type="password" name="password" class="form-control rounded-pill shadow-sm px-3" placeholder="Minim 6 caractere" required>
            </div>

            <div class="p-3 mb-4 rounded-4" style="background: rgba(32, 64, 223, 0.05); border: 1px dashed #2040df;">
                <label class="form-label small fw-bold d-block text-center mb-2">Verificare de securitate</label>
                <div class="d-flex align-items-center justify-content-center gap-3">
                    <span class="fs-5 fw-bold"><?php echo $_SESSION['nr1']; ?> + <?php echo $_SESSION['nr2']; ?> = </span>
                    <input type="text" name="captcha" class="form-control rounded-pill shadow-sm text-center" style="width: 100px;" placeholder="?" required>
                </div>
            </div>

            <button type="submit" name="register" class="btn btn-primary w-100 rounded-pill py-2 fw-bold shadow">
                CREEAZĂ CONTUL
            </button>
            </form>

            <div class="text-center mt-4">
                <p class="small">Ai deja cont? <a href="login.php" class="text-decoration-none fw-bold" style="color: #f0389a;">Conectează-te aici</a></p>
            </div>
        </div>

        <?php include("includes/footer.php"); ?>
    </body>
</html>
