<div id="content" class="app-content">
	<form action="<?php echo $action; ?>" method="post">
		<div class="row mb-3">
			<div class="col-md-6 ui-sortable">
				<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
					<div class="panel-heading ui-sortable-handle">
						<h4 class="panel-title">KELOLA DATA SERVICE</h4>
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="panel-body">
						<thead>
							<table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle">
								<tr>
									<td>Service Name <?php echo form_error('service_name') ?></td>
									<td><input required type="text" class="form-control" name="service_name" id="service_name" placeholder="Service Name" value="<?php echo $service_name; ?>" /></td>
								</tr>
								<tr>
									<td>Icon <?php echo form_error('icon') ?></td>
									<td><input required type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" /></td>
								</tr>
						</thead>
						</table>
					</div>
				</div>
			</div>

			<!-- insurer -->
			<div class="col-md-6 ui-sortable">
				<div class="panel panel-inverse" data-sortable-id="form-stuff-3" data-init="true">
					<div class="panel-heading ui-sortable-handle">
						<h4 class="panel-title">Detail Service</h4>
					</div>
					<div class="panel-body">
						<button style="margin-bottom: 10px;" type="button" name="add_berkas" id="add_berkas" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
						<table class="table table-bordered " id="dynamic_field">
							<thead>
								<tr>
									<th>Detail Name </th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($button == 'Update') { ?>
									<?php
									$detail_file = $this->db->query("SELECT * from service_detail where service_detail.service_id ='$service_id'")->result();
									foreach ($detail_file as $row) { ?>
										<tr id="detail_file<?= $row->service_detail_id  ?>">
											<td>
												<input required type="text" class="form-control" name="service_detail_name[]" placeholder="" value="<?= $row->service_detail_name ?>" />
											</td>
											<td style="width: 5%;"><button type="button" name="" id="" class="btn btn-danger btn-sm btn_remove_data"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
										</tr>
									<?php } ?>
								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>
				<input type="hidden" name="service_id" value="<?php echo $service_id; ?>" />
				<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
				<a href="<?php echo site_url('service') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Back</a>


			</div>
		</div>
	</form>
</div>
</div>
</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		$('.theSelect').selectize({
			sortField: 'text'
		});
	});
</script>

<script>
	$(document).ready(function() {
		var i = 1;
		$('#add_berkas').click(function() {
			i++;
			$('#dynamic_field').append('<tr id="row' + i +
				'"><td><input required type="text" name="service_detail_name[]" placeholder="Detail Name" class="form-control " /></td><td><button type="button" name="remove" id="' +
				i + '" class="btn btn-danger btn_remove"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
		});

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});
		$(document).on('click', '.btn_remove_data', function() {
			var bid = this.id;
			var trid = $(this).closest('tr').attr('id');
			$('#' + trid + '').remove();
		});

	});
</script>
