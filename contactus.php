<?php
            include_once 'includes/inc_nocache.php'; // Clearing the cache information
            include_once 'includes/inc_connection.php';//Make connection with the database  	
            include_once "includes/inc_config.php";	//path config file
		    include_once "includes/inc_usr_functions.php";//Including user session value
$page_title ="Contact Us";
$page_seo_title ="Contact Us | GS Search";
$db_seokywrd ="";
$db_seodesc ="";
$current_page ="home";
$body_class ="homepage";

    // echo"<pre>";
    // var_dump($_POST);
    // echo"</pre>";
    // exit;
if(isset($_POST['btncntfrm']) && ($_POST['btncntfrm'] != "") &&
isset($_POST['txtname']) && ($_POST['txtname'] != ""))
       {

		    $name     = glb_func_chkvl($_POST['txtname']); 
			$email     = glb_func_chkvl($_POST['txtemail']);
			$phone    = glb_func_chkvl($_POST['textnum']);
      $subject   = glb_func_chkvl($_POST['textsubj']);
        $msg    = glb_func_chkvl($_POST['textmsg']);
        // $msg    = glb_func_chkvl($_POST['txtdesc']);
       
			
       $body = "<table width='60%' border='0' align='center' cellpadding='3' cellspacing='2'>
       <tr>	
       <td colspan='3' align='center'><h1>GS Search Contact Form</h1></td>
       </tr>	
       <tr>	
       <td  bgcolor='#F0F0F0'>Name*</td>
       <td  bgcolor='#F0F0F0'>:</td>				
       <td  bgcolor='#F0F0F0'>".$name."</td>
       </tr>				  	
       <tr>
       <td bgcolor='#F5F5F5'>Email*</td>
       <td bgcolor='#F5F5F5'>:</td>
       <td bgcolor='#F5F5F5'>".$email."</td>
       </tr>	
       <tr>
       <td bgcolor='#F0F0F0'>Phone*</td>
       <td bgcolor='#F0F0F0'>:</td>						
       <td bgcolor='#F0F0F0'>".$phone."</td>
       </tr>
       <tr>
       <td bgcolor='#F0F0F0'>Subject *</td>
       <td bgcolor='#F0F0F0'>:</td>
       <td bgcolor='#F0F0F0'>". $subject."</td>
       </tr>
       <td bgcolor='#F0F0F0'>Message*</td>
       <td bgcolor='#F0F0F0'>:</td>
       <td bgcolor='#F0F0F0'>$msg</td>
       </tr>	
       </table>";	
// echo $body;exit;
                            
							$fromemail = $u_prjct_email;
							$to = $u_prjct_email;
							$headers = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
							$headers .= "From: $fromemail" . "\r\n";
							$subject = "Contact Form";
							if (mail($to, $subject, $body, $headers))
							{?>
						
								<script>
								location.href='thankyou.php';
							</script>
							
							<?php 	}
							else
							{?>
						
								<script>
								location.href='error';
							</script>
							
							<?php
                          
							}
      }   
    //   else{
    //     echo"here1"; 
    //   } 
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
    <script src="<?php echo $rtpth; ?>assets/js/main.js"></script>
<script src="<?php echo $rtpth; ?>includes/yav.js" type="text/javascript"></script>
<script src="<?php echo $rtpth; ?>includes/yav-config.js" type="text/javascript"></script>
    <script type="text/javascript">
    
    var rules = new Array();
  rules[0] = 'txtname|required|Enter Your Full Name';
  rules[1] = 'txtemail:Email|required|Enter Email Id';
  rules[2] = 'txtemail:Email|email|Enter Your Valid Email Id';
  rules[3] = 'textsubj|required|Enter Your Subject';
  rules[4] = 'textnum|required|Enter Your Mobile Number';
  rules[5] = 'textnum|numeric|Enter Your Valid Mobile Number';
  rules[6] = 'textmsg|required|Enter Your Message';  
  </script>


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
                                    <p>For any queries / suggestions / feedback, Please fill the below form our team will get back to you.</p>
                                </div>
                            </div>
                        </div>
                        
                        <form name="frmcntct" id="frmcntct" method="POST" action="" onsubmit="return performCheck('frmcntct', rules,'inline');">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="text" name="txtname" id="txtname" placeholder="Name">
                                        <span id="errorsDiv_txtname" style="color: red;"></span>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="text" name="txtemail" id="txtemail" placeholder="Email">
                                        <span id="errorsDiv_txtemail" style="color: red;"></span>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="text" name="textsubj" id="textsubj" placeholder="Subject">
                                        <span id="errorsDiv_textsubj" style="color: red;"></span>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single_form">
                                        <input type="text" name="textnum" id="textnum" placeholder="Number">
                                        <span id="errorsDiv_textnum" style="color: red;"></span>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="single_form">
                                        <textarea name="textmsg" id="textmsg" placeholder="Message"></textarea>
                                        <span id="errorsDiv_textmsg" style="color: red;"></span>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="single_form">
                                        <input type="submit" name="btncntfrm" id="btncntfrm" class="main-btn" value="Send Message" >
                                        <!-- <input class="btn btn-gradient big-btn" type="submit" name="btnfedenq" id="btnfedenq" value="Send message"> -->

                                        <!-- <button class="main-btn">Send Massage</button> -->

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
