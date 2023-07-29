$(document).ready(function() {
    // $("#datatable").DataTable(), $("#datatable-buttons").DataTable({
    //     lengthChange: !1,
    //     buttons: ["copy", "excel", "pdf", "colvis"],
    //     "aLengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
    //     "pageLength": 10,
    //     "paging": true
    // }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");
    // $("#datatable2").DataTable(), $("#datatable-buttons").DataTable({
    //     lengthChange: !1,
    //     buttons: ["copy", "excel", "pdf", "colvis"],
    //     "aLengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
    //     "pageLength": 10,
    //     "paging": true
    // }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");
    // $("#datatable3").DataTable(), $("#datatable-buttons").DataTable({
    //     lengthChange: !1,
    //     buttons: ["copy", "excel", "pdf", "colvis"],
    //     "aLengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
    //     "pageLength": 10,
    //     "paging": true
    // }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm");

    $('#datatable').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
        "pageLength": 10,
        "paging": true,
        "autoWidth": false,
    });

    $('#datatable2').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
        "pageLength": 10,
        "paging": true,
        "autoWidth": false,
    });

    $('#datatable3').DataTable({
        "aLengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
        "pageLength": 10,
        "paging": true,
        "autoWidth": false,
    });

    // $('#datatable').DataTable({
    //     "dom": '<"dt-buttons"Bfli>rtp',
    //     "aLengthMenu": [[10, 25, 50, 100, 500, -1], [10, 25, 50, 100, 500, "All"]],
    //     "pageLength": 25,
    //     "paging": true,
    //     "autoWidth": false,
    //     "fixedHeader": true,
    //     "colReorder": true,
    //     "scrollCollapse": false,
    //     "buttons": ['colvis', 'copyHtml5', 'csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
    //     "ordering": true,
    //     "order":  [],
    //     "info": true,
    //     "procesing": true,
    //     "select": true,
    //     "searching": true,
    //     "stateSave": true,
    //     "columnDefs":  ""
    // });
});