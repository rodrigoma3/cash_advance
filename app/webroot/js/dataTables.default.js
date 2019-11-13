if (typeof proaFooterCallback === 'undefined') {
    var proaFooterCallback = [];
} else {
    proaFooterCallback = function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
            return typeof i === 'string' ?
                i.replace(/[R\$.&nbsp; ]/g, '').replace(/[,]/g, '.')*1 :
                typeof i === 'number' ?
                    i : 0;
        };

        var currencyFormat = function ( i ) {
            var m = (i + '').replace(/[.]/g, ',').replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            return (m.indexOf(',') == -1) ? m+',00' : m;
        };

        total = api
            .column( 5, {search: 'applied'} )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        totalUsado = api
            .column( 6, {search: 'applied'} )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        totalRestante = api
            .column( 7, {search: 'applied'} )
            .data()
            .reduce( function (a, b) {
                return intVal(a) + intVal(b);
            }, 0 );

        // Update footer
        // $( api.column( 4 ).footer() ).html(
        $('.totais').html(
            '<strong>' + $(api.column(5).header()).html() + ':</strong> R$ '+ currencyFormat(total.toFixed(2)) +' <strong>Total ' + $(api.column(6).header()).html() + ':</strong> R$ '+ currencyFormat(totalUsado.toFixed(2)) +' <strong>Total ' + $(api.column(7).header()).html() + ':</strong> R$ ' + currencyFormat(totalRestante.toFixed(2))
        );
    };
}
if (typeof visibilityFalse === 'undefined') {
    var visibilityFalse = [];
}
if (typeof colReorder === 'undefined' || colReorder) {
    var colReorder = true;
    var resetColReorder = {
        text: function ( dt, button, config ) {
            return dt.i18n( 'oLocale.resetColReorder', 'Reset column order' );
        },
        action: function ( e, dt, node, config ) {
            dt.colReorder.reset();
        }
    };
} else {
    var colReorder = false;
    var resetColReorder = [];
}
if (typeof tableResponsive === 'undefined' || tableResponsive) {
    var tableResponsive = {
        details: {
            type: 'column',
            target: 'td.control'
        }
    };
    var columnResponsive = {
        className: 'control',
        orderable: false,
        targets: 0
    };
} else {
    var tableResponsive = false;
    var columnResponsive = {};
}
var targetColumnSelect = 0;
if (typeof selectActive === 'undefined') {
    var columnSelect = {};
    var selectActive = {};
} else {
    if (typeof selectStyle === 'undefined') {
        var selectStyle = 'single'; // 'os', 'single', 'multi'
    }
    if (tableResponsive) {
        targetColumnSelect = 1;
    }
    var columnSelect = {
        className: 'select-checkbox',
        targets: targetColumnSelect,
        orderable: false,
    };
    var selectActive = {
        style:    selectStyle,
        selector: 'td.select-checkbox'
    };
}
var targetResponviePriority = 0
if (tableResponsive) {
    targetResponviePriority += 1;
}
if (selectActive) {
    targetResponviePriority += 1;
}
var columnResponsivePriorityOne = { responsivePriority: 1, targets: targetResponviePriority };
if (typeof columnActions === 'undefined') {
    var columnActions = {
        responsivePriority: 2,
        targets: -1,
        orderable: false,
        className: 'actions',
    };
} else {
    var columnActions = {};
}
if (typeof columnOrder === 'undefined') {
    var columnOrder = [ (targetColumnSelect+1), 'asc' ];
}
if (typeof columnOrder === 'undefined') {
    var columnOrder = [ (targetColumnSelect+1), 'asc' ];
}
if (typeof scrollActive === 'undefined') {
    var scrollActive = '';
}
if (typeof exportTable === 'undefined' || !exportTable) {
    var exportTable = [];
} else {
    var exportTable = {
        extend: 'collection',
        text: function ( dt, button, config ) {
            return dt.i18n( 'oLocale.export', 'Export' );
        },
        autoClose: true,
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: ':visible'+':not(.actions)'+':not(.control)'+':not(.select-checkbox)',
                    // rows: ':visible'
                },
                key: {
                    altKey: true,
                    key: 'c'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':not(.actions)'+':not(.control)'+':not(.select-checkbox)',
                },
                key: {
                    altKey: true,
                    key: 's'
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':not(.actions)'+':not(.control)'+':not(.select-checkbox)',
                },
                key: {
                    altKey: true,
                    key: 'b'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'+':not(.actions)'+':not(.control)'+':not(.select-checkbox)',
                    // rows: ':visible'
                },
                key: {
                    altKey: true,
                    key: 'r'
                },
				orientation: 'landscape',
				pageSize: 'A4',
                messageTop: function() {
                    return $('.totais').html().replace(/(<([^>]+)>)/g, '');
                },
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'+':not(.actions)'+':not(.control)'+':not(.select-checkbox)',
                    // rows: ':visible'
                },
                key: {
                    altKey: true,
                    key: 'p'
                },
                messageTop: function() {
                    return $('.totais').html();
                },
				customize: function(win) {

					var last = null;
					var current = null;
					var bod = [];

					var css = '@page { size: landscape; }'
						head = win.document.head || win.document.getElementsByTagName('head')[0],
						style = win.document.createElement('style');

					style.type = 'text/css';
					style.media = 'print';

					if (style.styleSheet) {
					  style.styleSheet.cssText = css;
					} else {
					  style.appendChild(win.document.createTextNode(css));
					}

					head.appendChild(style);
				}
            }
        ]
    };
}

function arraysEqual(a, b) {
  a = Array.isArray(a) ? a : [];
  b = Array.isArray(b) ? b : [];
  return a.length === b.length && a.every((el, ix) => el === b[ix]);
}

function arraysContainSame(a, b) {
  a = Array.isArray(a) ? a : [];
  b = Array.isArray(b) ? b : [];
  return a.length === b.length && a.every(el => b.includes(el));
}


$(document).ready(function() {
    var rowsData;

    $.extend( true, $.fn.dataTable.defaults, {
        "language": {
            "url": locale
        },
        "scrollY": scrollActive,
        "lengthMenu": [[10, 25, 50, -1], ["10", "25", "50", function ( dt, button, config ) { return dt.i18n( 'oLocale.all', 'All' ); }]],
        initComplete: function () {
            // var qtdColumns = this.api().columns().count();
            var thisapi = this.api();

            thisapi.columns().every( function () {
                var column = this;
                if (!$(column.header()).hasClass('select-checkbox') && !$(column.header()).hasClass('control') && !$(column.header()).hasClass('actions')) {
                // if (column.index() !== 0 && column.index() !== (qtdColumns-1)) {
                    var title = $(column.header()).html();
                    $.getJSON(locale, function(data) {
                        var search = data.sSearchPlaceholder;
                        var input = $('<input type="text" placeholder="'+search+' '+title+'" />')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'keyup change', function () {
                            // var val = $.fn.dataTable.util.escapeRegex(
                            //     $(this).val()
                            // );
                            var val = $(this).val();
                            if ( column.search() !== val ) {
                                if (val == " ") {
                                    column
                                    .search( '^\\s\\s*$', true, false )
                                    .draw();
                                } else {
                                    column
                                    .search( val )
                                    .draw();
                                }
                            }
                        } );
                    });
                }
            } );
            if (selectStyle !== 'single') {
                $('th.select-checkbox').on('click', function() {
                    if ($(this).closest('tr').hasClass('selected')) {
                        thisapi.rows({search:'applied'}).deselect();
                        $(this).closest('table').find('tr').each(function() {
                            $(this).removeClass('selected');
                        });
                    } else {
                        thisapi.rows({search:'applied'}).select();
                        $(this).closest('table').find('tr').each(function() {
                            $(this).addClass('selected');
                        });
                    }
                });
                $('td.select-checkbox').on('click', function() {
                    var countSelected = thisapi.rows( { selected: true } ).count();
                    var countTotal = thisapi.rows().count();
                    if (!$(this).closest('tr').hasClass('selected')) {
                        countTotal -= 1;
                    } else {
                        countTotal += 1;
                    }
                    if (countSelected === countTotal) {
                        $(this).closest('table').find('thead tr, tfoot tr').each(function() {
                            $(this).addClass('selected');
                        });
                    } else {
                        $(this).closest('table').find('thead tr, tfoot tr').each(function() {
                            $(this).removeClass('selected');
                        });
                    }
                });
            }
        },
        // colReorder: colReorder,
        dom: 'Bfrtip',
        responsive: tableResponsive,
        columnDefs: [
            columnResponsive,
            columnResponsivePriorityOne,
            columnActions,
            // columnSelect,
            // {
            //     targets: visibilityFalse,
            //     visible: false
            // }
        ],
        footerCallback: proaFooterCallback,
        // select: selectActive,
        order: columnOrder,
        buttons: [
            'pageLength',
            // {
            //     extend: 'colvis',
            //     // columns: ':not(.actions)'+':not(.control)'+':not(.select-checkbox)',
            //     // columns: ':not(:first-child)+:not(:last-child)',
            //     columns: function ( idx, data, node ) {
            //         return (node.firstChild !== null
            //                 && node.firstChild.nodeValue !== ''
            //                 && node.firstChild.nodeValue !== 'Actions'
            //                 && node.firstChild.nodeValue !== 'Ações'
            //                 && node.firstChild.nodeValue !== 'Acciones');
            //     },
            //     postfixButtons: [
            //         'colvisRestore',
            //         {
            //             extend: 'colvisGroup',
            //             text: function ( dt, button, config ) {
            //                 return dt.i18n( 'oLocale.showAll', 'Show all' );
            //             },
            //             show: ':hidden'
            //         },
            //         {
            //             extend: 'colvisGroup',
            //             text: function ( dt, button, config ) {
            //                 return dt.i18n( 'oLocale.showNone', 'Show none' );
            //             },
            //             hide: ':visible,:hidden'
            //         }
            //     ],
            //     // collectionLayout: 'fixed three-column'
            // },
            // {
            //     extend: 'collection',
            //     text: function ( dt, button, config ) {
            //         return dt.i18n( 'oLocale.rowvis', 'Row visibility' );
            //     },
            //     autoClose: true,
            //     buttons: [
            //         {
            //             text: function ( dt, button, config ) {
            //                 return dt.i18n( 'oLocale.rowvisSelected', 'Rows selected' );
            //             },
            //             action: function ( e, dt, node, config ) {
            //                 rowsData = dt.rows().data();
            //                 // dt.rows({ selected: true }).nodes().to$().css({"display":"table-row"});
            //                 // dt.rows({ selected: false }).nodes().to$().css({"display":"none"});
            //                 dt.rows({ selected: false }).nodes().to$().css({"display":"none"});
            //                 // dt.rows({ selected: false }).remove().draw();
            //             }
            //         },
            //         {
            //             text: 'All rows',
            //             text: function ( dt, button, config ) {
            //                 return dt.i18n( 'oLocale.rowvisRestore', 'Restore visibility' );
            //             },
            //             action: function ( e, dt, node, config ) {
            //                 // dt.rows().nodes().to$().css({"display":"table-row"});
            //                 // var rowsSelectedData = dt.rows({ selected: true }).data();
            //                 // dt.clear().draw();
            //                 // $.each(rowsData, function(k,v) {
            //                 //     // dt.row.add(v).draw(false);
            //                 //     var rowNode = dt.row.add(v).draw().node();
            //                 //     $.each(rowsSelectedData, function(i,a) {
            //                 //         if (arraysEqual(v,a)) {
            //                 //             $(rowNode).addClass('selected');
            //                 //         }
            //                 //     });
            //                 // });
            //
            //
            //                 // dt.draw();
            //                 // dt.columns.adjust().draw();
            //             }
            //         }
            //     ]
            // },
            exportTable,
            // resetColReorder
        ],
    } );

});
