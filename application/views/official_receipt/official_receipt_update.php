<div id="content" class="app-content">
	<div class="row">
		<div class="col-xl-3 ui-sortable">
			<div class="panel panel-inverse" data-sortable-id="index-1">
				<div class="panel-heading ui-sortable-handle">
					<h4 class="panel-title">Select Ref No</h4>
				</div>
				<div class="panel-body">
					<form>
						<div class="form-group">

							<input type="text" readonly="" class="form-control" name="" id="" value="<?= $ref_no ?>" />
							<input type="hidden" class="form-control" name="ref_no_id" id="ref_no_id" value="<?= $file_id ?>" />
							<input type="hidden" class="form-control" name="or_id" id="or_id" value="<?= $or_id ?>" />
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
						<tbody id="detail_or">
							<?php $no = 1;
							foreach ($detail_or as $row) {
							?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $or_no ?></td>
								</tr>
							<?php } ?>
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
												<input autocomplete="off" type="text" readonly="" class="form-control" name="or_no" id="or_no" placeholder="Ref No" value="<?php echo $or_no; ?>" />
											</div>

											<div class="form-group mb-2">
												<label class="form-label" for="or_date">OR Date</label>
												<input class="form-control" type="date" id="or_date" name="or_date" placeholder="or_date" value="<?= $or_date ?>" required="">
											</div>

											<div class="form-group mb-2">
												<label class="form-label" for="insurer_id">Insurer</label>
												<select class="form-select theSelect" id="insurer_id" name="insurer_id">
													<option value="" selected>-- Pilih --</option>
													<?php foreach ($insurer_data as $key => $data) { ?>
														<?php if ($insurer_id == $data->insurer_id) { ?>
															<option value="<?php echo $data->insurer_id ?>" selected><?php echo $data->type_insurer_name ?> - <?php echo $data->insurer_name ?> - <?php echo $data->fee ?>%</option>
														<?php } else { ?>
															<option value="<?php echo $data->insurer_id ?>"><?php echo $data->type_insurer_name ?> - <?php echo $data->insurer_name ?> - <?php echo $data->fee ?>%</option>
														<?php } ?>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group mb-2">
												<label class="form-label" for="invoice_no">Invoice No</label>
												<input autocomplete="off" class="form-control" type="text" id="invoice_no" name="invoice_no" value="<?= $invoice_no ?>" required="">
											</div>

											<div class="form-group mb-2">
												<label class="form-label" for="invoice_date">Invoice Date</label>
												<input class="form-control" type="date" id="invoice_date" name="invoice_date" value="<?= $invoice_date ?>" placeholder="Harga">
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
													<input readonly id="rate" value="<?= $rate ?>" class="form-control" type="number" name="rate" placeholder="-">
												</div>
											</div>
										</div>
									</div>

									<div class="row mt-4">
										<div class="col-md-6">
											<div class="row form-group">
												<div class="col-md-6 mb-2">
													<label class="form-label" for="percentage">Percentage (%) </label>
													<input class="form-control" value="<?= $fee_all ?>" type="hidden" id="total_fee" name="fee_all" placeholder="">
													<div class="input-group mb-3">

														<input readonly class="form-control" type="text" id="percentage" name="percentage" value="<?= $percentage ?>" placeholder="Percentage">
														<div style="width: 25%;" class="input-group-text"><span id="">%</span></div>
													</div>
												</div>

												<div class="col-md-6 mb-2">
													<label class="form-label" for="fee">Fee</label>

													<div class="input-group mb-2">
														<div style="width: 25%;" class="input-group-text"><span id="text_fee"><?= $currency_code ?></span></div>
														<input readonly class="form-control" type="text" id="fee_text" name="fee_text" placeholder="Fee" value="<?= rupiah($total_fee) ?>">
														<input readonly class="form-control" type="hidden" id="fee" name="fee" placeholder="Fee" value="<?= $total_fee?>">
													</div>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-6 mb-1">
													<label class="form-label" for="expense">Expense</label>

													<div class="input-group mb-3">
														<div style="width: 25%;" class="input-group-text"><span id="text_expense"><?= $currency_code ?></span></div>
														<input min="0" class="form-control" type="text" id="expense_text" name="expense_text" placeholder="Expense" value=" <?= rupiah($expense) ?>">
														<input min="0" class="form-control" type="hidden" id="expense" name="expense" placeholder="Expense" value="<?= $expense ?>">
													</div>
												</div>
												<div class="col-md-6 mb-1">
													<label class="form-label" for="discount">Discount</label>

													<div class="input-group mb-3">
														<div style="width: 25%;" class="input-group-text"><span id="text_discount"><?= $currency_code ?></span></div>
														<input min="0" class="form-control" type="text" id="discount_text" name="discount_text" placeholder="Discount" value="<?= rupiah($discount) ?>">
														<input min="0" class="form-control" type="hidden" id="discount" name="discount" placeholder="Discount" value="<?= $discount ?>">
													</div>
												</div>
											</div>

											
											<div class="row form-group">
												<div class="col-md-12 mb-3">
													<label class="form-label" for="grand_total">Grand Total</label>

													<div class="input-group mb-3">
														<div style="width: 13%;" class="input-group-text"><span id="text_grand_total"><?= $currency_code ?></span></div>	
														<input readonly class="form-control" type="text" id="grand_total_text" name="grand_total_text" placeholder="Grand Total" value="<?= rupiah($grand_total)  ?>">
														<input readonly class="form-control" type="hidden" id="grand_total" name="grand_total" placeholder="Grand Total" value="<?= $grand_total ?>">
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-6">

											<div class="row form-group">
												<div class="col-md-12 mb-4">
													<label class="form-label" for="grand_total">VAT Options</label>
													<div class="col-md-12 pt-2">
														<div class="form-check form-check-inline">
															<input class="form-check-input message_pri" type="radio" id="vat1" name="vat" value="Before Expense" <?php echo $vat == 'Before Expense' ? 'checked' : 'null' ?>>
															<label class="form-check-label" for="vat">VAT Before Expense</label>
														</div>
														<div class="form-check form-check-inline">
															<input class="form-check-input message_pri" type="radio" id="vat2" value="After Expense" name="vat" <?php echo $vat == 'After Expense' ? 'checked' : 'null' ?>>
															<label class="form-check-label" for="vat">VAT After Expense</label>
														</div>
													</div>
												</div>
											</div>
											<div class="row form-group">
												<div class="col-md-12 mb-2">
													<label class="form-label" for="catatan">Description</label>
													<textarea class="form-control" id="description" name="description" placeholder="Description" rows="2"><?= $description ?></textarea>
												</div>
											</div>

											<div class="row form-group">
												<div class="col-md-12 mb-2">
													<label class="form-label" for="status">Status Payment</label>
													<select id="status" name="status" class="form-control theSelect">
														<option value="Unpaid" <?php echo $status == 'Unpaid' ? 'selected' : 'null' ?>>Unpaid </option>
														<option value="Paid" <?php echo $status == 'Paid' ? 'selected' : 'null' ?>>Paid</option>
													</select>
												</div>
											</div>
										</div>

										<div class="col-md-4">
											<div class="form-group">
												<?php if ($status == 'Paid') { ?>
													<button id="simpan_data" type="submit" class="btn btn-danger" disabled><i class="fas fa-save"></i> <?php echo $button ?></button>
													<a href="<?php echo site_url('official_receipt') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a>
													<p>*Contact super admin to edit data</p>
												<?php } else { ?>
													<button id="simpan_data" type="submit" class="btn btn-danger"><i class="fas fa-save"></i> <?php echo $button ?></button>
													<a href="<?php echo site_url('official_receipt') ?>" class="btn btn-info"><i class="fas fa-undo"></i> Kembali</a>
												<?php } ?>

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
		$.ajax({
			url: '<?= base_url() ?>Official_receipt/get_detail_or',
			method: 'post',
			data: {
				file_id: file_id
			},
			success: function(response) {
				$("#detail_or").html(response);
			}
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

		$.ajax({
			url: '<?php echo site_url('official_receipt/get_currency_code') ?>',
			type: 'POST',
			data: {
				currency_id: currency_id
			},
			success: function(res) {
				$('#text_expense').html(res)
				$('#text_discount').html(res)
				$('#text_fee').html(res)
				$('#text_grand_total').html(res)
			}
		});
	})

	insurer_id.change(function() {
		let insurer_id = $(this).val()
		let file_id = $('#ref_no_id').val()
		$.ajax({
			url: '<?php echo site_url('official_receipt/get_percentage') ?>',
			type: 'POST',
			data: {
				insurer_id: insurer_id,
				file_id: file_id
			},
			success: function(res) {
				percentage.val(res)
				calculate()
				// $('#expense').val(0)
				// $('#discount').val(0)
			}
		});
	})

	function calculate() {
		let total_fee = $('#total_fee').val()
		let percentage = $('#percentage').val()
		let discount = $('#discount').val()
		let expense = $('#expense').val()
		var vat = $(".message_pri:checked").val();
		// console.log(vat)
		if (!discount) {
			discount = 0
		}
		if (!expense) {
			expense = 0
		}

		let fee = (percentage / 100 * total_fee)

		if (vat == 'Before Expense') {
			vat = parseInt(fee) * 10 / 100
		} else {
			vat = (parseInt(fee) + parseInt(expense)) * 10 / 100
		}

		let grand_total = parseInt(fee) + parseInt(expense) + parseInt(vat) - parseInt(discount)
		if (percentage) {
			$('#fee').val(fee)
			$('#fee_text').val(convertToRupiah(fee))
			$('#grand_total').val(grand_total)
			$('#grand_total_text').val(convertToRupiah(grand_total))
		} else {
			$('#fee').val('')
			$('#grand_total').val('')
		}
	}
	$(document).on('keyup mouseup', '#discount_text, #expense_text', function() {
		calculate()
	})

	$(document).on('change', '.message_pri', function() {
		calculate()
	});
</script>

<script>
	$("#simpan_data").click(function() {
		var ref_no_id2 = $('#ref_no_id').val();
		var or_id = $('#or_id').val();
		var or_no2 = $('#or_no').val();
		var insurer_id2 = $('#insurer_id').val();
		var currency_id2 = $('#currency_id').val();
		var expense2 = $('#expense').val();
		var or_date2 = $('#or_date').val();
		var invoice_no2 = $('#invoice_no').val();
		var invoice_date2 = $('#invoice_date').val();
		var percentage2 = $('#percentage').val();
		var fee2 = $('#fee').val();
		var discount2 = $('#discount').val();
		var expense2 = $('#expense').val();
		var description2 = $('#description').val();
		var status = $('#status').val();
		var vat = $(".message_pri:checked").val();
		if (!ref_no_id2) {
			alert('Ref No not yet selected');
			$('#ref_no_id').focus();
		} else if (!insurer_id2) {
			alert('Insurer not yet selected');
			$('#insurer_id').focus();
		} else if (!currency_id2) {
			alert('Currency not yet selected');
			$('#currency_id').focus();
		} else if (!expense2) {
			alert('Expense has not been filled in');
			$('#expense').focus();
		} else {
			if (confirm('Want to process this transaction?')) {
				$.ajax({
					type: "POST",
					url: "<?= site_url('official_receipt/update_action') ?>",
					data: {
						'process_update': true,
						'or_id': or_id,
						'or_no': or_no2,
						'file_id': ref_no_id2,
						'or_date': or_date2,
						'invoice_no': invoice_no2,
						'invoice_date': invoice_date2,
						'insurer_id': insurer_id2,
						'currency_id': currency_id2,
						'percentage': percentage2,
						'total_fee': fee2,
						'discount': discount2,
						'vat': vat,
						'expense': expense2,
						'status': status,
						'description': description2

					},
					dataType: "json",
					success: function(result) {
						if (result.success == true) {
							alert('Successful transaction update');
							window.location = '<?= base_url('official_receipt') ?>'
						} else {
							alert('Transaction update failed');
						}
					}

				});
			}
		}



	});
</script>

<script type="text/javascript">
	/* Tanpa Rupiah */
	var tanpa_rupiah_expense = document.getElementById('expense_text');
	tanpa_rupiah_expense.addEventListener('keyup', function(e) {
		tanpa_rupiah_expense.value = formatRupiah(this.value);
		$('#expense').val(tanpa_rupiah_expense.value.replace(/\./g, ''))
	});

	var dicount_tanpa_rupiah = document.getElementById('discount_text');
	dicount_tanpa_rupiah.addEventListener('keyup', function(e) {
		dicount_tanpa_rupiah.value = formatRupiah(this.value);
		$('#discount').val(dicount_tanpa_rupiah.value.replace(/\./g, ''))
	});

	/* Fungsi */

	function formatRupiah(angka, prefix) {
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split = number_string.split(','),
			sisa = split[0].length % 3,
			rupiah = split[0].substr(0, sisa),
			ribuan = split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
	}

	function convertToRupiah(angka) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return rupiah.split('', rupiah.length - 1).reverse().join('');
	}
</script>
