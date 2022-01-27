<div id="content" class="app-content">
<div class="col-xl-6 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA SECRETARY</h4>
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
	    <tr><td >Secretary Code <?php echo form_error('secretary_code') ?></td><td><input type="text" class="form-control" name="secretary_code" id="secretary_code" placeholder="Secretary Code" value="<?php echo $secretary_code; ?>" /></td></tr>
	    <tr><td >Secretary Name <?php echo form_error('secretary_name') ?></td><td><input type="text" class="form-control" name="secretary_name" id="secretary_name" placeholder="Secretary Name" value="<?php echo $secretary_name; ?>" /></td></tr>
	    
        <tr><td >Secretary Address <?php echo form_error('secretary_address') ?></td><td> <textarea class="form-control" rows="3" name="secretary_address" id="secretary_address" placeholder="Secretary Address"><?php echo $secretary_address; ?></textarea></td></tr>
	    <tr><td></td><td><input type="hidden" name="secretary_id" value="<?php echo $secretary_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('secretary') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>
