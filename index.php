<?php
$page_title = "Home | GS Search";
$page_seo_title = "Home | GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
include('header-home.php');
?>
<!--====== Slider PART START ======-->
<section class="slider_area_3 bg_cover d-flex align-items-center"
  style="background-image: url(<?php echo $rtpth; ?>assets/images/slider-4.jpg)">
  <div class="container">
    <div class="row align-items-center">
    
    
          
      <div class="col-lg-12">
        <div class="slider_content_3 text-center">
       <div class="row  justify-content-center"> <div class="col-lg-8">
            <div class="header_search" id="header_search">
              <form method="post" name="frmserqtn" id="frmserqtn" onSubmit="srch('<?php echo $membrsubsts; ?>')">
                <input type="text" placeholder="Search" name="txtsrchval" id="txtsrchval" value="<?php if (isset($_POST['txtsrchval']) && $_POST['txtsrchval'] != "") { echo $_POST['txtsrchval']; } elseif (isset($_REQUEST['txtsrchval']) && $_REQUEST['txtsrchval'] != "") { echo $_REQUEST['txtsrchval']; } ?>">
                <button id="searchbtn" type='submit'><i class="fa fa-search"></i></button>
              </form>
            </div>
            <!-- <div class="header_search" style="<?php echo $stl; ?>" id="header_search">
              <form method="post" name="frmserqtn" id="frmserqtn" onSubmit="srch('<?php echo $membrsubsts; ?>')">
                <input type="text" placeholder="Search" <?php echo $dsbld; ?> name="txtsrchval" id="txtsrchval" value="<?php if (isset($_POST['txtsrchval']) && $_POST['txtsrchval'] != "") { echo $_POST['txtsrchval']; } elseif (isset($_REQUEST['txtsrchval']) && $_REQUEST['txtsrchval'] != "") { echo $_REQUEST['txtsrchval']; } ?>">
                <button id="searchbtn" <?php echo $dsbld; ?> type='submit'><i class="fa fa-search"></i></button>
              </form>
            </div>
            <div class="error-message" id="error-message" style="display: none; color: red;">Login to enable search questions across the site</div> -->
          </div>
          </div>
          
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
$sqry_exm_cat = "SELECT count(addquesm_id) as qnscnt, prodmnexmsm_id, prodmnexmsm_name,prodmnexmsm_img, prodmnexmsm_desc, exam_subcategorym_name, yearsm_id, yearsm_name from addques_mst
inner join prodmnexms_mst on prodmnexmsm_id =  addquesm_prodmnexmsm_id
inner join exam_subcategory_mst on exam_subcategorym_id = addquesm_exmscat_id
inner join years_mst on yearsm_id = addquesm_yearsm_id
where prodmnexmsm_sts='a' group by prodmnexmsm_id order by qnscnt,yearsm_name,prodmnexmsm_name desc limit 4";
$srs_exm_cat = mysqli_query($conn, $sqry_exm_cat);
$cntrec_exm_cat = mysqli_num_rows($srs_exm_cat);
if ($cntrec_exm_cat > 0) { ?>
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
        while ($srow_exm_cat = mysqli_fetch_array($srs_exm_cat)) {
          $exm_cat_id = $srow_exm_cat['prodmnexmsm_id'];
          $exm_cat_name = $srow_exm_cat['prodmnexmsm_name'];
          $exm_cat_url = funcStrRplc($exm_cat_name);
          $exm_cat_desc = $srow_exm_cat['prodmnexmsm_desc'];
          $exm_scatnm = $srow_exm_cat['exam_subcategorym_name'];
          $exm_scatnm_url = funcStrRplc($exm_scatnm);
          $exm_yr = $srow_exm_cat['yearsm_name'];
          $exm_cat_img = $srow_exm_cat['prodmnexmsm_img'];
          $path=$u_mnlnks_bnrfldnm.$exm_cat_img;
          if($exm_cat_img!=''&&file_exists($path)){
            $image=$rtpth.$path;
          }
          else{
            $image=$rtpth.'exm_cat_img/default.jpg';
          }
          ?>
          <div class="col-lg-3 col-sm-6">
            <div class="single_courses courses_gray mt-30">
              <div class="courses_image">
                <!-- <img src="<?php echo $rtpth; ?>assets/images/courses-2.jpg" alt="courses"> -->
                <img src="<?php echo $image ?>" alt="courses">
              </div>
              <div class="courses_content">
                <h4 class="title"><a href="<?php echo $rtpth . $exm_cat_url."/".$exm_scatnm_url."/".$exm_yr; ?>"><?php echo $exm_cat_name; ?></a></h4>
                <p class="mt-2">
                  <?php echo $exm_cat_desc; ?>
                </p>
                <div class="meta d-flex justify-content-between">
                  <span><a href="<?php echo $rtpth . $exm_cat_url . "/" . $exm_scatnm_url . "/" . $exm_yr; ?>" class="w100">View</a></span>
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




<section class="testimonial_area_3">
        <div class="testimonial_title_wrapper_2 bg_cover" style="background-image: url(assets/images/testimonial_bg.jpg)">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="testimonial_title text-center">
                            <img src="assets/images/quota.png" alt="quota">
                            <h2 class="title">What Students Say</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="testimonial_title_shape">
                <img src="assets/images/shape/shape-8.png" alt="shape">
            </div>
        </div>

        <div class="testimonial_content_wrapper">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="testimonial">
                            <div class="testimonial_content_active_3">
                                <div class="single_testimonial_3 text-center">
                                    <p>I found myself working in a true partnership that results in an incredible experience, and an end product that is the best1. </p>
                                    <h5 class="author_name">Arnold Holder1</h5>
                                    <span>Student, Language1</span>
                                </div>
                                <div class="single_testimonial_3 text-center">
                                    <p>I found myself working in a true partnership that results in an incredible experience, and an end product that is the best2. </p>
                                    <h5 class="author_name">Nrnold Molder2</h5>
                                    <span>Student, Language2</span>
                                </div>
                                <div class="single_testimonial_3 text-center">
                                    <p>I found myself working in a true partnership that results in an incredible experience, and an end product that is the best3. </p>
                                    <h5 class="author_name">Hrnold Aolder3</h5>
                                    <span>Student, Language3</span>
                                </div>
                                <div class="single_testimonial_3 text-center">
                                    <p>I found myself working in a true partnership that results in an incredible experience, and an end product that is the best4. </p>
                                    <h5 class="author_name">Jrnold Iolder4</h5>
                                    <span>Student, Language4</span>
                                </div>
                            </div>
                            <div class="testimonial_author_active_3">
                                <div class="single_author">
                                    <img src="assets/images/author-4.jpg" alt="author">
                                </div>
                                <div class="single_author">
                                    <img src="assets/images/author-5.jpg" alt="author">
                                </div>
                                <div class="single_author">
                                    <img src="assets/images/author-6.jpg" alt="author">
                                </div>
                                <div class="single_author">
                                    <img src="assets/images/author-5.jpg" alt="author">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




<!--====== Blog PART ENDS ======-->
<?php
$adrqry="SELECT advdm_id,advdm_name,advdm_desc,advdm_dimgnm,advdm_mimgnm,advdm_lnk,advdm_text,advdm_prty,advdm_sts from advd_mst where advdm_sts='a' and advdm_id!='' order by  advdm_prty asc";
$exuqry=mysqli_query($conn,$adrqry);
$count_advt=mysqli_num_rows($exuqry);
if($count_advt>0){
  ?>
  <div class="container">
  <div class="row mb-4 justify-content-center">
    <?php
    while($advt_rows=mysqli_fetch_assoc($exuqry)){
      $ad_name=$advt_rows['advdm_name'];
      $ad_img = $advt_rows['advdm_dimgnm'];
      $ad_path=$gusradvd_fldnm.$ad_img;
      if($ad_img!=''&&file_exists($ad_path)){
        $ad_image=$rtpth.$ad_path;
      }
      else{
        $ad_image=$rtpth.'exm_cat_img/default.jpg';
      }
      ?>

    <div class="col-sm-3">
    <img src="<?php echo $ad_image; ?>">
    </div>

      <?php
    }
    ?>
    </div>
  </div>
  <?php
}
?>

<!-- <div class="container">
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
</div> -->
<?php include('footer.php'); ?>