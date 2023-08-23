<?php
include('header.php');
if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != "") {
  $sqry_exm_scat1 = "SELECT exam_subcategorym_id, exam_subcategorym_name, exam_subcategorym_desc,prodmnexmsm_name from exam_subcategory_mst
  inner join addques_mst on addquesm_exmscat_id = exam_subcategorym_id
  left join prodmnexms_mst on prodmnexmsm_id = exam_subcategorym_prodmnexmsm_id
  where exam_subcategorym_sts = 'a'";
  if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] != "") {
    $cat_id = glb_func_chkvl($_REQUEST['cat_id']);
    $cat_id_qry = funcStrUnRplc($cat_id);
    $sqry_exm_scat1 .= " and exam_subcategorym_name = '$cat_id_qry'";
  }
  $sqry_exm_scat2 = " group by exam_subcategorym_id order by exam_subcategorym_prty asc";
  $sqry_exm_scat = $sqry_exm_scat1 . " " . $sqry_exm_scat2;
  $srs_exm_scat = mysqli_query($conn, $sqry_exm_scat);
  $cntrec_exm_scat = mysqli_num_rows($srs_exm_scat);
  if ($cntrec_exm_scat > 0) {
    $srows_exec_cat = mysqli_fetch_assoc($srs_exm_scat);
    $exm_catnm = $srows_exec_cat['prodmnexmsm_name'];
  } else {
    ?>
    <script type="text/javascript">
      location.href = "<?php echo $rtpth; ?>home";
    </script>
    <?php
  }
} else {
  ?>
  <script type="text/javascript">
    location.href = "<?php echo $rtpth; ?>home";
  </script>
  <?php
}
$page_title = $exm_catnm;
$page_seo_title = $exm_catnm . " | GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
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
              </a>
            </li>
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
      $srs_scat_new1 = mysqli_query($conn, $sqry_exm_scat1);
      $cnt_scat_rws1 = mysqli_num_rows($srs_scat_new1);
      if ($cnt_scat_rws1 > 0) {
        while ($srow_exm_scat = mysqli_fetch_array($srs_exm_scat1)) {
          $scat_id = $srow_exm_scat['exam_subcategorym_id'];
          $scat_name = $srow_exm_scat['exam_subcategorym_name'];
          $scat_desc = $srow_exm_scat['exam_subcategorym_desc'];
          $scatnm_url = funcStrRplc($scat_name);
          $catnm = $srow_exm_scat['prodmnexmsm_name'];
          $catnm_url = funcStrRplc($catnm);
          ?>
          <div class="col-lg-3 col-sm-6">
            <div class="single_courses courses_gray mt-30">
              <div class="courses_image">
                <!-- <img src="<?php echo $rtpth; ?>assets/images/courses-2.jpg" alt="courses"> -->
              </div>
              <div class="courses_content">
                <h4 class="title"><a href="#">
                    <?php echo $exm_cat_name; ?>
                  </a></h4>
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
      }
      ?>
    </div>
  </div>
</section>
<?php include('footer.php'); ?>
<script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>