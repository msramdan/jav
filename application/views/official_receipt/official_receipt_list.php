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
										<tr class="table-secondary">
											<th>No</th>
											<th>OR No</th>
											<th>Ref No</th>
											<th>OR Date</th>
											<th>Insurer</th>
											<th>Currency</th>
											<th>Grand Total</th>
											<th>Status Payment</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody><?php $no = 1;
											foreach ($official_receipt_data as $official_receipt) {
											?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?php echo $official_receipt->or_no ?></td>
												<td><?php echo $official_receipt->ref_no ?></td>
												<td><?php echo $official_receipt->or_date ?></td>
												<td><?php echo $official_receipt->insurer_name ?></td>
												<td><?php echo $official_receipt->currency_code ?></td>
												<?php if ($official_receipt->vat == 'Before Expense') { ?>
													<td><?= rupiah((($official_receipt->total_fee + $official_receipt->expense) + ($official_receipt->total_fee) * 10 / 100) - $official_receipt->discount ) ?></td>
												<?php } else if ($official_receipt->vat == 'After Expense') { ?>
													<td><?= rupiah((($official_receipt->total_fee + $official_receipt->expense) + ($official_receipt->total_fee + $official_receipt->expense) * 10 / 100) - $official_receipt->discount ) ?></td>
												<?php } ?>
												<td><?php if ($official_receipt->status == 'Paid') { ?>
														<div class="d-grid gap-2">
															<button class="btn btn-success btn-sm" type="button"><i class="fa fa-check"></i> Paid </button>
														</div>
													<?php } else { ?>
														<div class="d-grid gap-2">
															<button class="btn btn-warning btn-sm" type="button"><i class="fa fa-times"></i> Unpaid</button>
														</div>
													<?php } ?>

												</td>
												<td style="text-align:center">
													<?php
													echo anchor(site_url('official_receipt/print_or/' . encrypt_url($official_receipt->or_id)), '<i class="fas fa-print" aria-hidden="true"></i> 1', 'class="btn btn-white btn-sm" target="_blank"');
													echo '  ';
													echo anchor(site_url('official_receipt/print_breakdown/' . encrypt_url($official_receipt->or_id)), '<i class="fas fa-print" aria-hidden="true"></i> 2', 'class="btn btn-white btn-sm " target="_blank"');
													echo '  ';
													echo anchor(site_url('official_receipt/print_invoice/' . encrypt_url($official_receipt->or_id)), '<i class="fas fa-print" aria-hidden="true"></i> 3', 'class="btn btn-white btn-sm " target="_blank"');
													echo '  ';
													echo anchor(site_url('official_receipt/update/' . encrypt_url($official_receipt->or_id)), '<i class="fas fa-pencil-alt" aria-hidden="true"></i>', 'class="btn btn-primary btn-sm update_data"');
													echo '  ';
													?>

													<?php if ($official_receipt->status == 'Unpaid') { ?>
														<a href="<?= base_url('official_receipt/delete/' . encrypt_url($official_receipt->or_id)) ?>" class="btn btn-danger btn-sm delete_data" delete=""><i class="fas fa-trash-alt" aria-hidden="true"></i></a>
													<?php } else { ?>
														<button href="" class="btn btn-danger btn-sm delete_data" delete="" disabled><i class="fas fa-trash-alt" aria-hidden="true"></i></button>
													<?php } ?>

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
