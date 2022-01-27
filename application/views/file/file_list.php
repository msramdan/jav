<div id="content" class="app-content">
	<h1 class="page-header">DATA FILE</h1>
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
										<?php echo anchor(site_url('file/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm tambah_data"'); ?>
									</div>
								</div>
							</div>
							<div class="box-body">
								<table id="data-table-default" class="table table-bordered table-hover table-td-valign-middle text-white">
									<thead>
										<tr>
											<th style="width: 5%;">No</th>
											<th data-orderable="false">Penginput</th>
											<th>Ref No</th>
											<th>Date Of Receive</th>
											<th>Adjuster</th>
											<th>Trade</th>
											<th>Type Of Loss</th>
											<th>Detail Dol</th>
											<th>Date Of Loss</th>
											<th>Date Of Survey</th>
											<th>Policy Number</th>
											<th>Situation Of Loss</th>
											<th>Insurer Ref No</th>
											<th>Insured</th>
											<th>Broker</th>
											<th>Remark</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody><?php $no = 1;
											foreach ($file_data as $file) {
											?>
											<tr>
												<td><?= $no++ ?></td>
												<td><img src="<?= base_url() ?>assets/assets/img/user/<?php echo $file->photo ?>" class="rounded h-25px my-n1 mx-n1" />  &nbsp; <?php echo ucfirst($file->nama_user) ?>  </td>
												<td><?php echo $file->ref_no ?></td>
												<td><?php echo $file->date_of_receive ?></td>
												<td><?php echo $file->adjuster_name ?></td>
												<td><?php echo $file->trade_name ?></td>
												<td><?php echo $file->tol_name ?></td>
												<td><?php echo $file->detail_dol ?></td>
												<td><?php echo $file->date_of_loss ?></td>
												<td><?php echo $file->date_of_survey ?></td>
												<td><?php echo $file->policy_number ?></td>
												<td><?php echo $file->situation_of_loss ?></td>
												<td><?php echo $file->insurer_ref_no ?></td>
												<td><?php echo $file->insured ?></td>
												<td><?php echo $file->broker_name ?></td>
												<td><?php echo $file->remark_id ?></td>
												<td style="text-align:center" width="200px">
													<?php
													echo anchor(site_url('file/read/' . encrypt_url($file->file_id)), '<i class="fas fa-eye" aria-hidden="true"></i>', 'class="btn btn-success btn-sm read_data"');
													echo '  ';
													echo anchor(site_url('file/update/' . encrypt_url($file->file_id)), '<i class="fas fa-pencil-alt" aria-hidden="true"></i>', 'class="btn btn-primary btn-sm update_data"');
													echo '  ';
													echo anchor(site_url('file/delete/' . encrypt_url($file->file_id)), '<i class="fas fa-trash-alt" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm delete_data" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
