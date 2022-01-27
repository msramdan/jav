<div id="content" class="app-content">
	<form action="<?php echo $action; ?>" method="post">
		<div class="row mb-3">
			<div class="col-md-6 ui-sortable">
				<div class="panel panel-inverse" data-sortable-id="form-stuff-1" data-init="true">
					<div class="panel-heading ui-sortable-handle">
						<h4 class="panel-title">Form Controls</h4>
						<div class="panel-heading-btn">
							<a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-reload"><i class="fa fa-redo"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-warning" data-toggle="panel-collapse"><i class="fa fa-minus"></i></a>
							<a href="javascript:;" class="btn btn-xs btn-icon btn-danger" data-toggle="panel-remove"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<div class="panel-body">
						<thead></thead>
						<tbody>
							<table id="data-table-default" class="table  table-bordered table-hover table-td-valign-middle table-sm">
								<tr>
									<td style="width: 30%;">Ref No <?php echo form_error('ref_no') ?></td>
									<td>
										<?php if ($button == 'Create') { ?>
											<input type="text" readonly="" class="form-control" name="ref_no" id="ref_no" placeholder="" value="<?= $kodeunik ?>" />
										<?php } else { ?>
											<input type="text" readonly="" class="form-control" name="ref_no" id="ref_no" placeholder="Ref No" value="<?php echo $ref_no; ?>" />
										<?php } ?>

									</td>
								</tr>
								<tr>
									<td>Date of Receive <?php echo form_error('date_of_receive') ?></td>
									<td><input required type="date" class="form-control" name="date_of_receive" id="date_of_receive" placeholder="Date of Receive" value="<?php echo $date_of_receive; ?>" /></td>
								</tr>
								<tr>
									<td>Adjuster <?php echo form_error('adjuster_id') ?></td>
									<td><select required name="adjuster_id" class="form-control theSelect" style="width: 100%;">
											<option value="">-- Pilih -- </option>
											<?php foreach ($adjuster as $key => $data) { ?>
												<?php if ($adjuster_id == $data->adjuster_id) { ?>
													<option value="<?php echo $data->adjuster_id ?>" selected><?php echo $data->adjuster_code ?> - <?php echo $data->adjuster_name ?></option>
												<?php } else { ?>
													<option value="<?php echo $data->adjuster_id ?>"><?php echo $data->adjuster_code ?> - <?php echo $data->adjuster_name ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Trade <?php echo form_error('trade_id') ?></td>
									<td><select required name="trade_id" class="form-control theSelect" style="width: 100%;">
											<option value="">-- Pilih -- </option>
											<?php foreach ($trade as $key => $data) { ?>
												<?php if ($trade_id == $data->trade_id) { ?>
													<option value="<?php echo $data->trade_id ?>" selected><?php echo $data->trade_code ?> - <?php echo $data->trade_name ?></option>
												<?php } else { ?>
													<option value="<?php echo $data->trade_id ?>"><?php echo $data->trade_code ?> - <?php echo $data->trade_name ?></option>
												<?php } ?>
											<?php } ?>
										</select>
									</td>
								</tr>
								<tr>
									<td>Type of Loss <?php echo form_error('type_of_loss_id') ?></td>
									<td><select required name="type_of_loss_id" class="form-control theSelect" style="width: 100%;">
											<option value="">-- Pilih -- </option>
											<?php foreach ($type_of_loss as $key => $data) { ?>
												<?php if ($type_of_loss_id == $data->type_of_loss_id) { ?>
													<option value="<?php echo $data->type_of_loss_id ?>" selected><?php echo $data->tol_code ?> - <?php echo $data->tol_name ?></option>
												<?php } else { ?>
													<option value="<?php echo $data->type_of_loss_id ?>"><?php echo $data->tol_code ?> - <?php echo $data->tol_name ?></option>
												<?php } ?>
											<?php } ?>
										</select></td>
								</tr>


								<tr>
									<td>Detail Dol <?php echo form_error('detail_dol') ?></td>
									<td> <textarea required class="form-control" rows="3" name="detail_dol" id="detail_dol" placeholder="Detail Dol"><?php echo $detail_dol; ?></textarea></td>
								</tr>
								<tr>
									<td>Date of Loss <?php echo form_error('date_of_loss') ?></td>
									<td><input required type="date" class="form-control" name="date_of_loss" id="date_of_loss" placeholder="Date of Loss" value="<?php echo $date_of_loss; ?>" /></td>
								</tr>
								<tr>
									<td>Date of Survey <?php echo form_error('date_of_survey') ?></td>
									<td><input required type="date" class="form-control" name="date_of_survey" id="date_of_survey" placeholder="Date of Survey" value="<?php echo $date_of_survey; ?>" /></td>
								</tr>
								<tr>
									<td>Policy Number <?php echo form_error('policy_number') ?></td>
									<td><input required type="text" class="form-control" name="policy_number" id="policy_number" placeholder="Policy Number" value="<?php echo $policy_number; ?>" /></td>
								</tr>

								<tr>
									<td>Situation of Loss <?php echo form_error('situation_of_loss') ?></td>
									<td> <textarea required class="form-control" rows="3" name="situation_of_loss" id="situation_of_loss" placeholder="Situation of Loss"><?php echo $situation_of_loss; ?></textarea></td>
								</tr>
								<tr>
									<td>Insurer Ref No <?php echo form_error('insurer_ref_no') ?></td>
									<td><input required type="text" class="form-control" name="insurer_ref_no" id="insurer_ref_no" placeholder="Insurer Ref No" value="<?php echo $insurer_ref_no; ?>" /></td>
								</tr>
								<tr>
									<td>Insured <?php echo form_error('insured') ?></td>
									<td><input required type="text" class="form-control" name="insured" id="insured" placeholder="Insured" value="<?php echo $insured; ?>" /></td>
								</tr>
								<tr>
									<td>Broker <?php echo form_error('broker_id') ?></td>
									<td><select required name="broker_id" class="form-control theSelect" style="width: 100%;">
											<option value="">-- Pilih -- </option>
											<?php foreach ($broker as $key => $data) { ?>
												<?php if ($broker_id == $data->broker_id) { ?>
													<option value="<?php echo $data->broker_id ?>" selected><?php echo $data->broker_code ?> - <?php echo $data->broker_name ?></option>
												<?php } else { ?>
													<option value="<?php echo $data->broker_id ?>"><?php echo $data->broker_code ?> - <?php echo $data->broker_name ?></option>
												<?php } ?>
											<?php } ?>
										</select></td>
								</tr>
								<input type="hidden" name="file_id" value="<?php echo $file_id; ?>" />
								<input type="hidden" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?= $this->fungsi->user_login()->user_id ?>" /></td>
								</thead>
							</table>
					</div>
				</div>
			</div>

			<!-- insurer -->
			<div class="col-md-6 ui-sortable">
				<div class="panel panel-inverse" data-sortable-id="form-stuff-3" data-init="true">
					<div class="panel-heading ui-sortable-handle">
						<h4 class="panel-title">Detail Insurer</h4>
					</div>
					<div class="panel-body">
						<button style="margin-bottom: 10px;" type="button" name="add_berkas" id="add_berkas" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Insurer</button>
						<table class="table table-bordered table-sm" id="dynamic_field">
							<thead>
								<tr>
									<th>Insurer name </th>
									<th>Type</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($button == 'Update') { ?>
									<?php
									$detail_file = $this->db->query("SELECT * from detail_insurer join insurer on insurer.insurer_id =detail_insurer.insurer_id  where detail_insurer.file_id='$file_id' order BY detail_insurer_id  ASC")->result();
									foreach ($detail_file as $row) { ?>
										<tr id="detail_file<?= $row->detail_insurer_id ?>">
											<td style="width: 45%;">
												<select name="insurer_id[]" class="form-control">
													<option style="color: black;" value="">-- Pilih -- </option>
													<?php foreach ($insurer as $key => $rows) { ?>
														<?php if ($row->insurer_id == $rows->insurer_id) { ?>
															<option style="color: black;" value="<?php echo $rows->insurer_id ?>" selected><?php echo $rows->insurer_code ?> - <?php echo $rows->insurer_name ?></option>
														<?php } else { ?>
															<option style="color: black;" value="<?php echo $rows->insurer_id ?>"><?php echo $rows->insurer_code ?> - <?php echo $rows->insurer_name ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</td>
											<td style="width: 45%;">
												<select name="type_insurer_id[]" class="form-control">
													<option style="color: black;" value="">-- Pilih -- </option>
													<?php foreach ($type_insurer as $key => $rows) { ?>
														<?php if ($row->type_insurer_id == $rows->type_insurer_id) { ?>
															<option style="color: black;" value="<?php echo $rows->type_insurer_id ?>" selected> <?php echo $rows->type_insurer_name ?></option>
														<?php } else { ?>
															<option style="color: black;" value="<?php echo $rows->type_insurer_id ?>"> <?php echo $rows->type_insurer_name ?></option>
														<?php } ?>
													<?php } ?>
												</select>
											</td>
											<td style="width: 5%;"><button type="button" name="" id="" class="btn btn-danger btn-sm btn_remove_data"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
										</tr>
									<?php } ?>
								<?php } ?>

							</tbody>
						</table>
					</div>
				</div>

				<!-- Remark -->
				<div class="panel panel-inverse" data-sortable-id="form-stuff-4" data-init="true">
					<div class="panel-heading ui-sortable-handle">
						<h4 class="panel-title">Detail Remark</h4>
					</div>
					<div class="panel-body" style="overflow-x: scroll; ">
						<button style="margin-bottom: 10px;" type="button" name="add_berkas2" id="add_berkas2" class="btn btn-success btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Add Remark</button>
						<table class="table table-bordered table-sm" id="dynamic_field2" style="width: 700px;">
							<thead>
								<tr>
									<th style="width: 200px;">Current Position</th>
									<th style="width: 100px;">Date</th>
									<th style="width: 100px;">Fee (%)</th>
									<th style="width: 200px;">Secrtry</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if ($button == 'Update') { ?>
									<?php
									$detail_remark = $this->db->query("SELECT * from detail_remark
									join remark on remark.remark_id =detail_remark.remark_id
									left join secretary on secretary.secretary_id =detail_remark.secretary_id
									where detail_remark.file_id='$file_id' order BY detail_remark_id  ASC ")->result();
									foreach ($detail_remark as $row) { ?>
										<tr id="detil_remark<?= $row->detail_remark_id ?>">
											<td>
												<select required name="remark_id[]" class="form-control">
													<option style="color: black;" value="">-- Pilih -- </option>
													<?php foreach ($remark as $key => $data) { ?>
														<?php if ($row->remark_id == $data->remark_id) { ?>
															<option style="color: black;" value="<?php echo $data->remark_id ?>" selected><?php echo $data->remark_code ?> - <?php echo $data->remark_name ?></option>
														<?php } else { ?>
															<option style="color: black;" value="<?php echo $data->remark_id ?>"><?php echo $data->remark_code ?> - <?php echo $data->remark_name ?></option>
														<?php } ?>
													<?php } ?>
												</select>

											</td>
											<td>
												<input type="date" class="form-control" name="date[]" placeholder="" value="<?= $row->date ?>" />
											</td>
											<td>
												<input type="number" class="form-control" name="fee[]" placeholder="" value="<?= $row->fee ?>" />
											</td>
											<td>
												<select name="secretary_id[]" class="form-control">
													<option style="color: black;" value="">-- Pilih -- </option>
													<?php foreach ($secretary as $key => $rows) { ?>
														<?php if ($row->secretary_id == $rows->secretary_id) { ?>
															<option style="color: black;" value="<?php echo $rows->secretary_id ?>" selected><?php echo $rows->secretary_code ?> - <?php echo $rows->secretary_name ?></option>
														<?php } else { ?>
															<option style="color: black;" value="<?php echo $rows->secretary_id ?>"><?php echo $rows->secretary_code ?> - <?php echo $rows->secretary_name ?></option>
														<?php } ?>
													<?php } ?>
												</select>

											</td>
											<td><button type="button" name="" id="" class="btn btn-danger btn-sm btn_remove2"><i class="fa fa-trash" aria-hidden="true"></i></button></td>
										</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
				<a href="<?php echo site_url('file') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a>
			</div>
		</div>
	</form>
</div>
</div>
</div>
</div>

<script>
	$(document).ready(function() {
		$(".theSelect").select2();
	})
</script>
<script>
	$(document).ready(function() {
		var i = 1;
		$('#add_berkas').click(function() {
			i++;
			$('#dynamic_field').append('<tr id="row' + i +
				'"><td><select required name="insurer_id[]" class="form-control theSelect" style="width: 100%;"><option value=""  style="color:black">-- Pilih -- </option><?php foreach ($insurer as $key => $data) { ?><option  style="color:black" value="<?php echo $data->insurer_id ?>"><?php echo $data->insurer_code ?> - <?php echo $data->insurer_name ?></option><?php } ?></select></td><td style="width: 45%;"><select required name="type_insurer_id[]" class="form-control "  style="width: 100%;"><option value="" style="color:black">-- Pilih --</option><?php foreach ($type_insurer as $key => $rows) { ?><option style="color: black;" value="<?php echo $rows->type_insurer_id ?>"> <?php echo $rows->type_insurer_name ?></option><?php } ?></select></td><td><button type="button" name="remove" id="' +
				i + '" class="btn btn-danger btn_remove"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
		});

		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});
		$(document).on('click', '.btn_remove_data', function() {
			var bid = this.id;
			var trid = $(this).closest('tr').attr('id');
			$('#' + trid + '').remove();
		});

	});
</script>


<script>
	$(document).ready(function() {
		var i = 1;
		$('#add_berkas2').click(function() {
			i++;
			$('#dynamic_field2').append('<tr id="row2' + i +
				'"><td><select required name="remark_id[]" class="form-control theSelect" style="width: 100%;"><option value="" style="color:black">-- Pilih -- </option><?php foreach ($remark as $key => $data) { ?><option style="color:black" value="<?php echo $data->remark_id ?>"><?php echo $data->remark_code ?> - <?php echo $data->remark_name ?></option><?php } ?></select></td><td><input required type="date" name="date[]" placeholder="" class="form-control " /></td><td><input type="number" name="fee[]" placeholder="" class="form-control " /></td><td><select name="secretary_id[]" class="form-control theSelect" style="width: 100%;"><option value="" style="color:black">-- Pilih -- </option><?php foreach ($secretary as $key => $data) { ?><option style="color:black" value="<?php echo $data->secretary_id ?>"><?php echo $data->secretary_name ?></option><?php } ?></select></td></td> <td><button type="button" name="remove" id="' +
				i + '" class="btn btn-danger btn_remove2"><i class="fa fa-trash" aria-hidden="true"></i></button></td></tr>');
		});

		$(document).on('click', '.btn_remove2', function() {
			var button_id = $(this).attr("id");
			$('#row2' + button_id + '').remove();
		});

		$(document).on('click', '.btn_remove2', function() {
			var bid = this.id;
			var trid = $(this).closest('tr').attr('id');
			$('#' + trid + '').remove();
		});

	});
</script>