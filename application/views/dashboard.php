<div id="content" class="app-content">
	<div class="row">
		<div class="row mt-4">
			<div class="col-md-6">
			<form action="<?= base_url() ?>dashboard" method="GET">
				<div class="row form-group">
					<div class="col-md-4 mb-1">
						<label class="form-label" for="start_date">Start Date</label>

						<div class="input-group mb-3">
							<input required  <?php if (isset($_GET['start_date'])) { ?> value="<?= $_GET['start_date'] ?>" <?php } ?> class="form-control" type="date" id="start_date" name="start_date" placeholder="start_date">
						</div>
					</div>
					<div class="col-md-4 mb-1">
						<label class="form-label" for="end_date">End Date</label>
						<div class="input-group mb-3">
							<input required <?php if (isset($_GET['end_date'])) { ?> value="<?= $_GET['end_date'] ?>" <?php } ?> class="form-control" type="date" id="end_date" name="end_date" placeholder="end_date">
						</div>
					</div>
					<div class="col-md-4 mb-1">
						<label class="form-label" for="filter" style="opacity: 0;">.</label>
						<div class="input-group mb-3">
						<button type="submit" class="btn btn-primary">Filter</button>&nbsp;
						
						<?php if (isset($_GET['start_date'])) { ?>
							<a href="<?= base_url() ?>dashboard" type="submit" class="btn btn-warning">Reset</a>
						<?php } ?>
						</div>
					</div>
				</div>
			</form>
			</div>
		</div>

		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-gradient-cyan-blue">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-flag-checkered"></i></div>
				<div class="stats-content">
					<div class="stats-title">RECEIVING</div>
					<div class="stats-number"><?= $receiving ?> FILE</div>
					<div class="stats-progress progress">
						<div class="progress-bar" style="width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-gradient-indigo">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-spinner"></i></div>
				<div class="stats-content">
					<div class="stats-title">OUTSTANDING</div>
					<div class="stats-number"><?= $outstanding ?> FILE</div>
					<div class="stats-progress progress">
						<div class="progress-bar" style="width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-gradient-green">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-check"></i></div>
				<div class="stats-content">
					<div class="stats-title">PAID PAYMENT</div>
					<div class="stats-number"><?= $paid ?> OR</div>
					<div class="stats-progress progress">
						<div class="progress-bar" style="width: 100%"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-md-6">
			<div class="widget widget-stats bg-gradient-orange-red">
				<div class="stats-icon stats-icon-lg"><i class="fa fa-times"></i></div>
				<div class="stats-content">
					<div class="stats-title">UNPAID PAYMENT</div>
					<div class="stats-number"><?= $unpaid ?> OR</div>
					<div class="stats-progress progress">
						<div class="progress-bar" style="width: 100%;"></div>
					</div>
				</div>
			</div>
		</div>
		<center><img src="<?= base_url() ?>assets/load.png" style="width: 60%;margin-top:10px;opacity: 0.2;" alt="Logo PT Japenansi Nusantara">
		</center>

	</div>

</div>

<script type="text/javascript">
	function autoplay() {
		var r = true;
		if (r == true) {
			document.getElementById("audio").play();
		}
	}
</script>
