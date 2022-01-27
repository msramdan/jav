<div id="content" class="app-content">
<div class="col-md-6 ui-sortable">
<div class="panel panel-inverse" data-sortable-id="form-stuff-1"  data-init="true">

<div class="panel-heading ui-sortable-handle">
<h4 class="panel-title">KELOLA DATA BROKER</h4>
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
	    <tr><td >Broker Code <?php echo form_error('broker_code') ?></td><td><input type="text" class="form-control" name="broker_code" id="broker_code" placeholder="Broker Code" value="<?php echo $broker_code; ?>" /></td></tr>
	    <tr><td >Broker Name <?php echo form_error('broker_name') ?></td><td><input type="text" class="form-control" name="broker_name" id="broker_name" placeholder="Broker Name" value="<?php echo $broker_name; ?>" /></td></tr>
	    
        <tr><td >Address <?php echo form_error('address') ?></td><td> <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo $address; ?></textarea></td></tr>
	    <tr><td >Name On Tax <?php echo form_error('name_on_tax') ?></td><td><input type="text" class="form-control" name="name_on_tax" id="name_on_tax" placeholder="Name On Tax" value="<?php echo $name_on_tax; ?>" /></td></tr>
	    
        <tr><td >Address On Tax <?php echo form_error('address_on_tax') ?></td><td> <textarea class="form-control" rows="3" name="address_on_tax" id="address_on_tax" placeholder="Address On Tax"><?php echo $address_on_tax; ?></textarea></td></tr>
	    <tr><td >Npwp <?php echo form_error('npwp') ?></td><td><input type="text" class="form-control" name="npwp" id="npwp" placeholder="Npwp" value="<?php echo $npwp; ?>" /></td></tr>
	    <tr><td></td><td><input type="hidden" name="broker_id" value="<?php echo $broker_id; ?>" /> 
	    <button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button> 
	    <a href="<?php echo site_url('broker') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a></td></tr>
</thead>
	</table></form>        </div>
</div>
</div>
</div>
