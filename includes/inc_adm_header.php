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
					<img src="<?php echo $rtpth; ?>assets/images/logo.png" class="elevation-2" alt="G S Search"
						style="background-color: white">
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
								<!-- <li class="nav-item">
									<a href="view_all_banner.php" class="nav-link <?php if ($pagenm == "Banner") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p> Banner</p>
									</a>
								</li> -->
								<!-- <li class="nav-item">
									<a href="vw_all_abtus.php" class="nav-link <?php if ($pagenm == "About Us") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p> About Us</p>
									</a>
								</li> -->
								<li class="nav-item">
									<a href="view_users.php" class="nav-link <?php if ($pagenm == "users") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Users</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_main_category.php" class="nav-link <?php if ($pagenm == "Exam Category") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Exam Category</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_exam_subcategory.php" class="nav-link <?php if ($pagenm == "Exam Subcategory") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Exam Subcategory</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="view_exam_type.php" class="nav-link <?php if ($pagenm == "Exam Type") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Exam Type</p>
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
									<a href="view_subscription_amt.php" class="nav-link <?php if ($pagenm == "Subscription") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Subscription</p>
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
									<a href="view_srchlmts.php" class="nav-link <?php if ($pagenm == "Search") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Search Limitations</p>
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

							</ul>
						</li>
						<!-- <li class="nav-item">
									<a href="view_all_stdtestmnl.php" class="nav-link <?php if ($pagenm == "student testmonials") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Student Testmonials</p>
									</a>
								</li> -->
						<li class="nav-item">
									<a href="view_all_advertisement.php" class="nav-link <?php if ($pagenm == "advertisement") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Advertisement</p>
									</a>
								</li>
						<li class="nav-item">
									<a href="view_all_members.php" class="nav-link <?php if ($pagenm == "Members") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Members</p>
									</a>
								</li>
						<li class="nav-item has-treeview <?php if ($pagemncat == "Questions") {
							echo "menu-open";
						} ?>">
							<a href="#" class="nav-link">
								<i class="nav-icon fas fa-circle"></i>
								<p>Questions<i class="right fas fa-angle-left"></i></p>
							</a>
							<ul class="nav nav-treeview <?php if ($pagemncat == "Questions") {
								echo "menu-open";
							} ?>">
								<li class="nav-item">
									<a href="view_questions.php" class="nav-link <?php if ($pagenm == "Questions") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Add Questions</p>
									</a>
								</li>
								<li class="nav-item">
									<a href="add_blkqns.php" class="nav-link <?php if ($pagenm == "Question Bulk Upload") {
										echo "active";
									} ?>">
										<i class="far fa-dot-circle nav-icon"></i>
										<p>Question Bulk Upload</p>
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


					</ul>
				</nav>
				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<div class="content-wrapper">