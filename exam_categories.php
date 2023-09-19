<?php
$page_title = "Exam Categories";
$page_seo_title = "Exam Categories| GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "inner";
$body_class = "inner";
include('header.php');
?>
<section class="page_banner bg_cover" style="background-image: url(assets/images/about_bg.jpg)">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner_content text-center">
          <h4 class="title">
            <?php echo $page_title; ?>
          </h4>
          <ul class="breadcrumb justify-content-center">
            <li><a href="<?php echo $rtpth; ?>home">Home</a></li>
            <li><a class="active">
                <?php echo $page_title; ?>
              </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="courses_area pt-120 pb-130">
  <div class="container">
    <div class="row">
      <?php
      $sqry_exm_cat = "SELECT qnscnt, prodmnexmsm_id, prodmnexmsm_name, prodmnexmsm_img, prodmnexmsm_desc, exam_subcategorym_name, yearsm_name FROM (SELECT COUNT(addquesm_id) as qnscnt, prodmnexmsm_id, prodmnexmsm_name,prodmnexmsm_img, prodmnexmsm_desc, exam_subcategorym_name, yearsm_name,ROW_NUMBER() OVER (PARTITION BY prodmnexmsm_id, exam_subcategorym_name ORDER BY yearsm_name DESC) AS rn FROM addques_mst AS a
      INNER JOIN years_mst AS y ON y.yearsm_id = a.addquesm_yearsm_id
      INNER JOIN prodmnexms_mst AS p ON p.prodmnexmsm_id = a.addquesm_prodmnexmsm_id
      INNER JOIN exam_subcategory_mst AS e ON e.exam_subcategorym_id = a.addquesm_exmscat_id
      WHERE p.prodmnexmsm_sts = 'a' GROUP BY prodmnexmsm_id) AS subquery
      WHERE rn = 1";
      $srs_exm_cat = mysqli_query($conn, $sqry_exm_cat);
      $cntrec_exm_cat = mysqli_num_rows($srs_exm_cat);
      if ($cntrec_exm_cat > 0) {
        while ($srow_exm_cat = mysqli_fetch_array($srs_exm_cat)) {
          $exm_cat_id = $srow_exm_cat['prodmnexmsm_id'];
          $exm_cat_name = $srow_exm_cat['prodmnexmsm_name'];
          $exm_catnm_url = funcStrRplc($exm_cat_name);
          $exm_cat_desc = $srow_exm_cat['prodmnexmsm_desc'];
          $exm_scatnm = $srow_exm_cat['exam_subcategorym_name'];
          $exm_scatnm_url = funcStrRplc($exm_scatnm);
          $exm_yr = $srow_exm_cat['yearsm_name'];
          $exm_cat_img = $srow_exm_cat['prodmnexmsm_img'];
          /* $path=$u_mnlnks_bnrfldnm.$exm_cat_img;
          if($exm_cat_img!=''&&file_exists($path)){
            $image=$rtpth.$path;
          }
          else{
            $image=$rtpth.'exm_cat_img/default.jpg';
          } */
          ?>
          <div class="col-lg-3 col-sm-6">
            <div class="single_courses courses_gray mt-30">
              <div class="courses_image">
                <!-- <img src="<?php echo $rtpth; ?>assets/images/courses-2.jpg" alt="courses"> -->
                <!-- <img src="<?php echo $image ?>" alt="courses"> -->
              </div>
              <div class="courses_content">
                <h4 class="title"><a href="<?php echo $rtpth . $exm_catnm_url . "/" . $exm_scatnm_url . "/" . $exm_yr; ?>">
                    <?php echo $exm_cat_name; ?>
                  </a></h4>
                <p class="mt-2">
                  <?php echo $exm_cat_desc; ?>
                </p>
                <div class="meta d-flex justify-content-between">
                  <span><a href="<?php echo $rtpth . $exm_catnm_url . "/" . $exm_scatnm_url . "/" . $exm_yr; ?>"
                      class="w100">View</a></span>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
      } else {
        ?>
        <script type="text/javascript">
          location.href = "<?php echo $rtpth; ?>home";
        </script>
        <?php
      }
      ?>
    </div>
  </div>
</section>
<?php include('footer.php'); ?>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>