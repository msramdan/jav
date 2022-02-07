<div id="content" class="app-content">
	<div class="col-md-6 ui-sortable">
		<div class="panel panel-inverse" data-sortable-id="form-stuff-1" style="" data-init="true">

			<div class="panel-heading ui-sortable-handle">
				<h4 class="panel-title">KELOLA DATA CONTACT</h4>
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
								<td>Office Name <?php echo form_error('office_name') ?></td>
								<td><input type="text" class="form-control" name="office_name" id="office_name" placeholder="Office Name" value="<?php echo $office_name; ?>" /></td>
							</tr>

							<tr>
								<td>Address <?php echo form_error('address') ?></td>
								<td> <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"><?php echo $address; ?></textarea></td>
							</tr>
							<tr>
								<td>Phone <?php echo form_error('phone') ?></td>
								<td><input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" /></td>
							</tr>
							<tr>
								<td>Fax <?php echo form_error('fax') ?></td>
								<td><input type="text" class="form-control" name="fax" id="fax" placeholder="Fax" value="<?php echo $fax; ?>" /></td>
							</tr>
							<tr>
								<td>General Enquiry <?php echo form_error('general_enquiry') ?></td>
								<td><input type="text" class="form-control" name="general_enquiry" id="general_enquiry" placeholder="General Enquiry" value="<?php echo $general_enquiry; ?>" /></td>
							</tr>
							<tr>
								<td>Contact Persons <?php echo form_error('contact_persons') ?></td>
								<td><input type="text" class="form-control" name="contact_persons" id="contact_persons" placeholder="Contact Persons" value="<?php echo $contact_persons; ?>" /></td>
							</tr>
							<tr>
								<td>Contact Persons2 <?php echo form_error('contact_persons2') ?></td>
								<td><input type="text" class="form-control" name="contact_persons2" id="contact_persons2" placeholder="Contact Persons2" value="<?php echo $contact_persons2; ?>" /></td>
							</tr>
							<tr>
								<td></td>
								<td><input type="hidden" name="contact_id" value="<?php echo $contact_id; ?>" />
									<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
									<a href="<?php echo site_url('contact') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Back</a>
								</td>
							</tr>
					</thead>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>
