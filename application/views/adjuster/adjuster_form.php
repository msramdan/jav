<div id="content" class="app-content">
	<div class="col-md-6 ui-sortable">
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1"  data-init="true">

			<div class="panel-heading ui-sortable-handle">
				<h4 class="panel-title">KELOLA DATA ADJUSTER</h4>
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
								<td >Adjuster Code <?php echo form_error('adjuster_code') ?></td>
								<td><input type="text" class="form-control" name="adjuster_code" id="adjuster_code" placeholder="Adjuster Code" value="<?php echo $adjuster_code; ?>" /></td>
							</tr>
							<tr>
								<td >Adjuster Name <?php echo form_error('adjuster_name') ?></td>
								<td><input type="text" class="form-control" name="adjuster_name" id="adjuster_name" placeholder="Adjuster Name" value="<?php echo $adjuster_name; ?>" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="hidden" name="adjuster_id" value="<?php echo $adjuster_id; ?>" />
									<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
									<a href="<?php echo site_url('adjuster') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Back</a>
								</td>
							</tr>
					</thead>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
