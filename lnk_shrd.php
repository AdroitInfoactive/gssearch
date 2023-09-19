<?php
include('header.php');
if ((isset($_REQUEST['catid']) && $_REQUEST['catid'] != "") && (isset($_REQUEST['scatid']) && $_REQUEST['scatid'] != "") && (isset($_REQUEST['yr']) && $_REQUEST['yr'] != "") && (isset($_REQUEST['qnsid']) && $_REQUEST['qnsid'] != "")) {
  $sqry_exm_scat1 = "SELECT exam_subcategorym_id, exam_subcategorym_name, exam_subcategorym_desc,prodmnexmsm_name from exam_subcategory_mst
  inner join addques_mst on addquesm_exmscat_id = exam_subcategorym_id
  inner join prodmnexms_mst on prodmnexmsm_id = exam_subcategorym_prodmnexmsm_id
  inner join years_mst on yearsm_id = addquesm_yearsm_id
  where exam_subcategorym_sts = 'a'";
  if (isset($_REQUEST['catid']) && $_REQUEST['catid'] != "") {
    $cat_id = ($_REQUEST['catid']);
    $cat_id_qry = funcStrUnRplc($cat_id);
    $sqry_exm_scat1 .= " and prodmnexmsm_name = '$cat_id_qry'";
  }
  if (isset($_REQUEST['scatid']) && $_REQUEST['scatid'] != "") {
    $scat_id = ($_REQUEST['scatid']);
    $scat_id_qry = funcStrUnRplc($scat_id);
    $sqry_exm_scat1 .= " and exam_subcategorym_name = '$scat_id_qry'";
  }
  if (isset($_REQUEST['yr']) && $_REQUEST['yr'] != "") {
    $yr_id = ($_REQUEST['yr']);
    $yr_id_qry = funcStrUnRplc($yr_id);
    $sqry_exm_scat1 .= " and yearsm_name= '$yr_id_qry'";
  }
  if (isset($_REQUEST['qnsid']) && $_REQUEST['qnsid'] != "") {
    $qns_id = ($_REQUEST['qnsid']);
    $qns_id_qry = funcStrUnRplc($qns_id);
    $sqry_exm_scat1 .= " and addquesm_id = '$qns_id_qry'";
  }
  $sqry_exm_scat2 = " group by exam_subcategorym_id order by exam_subcategorym_prty asc";
  $sqry_exm_scat = $sqry_exm_scat1 . " " . $sqry_exm_scat2;
  $srs_exm_scat = mysqli_query($conn, $sqry_exm_scat);
  $cntrec_exm_scat = mysqli_num_rows($srs_exm_scat);
  if ($cntrec_exm_scat > 0) {
    $srows_exec_cat = mysqli_fetch_assoc($srs_exm_scat);
    $exm_catnm = $srows_exec_cat['prodmnexmsm_name'];
    $exm_scatnm = $srows_exec_cat['exam_subcategorym_name'];
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
$page_title = $exm_scatnm;
$page_seo_title = $exm_catnm . "-" . $exm_scatnm . " | GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "linkshared";
$body_class = "homepage";
include_once('script.php');
include_once('../includes/inc_fnct_ajax_validation.php');
?>
<section class="page_banner bg_cover" style="background-image: url(<?php echo $rtpth; ?>assets/images/about_bg.jpg)">
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
                <?php echo $exm_catnm . " / " . $page_title; ?>
              </a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="about_area pt-80">
  <div class="container-fluid">
    <div class="row ">
      <div class="col-lg-3 col-sm-3 ">
        <?php
        $sqry_exmscat_nms = "SELECT exam_subcategorym_id, exam_subcategorym_name, exam_subcategorym_desc,prodmnexmsm_id, prodmnexmsm_name, addquesm_yearsm_id, yearsm_id, yearsm_name from exam_subcategory_mst
        inner join addques_mst on addquesm_exmscat_id = exam_subcategorym_id
        inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
        inner join years_mst on yearsm_id = addquesm_yearsm_id
        where exam_subcategorym_sts = 'a' and yearsm_sts = 'a' and prodmnexmsm_sts = 'a' and addquesm_sts = 'a' and prodmnexmsm_name= '$cat_id_qry' group by exam_subcategorym_id order by exam_subcategorym_prty asc";
        $srs_exmscat_nms = mysqli_query($conn, $sqry_exmscat_nms);
        $cntrec_exmscat_nms = mysqli_num_rows($srs_exmscat_nms);
        if ($cntrec_exmscat_nms > 0) { ?>
          <ul id="accordion" class="accordion">
            <?php
            while ($srows_exmscat_nms = mysqli_fetch_assoc($srs_exmscat_nms)) {
              $catid = $srows_exmscat_nms['prodmnexmsm_id'];
              $catnm = $srows_exmscat_nms['prodmnexmsm_name'];
              $scatid = $srows_exmscat_nms['exam_subcategorym_id'];
              $scatnm = $srows_exmscat_nms['exam_subcategorym_name'];
              $scatnm_url = funcStrRplc($scatnm);
              if ($scatnm_url == $scat_id) {
                $mn_li_cls = "open";
                $mn_stl = "block";
              } else {
                $mn_li_cls = "";
                $mn_stl = "none";
              }
              ?>
              <li class="<?php echo $mn_li_cls; ?>">
                <div class="link">
                  <?php echo $scatnm; ?><i class="fa fa-chevron-down"></i>
                </div>
                <?php
                $sqry_exm_nms = "SELECT yearsm_id, yearsm_name, prodmnexmsm_id, prodmnexmsm_name, exam_subcategorym_id, exam_subcategorym_name from addques_mst
                inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
                inner join exam_subcategory_mst on exam_subcategorym_id = addquesm_exmscat_id
                inner join years_mst on yearsm_id = addquesm_yearsm_id
                where exam_subcategorym_sts = 'a' and yearsm_sts = 'a' and prodmnexmsm_sts = 'a' and addquesm_sts = 'a' and exam_subcategorym_id = '$scatid' group by yearsm_id order by yearsm_name desc";
                $srs_exm_nms = mysqli_query($conn, $sqry_exm_nms);
                $cntrec_exm_nms = mysqli_num_rows($srs_exm_nms);
                if ($cntrec_exm_nms > 0) { ?>
                  <ul class="submenu" style="display : <?php echo $mn_stl; ?>">
                    <?php
                    while ($srows_exm_nms = mysqli_fetch_assoc($srs_exm_nms)) {
                      $exm_yr_nm = $srows_exm_nms['yearsm_name'];
                      $exm_catnm = $srows_exm_nms['prodmnexmsm_name'];
                      $exm_catnm_url = funcStrRplc($exm_catnm);
                      $exm_scatnm = $srows_exm_nms['exam_subcategorym_name'];
                      $exm_scatnm_url = funcStrRplc($exm_scatnm);
                      $mn_yr = $srows_exm_nms['yearsm_name'];
                      if ($mn_yr == $yr_id) {
                        $mn_bg = "background-color: #b63b4d";
                      } else {
                        $mn_bg = "";
                      }
                      ?>
                      <li><a style="<?php echo $mn_bg; ?>"
                          href="<?php echo $rtpth . $exm_catnm_url . "/" . $exm_scatnm_url . "/" . $exm_yr_nm; ?>"><?php echo $exm_yr_nm; ?></a></li>
                      <?php
                    }
                    ?>
                  </ul>
                  <?php
                }
                ?>
              </li>
              <?php
            }
            ?>
          </ul>
          <?php
        }
        ?>
       <!--  <div class="single_courses_details  mb-60">
          <h4 class="courses_details_title">Similar Questions</h4>
          <div class="courses_curriculum mt-50">
            <div class="courses_top_bar d-sm-flex justify-content-between align-items-center">
              <div class="courses_title">
                <h4 class="courses_details_title">'Rapid Financing Instrument' and 'Rapid Credit Facility' are related
                  to the provisions of lending by which one of the following ?
                </h4>
              </div>
            </div>
            <div class="card-body">
              <form action="">
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadioInlineA" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInlineA">
                    <?php echo $qn_optn1; ?>
                  </label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadioInlineB" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInlineB">Asian Development Bank</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadioInlineC" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInlineC">International Monetary Fund</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="customRadioInlineD" name="customRadioInline1" class="custom-control-input">
                  <label class="custom-control-label" for="customRadioInlineD">United Nations Environment Programme
                    Finance Initiative
                  </label>
                </div>
                <p><strong><span class="text-success"><i class="fa fa-check"></i> Correct</span> <span
                      class="text-danger"><i class="fa fa-close"></i> Wrong</span></strong></p>
            </div>
          </div>
        </div> -->
      </div>
      <?php
      $sqry_qns1 = "SELECT addquesm_id, addquesm_qnm, addquesm_prodmnexmsm_id, addquesm_exmscat_id, addquesm_typ_id, addquesm_yearsm_id, addquesm_topicsm_id, addquesm_subtopicsm_id, addquesm_optn1, addquesm_optn2, addquesm_optn3, addquesm_optn4, addquesm_crtans, addquesm_expln, addquesm_qns_typ, addquesm_qns_tag from addques_mst
      inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
      inner join exam_subcategory_mst on exam_subcategorym_id = addquesm_exmscat_id
      inner join years_mst on yearsm_id = addquesm_yearsm_id
      inner join topics_mst on topicsm_id = addquesm_topicsm_id
      left join subtopics_mst on subtopicsm_id = addquesm_subtopicsm_id where addquesm_sts = 'a' and prodmnexmsm_sts = 'a' and exam_subcategorym_sts = 'a' and prodmnexmsm_name = '$cat_id_qry' and exam_subcategorym_name = '$scat_id_qry' and yearsm_name= '$yr_id_qry' and addquesm_id = '$qns_id_qry' group by addquesm_id limit 1";
      $srs_qns1 = mysqli_query($conn, $sqry_qns1);
      $cntrec_qns1 = mysqli_num_rows($srs_qns1);
      if ($cntrec_qns1 > 0) {
        $srows_qns = mysqli_fetch_assoc($srs_qns1);
        $qn_id = $srows_qns['addquesm_id'];
        $qn_qnm = strip_tags(html_entity_decode($srows_qns['addquesm_qnm']));
        $qn_tag = $srows_qns['addquesm_qns_tag'];
        $qn_crtans = $srows_qns['addquesm_crtans'];
        $qn_expln = strip_tags(html_entity_decode($srows_qns['addquesm_expln']));
        $qns_lnk = $rtpth . $cat_id . "/" . $scat_id . "/" . $yr_id . "/" . $qn_id;
        $tot_qns = 1;
        ?>
        <div class="col-lg-9 col-sm-9 pr-md-5">
          <div class="single_courses_details  mb-60">
            <h4 class="courses_details_title">(
              <?php echo $qn_tag; ?>)
            </h4>
            <div class="courses_curriculum mt-50">
              <div class="courses_top_bar d-sm-flex justify-content-between align-items-center">
                <div class="courses_title">
                  <h4 class="courses_details_title">
                    <?php echo $qn_qnm; ?>
                  </h4>
                  <div class="ps-product__item sub-toggle" data-toggle="tooltip" data-placement="left" title=""
                    data-original-title="Share">
                    <a data-toggle="modal" data-target="#shareProduct"><i class="fa fa-share-square-o"
                        onclick="get_qns_lnk('<?php echo $qns_lnk; ?>');"></i></a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <?php
                $i = 1;
                for ($j = 1; $j < 5; $j++) { ?>
                  <div class="custom-control custom-radio">
                    <input type="radio" id="<?php echo $qn_id; ?>customRadioInline<?php echo $j; ?>"
                      name="<?php echo $qn_id; ?>customRadioInline<?php echo $qn_id; ?>" class="custom-control-input"
                      onclick="show_ans(<?php echo $i; ?>,<?php echo $j; ?>,<?php echo $qn_id; ?>);">
                    <label class="custom-control-label" for="<?php echo $qn_id; ?>customRadioInline<?php echo $j; ?>">
                      <?php echo strip_tags(html_entity_decode($srows_qns['addquesm_optn' . $j])); ?>
                    </label>
                  </div>
                  <?php
                }
                ?>
                <p>
                  <strong>
                    <span class="text-success" style="display: none" id="crct<?php echo $i; ?>"><i
                        class="fa fa-check"></i>
                      Correct</span>
                    <span class="text-danger" style="display: none" id="wrng<?php echo $i; ?>"><i class="fa fa-close"></i>
                      Wrong</span>
                  </strong>
                </p>
              </div>
              <div class="scrolling-box" id="explnbx_<?php echo $i; ?>" style="display: none">
              </div>
            </div>
          </div>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
</section>
<?php
$sqry_exm_cat = "SELECT prodmnexmsm_id, prodmnexmsm_name, prodmnexmsm_desc, exam_subcategorym_name, yearsm_id, yearsm_name from prodmnexms_mst
inner join addques_mst on addquesm_prodmnexmsm_id = prodmnexmsm_id
inner join exam_subcategory_mst on exam_subcategorym_prodmnexmsm_id = prodmnexmsm_id
inner join years_mst on yearsm_id = addquesm_yearsm_id
where prodmnexmsm_sts='a' group by prodmnexmsm_id order by yearsm_name,prodmnexmsm_name desc limit 4";
$srs_exm_cat = mysqli_query($conn, $sqry_exm_cat);
$cntrec_exm_cat = mysqli_num_rows($srs_exm_cat);
if ($cntrec_exm_cat > 0) { ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="section_title text-center pb-20">
            <h3 class="main_title">We also Recommend</h3>
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
          ?>
          <div class="col-lg-3 col-sm-6">
            <div class="single_courses courses_gray mt-30">
              <div class="courses_image">
                <!-- <img src="<?php echo $rtpth; ?>assets/images/courses-2.jpg" alt="courses"> -->
              </div>
              <div class="courses_content">
                <h4 class="title"><a
                    href="<?php echo $rtpth . $exm_cat_url . "/" . $exm_scatnm_url . "/" . $exm_yr; ?>"><?php echo $exm_cat_name; ?></a></h4>
                <p class="mt-2">
                  <?php echo $exm_cat_desc; ?>
                </p>
                <div class="meta d-flex justify-content-between">
                  <span><a href="<?php echo $rtpth . $exm_cat_url . "/" . $exm_scatnm_url . "/" . $exm_yr; ?>"
                      class="w100">View</a></span>
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
  <?php
}
?>
<?php include('footer.php'); ?>
<script>
  $(function () {
    var Accordion = function (el, multiple) {
      this.el = el || {};
      this.multiple = multiple || false;
      // Variables privadas
      var links = this.el.find('.link');
      // Evento
      links.on('click', { el: this.el, multiple: this.multiple }, this.dropdown)
    }
    Accordion.prototype.dropdown = function (e) {
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
  (function () {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>