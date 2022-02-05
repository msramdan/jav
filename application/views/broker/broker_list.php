<div id="content" class="app-content">
	<h1 class="page-header">DATA BROKER</h1>
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
										<?php echo anchor(site_url('broker/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm tambah_data"'); ?>
									</div>
								</div>
							</div>
							<div class="box-body" style="overflow-x: scroll; ">
								<table id="data-table-default" class="table table-bordered table-hover table-td-valign-middle text-white">
									<thead>
									<tr class="table-secondary">
											<th style="width: 5%;">No</th>
											<th>Broker Code</th>
											<th>Broker Name</th>
											<th>Address</th>
											<th>Name On Tax</th>
											<th>Address On Tax</th>
											<th>Npwp</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody><?php $no = 1;
											foreach ($broker_data as $broker) {
											?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?php echo $broker->broker_code ?></td>
												<td><?php echo $broker->broker_name ?></td>
												<td><?php echo $broker->address ?></td>
												<td><?php echo $broker->name_on_tax ?></td>
												<td><?php echo $broker->address_on_tax ?></td>
												<td><?php echo $broker->npwp ?></td>
												<td style="text-align:center" width="200px">
													<?php

													echo anchor(site_url('broker/update/' . encrypt_url($broker->broker_id)), '<i class="fas fa-pencil-alt" aria-hidden="true"></i>', 'class="btn btn-primary btn-sm update_data"');
													echo '  ';
													echo anchor(site_url('broker/delete/' . encrypt_url($broker->broker_id)), '<i class="fas fa-trash-alt" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm delete_data" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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
