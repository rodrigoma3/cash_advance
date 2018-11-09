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

    $(document).on('change', '#ProaStartDateDay, #ProaStartDateMonth, #ProaStartDateYear', function() {
        var day = $('#ProaStartDateDay').prop('value');
        var month = $('#ProaStartDateMonth').prop('value');
        var year = $('#ProaStartDateYear').prop('value');
        // var date = year + "-" + month + "-" + day + "T00:00:00";
        var dateStart = new Date(year + "-" + month + "-" + day + "T00:00:00");
        var dateEnd = new Date(year + "-" + month + "-" + day + "T00:00:00");
        dateEnd.setDate(dateStart.getDate() + 29);
        var datePct = new Date(year + "-" + month + "-" + day + "T00:00:00");
        datePct.setDate(dateStart.getDate() + 58);
        // console.log("date: " + date);
        console.log("dateStart: " + dateStart);
        console.log("dateEnd: " + dateEnd);
        console.log("datePct: " + datePct);
        // console.log(dateEnd.getDate()); //dia
        // console.log(dateEnd.getMonth() + 1); //mes
        // console.log(dateEnd.getFullYear()); //ano

        $('#ProaEndDateDay').prop('value', zeroLeftDate(dateEnd.getDate())).change();
        $('#ProaEndDateMonth').prop('value', zeroLeftDate(dateEnd.getMonth() + 1)).change();
        $('#ProaEndDateYear').prop('value', dateEnd.getFullYear()).change();

        $('#ProaPctDateDay').prop('value', zeroLeftDate(datePct.getDate())).change();
        $('#ProaPctDateMonth').prop('value', zeroLeftDate(datePct.getMonth() + 1)).change();
        $('#ProaPctDateYear').prop('value', datePct.getFullYear()).change();
    });

    function zeroLeftDate(d) {
        if (d < 10) {
            return "0" + d;
        }
        return d;
    }
});
