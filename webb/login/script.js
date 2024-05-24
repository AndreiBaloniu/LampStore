// Validare formular de login
const loginForm = document.getElementById("loginForm");
loginForm.addEventListener("submit", function(event) {
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    // Validare adresa de email folosind expresia regulată
    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email)) {
        event.preventDefault();
        alert("Adresa de email nu este validă!");
    }

    // Alte verificări pot fi adăugate aici, cum ar fi validarea parolei etc.
});
