<div id="content" class="app-content">


	<div class="row">

		<div class="col-xl-3 ui-sortable">

			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading ui-sortable-handle">
					<h4 class="panel-title">FILTER</h4>
				</div>
				<div class="panel-body">
					<form action="<?= base_url() ?>file" method="GET">
						<div class="form-group" style="margin-bottom: 5px;">
							<label for="exampleInputEmail1">Start Date</label>
							<input type="date" <?php if (isset($_GET['start_date'])) { ?> value="<?= $_GET['start_date'] ?>" <?php } ?> name="start_date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
						</div>
						<div class="form-group">
							<label for="exampleInputPassword1">End Date</label>
							<input type="date" <?php if (isset($_GET['end_date'])) { ?> value="<?= $_GET['end_date'] ?>" <?php } ?> name="end_date" class="form-control" id="exampleInputPassword1" placeholder="Password">
						</div>
						<hr>
						<div class="form-group">
							<label for="exampleInputPassword1">Status Case</label>
							<select name="status" class="form-control theSelect">
								<option value="">-- Pilih --</option>
								<?php if (isset($_GET['status'])) { ?>
									<option value="Receiving" <?php echo $_GET['status'] == 'Receiving' ? 'selected' : 'null' ?>>Receiving</option>
									<option value="Outstanding" <?php echo $_GET['status'] == 'Outstanding' ? 'selected' : 'null' ?>>Outstanding</option>
								<?php } else { ?>
									<option value="Receiving">Receiving</option>
									<option value="Outstanding">Outstanding</option>
								<?php } ?>
							</select>
						</div>
						<hr>
						<div class="form-group">
							<label for="exampleInputPassword1">Insurer</label>
							<select name="insurer_id" class="form-control theSelect">
								<option style="color: black;" value="">-- Pilih -- </option>
								<?php if (isset($_GET['insurer_id'])) { ?>
									<?php foreach ($insurer as $d) : ?>
										<option value="<?php echo $d->insurer_id ?>" <?php if ($_GET['insurer_id'] == $d->insurer_id) { ?> selected <?php } ?>><?php echo $d->insurer_code ?> - <?php echo $d->insurer_name ?>
										</option>
									<?php endforeach ?>
								<?php } else { ?>
									<?php foreach ($insurer as $key => $rows) { ?>
										<option style="color: black;" value="<?php echo $rows->insurer_id ?>"><?php echo $rows->insurer_code ?> - <?php echo $rows->insurer_name ?></option>
									<?php } ?>
								<?php } ?>
							</select>
						</div>
						<hr>
						<button type="submit" class="btn btn-primary">Filter</button>
						<?php if (isset($_GET['start_date'])) { ?>
							<a href="<?= base_url('file') ?>" class="btn btn-warning"> Reset</a>
						<?php } ?>
					</form>
				</div>
			</div>


		</div>


		<div class="col-xl-9 ui-sortable">

			<div class="panel panel-inverse" data-sortable-id="index-6">
				<div class="panel-heading ui-sortable-handle">
					<h4 class="panel-title">DATA FILE</h4>
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
												<tr class="table-secondary">
													<th style="width: 5%;">No</th>
													<th data-orderable="false">Penginput</th>
													<th>Ref No</th>
													<th>Date of Receive</th>
													<th>Adjuster</th>
													<th>Trade</th>
													<th>Type of Loss</th>
													<th>Detail Dol</th>
													<th>Date of Loss</th>
													<th>Date of Survey</th>
													<th>Policy Number</th>
													<th>Situation of Loss</th>
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
														<td><img src="<?= base_url() ?>assets/assets/img/user/<?php echo $file->photo ?>" class="rounded h-25px my-n1 mx-n1" /> &nbsp; <?php echo ucfirst($file->nama_user) ?> </td>
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
														<td><?php echo remark_name($file->remark_id) ?></td>
														<td style="text-align:center" width="200px">
															<?php
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

	<script type="text/javascript">
		$(document).ready(function() {
			$(".theSelect").select2();
		});
	</script>
