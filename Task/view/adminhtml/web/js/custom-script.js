require(['jquery'], function($) {
    $(document).ready(function() {
        const searchInput = $("#search-key");
        const tableRows = $("#custom-config-table tbody tr");

        searchInput.on("input", function() {
            const searchText = searchInput.val().toLowerCase();

            tableRows.each(function() {
                const parentKey = $(this).find("td:first-child").text().toLowerCase();
                const key = $(this).find("td:nth-child(2)").text().toLowerCase();

                if (parentKey.includes(searchText) || key.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
});