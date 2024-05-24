document.addEventListener("DOMContentLoaded", function() {
    const productList = document.querySelector(".product-list");


    // Afisam fiecare produs în lista
    products.forEach(product => {
        const productDiv = document.createElement("div");
        productDiv.classList.add("product");
        productDiv.innerHTML = `
            <h3>${product.name}</h3>
            <p>Preț: ${product.price} lei</p>
        `;
        productList.appendChild(productDiv);
    });
});

function createItemCard(product) {
    const card = document.createElement("div");
    card.classList.add("product");
    card.innerHTML = `
        <div class="product-info">
            <img class="product-img" src="${product.image}" alt="${product.name}">
            <div class="product-details">
                <h3>${product.name}</h3>
                <p>${product.description}</p>
                <p>Preț: ${product.price}</p>
            </div>
        </div>
    `;
    card.addEventListener("click", function() {
        openProductDetails(product.id);
    });
    return card;
}

function openProductDetails(productId) {
    // Redirecționează către pagina de detalii despre produs, furnizând id-ul produsului
    window.location.href = `../produse_details/product_details.html?id=${productId}`;
}

// script.js

function searchProducts() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let products = document.getElementsByClassName('product');

    for (let i = 0; i < products.length; i++) {
        let product = products[i];
        let name = product.getElementsByClassName('product-details')[0].getElementsByTagName('h3')[0].innerText;

        if (name.toLowerCase().indexOf(filter) > -1) {
            product.style.display = "";
        } else {
            product.style.display = "none";
        }
    }
}

function filterProducts() {
    let select = document.getElementById('filterSelect');
    let filter = select.value;
    let products = document.getElementsByClassName('product');

    for (let i = 0; i < products.length; i++) {
        let product = products[i];
        let category = product.getAttribute('data-category');

        if (filter === 'toate' || category === filter) {
            product.style.display = "";
        } else {
            product.style.display = "none";
        }
    }
}

// Funcționalitate pentru fereastra modală
function openModal(element) {
    let modal = document.getElementById('imageModal');
    let modalImg = document.getElementById('modalImage');
    let captionText = document.getElementById('caption');
    
    modal.style.display = "block";
    modalImg.src = element.src;
    captionText.innerHTML = element.alt;
}

function closeModal() {
    let modal = document.getElementById('imageModal');
    modal.style.display = "none";
}
