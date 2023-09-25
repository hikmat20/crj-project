<table class="table table-sm table-borderd" id="list-item">
    <thead>
        <tr class="table-secondary">
            <th class="text-center desktop tablet mobile align-middle" width="30">No</th>
            <th class="desktop tablet mobile tx-dark tx-bold align-middle">Indonesia Code</th>
            <!-- <th class="desktop tablet mobile align-middle">Origin Code</th> -->
            <!-- <th class="desktop tablet align-middle">Origin</th> -->
            <!-- <th class="desktop tablet">Product Name</th> -->
            <th class="desktop tablet align-middle" width="20%">Description</th>
            <th class="desktop align-middle">Type</th>
            <!-- <th class="desktop text-center align-middle" width="60">Status</th> -->
            <!-- <th class="desktop text-center align-middle" width="100">Last Update</th> -->
            <th width="110" class="desktop text-center no-sort align-middle">Opsi</th>
        </tr>
    </thead>
    <tbody class="tx-dark"></tbody>
</table>

<script>
    $(document).ready(function() {
        $('#list-item').DataTable({
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "bAutoWidth": true,
            "destroy": true,
            "responsive": true,
            "language": {
                "sSearch": "",
                'searchPlaceholder': 'Search...',
                'processing': `<div class="sk-wave">
                  <div class="sk-rect sk-rect1 bg-gray-800"></div>
                  <div class="sk-rect sk-rect2 bg-gray-800"></div>
                  <div class="sk-rect sk-rect3 bg-gray-800"></div>
                  <div class="sk-rect sk-rect4 bg-gray-800"></div>
                  <div class="sk-rect sk-rect5 bg-gray-800"></div>
                </div>`,
                "sLengthMenu": "Display _MENU_",
                "sInfo": "Display <b>_START_</b> to <b>_END_</b> from <b>_TOTAL_</b> data",
                "sInfoFiltered": "(filtered from _MAX_ total entries)",
                "oPaginate": {
                    "sPrevious": "<i class='fa fa-arrow-left' aria-hidden='true'></i>",
                    "sNext": "<i class='fa fa-arrow-right' aria-hidden='true'></i>"
                }
            },
            "responsive": {
                "breakpoints": [{
                        "name": 'desktop',
                        "width": Infinity
                    },
                    {
                        "name": 'tablet',
                        "width": 1148
                    },
                    {
                        "name": 'mobile',
                        "width": 680
                    },
                    {
                        "name": 'mobile-p',
                        "width": 320
                    }
                ],
            },
            "aaSorting": [
                [1, "asc"]
            ],
            "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }, {
                    "targets": 'tx-bold tx-dark tx-center',
                    "className": 'tx-bold tx-dark text-center',
                }, {
                    "targets": 'tx-dark tx-center',
                    "className": 'tx-dark text-center',
                }, {
                    "targets": 'text-center',
                    "className": 'tx-center',
                }, {
                    "targets": 'tx-bold tx-dark',
                    "className": 'tx-bold tx-dark',
                }, {
                    "targets": 'text-right',
                    "className": 'text-right',
                },

            ],
            "sPaginationType": "simple_numbers",
            "iDisplayLength": 10,
            "aLengthMenu": [5, 10, 20, 50, 100, 150],
            "ajax": {
                url: siteurl + thisController + 'getDataItem',
                type: "post",
                data: function(d) {
                    d.status = '1'
                },
                cache: false,
                error: function() {
                    $(".my-grid-error").html("");
                    $("#my-grid").append(
                        '<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>'
                    );
                    $("#my-grid_processing").css("display", "none");
                },

            }
        });

        $('.dataTables_length select').select2({
            minimumResultsForSearch: -1,
            dropdownParent: $('#modalSelect .modal-body')
        })
    })
</script>