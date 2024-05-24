// script.js

function searchTable() {
    let input = document.getElementById('searchInput');
    let filter = input.value.toLowerCase();
    let table = document.getElementById('employeesTable');
    let tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        let td = tr[i].getElementsByTagName('td');
        let showRow = false;

        for (let j = 0; j < td.length; j++) {
            if (td[j].innerText.toLowerCase().indexOf(filter) > -1) {
                showRow = true;
                break;
            }
        }
        tr[i].style.display = showRow ? '' : 'none';
    }
}

function sortTable(columnIndex) {
    let table = document.getElementById('employeesTable');
    let rows = Array.from(table.rows).slice(1);
    let ascending = table.rows[0].cells[columnIndex].classList.toggle('asc');

    rows.sort((a, b) => {
        let aText = a.cells[columnIndex].innerText.toLowerCase();
        let bText = b.cells[columnIndex].innerText.toLowerCase();

        if (aText < bText) return ascending ? -1 : 1;
        if (aText > bText) return ascending ? 1 : -1;
        return 0;
    });

    rows.forEach(row => table.appendChild(row));
}
