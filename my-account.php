<?php
error_reporting(0);
session_start();
$servr_ip = $_SERVER['SERVER_ADDR'];
include_once 'includes/inc_config.php'; //Making paging validation	
include_once $inc_user_cnctn; //Making database Connection
include_once $inc_user_usr_fnctn; //checking for session	
include_once $inc_user_fldr_pth;
include_once $rtpth . "script.php";
include_once $rtpth . "includes/inc_fnct_ajax_validation.php";
include_once $inc_mbr_sess;
$page_title = "My Account";
$page_seo_title = "My Account | GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "myaccount";
$body_class = "myaccount";
include('header.php');
$membrid = $_SESSION['sesmbrid'];
?>



<section class="page_banner bg_cover" style="background-image: url(<?php echo $rtpth; ?>assets/images/about_bg.jpg)">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="banner_content text-center">
					<h4 class="title"><?php echo $page_title; ?></h4>
					<ul class="breadcrumb justify-content-center">
						<li><a href="<?php echo $rtpth; ?>">Home</a></li>
						<li><a class="active" href="#"><?php echo $page_title; ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
$sqrymbr = "SELECT mbrm_name,mbrm_emailid,mbrm_mobile,mbrm_sts from mbr_mst where mbrm_id='$membrid' and mbrm_sts='a' ";
$res = mysqli_query($conn, $sqrymbr);
$count = mysqli_num_rows($res);
$result_mbr = mysqli_fetch_assoc($res);
$name = $result_mbr['mbrm_name'];
$email = $result_mbr['mbrm_emailid'];
$mobile = $result_mbr['mbrm_mobile'];

?>


<section class="about_area pt-80">
	<div class="container">
		<div class="row justify-content-center">


			<div class="col-lg-8 col-sm-8 pr-md-5">
				<div class="card">
					<div class="card-body">
						<div class="alert alert-primary" role="alert">
							<strong>Name: </strong> <?php echo $name; ?>
						</div>
						<div class="alert alert-primary" role="alert">
							<strong>Email: </strong> <?php echo $email; ?>
						</div>
						<div class="alert alert-primary" role="alert">
							<strong>Phone: </strong> <?php echo $mobile; ?>
						</div>
						<p class="text-center"><a href="#" class="main-btn" data-toggle="modal" data-target="#editusrDetail">Edit</a></p>
					</div>
				</div>
			</div>

			<div class="col-sm-4">
				<div class="courses_details_sidebar">
					<div class="courses_sidebar_image">
						<img src="assets/images/courses-details.jpg" alt="courses details">
						<?php
						$sqrysubamt = "SELECT subscrptnm_amt_id,subscrptnm_amt_name,subscrptnm_amt_sts from subscrptn_amt_mst where subscrptnm_amt_sts='a'";
						$ressubamt = mysqli_query($conn, $sqrysubamt);
						$count1 = mysqli_num_rows($ressubamt);
						$result_sub_amt = mysqli_fetch_assoc($ressubamt);
						$amt = $result_sub_amt['subscrptnm_amt_name'];
						?>
						<div class="price">
							<div class="price_wrapper">
								<p>Yearly</p>
								<span>₹ <?php echo $amt; ?></span>
							</div>
						</div>

					</div>
					<div class="courses_sidebar_title">
						<h4 class="title">Subscription Details</h4>
					</div>
					<?php
					$dt = date("Y-m-d");
					$CurrMonth  = date("n");

					$sqrysubamt_dtl = "SELECT mbrd_sbcr_id,mbrd_sbcr_mbrm_id,mbrd_sbcr_amt_id,mbrd_sbcr_paidon,mbrd_sbcr_endon,
					DATE_format(mbrd_sbcr_endon, '%D %M %Y') as eddate,
					DATE_format(mbrd_sbcr_paidon, '%D %M %Y') as stdate,
					DATE_format(mbrd_sbcr_paidon, '%d') as stdt,
					DATE_format(mbrd_sbcr_paidon, '%b') as stmnth,
					DATE_format(mbrd_sbcr_paidon, '%Y') as styr,
					DATE_format(mbrd_sbcr_endon, '%d') as endt,
					DATE_format(mbrd_sbcr_endon, '%b ') as enmnth,
					DATE_format(mbrd_sbcr_endon, '%Y ') as enyr
					from  mbr_sbcr_dtl where mbrd_sbcr_mbrm_id='$membrid' and (mbrd_sbcr_endon >= '$dt') ";
					$ressubamt_dtl = mysqli_query($conn, $sqrysubamt_dtl);
					$count2 = mysqli_num_rows($ressubamt_dtl);
					$result_sub_amt = mysqli_fetch_assoc($ressubamt_dtl);
					$stdt = $result_sub_amt['stdate'];
					$endt = $result_sub_amt['endt'];
					$strt_mn = $result_sub_amt['stmnth'];
					$str_dt = $result_sub_amt['stdt'];
					$strt_yr = $result_sub_amt['styr'];
					$end_mt = $result_sub_amt['enmnth'];
					$end_yr = $result_sub_amt['enyr'];

					$end_dt = $result_sub_amt['mbrd_sbcr_endon'];
					if ($dt <= $end_dt) {
						$sts = "Active";
					} else {
						$sts = "Inactive";
					}
					?>
					<div class="courses_sidebar_list">
						<ul class="list">
							<li><i class="fa fa-clock-o"></i> Subscription Date<span>
									<?php if ($sts == 'Active') {
									echo $str_dt . ' ' . $strt_mn . ' ' . $strt_yr;
									} else {
										echo "NA";
									}
									?>
								</span>

							</li>
							<li><i class="fa fa-clock-o"></i> Subscription End<span>
							<?php if ($sts == 'Active') {
							 echo $endt . ' ' . $end_mt . ' ' . $end_yr; 
							} else {
								echo "NA";
							}
							?>
							 </span>
							</li>
							<!-- <li><i class="fa fa-clock-o"></i> Subscription End Date<span><?php echo $endt; ?></span></li> -->
							<li><i class="fa fa-puzzle-piece"></i> Status<span><?php echo $sts; ?></span></li>

						</ul>
						<?php
						if ($sts == "Active") {
						?>
							<!-- <a class="main-btn btn-block" style="cursor: none;" href="#">Buy Now</a> -->
						<?php
						} else {
						?>
							<a class="main-btn btn-block"  href="<?php echo $rtpth;?>razorpay/pay.php">Buy Now</a>
						<?php
						}
						?>

					</div>


				</div>
			</div>

</section>




<?php include('footer.php'); ?>





<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>


<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
	$(function() {
		var Accordion = function(el, multiple) {
			this.el = el || {};
			this.multiple = multiple || false;

			// Variables privadas
			var links = this.el.find('.link');
			// Evento
			links.on('click', {
				el: this.el,
				multiple: this.multiple
			}, this.dropdown)
		}

		Accordion.prototype.dropdown = function(e) {
			var $el = e.data.el;
			$this = $(this),
				$next = $this.next();

			$next.slideToggle();
			$this.parent().toggleClass('open');

			if (!e.data.multiple) {
				$el.find('.submenu').not($next).slideUp().parent().removeClass('open');
			};
		}

		var accordion = new Accordion($('#accordion'), false);
		var accordion = new Accordion($('#accordion2'), false);
	});
</script>

<script type="text/javascript">
	var _gaq = _gaq || [];
	_gaq.push(['_setAccount', 'UA-36251023-1']);
	_gaq.push(['_setDomainName', 'jqueryscript.net']);
	_gaq.push(['_trackPageview']);

	(function() {
		var ga = document.createElement('script');
		ga.type = 'text/javascript';
		ga.async = true;
		ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(ga, s);
	})();
</script>