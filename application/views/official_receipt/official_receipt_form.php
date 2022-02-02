<div id="content" class="app-content">
	<div class="row">
		<div class="col-xl-3 ui-sortable">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading ui-sortable-handle">
					<h4 class="panel-title">Select Ref No</h4>
				</div>
				<div class="panel-body">
					<form accept="<?= base_url() ?>file" method="GET">
						<div class="form-group">
							<select id="ref_no_id" name="ref_no_id" class="form-control theSelect">
								<option value="">-- Pilih -- </option>
								<?php foreach ($file as $key => $data) { ?>
									<option value="<?php echo $data->file_id ?>"><?php echo $data->ref_no ?></option>
								<?php } ?>
							</select>
						</div>
					</form>
				</div>
			</div>

			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading ui-sortable-handle">
					<h4 class="panel-title">Detail List OR</h4>
				</div>
				<div class="panel-body">
					<table class="table  table-bordered table-hover table-tr-valign-middle" id="table_detail_or">
						<thead>
							<tr class="table-secondary">
								<td>No</td>
								<td>OR No</td>
							</tr>
						</thead>
						<tbody>

						</tbody>
					</table>
				</div>
			</div>


		</div>


		<div class="col-xl-9 ui-sortable">

			<div class="panel panel-inverse" data-sortable-id="index-6">
				<div class="panel-heading ui-sortable-handle">
					<h4 class="panel-title">Data Form</h4>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="panel-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group mb-2">
												<label class="form-label" for="kode">OR No</label>

												<?php if ($button == 'Create') { ?>
													<input autocomplete="off" type="text" readonly="" class="form-control" name="ref_no" id="ref_no" placeholder="" value="<?= $kodeunik ?>" />
												<?php } else { ?>
													<input autocomplete="off" type="text" readonly="" class="form-control" name="ref_no" id="ref_no" placeholder="Ref No" value="<?php echo $ref_no; ?>" />
												<?php } ?>


											</div>

											<div class="form-group mb-2">
												<label class="form-label" for="tanggal">OR Date</label>
												<input class="form-control" type="date" id="tanggal" name="tanggal" placeholder="tanggal" value="<?= date('Y-m-d') ?>" required="">
											</div>

											<div class="form-group mb-2">
												<label class="form-label" for="tanggal">Insurer</label>
												<select class="form-select theSelect" id="insurer_id" name="insurer_id">
													<option style="color: black;" value="" selected="">-- Pilih --</option>
													<span id="result"></span>
												</select>
												<p style="color:white" id="note_insurer">*Silahkan pilih Ref No terlebih dahulu</p>

											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-2">
												<label class="form-label" for="attn">Invoice No</label>
												<input autocomplete="off" class="form-control" type="text" id="attn" name="attn" value="" required="">
											</div>

											<input type="hidden" name="stok" id="stok">
											<input type="hidden" name="kode_produk" id="kode-produk">
											<input type="hidden" name="unit_produk" id="unit-produk">
											<input type="hidden" name="index_tr" id="index-tr">

											<div class="form-group mb-2">
												<label class="form-label" for="produk">Invoice Date</label>
												<input class="form-control" type="date" id="harga" name="Harga" value="<?= date('Y-m-d') ?>" placeholder="Harga">
											</div>

											<div class="row form-group">
												<div class="col-md-6 mb-2">
													<label class="form-label" for="harga">Currency</label>
													<select id="currency_id" name="currency_id" class="form-control theSelect">
														<option value="">-- Pilih -- </option>
														<?php foreach ($currency_data as $key => $data) { ?>
															<?php if ($currency_id == $data->currency_id) { ?>
																<option value="<?php echo $data->currency_id ?>" selected><?php echo $data->currency_code  ?></option>
															<?php } else { ?>
																<option value="<?php echo $data->currency_id ?>"><?php echo $data->currency_code  ?></option>
															<?php } ?>
														<?php } ?>
													</select>

												</div>

												<div class="col-md-6 mb-2">
													<label class="form-label" for="rate">Rate</label>
													<input readonly id="rate" value="" class="form-control" type="number" name="rate" placeholder="-">
												</div>
											</div>
										</div>
									</div>

									<div class="row mt-4">
										<div class="col-md-6">
											<div class="row form-group">
												<div class="col-md-6 mb-2">
													<label class="form-label" for="percentage">Percentage (%) </label>
													<input class="form-control" type="hidden" id="total_fee" name="total_fee" placeholder="">
													<input readonly class="form-control" type="number" id="percentage" name="percentage" placeholder="Percentage">
												</div>

												<div class="col-md-6 mb-2">
													<label class="form-label" for="fee">Fee</label>
													<input readonly class="form-control" type="number" id="fee" name="fee" placeholder="Fee">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-6 mb-2">
													<label class="form-label" for="expense">Expense</label>
													<input value="0" min="0" class="form-control" type="number" id="expense" name="expense" placeholder="Expense">
												</div>
												<div class="col-md-6 mb-2">
													<label class="form-label" for="discount">Discount</label>
													<input value="0" min="0" class="form-control" type="number" id="discount" name="discount" placeholder="Discount">
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12 mb-4">
													<label class="form-label" for="grand_total">Grand Total</label>
													<input readonly class="form-control" type="number" id="grand_total" name="grand_total" placeholder="Grand Total">
												</div>
											</div>
										</div>

										<div class="col-md-6">

											<div class="row form-group">
												<div class="col-md-12 mb-4">
													<label class="form-label" for="grand_total">VAT Options</label>
													<div class="col-md-12 pt-2">
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="radio" id="inlineRadio1" name="inlineRadio" checked >
															<label class="form-check-label" for="inlineRadio1">VAT Before Expense</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input" type="radio" id="customRadio2" name="inlineRadio">
															<label class="form-check-label" for="customRadio2">VAT After Expense</label>
														</div>
													</div>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12 mb-4">
													<label class="form-label" for="catatan">Description</label>
													<textarea class="form-control" id="description" name="description" placeholder="Description" rows="4"></textarea>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<button type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
												<a href="<?php echo site_url('official_receipt') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>

	</div>

</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".theSelect").select2();
	});
</script>

<script>
	const ref_no_id = $('#ref_no_id')
	const table_detail_or = $('#table_detail_or')
	const currency_id = $('#currency_id')
	const rate = $('#rate')
	const insurer_id = $('#insurer_id')
	const percentage = $('#percentage')
	const fee = $('#fee')
	const total_fee = $('#total_fee')

	ref_no_id.change(function() {
		let file_id = $(this).val()
		let noTable = 1
		table_detail_or.find('tbody').html(`
            <tr>
                <td colspan="6" class="text-center">Loading...</td>
            </tr>
            `)
		$.ajax({
			url: '<?= base_url() ?>Official_receipt/get_detail_or',
			method: 'post',
			dataType: 'json',
			data: {
				file_id: file_id
			},
			success: function(response) {}
		});
		$.ajax({
			url: '<?php echo site_url('official_receipt/get_detail_insurer') ?>',
			type: 'POST',
			data: {
				file_id: file_id
			},
			success: function(res) {
				$("#insurer_id").html(res);
				percentage.val('')
				$('#fee').val('')
				$('#grand_total').val('')
			}
		});

		$.ajax({
			url: '<?php echo site_url('official_receipt/total_fee') ?>',
			type: 'POST',
			data: {
				file_id: file_id
			},
			success: function(res) {
				total_fee.val(res)
			}
		});


	})

	currency_id.change(function() {
		let currency_id = $(this).val()
		rate.val('Loading...')
		$.ajax({
			url: '<?php echo site_url('official_receipt/get_rate') ?>',
			type: 'POST',
			data: {
				currency_id: currency_id
			},
			success: function(res) {
				rate.val(res)
			}
		});
	})

	insurer_id.change(function() {
		let insurer_id = $(this).val()
		$.ajax({
			url: '<?php echo site_url('official_receipt/get_percentage') ?>',
			type: 'POST',
			data: {
				insurer_id: insurer_id
			},
			success: function(res) {
				percentage.val(res)
				calculate()
				$('#expense').val(0)
				$('#discount').val(0)
			}
		});
	})

	function calculate() {
		let total_fee = $('#total_fee').val()
		let percentage = $('#percentage').val()
		let discount = $('#discount').val()
		let expense = $('#expense').val()
		if (!discount) {
			discount = 0
		}
		if (!expense) {
			expense = 0
		}

		let fee = (percentage / 100 * total_fee)

		let grand_total = parseInt(fee) + parseInt(expense) - parseInt(discount)
		if (percentage) {
			$('#fee').val(fee)
			$('#grand_total').val(grand_total)
		} else {
			$('#fee').val('')
			$('#grand_total').val('')
		}
	}


	$(document).on('keyup mouseup', '#discount, #expense', function() {
		calculate()
	})
</script>
