// Validare formular de înregistrare
const registerForm = document.getElementById("registerForm");
registerForm.addEventListener("submit", function(event) {
    const username = document.getElementById("username").value;
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

// Funcție pentru a popula dropdown-ul cu orașe în funcție de țara selectată
function populateCities() {
    const country = document.getElementById("country").value;
    const cityDropdown = document.getElementById("city");
    // Resetăm dropdown-ul cu orașe
    cityDropdown.innerHTML = "<option value=''>Alege un oraș</option>";
    // Populăm orașele în funcție de țara selectată
    if (country === "Romania") {
        // Dacă este selectată România, adăugăm orașe românești
        const romanianCities = ["București", "Cluj-Napoca", "Timișoara", "Iași"];
        romanianCities.forEach(city => {
            const option = document.createElement("option");
            option.text = city;
            option.value = city;
            cityDropdown.add(option);
        });
    } else if (country === "Statele Unite") {
        // Dacă este selectată Statele Unite, adăugăm orașe americane
        const usCities = ["New York", "Los Angeles", "Chicago", "Houston"];
        usCities.forEach(city => {
            const option = document.createElement("option");
            option.text = city;
            option.value = city;
            cityDropdown.add(option);
        });
    }
}
