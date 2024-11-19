"use strict";

$(document).ready(function () {
    $('#tablaES').DataTable({
        scrollX: true,
        pagingType: "full_numbers",
        language: window.espanol
    });

    $('#tablaSelectES').DataTable({
        scrollX: true,
        select: true,
        blurable: true,
        select: { style: "single" },
        pagingType: "full_numbers",
        language: window.espanol
    });

    $('#tablaSelectMultiES').DataTable({
        scrollX: true,
        select: true,
        blurable: true,
        select: { style: "multi" },
        pagingType: "full_numbers",
        language: window.espanol
    });
});
