<div id="content" class="app-content">
	<div class="col-md-6 ui-sortable">
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

			<div class="panel-heading ui-sortable-handle">
				<h4 class="panel-title">KELOLA DATA SETTING APP</h4>
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
								<td >Nama Aplikasi <?php echo form_error('nama_aplikasi') ?></td>
								<td><input type="text" class="form-control" name="nama_aplikasi" id="nama_aplikasi" placeholder="Nama Aplikasi" value="<?php echo $nama_aplikasi; ?>" /></td>
							</tr>
							<tr>
								<td >Nama Perusahaan <?php echo form_error('nama_perusahaan') ?></td>
								<td><input type="text" class="form-control" name="nama_perusahaan" id="nama_perusahaan" placeholder="Nama Perusahaan" value="<?php echo $nama_perusahaan; ?>" /></td>
							</tr>

							<tr>
								<td >Alamat <?php echo form_error('alamat') ?></td>
								<td> <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea></td>
							</tr>
							<tr>
								<td >Website <?php echo form_error('website') ?></td>
								<td><input type="text" class="form-control" name="website" id="website" placeholder="Website" value="<?php echo $website; ?>" /></td>
							</tr>
							<?php if ($this->uri->segment(2) == 'create' || $this->uri->segment(2) == 'create_action') { ?>
								<tr>
									<td >Logo Perusahaan <?php echo form_error('photo') ?></td>
									<td><input type="file" class="form-control" name="photo" id="photo" placeholder="photo" required="" value="" onchange="return validasiEkstensi()" />
										<!-- <div id="preview"></div> -->
									</td>
								</tr>
							<?php } else { ?>
								<div class="form-group">
									<tr>
										<td >Logo Perusahaan <?php echo form_error('photo') ?></td>
										<td>
											<a href="#modal-dialog" data-bs-toggle="modal"><img src="<?php echo base_url(); ?>assets/assets/img/logo/<?= $photo ?>" style="width: 150px;height: 150px;border-radius: 5%;"></img></a>
											<input type="hidden" name="photo_lama" value="<?= $photo ?>">
											<p style="color: red">Note :Pilih Logo Perusahaan Jika Ingin Merubahnya</p>
											<input type="file" class="form-control" name="photo" id="photo" placeholder="photo" value="" onchange="return validasiEkstensi()" />
										</td>

									</tr>
								</div>
							<?php } ?>
							<tr>
								<td></td>
								<td><input type="hidden" name="app_setting_id" value="<?php echo $app_setting_id; ?>" />
									<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
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
					document.getElementById('preview').innerHTML = '<iframe src="' + e.target.result + '" style="height:150px; width:200px"/>';
				};
				reader.readAsDataURL(inputFile.files[0]);
			}
		}
	}
</script>

