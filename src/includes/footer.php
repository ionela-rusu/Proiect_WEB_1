<footer class="glass-footer">
    <div class="footer-content">
        <div class="footer-section">
            <h4>Biblioteca Online</h4>
            <p>Proiect realizat pentru Facultatea de Matematica, UAIC.</p>
        </div>

        <div class="footer-section">
            <h4>Link-uri Rapide</h4>
            <ul>
                <li><a href="dashboard.php">Cărțile Mele</a></li>
                <li><a href="contact.php">Contact & Media</a></li>
                <li><a href="#">Termeni și Condiții</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Info Session</h4>
            <p id="live-clock">Se încarcă ora...</p>
            <p>Utilizator logat: <strong>
                <?php 
                if(isset($_SESSION['username'])) {
                    echo $_SESSION['username']; 
                }
                else {
                    echo "Vizitator"; 
                }
                ?>
            </strong></p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2026 - Toate drepturile rezervate. Realizat de Ionela Rusu</p>
    </div>
</footer>

<script>
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('ro-RO');
        document.getElementById('live-clock').innerHTML = "Ora locală: " + timeString;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>
</body>
</html>