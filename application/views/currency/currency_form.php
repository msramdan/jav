<div id="content" class="app-content">
	<div class="col-md-6 ui-sortable">
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

			<div class="panel-heading ui-sortable-handle">
				<h4 class="panel-title">KELOLA DATA CURRENCY</h4>
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
								<td>Currency Code <?php echo form_error('currency_code') ?></td>
								<td><input type="text" class="form-control" name="currency_code" id="currency_code" placeholder="Currency Code" value="<?php echo $currency_code; ?>" /></td>
							</tr>
							<tr>
								<td>Currency Name <?php echo form_error('currency_name') ?></td>
								<td><input type="text" class="form-control" name="currency_name" id="currency_name" placeholder="Currency Name" value="<?php echo $currency_name; ?>" /></td>
							</tr>
							<tr>
								<td>Says <?php echo form_error('says') ?></td>
								<td><input type="text" class="form-control" name="says" id="says" placeholder="Says" value="<?php echo $says; ?>" /></td>
							</tr>
							<tr>
								<td>Rate <?php echo form_error('rate') ?></td>
								<td><input type="number" class="form-control" name="rate" id="rate" placeholder="Rate" value="<?php echo $rate; ?>" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="hidden" name="currency_id" value="<?php echo $currency_id; ?>" />
									<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
									<a href="<?php echo site_url('currency') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Back</a>
								</td>
							</tr>
					</thead>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
