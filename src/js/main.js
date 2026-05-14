document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            const confirmare = confirm("Ești sigur că vrei să ștergi această carte?");
            
            if (!confirmare) {
                e.preventDefault();
            }
        });
    });

    console.log("Main.js a fost încărcat cu succes! Sistemul de bibliotecă este gata.");
});