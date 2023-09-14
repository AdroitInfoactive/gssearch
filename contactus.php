<?php
$page_title ="Contact Us";
$page_seo_title ="Contact Us | GS Search";
$db_seokywrd ="";
$db_seodesc ="";
$current_page ="home";
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



       <section class="contact_area pt-80 pb-130">
        <div class="services_shape_1" style="background-image: url(assets/images/shape/shape-12.html)"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact_form mt-40">                        
                        
                        <div class="row">
                            <div class="col-lg-10">
                                <div class="section_title pb-30">
                                    <h3 class="main_title">Get in touch</h3>
                                    <p>What do you think is better to receive after each lesson: a lovely looking badge or important skills you can immediately put into practice.</p>
                                </div>
                            </div>
                        </div>
                        
                        <form action="https://raistheme.com/html/edustdy/edustdy/contact.php" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="text" placeholder="Name">
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="email" placeholder="Email">
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="text" placeholder="Subject">
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="text" placeholder="Number">
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="single_form">
                                        <textarea placeholder="Massage"></textarea>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="single_form">
                                        <button class="main-btn">Send Massage</button>
                                    </div> <!-- single form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- contact form -->
                </div>
                <div class="col-lg-4">
                    <div class="contact_info pt-20">
                        <ul>
                            
                            <li>
                                <div class="single_info d-flex align-items-center mt-30">
                                    <div class="info_icon">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="info_content media-body">
                                        <p>+91 9177 666 963</p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                            <li>
                                <div class="single_info d-flex align-items-center mt-30">
                                    <div class="info_icon">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    <div class="info_content media-body">
                                        <p>info@gssearch.in</p>
                                    </div>
                                </div> <!-- single info -->
                            </li>
                        </ul>
                    </div> <!-- contact info -->
                    <?php /*?><div class="contact_map mt-50">
                        <div class="gmap_canvas">                            
                            <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Mission%20District%2C%20San%20Francisco%2C%20CA%2C%20USA&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                        </div>
                    </div><?php */?> <!-- contact map -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
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