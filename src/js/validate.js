function validateLogin() {
    let email = document.getElementsByName("email")[0].value;
    let password = document.getElementsByName("password")[0].value;

    if (email.trim() === "" || password.trim() === "") {
        alert("Te rugăm să completezi toate câmpurile pentru a te loga!");
        return false;
    }

    return true;
}

function validateBook() {
    let title = document.getElementsByName("title")[0].value;
    let author = document.getElementsByName("author")[0].value;

    if (title.trim() === "" || author.trim() === "") {
        alert("Te rugăm să introduci titlul și autorul cărții!");
        return false;
    }
    return true;
}

function validateRegister() {
    let pass = document.getElementsByName("password")[0].value;
    let captcha = document.getElementsByName("captcha")[0].value;

    if (pass.length < 6) {
        alert("Parola trebuie să aibă cel puțin 6 caractere!");
        return false;
    }
    if (isNaN(captcha)) {
        alert("Te rugăm să introduci un număr valid la rezultat!");
        return false;
    }s
    return true;
}