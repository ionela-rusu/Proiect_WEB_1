<?php
include("includes/auth.php");
include("includes/db.php");
include("classes/book.php");
include("includes/header.php");

$book = new book($conn);
$user_id = $_SESSION['user_id'];

$result = $book->getBooks($user_id);
$total_books = mysqli_num_rows($result);
?>

<style>
#searchSuggestions {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(32, 64, 223, 0.1);
    max-height: 300px;
    overflow-y: auto;
}

#searchSuggestions .list-group-item {
    border: none;
    padding: 10px 15px;
    transition: all 0.2s;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 12px;
}

#searchSuggestions .list-group-item:hover {
    background: rgba(32, 64, 223, 0.08);
    color: #2040df;
}

#searchSuggestions img {
    width: 35px;
    height: 50px;
    object-fit: cover;
    border-radius: 4px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
</style>

<head><title>Dashboard - Cartile mele</title></head>
<div class="main-wrapper">
    <h1 class="display-6 fw-bold text-dark">Bine ai venit, <?php echo $_SESSION['username']; ?>!</h1>
    <p class="text-muted mb-4">Aici poți gestiona colecția ta personală de lecturi.</p>

    <?php if ($total_books > 0): ?>
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <a href="add_book.php" class="btn btn-primary rounded-pill shadow-sm px-4 py-2">
                <i class="bi bi-plus-lg me-2"></i>Adaugă o carte nouă
            </a>

            <div class="search-container position-relative" style="min-width: 400px; max-width: 700px;">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 rounded-start-pill text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" id="bookSearch" class="form-control border-start-0 rounded-end-pill shadow-sm" 
                        placeholder="Caută un titlu sau autor..." onkeyup="liveSearch()" autocomplete="off">
                </div>
    
                <div id="searchSuggestions" class="list-group position-absolute w-100 shadow-lg d-none" 
                    style="z-index: 1050; top: 110%; border-radius: 15px;">
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle custom-table" id="booksTable">
                <thead class="table-light">
                    <tr>
                        <th style="width: 20%;">Copertă</th>
                        <th style="width: 25%;">Titlu și Autor</th>
                        <th style="width: 25%;" class="text-center">Status</th>
                        <th style="width: 30%;" class="text-center">Acțiuni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td>
                            <div class="p-1"> 
                                <img src="uploads/<?php echo $row['image']; ?>" 
                                    class="rounded shadow border" 
                                    style="width: 90px; height: 130px; object-fit: cover; display: block;">
                            </div>
                        </td>
                        <td>
                            <div class="fw-bold text-truncate" style="max-width: 250px;"><?php echo $row['title']; ?></div>
                            <div class="text-muted small"><?php echo $row['author']; ?></div>
                        </td>
                        <td class="text-center">
                            <?php 
                            $status = $row['status'];
                            if($status == 'am_terminat') {
                                echo '<span class="badge rounded-pill bg-success text-white px-3 py-2">Am terminat-o</span>';
                            } elseif($status == 'o_citesc') {
                                echo '<span class="badge rounded-pill bg-warning text-dark px-3 py-2">O citesc</span>';
                            } else {
                                echo '<span class="badge rounded-pill bg-info text-white px-3 py-2">Vreau să citesc</span>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <a href="edit_book.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm rounded-pill px-3">
                                    <i class="bi bi-pencil"></i> Editează
                                </a>
                                <a href="delete_book.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3 btn-delete">
                                    <i class="bi bi-trash"></i> Șterge
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    <?php else: ?>
        <div class="text-center py-5">
            <div class="mb-3">
                <i class="bi bi-book-half text-muted" style="font-size: 5rem; opacity: 0.2;"></i>
            </div>
            <h3 class="text-muted fw-light">Biblioteca ta este goală</h3>
            <p class="text-muted mb-4">Se pare că nu ai adăugat nicio carte încă.</p>
            <a href="add_book.php" class="btn btn-primary rounded-pill shadow px-5 py-3">
                <i class="bi bi-plus-lg me-2"></i>Adaugă prima ta carte
            </a>
        </div>
    <?php endif; ?>

    <a href="logout.php" class="btn btn-light btn-sm rounded-pill shadow-sm border mt-4">
        <i class="bi bi-box-arrow-right"></i> Ieșire (Logout)
    </a>
</div>

<script>
function liveSearch() {
    let input = document.getElementById("bookSearch");
    let filter = input.value.toLowerCase();
    let suggestions = document.getElementById("searchSuggestions");
    let tableRows = document.querySelectorAll("#booksTable tbody tr");
    
    suggestions.innerHTML = "";

    if (filter.length === 0) {
        suggestions.classList.add("d-none");
        return;
    }

    let found = false;

    tableRows.forEach(row => {
        let imgSource = row.querySelector("img").src;
        let infoCell = row.getElementsByTagName("td")[1];
        let title = infoCell.querySelector(".fw-bold").innerText;
        let author = infoCell.querySelector(".text-muted").innerText;
        
        let statusBadgeHTML = row.getElementsByTagName("td")[2].innerHTML;
        
        let actionsTd = row.getElementsByTagName("td")[3].cloneNode(true);
        let actionButtons = actionsTd.querySelectorAll('a');
        
        actionButtons.forEach(btn => {
            btn.classList.add('btn-sm', 'rounded-circle');
            btn.style.width = '28px';
            btn.style.height = '28px';
            btn.style.display = 'inline-flex';
            btn.style.alignItems = 'center';
            btn.style.justifyContent = 'center';
            btn.style.padding = '0';
            btn.style.fontSize = '0.75rem';

            if (btn.classList.contains('btn-delete')) {
                btn.setAttribute('onclick', 'return confirm("Ești sigur că vrei să ștergi această carte?");');
            }

            let icon = btn.querySelector('i');
            if (icon) {
                btn.innerHTML = '';
                btn.appendChild(icon);
            }
        });

        let combinedText = (title + " " + author).toLowerCase();

        if (combinedText.includes(filter)) {
            found = true;
            let item = document.createElement("div");
            item.className = "list-group-item d-flex align-items-center justify-content-between py-1 px-3";
            
            item.innerHTML = `
                <div class="d-flex align-items-center gap-2" style="width: 50%; min-width: 0;">
                    <img src="${imgSource}" alt="cover" style="width: 28px; height: 40px; object-fit: cover; border-radius: 3px;">
                    <div class="text-truncate">
                        <div class="fw-bold text-dark text-truncate" style="font-size: 0.8rem; line-height: 1.1;">${title}</div>
                        <div class="text-muted" style="font-size: 0.65rem;">${author}</div>
                    </div>
                </div>
                <div class="text-center" style="width: 25%;">
                    <div style="transform: scale(0.85);">${statusBadgeHTML}</div>
                </div>
                <div class="d-flex gap-1 justify-content-end" style="width: 25%;">
                    ${actionsTd.innerHTML}
                </div>
            `;

            suggestions.appendChild(item);
        }
    });

    if (found) {
        suggestions.classList.remove("d-none");
    } else {
        suggestions.innerHTML = '<div class="list-group-item text-muted small text-center py-2">Nicio carte...</div>';
        suggestions.classList.remove("d-none");
    }
}

document.addEventListener("click", function(e) {
    let searchBox = document.querySelector(".search-container");
    if (searchBox && !searchBox.contains(e.target)) {
        document.getElementById("searchSuggestions").classList.add("d-none");
    }
});
</script>

<?php include("includes/footer.php"); ?>