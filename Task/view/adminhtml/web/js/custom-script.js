document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("search-key");
    const tableRows = document.querySelectorAll("#custom-config-table tbody tr");

    searchInput.addEventListener("input", function() {
        const searchText = searchInput.value.toLowerCase();

        tableRows.forEach(function(row) {
            const parentKey = row.querySelector("td:first-child").textContent.toLowerCase();
            const key = row.querySelector("td:nth-child(2)").textContent.toLowerCase();

            if (parentKey.includes(searchText) || key.includes(searchText)) {
                row.style.display = "table-row";
            } else {
                row.style.display = "none";
            }
        });
    });
});