<div id="content" class="app-content">
	<h1 class="page-header">DATA OFFICIAL_RECEIPT</h1>
	<div class="panel panel-inverse">
		<div class="panel-heading">
			<h4 class="panel-title"></h4>
			<div class="panel-heading-btn">
				<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
				<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
			</div>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						<div class="box-body">
							<div class='row'>
								<div class='col-md-9'>
									<div style="padding-bottom: 10px;">
										<?php echo anchor(site_url('official_receipt/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm tambah_data"'); ?>
									</div>
								</div>
							</div>
							<div class="box-body" style="overflow-x: scroll; ">
								<table id="data-table-default" class="table table-bordered table-hover table-td-valign-middle text-white">
									<thead>
										<tr>
											<th>No</th>
											<th>OR No</th>
											<th>Ref No</th>
											<th>OR Date</th>
											<th>Insurer</th>
											<th>Currency</th>
											<th>Total Fee</th>
											<th>Expense</th>
											<th>Description</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody><?php $no = 1;
											foreach ($official_receipt_data as $official_receipt) {
											?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?php echo $official_receipt->or_no ?></td>
												<td><?php echo $official_receipt->file_id ?></td>
												<td><?php echo $official_receipt->or_date ?></td>
												<td><?php echo $official_receipt->insurer_id ?></td>
												<td><?php echo $official_receipt->currency_id ?></td>
												<td><?php echo $official_receipt->total_fee ?></td>
												<td><?php echo $official_receipt->expense ?></td>
												<td><?php echo $official_receipt->description ?></td>
												<td style="text-align:center" width="200px">
													<?php
													echo anchor(site_url('official_receipt/read/' . encrypt_url($official_receipt->or_id)), '<i class="fas fa-eye" aria-hidden="true"></i>', 'class="btn btn-success btn-sm read_data"');
													echo '  ';
													echo anchor(site_url('official_receipt/update/' . encrypt_url($official_receipt->or_id)), '<i class="fas fa-pencil-alt" aria-hidden="true"></i>', 'class="btn btn-primary btn-sm update_data"');
													echo '  ';
													echo anchor(site_url('official_receipt/delete/' . encrypt_url($official_receipt->or_id)), '<i class="fas fa-trash-alt" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm delete_data" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
													?>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	if (is_allowed_button($this->uri->segment(1), 'read') < 1) { ?>
		<script>
			$('.read_data').css('display', 'none')
		</script>
	<?php } ?>

	<?php
	if (is_allowed_button($this->uri->segment(1), 'create') < 1) { ?>
		<script>
			$('.tambah_data').css('display', 'none')
		</script>
	<?php } ?>

	<?php
	if (is_allowed_button($this->uri->segment(1), 'update') < 1) { ?>
		<script>
			$('.update_data').css('display', 'none')
		</script>
	<?php } ?>

	<?php
	if (is_allowed_button($this->uri->segment(1), 'delete') < 1) { ?>
		<script>
			$('.delete_data').css('display', 'none')
		</script>
	<?php } ?>
