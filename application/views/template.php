<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<title><?= $sett_apps->nama_aplikasi ?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link href="<?= base_url() ?>assets/assets/css/vendor.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/assets/css/transparent/app.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<!-- data table -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
	<link href="<?= base_url() ?>assets/assets/plugins/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" />
	<link href="<?= base_url() ?>assets/assets/plugins/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
	<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
</head>

<body>
	<div class="app-cover"></div>
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<div id="app" class="app app-header-fixed app-sidebar-fixed">
		<div id="header" class="app-header">
			<div class="navbar-header">
				<a href="" class="navbar-brand"><span class="navbar-logo"></span> <?= $sett_apps->nama_aplikasi ?></a>
				<button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-nav">
				<div class="navbar-item navbar-form">
					<script type="text/javascript">
						function tampilkanwaktu() {
							var waktu = new Date();
							var sh = waktu.getHours() + "";
							var sm = waktu.getMinutes() + "";
							var ss = waktu.getSeconds() + "";
							document.getElementById("clock").innerHTML = (sh.length == 1 ? "0" + sh : sh) + ":" + (sm.length == 1 ? "0" + sm : sm) + ":" + (ss.length == 1 ? "0" + ss : ss);
						}
					</script>

					<body onload="tampilkanwaktu();setInterval('tampilkanwaktu()', 1000);">
						<?php
						$hari = date('l');
						if ($hari == "Sunday") {
							echo "Minggu";
						} elseif ($hari == "Monday") {
							echo "Senin";
						} elseif ($hari == "Tuesday") {
							echo "Selasa";
						} elseif ($hari == "Wednesday") {
							echo "Rabu";
						} elseif ($hari == "Thursday") {
							echo ("Kamis");
						} elseif ($hari == "Friday") {
							echo "Jum'at";
						} elseif ($hari == "Saturday") {
							echo "Sabtu";
						}
						?>,
						<?php
						$tgl = date('d');
						echo $tgl;
						$bulan = date('F');
						if ($bulan == "January") {
							echo " Januari ";
						} elseif ($bulan == "February") {
							echo " Februari ";
						} elseif ($bulan == "March") {
							echo " Maret ";
						} elseif ($bulan == "April") {
							echo " April ";
						} elseif ($bulan == "May") {
							echo " Mei ";
						} elseif ($bulan == "June") {
							echo " Juni ";
						} elseif ($bulan == "July") {
							echo " Juli ";
						} elseif ($bulan == "August") {
							echo " Agustus ";
						} elseif ($bulan == "September") {
							echo " September ";
						} elseif ($bulan == "October") {
							echo " Oktober ";
						} elseif ($bulan == "November") {
							echo " November ";
						} elseif ($bulan == "December") {
							echo " Desember ";
						}
						$tahun = date('Y');
						echo $tahun;
						?>
						<span id="clock"></span>
				</div>

				<div class="navbar-item dropdown">
					<a href="<?= base_url() ?>" target="_blank" class="navbar-link dropdown-toggle icon">
						<img src="<?= base_url() ?>assets/assets/image.webp" alt="Halaman Website" height="27px">
						Visit Website
					</a>
				</div>

				<div class="navbar-item navbar-user dropdown">
					<a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
						<?php
						$data_img = $this->fungsi->user_login()->photo;
						?>
						<img src="<?= base_url() ?>assets/assets/img/user/<?= $data_img ?>" alt="" />
						<span>
							<span class="d-none d-md-inline"><?= ucfirst($this->fungsi->user_login()->username) ?></span>
							<b class="caret"></b>
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-end me-1">
						<a href="<?= base_url() ?>User/edit_profile" class="dropdown-item">Edit Profile</a>
						<div class="dropdown-divider"></div>
						<a href="<?= base_url() ?>Auth/logout" class="dropdown-item">Log Out</a>
					</div>
				</div>
			</div>
		</div>


		<div id="sidebar" class="app-sidebar">

			<div class="app-sidebar-content" data-scrollbar="true" data-height="100%">

				<div class="menu">
					<div class="menu-profile">
						<a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
							<div class="menu-profile-cover with-shadow"></div>
							<div class="menu-profile-image">
								<img src="<?= base_url() ?>assets/assets/img/user/<?= $this->fungsi->user_login()->photo ?>" alt="" />
							</div>
							<div class="menu-profile-info">
								<div class="d-flex align-items-center">
									<div class="flex-grow-1">
										<?= ucfirst($this->fungsi->user_login()->nama_user) ?>
									</div>
								</div>
								<small><?= ucfirst($this->fungsi->user_login()->email) ?></small>
							</div>
						</a>
					</div>

					<div class="menu-header">Navigation</div>
					<div class="menu-item">
						<a href="<?= base_url() ?>Dashboard" class="menu-link">
							<div class="menu-icon">
								<i class="fa fa-home"></i>
							</div>
							<div class="menu-text">Dashboard</div>
						</a>
					</div>
					<?php
					$session_level_id = $this->fungsi->user_login()->level_id;
					$queryMenu = "SELECT `user_access_menu`.`user_access_menu_id`,`level_id`,`menu`.`menu`,`menu`.`icon`,`menu`.`menu_id` as menu_id
            FROM `user_access_menu` JOIN `sub_menu` 
              ON `user_access_menu`.`sub_menu_id` = `sub_menu`.`sub_menu_id`
              JOIN `menu` 
              ON `menu`.`menu_id` = `sub_menu`.`menu_id`
           WHERE `user_access_menu`.`level_id` = $session_level_id
           GROUP BY `menu`.`menu_id`
              ORDER BY `menu`.`urutan` ASC";
					$menu = $this->db->query($queryMenu)->result_array();
					?>
					<?php foreach ($menu as $m) : ?>
						<div class="menu-item has-sub">
							<a href="javascript:;" class="menu-link">
								<div class="menu-icon">
									<i class="<?= $m['icon'] ?>"></i>
								</div>

								<div class="menu-text"><?= $m['menu'] ?></div>
								<div class="menu-caret"></div>
							</a>
							<div class="menu-submenu">
								<div class="menu-item">
									<?php
									$menuId = $m['menu_id'];
									$querySubMenu = "SELECT `user_access_menu`.`level_id`,`user_access_menu`.`sub_menu_id`,`sub_menu`.*
	                FROM `user_access_menu` JOIN `sub_menu` 
	                  ON `user_access_menu`.`sub_menu_id` = `sub_menu`.`sub_menu_id`
	               WHERE `sub_menu`.`menu_id` = $menuId
	               AND `user_access_menu`.`level_id` = $session_level_id order by nama_sub_menu ASC
	               ";
									$subMenu = $this->db->query($querySubMenu)->result_array();
									?>
									<?php foreach ($subMenu as $sm) : ?>
										<a href="<?= base_url($sm['url']) ?>" class="menu-link">
											<div class="menu-text"><?= $sm['nama_sub_menu'] ?></div>
										</a>
									<?php endforeach; ?>

								</div>
							</div>
						</div>

					<?php endforeach ?>

					<div class="menu-item d-flex">
						<a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
					</div>

				</div>

			</div>

		</div>
		<div class="app-sidebar-bg"></div>
		<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
		<div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
		<?php if ($this->session->flashdata('message')) : ?>
		<?php endif; ?>

		<div class="flash-data2" data-flashdata2="<?= $this->session->flashdata('error'); ?>"></div>
		<?php if ($this->session->flashdata('error')) : ?>
		<?php endif; ?>

		<?php echo $contents ?>
		<script src="<?= base_url() ?>assets/assets/js/vendor.min.js" type="beba54df5f87d24c2458d535-text/javascript"></script>
		<script src="<?= base_url() ?>assets/assets/js/app.min.js" type="beba54df5f87d24c2458d535-text/javascript"></script>
		<script src="<?= base_url() ?>assets/assets/js/rocket-loader.min.js" data-cf-settings="beba54df5f87d24c2458d535-|49" defer=""></script>
		<script src="<?= base_url() ?>assets/assets/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
		<script src="<?= base_url() ?>assets/assets/plugins/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
		<script src="<?= base_url() ?>assets/assets/plugins/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
		<script src="<?= base_url() ?>assets/assets/plugins/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/sweetalert.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/assets/js/sweetalert.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> <!-- untuk sweet alret -->
		<script src="<?php echo base_url(); ?>assets/assets/js/dataflash.js"></script>
</body>

</html>

<script>
	//datatable
	$('#data-table-default').DataTable({
		responsive: true,
		
	});
	$('#data-table-default2').DataTable({
		responsive: true
	});

	$('#table-no-att').DataTable({
		responsive: true,
		"searching": false,
		"lengthChange": false,
		"paging":   false,
        "ordering": false,
        "info":     false
	});
</script>

