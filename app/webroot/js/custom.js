$(document).ready(function() {
    if ($('table.dataTables').length) {
        var table = $('table.dataTables').DataTable({});

        $('.dataTables tbody')
            .on( 'mouseenter', 'td:not(.child)', function () {
                if (!$(this).hasClass('dataTables_empty')) {
                    var colIdx = table.cell(this).index().column;
                    $( table.cells().nodes() ).removeClass( 'highlight' );
                    $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
                }
            }
        );

    }
});
