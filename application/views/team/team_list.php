<!-- #modal-dialog -->
<div class="modal fade" id="modal-dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
			</div>
			<div class="modal-body">
				<img src="" id="photo_team" width="100%" />
			</div>
			<div class="modal-footer">
				<a href="javascript:;" class="btn btn-white" data-bs-dismiss="modal">Close</a>
				<a class="btn btn-primary" id="download" href=""><i class="ace-icon fa fa-download"></i> Download</a>
			</div>
		</div>
	</div>
</div>

<div id="content" class="app-content">
	<h1 class="page-header">DATA TEAM</h1>
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
										<?php echo anchor(site_url('team/create'), '<i class="fas fa-plus-square" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm tambah_data"'); ?>
									</div>
								</div>
							</div>
							<div class="box-body" style="overflow-x: scroll; ">
								<table id="data-table-default" class="table table-bordered table-hover table-td-valign-middle text-white">
									<thead>
										<tr>
											<th>No</th>
											<th>Name</th>
											<th>Biografi</th>
											<th>Position</th>
											<th>Photo</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody><?php $no = 1;
											foreach ($team_data as $team) {
											?>
											<tr>
												<td><?= $no++ ?></td>
												<td><?php echo $team->name ?></td>
												<td><?php echo $team->biografi ?></td>
												<td><?php echo $team->position ?></td>
												<td class="with-img">
													<a id="view_gambar" href="#modal-dialog" data-bs-toggle="modal" data-photo="<?php echo $team->photo ?>">
														<img src="<?= base_url() ?>assets/web/img/team/<?php echo $team->photo ?>" class="rounded h-30px my-n1 mx-n1" />
												</td>
												<td style="text-align:center" width="200px">
													<?php
													echo anchor(site_url('team/update/' . encrypt_url($team->team_id)), '<i class="fas fa-pencil-alt" aria-hidden="true"></i>', 'class="btn btn-primary btn-sm update_data"');
													echo '  ';
													echo anchor(site_url('team/delete/' . encrypt_url($team->team_id)), '<i class="fas fa-trash-alt" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm delete_data" Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
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

	<script type="text/javascript">
		$(document).on('click', '#view_gambar', function() {
			var nama_user = $(this).data('nama_user');
			var photo = $(this).data('photo');
			$('#modal-dialog #photo_team').attr("src", "assets/web/img/team/" + photo);
			$('#modal-dialog #download').attr("href", "team/download/" + photo);
		})
	</script>

