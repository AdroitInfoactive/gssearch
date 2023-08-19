<?php
include_once '../includes/inc_connection.php';
// echo"here"; exit;
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>
		<?php echo $pgtl; ?>
	</title>
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->
		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex">
				<div class="image">
					<img src="<?php echo $rtpth; ?>assets/images/logos/ihm-logo-main.png" class="elevation-2"
						alt="G S Search" style="background-color: white">
				</div>
				<div class="info">
					<a href="#" class="d-block"></a>
				</div>
			</div>
			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user panel (optional) -->
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
						<li class="nav-item has-treeview menu-open">
							<a href="./main.php" class="nav-link active">
								<i class="nav-icon fas fa-tachometer-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<!-- Setup Menu start -->
						<li class="nav-item has-treeview <?php if ($pagemncat == "Setup") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Setup<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Setup") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_all_banner.php" class="nav-link <?php if ($pagenm == "Banner") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p> Banner</p>
									</a>
								</li>
								<!-- <li class="nav-item">
									<a href="vw_all_abtus.php" class="nav-link <?php if ($pagenm == "About Us") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p> About Us</p>
									</a>
								</li> -->
								<li class="nav-item">
									<a href="view_main_category.php" class="nav-link <?php if ($pagenm == "Exam Category") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Exam Category</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_years.php" class="nav-link <?php if ($pagenm == "years") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Years</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_topics.php" class="nav-link <?php if ($pagenm == "topics") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Topics</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_subtopics.php" class="nav-link <?php if ($pagenm == "subtopics") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Sub Topics</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_questions.php" class="nav-link <?php if ($pagenm == "Add Questions") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Add Questions</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_product_category.php" class="nav-link <?php if ($pagenm == "Category") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Category</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_product_subcategory.php" class="nav-link <?php if ($pagenm == "Subcategory") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Subcategory</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_all_news.php" class="nav-link <?php if ($pagenm == "Updates / Notifications") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Updates / Notifications</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_all_stdtestmnl.php" class="nav-link <?php if ($pagenm == "Student Testimonial") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Student Testimonial</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="product.php" class="nav-link <?php if ($pagenm == "Downloads Category") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Downloads Category</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_downloads.php" class="nav-link <?php if ($pagenm == "Downloads") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p> Downloads</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="vw_all_achievements.php" class="nav-link <?php if ($pagenm == "Achievements") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p> Achievements</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview <?php if ($pagemncat == "Regular Courses") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Regular Courses<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Regular Courses") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_all_grad_typ.php" class="nav-link <?php if ($pagenm == "Graduation Type") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Graduation Type</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_Courses.php" class="nav-link <?php if ($pagenm == "Courses") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Courses</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview <?php if ($pagemncat == "Executive Programs") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Executive Programs<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Executive Programs") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_all_exect_cat.php" class="nav-link <?php if ($pagenm == "Executive Category") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Executive Category</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_all_exect_scat.php" class="nav-link <?php if ($pagenm == "Executive Sub Category") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Executive Sub Category</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_all_exect_prog.php" class="nav-link <?php if ($pagenm == "Executive Programs") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Executive Programs</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item">
							<a href="view_all_events.php" class="nav-link <?php if ($pagenm == "Events") {
								echo "active";
							} ?>">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>News / Events</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="view_all_prtnr.php" class="nav-link <?php if ($pagenm == "Partners") {
								echo "active";
							} ?>">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>Partners</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="view_all_bod.php" class="nav-link <?php if ($pagenm == "BoD") {
								echo "active";
							} ?>">
								<i class="far fa-dot-circle nav-icon"></i>
								<p>BoD & MoT</p>
							</a>
						</li>
						<!-- End setup cat -->
						<!-- Start Placement menu -->
						<!-- <li class="nav-item has-treeview <?php if ($pagemncat == "Placements") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Placements<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Placements") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_all_placement_highlights.php" class="nav-link <?php if ($pagenm == "Placement Higilights") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Placement Higilights</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_all_recruiters.php" class="nav-link <?php if ($pagenm == "Recruiters/Recognitions") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Recruiters/Recognitions</p>
									</a>
								</li>
							</ul>
						</li> -->
						<!-- End Placement menu -->
						<!-- Start Gallery menu -->
						<li class="nav-item has-treeview <?php if ($pagemncat == "Gallery") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Gallery<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Gallery") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_all_photocategory.php" class="nav-link <?php if ($pagenm == "Category") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Category</p>
									</a>
								</li>
								<li class="nav-item has-treeview <?php if ($pagenm == "Photos") {
									echo "menu-open";
								} ?>">
									<a href="view_all_photogallery.php" class="nav-link ">
										<i class="far fa-circle nav-icon"></i>
										<p>Photos</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_all_videogallery.php" class="nav-link <?php if ($pagenm == "Videos") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Videos</p>
									</a>
								</li>

							</ul>
						</li>
						<!-- End Gallery menu -->
						<!-- Start Award menu -->
						<!-- <li class="nav-item has-treeview <?php if ($pagemncat == "Awards") {
							echo "menu-open";
						} ?>">
														<a href="#" class="nav-link">
																<i class="nav-icon fas fa-circle"></i>
																<p>Awards<i class="right fas fa-angle-left"></i></p>
														</a>
														<ul class="nav nav-treeview <?php if ($pagemncat == "Awards") {
															echo "menu-open";
														} ?>">
																<li class="nav-item">
																		<a href="stock_purchase.php" class="nav-link <?php if ($pagenm == "Awards Category") {
																			echo "active";
																		} ?>">
																				<i class="far fa-dot-circle nav-icon"></i>
																				<p>Awards Category</p>
																		</a>
																</li>
																<li class="nav-item">
																		<a href="stock_purchase.php" class="nav-link <?php if ($pagenm == " Awards Gallery") {
																			echo "active";
																		} ?>">
																				<i class="far fa-dot-circle nav-icon"></i>
																				<p>Awards Gallery</p>
																		</a>
																</li>
														</ul>
												</li> -->
						<!-- End awards menu -->
						<!-- Start Page content -->
						<li class="nav-item has-treeview <?php if ($pagemncat == "Enquiries") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Enquiries<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Enquiries") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_all_crsenqry_mst.php" class="nav-link <?php if ($pagenm == "Course Enquiries") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Courses Enquiries</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_all_progenqry_mst.php" class="nav-link <?php if ($pagenm == "Program Enquiries") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p> Program Enquiries</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview <?php if ($pagemncat == "Page Content") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Page Content<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Page Content") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_all_pagecontain.php" class="nav-link <?php if ($pagenm == "Page Contents") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Page Contents</p>
									</a>
								</li>
							</ul>
						</li>
						<!-- end Page content -->




						<!-- My Account start -->

						<li class="nav-item has-treeview">
							<a href="#" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>
									My&nbsp;Account
									<i class="right fas fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item">
									<a href="change_password.php" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Change Password</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="logout.php" class="nav-link">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Logout</p>
									</a>
								</li>

							</ul>
						</li>
						<!-- My Account Ends -->
						<!-- Size Grid -->
						<!-- <li class="nav-item has-treeview">
														<a href="size-grid.php" class="nav-link">
																<i class="far fa-circle nav-icon"></i>
																<p>
																		Size Grid
																		<i class="right fas fa-angle-left"></i>
																</p>
														</a>
												</li> -->
						<!-- Sixe Grid End -->

					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->

			<!-- /.content-header -->