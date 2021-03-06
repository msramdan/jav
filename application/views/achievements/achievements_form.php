<div id="content" class="app-content">
	<div class="col-md-6 ui-sortable">
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

			<div class="panel-heading ui-sortable-handle">
				<h4 class="panel-title">KELOLA DATA ACHIEVEMENTS</h4>
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
								<td>Clients <?php echo form_error('clients') ?></td>
								<td><input type="text" class="form-control" name="clients" id="clients" placeholder="Clients" value="<?php echo $clients; ?>" /></td>
							</tr>
							<tr>
								<td>Projects <?php echo form_error('projects') ?></td>
								<td><input type="text" class="form-control" name="projects" id="projects" placeholder="Projects" value="<?php echo $projects; ?>" /></td>
							</tr>
							<tr>
								<td>Gifts <?php echo form_error('gifts') ?></td>
								<td><input type="text" class="form-control" name="gifts" id="gifts" placeholder="Gifts" value="<?php echo $gifts; ?>" /></td>
							</tr>
							<tr>
								<td>Offices <?php echo form_error('offices') ?></td>
								<td><input type="text" class="form-control" name="offices" id="offices" placeholder="Offices" value="<?php echo $offices; ?>" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="hidden" name="achievements_id" value="<?php echo $achievements_id; ?>" />
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
