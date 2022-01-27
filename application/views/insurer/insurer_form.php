<div id="content" class="app-content">
<div class="col-xl-6 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA INSURER</h4>
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
	    <tr><td >Insurer Code <?php echo form_error('insurer_code') ?></td><td><input type="text" class="form-control" name="insurer_code" id="insurer_code" placeholder="Insurer Code" value="<?php echo $insurer_code; ?>" /></td></tr>
	    <tr><td >Insurer Name <?php echo form_error('insurer_name') ?></td><td><input type="text" class="form-control" name="insurer_name" id="insurer_name" placeholder="Insurer Name" value="<?php echo $insurer_name; ?>" /></td></tr>
	    
        <tr><td >Address <?php echo form_error('address') ?></td><td> <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo $address; ?></textarea></td></tr>
	    <tr><td >Name On Tax <?php echo form_error('name_on_tax') ?></td><td><input type="text" class="form-control" name="name_on_tax" id="name_on_tax" placeholder="Name On Tax" value="<?php echo $name_on_tax; ?>" /></td></tr>
	    
        <tr><td >Address On Tax <?php echo form_error('address_on_tax') ?></td><td> <textarea class="form-control" rows="3" name="address_on_tax" id="address_on_tax" placeholder="Address On Tax"><?php echo $address_on_tax; ?></textarea></td></tr>
	    <tr><td >Npwp <?php echo form_error('npwp') ?></td><td><input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="insurer_id" value="<?php echo $insurer_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('insurer') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>
