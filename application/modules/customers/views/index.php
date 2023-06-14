<?php
$ENABLE_ADD     = has_permission('Customers.Add');
$ENABLE_MANAGE  = has_permission('Customers.Manage');
$ENABLE_VIEW    = has_permission('Customers.View');
$ENABLE_DELETE  = has_permission('Customers.Delete');
?>

<div class="br-pagetitle">
	<i class="tx-primary fa-4x <?= $template['page_icon']; ?>"></i>
	<div>
		<h4><?= $template['title']; ?></h4>
		<p class="mg-b-0">Lorem ipsum dolor sit amet.</p>
	</div>
</div><!-- d-flex -->
<div class="d-flex align-items-center justify-content-between pd-x-20 pd-sm-x-30 pd-t-25 mg-b-20 mg-sm-b-30">
	<?php echo Template::message(); ?>
	<div class="btn-group hidden-sm-down">
		<?php if ($ENABLE_VIEW) : ?>
			<a class="btn btn-primary btn-oblong add" href="javascript:void(0)" data-toggle="tooltip" data-placement="top" title="Add"><i class="fa fa-plus">&nbsp;</i>Add New Customer</a>
		<?php endif; ?>
	</div><!-- btn-group -->
</div>

<div class="br-pagebody pd-x-20 pd-sm-x-30 mg-y-3">
	<div class="card bd-gray-400">
		<div class="table-wrapper">
			<table id="dataTable" class="table table-bordered table-striped" width="100%">
				<thead>
					<tr>
						<th width="10">#</th>
						<th class="desktop tablet mobile" width="20%">Customer Name</th>
						<th class="desktop tablet mobile">Telephone</th>
						<th class="desktop tablet">Email</th>
						<th class="desktop">Address</th>
						<th class="text-center desktop">Status</th>
						<th width="100" class="text-center desktop">Action</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<th width="10">#</th>
						<th>Customer Name</th>
						<th>Telephone</th>
						<th>Email</th>
						<th>Address</th>
						<th class="text-center">Status</th>
						<th width="100" class="text-center">Action</th>
					</tr>
				</tfoot>
			</table>

		</div>
	</div>
</div>

<div class="modal fade effect-scale" id="dialog-popup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><span class="fa fa-users"></span></h4>
				<button type="button" class="btn btn-default close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body"></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger wd-100" data-dismiss="modal">
					<span class="fa fa-times"></span> Close</button>
			</div>
		</div>
	</div>
</div>


<!-- page script -->
<script type="text/javascript">
	$(document).ready(function() {
		loadData()
	})

	$(document).on('click', '.add', function() {
		$("#dialog-popup .modal-body").load(siteurl + thisController + 'addCustomer');
		$("#dialog-popup .modal-title").html('<i class="<?= $template['page_icon']; ?>" aria-hidden="true"></i> Add New Customer');
		$("#dialog-popup .modal-dialog").css({
			'max-width': '90%'
		});
		$("#dialog-popup").modal();
	});

	function loadData() {
		var oTable = $('#dataTable').DataTable({
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
				"sZeroRecords": "<i>Data tidak tersedia</i>",
				"sEmptyTable": "<i>Data tidak ditemukan</i>",
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
					"targets": 'text-center',
					"className": 'text-center',
				}

			],
			"sPaginationType": "simple_numbers",
			"iDisplayLength": 10,
			"aLengthMenu": [5, 10, 20, 50, 100, 150],
			"ajax": {
				url: siteurl + thisController + 'getData',
				type: "post",
				data: function(d) {
					d.status = 'aktif'
				},
				cache: false,
				error: function() {
					$(".my-grid-error").html("");
					$("#my-grid").append(
						'<tbody class="my-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>'
					);
					$("#my-grid_processing").css("display", "none");
				}
			}
		});

	}
</script>