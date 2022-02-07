<div id="content" class="app-content">
	<div class="col-md-6 ui-sortable">
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

			<div class="panel-heading ui-sortable-handle">
				<h4 class="panel-title">KELOLA DATA PORTFOLIO</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="panel-body">

				<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
					<thead>
						<table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle">
							<tr>
								<td>Title <?php echo form_error('title') ?></td>
								<td><input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" /></td>
							</tr>
							<tr>
								<td>Service <?php echo form_error('service_id') ?></td>
								<td><select name="service_id" class="form-control theSelect" style="width: 100%;">
										<option value="">-- Pilih -- </option>
										<?php foreach ($service as $key => $data) { ?>
											<?php if ($service_id == $data->service_id) { ?>
												<option value="<?php echo $data->service_id ?>" selected><?php echo $data->service_name ?></option>
											<?php } else { ?>
												<option value="<?php echo $data->service_id ?>"><?php echo $data->service_name ?></option>
											<?php } ?>
										<?php } ?>
									</select></td>
							</tr>
							<tr>
								<td>Description <?php echo form_error('description') ?></td>
								<td> <textarea class="form-control" rows="3" name="description" id="description" placeholder="Description"><?php echo $description; ?></textarea></td>
							</tr>
							<?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'create_action') { ?>
								<tr>
									<td>photo <?php echo form_error('photo') ?></td>
									<td><input type="file" class="form-control" name="photo" id="photo" placeholder="photo" required="" value="" onchange="return validasiEkstensi()" />
									</td>
								</tr>
							<?php } else { ?>
								<div class="form-group">
									<tr>
										<td>Photo <?php echo form_error('photo') ?></td>
										<td>
											<a href="#modal-dialog" data-bs-toggle="modal"><img src="<?php echo base_url(); ?>assets/web/img/portfolio/<?= $photo ?>" style="width: 150px;height: 150px;border-radius: 5%;"></img></a>
											<input type="hidden" name="photo_lama" value="<?= $photo ?>">
											<p style="color:white">Note :Pilih photo Jika Ingin Merubah photo</p>
											<input type="file" class="form-control" name="photo" id="photo" placeholder="photo" value="" onchange="return validasiEkstensi()" />
											<!-- <div id="preview"></div> -->
										</td>
									</tr>
								</div>
							<?php } ?>
							<tr>
								<td></td>
								<td><input type="hidden" name="portfolio_id" value="<?php echo $portfolio_id; ?>" />
									<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
									<a href="<?php echo site_url('portfolio') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Back</a>
								</td>
							</tr>
					</thead>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$(".theSelect").select2();
	});
</script>

<script type="text/javascript">
	function validasiEkstensi() {
		var inputFile = document.getElementById('photo');
		var pathFile = inputFile.value;
		var ekstensiOk = /(\.jpg|\.jpeg|\.png)$/i;
		if (!ekstensiOk.exec(pathFile)) {
			alert('Silakan upload file yang memiliki ekstensi .jpeg/.jpg/.png');
			inputFile.value = '';
			return false;
		} else {
			// Preview photo
			if (inputFile.files && inputFile.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					document.getElementById('preview').innerHTML = '<iframe src="' + e.target.result + '" style="height:400px; width:600px"/>';
				};
				reader.readAsDataURL(inputFile.files[0]);
			}
		}
	}
</script>
