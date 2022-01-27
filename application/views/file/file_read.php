<div id="content" class="app-content">
<div class="col-md-6 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">File Read</h4>
<div class="panel-heading-btn">
<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand" data-bs-original-title="" title="" data-tooltip-init="true"><i class="fa fa-expand"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
</div>
</div>
<div class="panel-body">
<table id="data-table-default" class="table table-hover table-bordered table-td-valign-middle">
	    <tr><td>Ref No</td><td><?php echo $ref_no; ?></td></tr>
	    <tr><td>Date Of Receive</td><td><?php echo $date_of_receive; ?></td></tr>
	    <tr><td>Adjuster Id</td><td><?php echo $adjuster_id; ?></td></tr>
	    <tr><td>Trade Id</td><td><?php echo $trade_id; ?></td></tr>
	    <tr><td>Type Of Loss Id</td><td><?php echo $type_of_loss_id; ?></td></tr>
	    <tr><td>Detail Dol</td><td><?php echo $detail_dol; ?></td></tr>
	    <tr><td>Date Of Loss</td><td><?php echo $date_of_loss; ?></td></tr>
	    <tr><td>Date Of Survey</td><td><?php echo $date_of_survey; ?></td></tr>
	    <tr><td>Policy Number</td><td><?php echo $policy_number; ?></td></tr>
	    <tr><td>Situation Of Loss</td><td><?php echo $situation_of_loss; ?></td></tr>
	    <tr><td>Insurer Ref No</td><td><?php echo $insurer_ref_no; ?></td></tr>
	    <tr><td>Insured</td><td><?php echo $insured; ?></td></tr>
	    <tr><td>Broker Id</td><td><?php echo $broker_id; ?></td></tr>
	    <tr><td>Remark Id</td><td><?php echo $remark_id; ?></td></tr>
	    <tr><td>User Id</td><td><?php echo $user_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('file') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
			</div>
        </div>
    </div>
</div>
