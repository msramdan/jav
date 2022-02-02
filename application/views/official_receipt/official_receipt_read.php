<div id="content" class="app-content">
<div class="col-md-6 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">Official_receipt Read</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
	    <tr><td>Or No</td><td><?php echo $or_no; ?></td></tr>
	    <tr><td>File Id</td><td><?php echo $file_id; ?></td></tr>
	    <tr><td>Or Date</td><td><?php echo $or_date; ?></td></tr>
	    <tr><td>Insurer Id</td><td><?php echo $insurer_id; ?></td></tr>
	    <tr><td>Currency Id</td><td><?php echo $currency_id; ?></td></tr>
	    <tr><td>Total Fee</td><td><?php echo $total_fee; ?></td></tr>
	    <tr><td>Expense</td><td><?php echo $expense; ?></td></tr>
	    <tr><td>Description</td><td><?php echo $description; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('official_receipt') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
			</div>
        </div>
    </div>
</div>