<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
include("includes/header.php"); 
?>
<head><title>Contact & Media</title></head>
<div class="main-wrapper">
    <div class="container-fluid">
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold" style="color: #2040df;">Contact & Media</h1>
            <p class="text-muted">Informații utile și resurse educaționale</p>
            <div class="mx-auto" style="width: 60px; height: 4px; background: linear-gradient(to right, #f0389a, #2040df); border-radius: 2px;"></div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm rounded-4 h-100 p-4" style="background: rgba(255,255,255,0.5);">
                    <h3 class="h4 fw-bold mb-4"><i class="bi bi-info-circle me-2"></i>Date de Contact</h3>
                    
                    <div class="d-flex mb-3">
                        <div class="icon-box me-3 text-primary"><i class="bi bi-geo-alt-fill fs-4"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Adresă</h6>
                            <p class="small text-muted mb-0">Bulevardul Carol I, Nr.11, 700506, Iaşi, România</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="icon-box me-3 text-primary"><i class="bi bi-telephone-fill fs-4"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Telefon</h6>
                            <p class="small text-muted mb-0">0232 20 1000</p>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="icon-box me-3 text-primary"><i class="bi bi-envelope-at-fill fs-4"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Email</h6>
                            <p class="small text-muted mb-0">contact@uaic.ro</p>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="icon-box me-3 text-primary"><i class="bi bi-clock-fill fs-4"></i></div>
                        <div>
                            <h6 class="mb-0 fw-bold">Program</h6>
                            <p class="small text-muted mb-0">Luni-Vineri: 8.00 – 16.00</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1877.7036896007237!2d27.571621133677542!3d47.174033956323214!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cafb61af5ef507%3A0x95f1e37c73c23e74!2sUniversitatea%20%E2%80%9EAlexandru%20Ioan%20Cuza%E2%80%9D!5e0!3m2!1sro!2sro!4v1777154965573!5m2!1sro!2sro" 
                        width="100%" height="100%" style="border:0; min-height: 300px;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <hr class="my-5 opacity-25">

        <div class="row g-4">
            <div class="col-md-6">
                <h3 class="h5 fw-bold mb-3 text-center"><i class="bi bi-youtube me-2 text-danger"></i>Prezentare UAIC</h3>
                <div class="ratio ratio-16x9 shadow-sm rounded-4 overflow-hidden border">
                    <iframe src="https://www.youtube.com/embed/K9uhrYSECAA" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-md-6">
                <h3 class="h5 fw-bold mb-3 text-center"><i class="bi bi-play-circle me-2 text-primary"></i>Cum au fost inventate numerele complexe?</h3>
                <div class="ratio ratio-16x9 shadow-sm rounded-4 overflow-hidden border bg-black">
                    <video controls>
                        <source src="uploads/How Imaginary Numbers Were Invented - Veritasium (1012p).mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>