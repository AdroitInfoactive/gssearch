<?php
$page_title = "Home | GS Search";
$page_seo_title = "Home | GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header.php');
?>
<!--====== Slider PART START ======-->
<section class="slider_area_3 bg_cover d-flex align-items-center"
  style="background-image: url(<?php echo $rtpth; ?>assets/images/slider-4.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="slider_content_3 text-center">
          <h2 class="main_title">Master your <span>Thousands of
            </span> with in the Practice zone</h2>
          <div class="slider_box_wrapper d-flex flex-wrap justify-content-between">
            <div class="single_column">
              <div class="single_box">
                <img src="<?php echo $rtpth; ?>assets/images/f-icon-1.png" alt="icon">
                <p>Prelims Papers</p>
                <a href="#"></a>
              </div>
            </div>
            <div class="single_column">
              <div class="single_box">
                <img src="<?php echo $rtpth; ?>assets/images/f-icon-2.png" alt="icon">
                <p>Mains Papers</p>
                <a href="#"></a>
              </div>
            </div>
            <div class="single_column">
              <div class="single_box">
                <img src="<?php echo $rtpth; ?>assets/images/f-icon-3.png" alt="icon">
                <p>Group 1 Papers</p>
                <a href="#"></a>
              </div>
            </div>
            <div class="single_column">
              <div class="single_box">
                <img src="<?php echo $rtpth; ?>assets/images/f-icon-4.png" alt="icon">
                <p>Group 2 Papers</p>
                <a href="#"></a>
              </div>
            </div>
            <div class="single_column">
              <div class="single_box">
                <img src="<?php echo $rtpth; ?>assets/images/f-icon-5.png" alt="icon">
                <p>Group 3 Papers</p>
                <a href="#"></a>
              </div>
            </div>
            <div class="single_column">
              <div class="single_box">
                <img src="<?php echo $rtpth; ?>assets/images/p-icon-6.png" alt="icon">
                <p>Group 4 Papers</p>
                <a href="#"></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--====== Slider PART ENDS ======-->
<!--====== Courses PART START ======-->
<?php
$sqry_exm_cat = "SELECT prodmnexmsm_id, prodmnexmsm_name, prodmnexmsm_desc from prodmnexms_mst
inner join addques_mst on addquesm_prodmnexmsm_id = prodmnexmsm_id where prodmnexmsm_sts='a'";
$srs_exm_cat = mysqli_query($conn, $sqry_exm_cat);
$cntrec_exm_cat = mysqli_num_rows($srs_exm_cat);
if ($cntrec_exm_cat > 0)
{ ?>
<section class="courses_area pt-120 pb-130">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="section_title text-center pb-20">
          <h3 class="main_title">Practice Zones</h3>
          <p>At Adroit, we add value and contribute to your success. If you're looking for a dynamic and
            innovative approach in maximising your organisation's communication potential, look no further
            than Adroit Infoactive Services.</p>
        </div>
      </div>
    </div>
    <div class="row">
      <?php
      while ($srow_exm_cat = mysqli_fetch_array($srs_exm_cat))
      {
        $exm_cat_id = $srow_exm_cat['prodmnexmsm_id'];
        $exm_cat_name = $srow_exm_cat['prodmnexmsm_name'];
        $exm_cat_desc = $srow_exm_cat['prodmnexmsm_desc'];
        ?>
        <div class="col-lg-3 col-sm-6">
          <div class="single_courses courses_gray mt-30">
            <div class="courses_image">
              <!-- <img src="<?php echo $rtpth; ?>assets/images/courses-2.jpg" alt="courses"> -->
            </div>
            <div class="courses_content">
              <h4 class="title"><a href="#"><?php echo $exm_cat_name; ?></a></h4>
              <p class="mt-2">
                <?php echo $exm_cat_desc; ?>
              </p>
              <div class="meta d-flex justify-content-between">
                <span><a href="#" class="w100">View</a></span>
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
      <div class="col-sm-12 mt-4">
        <p class="text-center"><a href="<?php echo $rtpth; ?>exam-categories" class="main-btn">View All</a></p>
      </div>
    </div>
  </div>
</section>
<?php
}
?>
<!--====== Courses PART ENDS ======-->
<!--====== Register PART START ======-->
<section class="register_area bg_cover"
  style="background-image: url(<?php echo $rtpth; ?>assets/images/register_bg.jpg)">
  <div class="container">
    <div class="row justify-content-center justify-content-lg-between">
      <div class="col-lg-6">
        <div class="register_countdown_content">
          <h4 class="title">Register for <br>Free <br>Test Papers</h4>
        </div>
      </div>
      <div class="col-xl-5 col-lg-5 col-md-8">
        <div class="register_form text-center">
          <div class="register_form_title">
            <h4 class="title">Register Now</h4>
          </div>
          <div class="register_form_wrapper">
            <!-- <form action="#">
              <div class="single_form">
                <input type="text" placeholder="Full Name">
              </div>
              <div class="single_form">
                <input type="text" placeholder="Your Email">
              </div>
              <div class="single_form">
                <input type="text" placeholder="Phone Number">
              </div>
              <div class="single_form">
                <textarea placeholder="Message"></textarea>
              </div> -->
              <div class="single_form">
                <button class="main-btn">Submit A Request</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--====== Register PART ENDS ======-->
<!--====== Blog PART START ======-->
<section class="blog_area pt-120 pb-130">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="section_title text-center pb-20">
          <h3 class="main_title">Year Wise Test Papers</h3>
          <p>What do you think is better to receive after each lesson: a lovely looking badge or important
            skills you can immediately put into practice.</p>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-4 col-md-7">
        <div class="single_blog mt-30">
          <div class="blog_image">
            <img src="<?php echo $rtpth; ?>assets/images/blog-1.jpg" alt="blog">
          </div>
          <div class="blog_content">
            <div class="blog_content_wrapper">
              <h4 class="blog_title"><a href="#">Mains Test 2021</a></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-7">
        <div class="single_blog mt-30">
          <div class="blog_image">
            <img src="<?php echo $rtpth; ?>assets/images/blog-2.jpg" alt="blog">
          </div>
          <div class="blog_content">
            <div class="blog_content_wrapper">
              <h4 class="blog_title"><a href="#">Groups Tests 2019</a></h4>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-7">
        <div class="single_blog mt-30">
          <div class="blog_image">
            <img src="<?php echo $rtpth; ?>assets/images/blog-3.jpg" alt="blog">
          </div>
          <div class="blog_content">
            <div class="blog_content_wrapper">
              <h4 class="blog_title"><a href="#">Prelims Tests 2018</a></h4>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--====== Blog PART ENDS ======-->
<div class="container">
  <div class="row mb-4 justify-content-center">
    <div class="col-sm-3">
      <img src="<?php echo $rtpth; ?>assets/images/ad-1.jpg">
    </div>
    <div class="col-sm-3">
      <img src="<?php echo $rtpth; ?>assets/images/ad-2.jpg">
    </div>
    <div class="col-sm-3">
      <img src="<?php echo $rtpth; ?>assets/images/ad-3.jpg">
    </div>
    <div class="col-sm-3">
      <img src="<?php echo $rtpth; ?>assets/images/ad-4.jpg">
    </div>
  </div>
</div>
<?php include('footer.php'); ?>