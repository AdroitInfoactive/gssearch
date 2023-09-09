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
$page_title ="My Account";
$page_seo_title ="My Account | GS Search";
$db_seokywrd ="";
$db_seodesc ="";
$current_page ="myaccount";
$body_class ="myaccount";
include('header.php');
?>

    

<section class="page_banner bg_cover" style="background-image: url(<?php echo $rtpth;?>assets/images/about_bg.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="banner_content text-center">
                        <h4 class="title"><?php echo $page_title;?></h4>
                        <ul class="breadcrumb justify-content-center">
                            <li><a href="#">Home</a></li>
                            <li><a class="active" href="#"><?php echo $page_title;?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="about_area pt-80">
        <div class="container">
            <div class="row justify-content-center">
               
                
                <div class="col-lg-8 col-sm-8 pr-md-5">
                  
            
            
            <div class="card">
            <div class="card-body">
            <div class="alert alert-primary" role="alert">
 <strong>Name: </strong> This is a primary alert—check it out!
</div>

<div class="alert alert-primary" role="alert">
 <strong>Email: </strong> This is a primary alert—check it out!
</div>

<div class="alert alert-primary" role="alert">
 <strong>Phone: </strong> This is a primary alert—check it out!
</div>


<p class="text-center"><a href="#" class="main-btn">Edit</a></p>
            </div>
            </div>
                    
                    
        </div>
        
        <div class="col-sm-4">
        <div class="courses_details_sidebar">
                        <div class="courses_sidebar_image">
                            <img src="assets/images/courses-details.jpg" alt="courses details">
                            <div class="price">
                                <div class="price_wrapper">
                                    <p>Yearly</p>
                                    <span>$99</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="courses_sidebar_title">
                            <h4 class="title">Subscription Details</h4>
                        </div>
                        <div class="courses_sidebar_list">
                            <ul class="list">
                                <li><i class="fa fa-clock-o"></i> Subscription Date <span>2 Sep 2023</span></li>
                                <li><i class="fa fa-clock-o"></i> Subscription End Date<span>23</span></li>
                                <li><i class="fa fa-puzzle-piece"></i> Status<span>Active</span></li>
                               
                            </ul>
                             <a class="main-btn btn-block" href="#">Buy Now</a>
                        </div>
                        
                        
                    </div>
        </div>
        
    </section>


    
    
    <?php include('footer.php');?>
	




<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
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
		links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
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
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>