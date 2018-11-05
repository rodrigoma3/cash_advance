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

    if ($('#ProaRubricId').length && $('#ProaRubricId').prop('tagName') == 'SELECT') {
        $('#ProaRubricId').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaUserId').length && $('#ProaUserId').prop('tagName') == 'SELECT') {
        $('#ProaUserId').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaStartDateDay').length && $('#ProaStartDateDay').prop('tagName') == 'SELECT') {
        $('#ProaStartDateDay').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaStartDateMonth').length && $('#ProaStartDateMonth').prop('tagName') == 'SELECT') {
        $('#ProaStartDateMonth').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaStartDateYear').length && $('#ProaStartDateYear').prop('tagName') == 'SELECT') {
        $('#ProaStartDateYear').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaEndDateDay').length && $('#ProaEndDateDay').prop('tagName') == 'SELECT') {
        $('#ProaEndDateDay').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaEndDateMonth').length && $('#ProaEndDateMonth').prop('tagName') == 'SELECT') {
        $('#ProaEndDateMonth').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaEndDateYear').length && $('#ProaEndDateYear').prop('tagName') == 'SELECT') {
        $('#ProaEndDateYear').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaPctDateDay').length && $('#ProaPctDateDay').prop('tagName') == 'SELECT') {
        $('#ProaPctDateDay').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaPctDateMonth').length && $('#ProaPctDateMonth').prop('tagName') == 'SELECT') {
        $('#ProaPctDateMonth').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
    if ($('#ProaPctDateYear').length && $('#ProaPctDateYear').prop('tagName') == 'SELECT') {
        $('#ProaPctDateYear').select2({
            language: lang,
            // allowClear: true,
            // maximumSelectionLength: 1
        });
    }
});
