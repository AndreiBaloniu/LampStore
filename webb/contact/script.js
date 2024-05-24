// Funcția pentru afișarea mai multor angajați
function showMoreEmployees() {
    const employeesContainer = document.querySelector('.employees');
    const button = document.querySelector('.employees .btn');

    // Array cu informații despre angajați
    const moreEmployees = [
        { name: 'Stroiu Robert', position: 'Sales Representative' },
        { name: 'Ionescu Iustin Iulius', position: 'Customer Support Specialist' }
    ];

    // Adaugăm noi angajați
    moreEmployees.forEach(employee => {
        const employeeDiv = document.createElement('div');
        employeeDiv.classList.add('employee');
        employeeDiv.innerHTML = `<h3>${employee.name}</h3><p>${employee.position}</p>`;
        employeesContainer.insertBefore(employeeDiv, button);
    });

    // Ascundem butonul după ce s-au adăugat angajații
    button.style.display = 'none';
}
const contactForm = document.getElementById("contactForm");
contactForm.addEventListener("submit", function(event) {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;

    const emailRegex = /\S+@\S+\.\S+/;
    if (!emailRegex.test(email)) {
        event.preventDefault();
        alert("Adresa de email nu este validă!");
    }

    // Alte verificări pentru nume și mesaj pot fi adăugate aici

});


document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('.employees .btn');
    button.addEventListener('click', showMoreEmployees);
});