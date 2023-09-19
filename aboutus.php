<?php
$page_title ="About Us";
$page_seo_title ="About Us | GS Search";
$db_seokywrd ="";
$db_seodesc ="";
$current_page ="aboutus";
$body_class ="homepage";
include('header.php');
?>

    

<section class="page_banner bg_cover" style="background-image: url(assets/images/about_bg.jpg)">
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
        <img class="shap_1" src="assets/images/shape/shape-1.png" alt="shape">
        <img class="shap_2" src="assets/images/shape/shape-2.png" alt="shape">
        <img class="shap_3" src="assets/images/shape/shape-3.png" alt="shape">
        <img class="shap_4" src="assets/images/shape/shape-4.png" alt="shape">
        
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about_content mt-45">
                        <h3 class="about_title">About Us</h3>
                        <p>Mastering your exam strategy is crucial. GSSEARCH Analyzes past exam data, such as previous question patterns and topics, It helps you tailor your study plan effectively and increase your chances of success. It's a valuable tool for understanding the exam's structure and content, allowing you to focus your efforts where they'll have the greatest impact.</p>
 

<p>Analyzing past exam questions can provide valuable insights. By reviewing thousands of questions on a specific topic, you can identify recurring patterns and areas of emphasis in the syllabus. This targeted approach can help you prepare more effectively and increase your chances of performing well in the exam.</p>

<p>GSSEARCH empowers you to optimize your study plan and enhance your prospects for success.</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about_image mt-50">
                        <img src="assets/images/about-1.jpg" alt="about" class="about_image-1">
                        <img src="assets/images/about-2.jpg" alt="about" class="about_image-2">
                        <?php /*?><img src="assets/images/about-3.jpg" alt="about" class="about_image-3"><?php */?>
                    </div>
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