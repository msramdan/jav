<div id="content" class="app-content">
	<div class="col-md-6 ui-sortable">
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

			<div class="panel-heading ui-sortable-handle">
				<h4 class="panel-title">KELOLA DATA REMARK</h4>
				<div class="panel-heading-btn">
					<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
					<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
				</div>
			</div>
			<div class="panel-body">

				<form action="<?php echo $action; ?>" method="post">
					<thead>
						<table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle">
							<tr>
								<td>Remark Code <?php echo form_error('remark_code') ?></td>
								<td><input type="text" class="form-control" name="remark_code" id="remark_code" placeholder="Remark Code" value="<?php echo $remark_code; ?>" /></td>
							</tr>
							<tr>
								<td>Remark Name <?php echo form_error('remark_name') ?></td>
								<td><input type="text" class="form-control" name="remark_name" id="remark_name" placeholder="Remark Name" value="<?php echo $remark_name; ?>" /></td>
							</tr>

							<tr>
								<td>Status Case <?php echo form_error('status_case') ?></td>
								<td>
									<div class="col-md-4" style="width: 100%;">
										<select name="status_case" class="form-control theSelect" value="<?= $status_case ?>" >
											<option value="">- Pilih -</option>
											<option value="Receiving" <?php echo $status_case == 'Receiving' ? 'selected' : 'null' ?>>Receiving</option>
											<option value="Outstanding" <?php echo $status_case == 'Outstanding' ? 'selected' : 'null' ?>>Outstanding</option>
										</select>
									</div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td><input type="hidden" name="remark_id" value="<?php echo $remark_id; ?>" />
									<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
									<a href="<?php echo site_url('remark') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Back</a>
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
		$('.theSelect').selectize({
			sortField: 'text'
		});
	});
</script>
