<?php
include('header.php');
if ((!isset($_REQUEST['text']) && $_REQUEST['text'] == "")) {
  ?>
  <script type="text/javascript">
    location.href = "<?php echo $rtpth; ?>home";
  </script>
  <?php
}
$srch_txt = funcStrUnRplc($_REQUEST['text']);
$yr_ids = funcStrUnRplc($_REQUEST['yrs_ids']);
$yrs_arr = explode(",", $yr_ids);
$exm_ids = funcStrUnRplc($_REQUEST['exm_ids']);
$exm_arr = explode(",", $exm_ids);
$topc_ids = funcStrUnRplc($_REQUEST['topc_ids']);
$topc_arr = explode(",", $topc_ids);
$page_title = "Search";
$page_seo_title = "Search | GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
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
            <li><a class="active">Search</a></li>
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
        <ul id="accordion" class="accordion">
          <li class="<?php echo $mn_li_cls; ?>">
            <div class="link">Year<i class="fa fa-chevron-down"></i>
            </div>
            <?php
            // ------------------------------------------------------ write years query with search key word and find count ---------------------------------------
            $sqry_srch_yr = "SELECT yearsm_id, yearsm_name, count(addquesm_id) as qns_cnt from addques_mst
            left join years_mst on addquesm_yearsm_id = yearsm_id
            left join prodmnexms_mst on addquesm_prodmnexmsm_id = prodmnexmsm_id
            left join exam_subcategory_mst on addquesm_exmscat_id = exam_subcategorym_id
            left join topics_mst on addquesm_topicsm_id = topicsm_id
            left join subtopics_mst on addquesm_subtopicsm_id = subtopicsm_id
            where addquesm_sts = 'a' and exam_subcategorym_sts = 'a' and prodmnexmsm_sts = 'a' and yearsm_sts = 'a' and (addquesm_qnm LIKE '%$srch_txt%' or addquesm_optn1 LIKE '%$srch_txt%' or addquesm_optn2 LIKE '%$srch_txt%' or addquesm_optn3 LIKE '%$srch_txt%' or addquesm_optn4 LIKE '%$srch_txt%')";
            if ($exm_ids != "") {
              $sqry_srch_exm .= " and addquesm_prodmnexmsm_id in ($exm_ids)";
            }
            if ($topc_ids != "") {
              $sqry_srch_exm .= " and addquesm_topicsm_id in ($topc_ids)";
            }
            $sqry_srch_yr .= " group by yearsm_id order by yearsm_id asc";
            $srs_srch_yr = mysqli_query($conn, $sqry_srch_yr);
            $cntrec_srch_yr = mysqli_num_rows($srs_srch_yr);
            if ($cntrec_srch_yr > 0) { ?>
              <ul class="submenu" style="display : <?php echo $mn_stl; ?>">
                <?php
                while ($srows_years = mysqli_fetch_assoc($srs_srch_yr)) {
                  $yr_id = $srows_years['yearsm_id'];
                  $yr_nm = $srows_years['yearsm_name'];
                  $yr_nm_url = funcStrRplc($yr_nm);
                  $qns_yr_cnt = $srows_years['qns_cnt'];
                  if ($mn_yr == $yr_id) {
                    $mn_bg = "background-color: #b63b4d";
                  } else {
                    $mn_bg = "";
                  }
                  if (in_array($yr_id, $yrs_arr))
                  {
                    $yr_chkd = "checked";
                  }
                  else {
                    $yr_chkd = "";
                  }
                  ?>
                  <li>
                    <input type="checkbox" id="year_nm<?php echo $yr_id; ?>" name="year_nm" class="" value="<?php echo $yr_id; ?>" onchange="get_rel_qns();" <?php echo $yr_chkd; ?>>
                    <label for="year_nm<?php echo $yr_id; ?>"><?php echo $yr_nm . "(" . $qns_yr_cnt . ")"; ?></label>
                  </li>
                  <?php
                }
                ?>
              </ul>
              <?php
            }
            ?>
          </li>
        </ul>
        <ul id="accordion1" class="accordion">
          <li class="<?php echo $mn_li_cls; ?>">
            <div class="link">Exam<i class="fa fa-chevron-down"></i>
            </div>
            <?php
            // ------------------------------------------------------ write years query with search key word and find count ---------------------------------------
            $sqry_srch_exm = "SELECT prodmnexmsm_id, prodmnexmsm_name, count(addquesm_id) as qns_cnt from addques_mst
            left join years_mst on addquesm_yearsm_id = yearsm_id
            left join prodmnexms_mst on addquesm_prodmnexmsm_id = prodmnexmsm_id
            left join exam_subcategory_mst on addquesm_exmscat_id = exam_subcategorym_id
            left join topics_mst on addquesm_topicsm_id = topicsm_id
            left join subtopics_mst on addquesm_subtopicsm_id = subtopicsm_id
            where addquesm_sts = 'a' and exam_subcategorym_sts = 'a' and prodmnexmsm_sts = 'a' and yearsm_sts = 'a' and (addquesm_qnm LIKE '%$srch_txt%' or addquesm_optn1 LIKE '%$srch_txt%' or addquesm_optn2 LIKE '%$srch_txt%' or addquesm_optn3 LIKE '%$srch_txt%' or addquesm_optn4 LIKE '%$srch_txt%')";
            if ($topc_ids != "")
            {
              $sqry_srch_exm .= " and addquesm_topicsm_id in ($topc_ids)";
            }
            if ($yr_ids != "") {
              $sqry_srch_exm .= " and addquesm_yearsm_id in ($yr_ids)";
            }
            $sqry_srch_exm .= " group by prodmnexmsm_id order by prodmnexmsm_id asc";
            $srs_srch_exm = mysqli_query($conn, $sqry_srch_exm);
            $cntrec_srch_exm = mysqli_num_rows($srs_srch_exm);
            if ($cntrec_srch_exm > 0) { ?>
              <ul class="submenu" style="display : <?php echo $mn_stl; ?>">
                <?php
                while ($srows_exm = mysqli_fetch_assoc($srs_srch_exm)) {
                  $exm_id = $srows_exm['prodmnexmsm_id'];
                  $exm_nm = $srows_exm['prodmnexmsm_name'];
                  $exm_nm_url = funcStrRplc($exm_nm);
                  $qns_exm_cnt = $srows_exm['qns_cnt'];
                  if ($mn_yr == $exm_id) {
                    $mn_bg = "background-color: #b63b4d";
                  } else {
                    $mn_bg = "";
                  }
                  if (in_array($exm_id, $exm_arr)) {
                    $exm_chkd = "checked";
                  }
                  else {
                    $exm_chkd = "";
                  }
                  ?>
                  <li>
                    <input type="checkbox" id="exam_nm<?php echo $exm_id; ?>" name="exam_nm" class="" value="<?php echo $exm_id; ?>" onchange="get_rel_qns();" <?php echo $exm_chkd; ?>>
                    <label for="exam_nm<?php echo $exm_id; ?>"><?php echo $exm_nm . "(" . $qns_exm_cnt . ")"; ?></label>
                  </li>
                  <?php
                }
                ?>
              </ul>
              <?php
            }
            ?>
          </li>
        </ul>
        <ul id="accordion2" class="accordion">
          <li class="<?php echo $mn_li_cls; ?>">
            <div class="link">Topics<i class="fa fa-chevron-down"></i>
            </div>
            <?php
            // ------------------------------------------------------ write years query with search key word and find count ---------------------------------------
            $sqry_srch_topc = "SELECT topicsm_id, topicsm_name, count(addquesm_id) as qns_cnt from addques_mst
            left join years_mst on addquesm_yearsm_id = yearsm_id
            left join prodmnexms_mst on addquesm_prodmnexmsm_id = prodmnexmsm_id
            left join exam_subcategory_mst on addquesm_exmscat_id = exam_subcategorym_id
            left join topics_mst on addquesm_topicsm_id = topicsm_id
            left join subtopics_mst on addquesm_subtopicsm_id = subtopicsm_id
            where addquesm_sts = 'a' and exam_subcategorym_sts = 'a' and prodmnexmsm_sts = 'a' and yearsm_sts = 'a' and (addquesm_qnm LIKE '%$srch_txt%' or addquesm_optn1 LIKE '%$srch_txt%' or addquesm_optn2 LIKE '%$srch_txt%' or addquesm_optn3 LIKE '%$srch_txt%' or addquesm_optn4 LIKE '%$srch_txt%')";
            if ($exm_ids != "") {
              $sqry_srch_topc .= " and addquesm_prodmnexmsm_id in ($exm_ids)";
            }
            if ($yr_ids != "")
            {
              $sqry_srch_topc .= " and addquesm_yearsm_id in ($yr_ids)";
            }
            $sqry_srch_topc .= " group by topicsm_id order by topicsm_id asc";
            $srs_srch_topc = mysqli_query($conn, $sqry_srch_topc);
            $cntrec_srch_topc = mysqli_num_rows($srs_srch_topc);
            if ($cntrec_srch_topc > 0) { ?>
              <ul class="submenu" style="display : <?php echo $mn_stl; ?>">
                <?php
                while ($srows_topc = mysqli_fetch_assoc($srs_srch_topc)) {
                  $topc_id = $srows_topc['topicsm_id'];
                  $topc_nm = $srows_topc['topicsm_name'];
                  $topc_nm_url = funcStrRplc($topc_nm);
                  $qns_topc_cnt = $srows_topc['qns_cnt'];
                  if ($mn_yr == $topc_id) {
                    $mn_bg = "background-color: #b63b4d";
                  } else {
                    $mn_bg = "";
                  }
                  if (in_array($topc_id, $topc_arr)) {
                    $topc_chkd = "checked";
                  }
                  else {
                    $topc_chkd = "";
                  }
                  ?>
                  <li>
                    <input type="checkbox" id="topc_nm<?php echo $topc_id; ?>" name="topc_nm" class="" value="<?php echo $topc_id; ?>" onchange="get_rel_qns();" <?php echo $topc_chkd; ?>>
                    <label for="topc_nm<?php echo $topc_id; ?>"><?php echo $topc_nm . "(" . $qns_topc_cnt . ")"; ?></label>
                  </li>
                  <?php
                }
                ?>
              </ul>
              <?php
            }
            ?>
          </li>
        </ul>
        <div class="single_courses_details  mb-60">
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
        </div>
      </div>
      <div class="col-lg-9 col-sm-9 pr-md-5">
        <?php
        $sqry_tot_qns = "SELECT addquesm_id, addquesm_qnm, addquesm_prodmnexmsm_id, addquesm_exmscat_id, addquesm_typ_id, addquesm_yearsm_id, addquesm_topicsm_id, addquesm_subtopicsm_id, addquesm_optn1, addquesm_optn2, addquesm_optn3, addquesm_optn4, addquesm_crtans, addquesm_expln, addquesm_qns_typ, addquesm_qns_tag from addques_mst
        inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
        inner join exam_subcategory_mst on exam_subcategorym_id = addquesm_exmscat_id
        inner join years_mst on yearsm_id = addquesm_yearsm_id
        inner join topics_mst on topicsm_id = addquesm_topicsm_id
        left join subtopics_mst on subtopicsm_id = addquesm_subtopicsm_id where addquesm_sts = 'a' and prodmnexmsm_sts = 'a' and exam_subcategorym_sts = 'a' and yearsm_sts = 'a' and (addquesm_qnm LIKE '%$srch_txt%' or addquesm_optn1 LIKE '%$srch_txt%' or addquesm_optn2 LIKE '%$srch_txt%' or addquesm_optn3 LIKE '%$srch_txt%' or addquesm_optn4 LIKE '%$srch_txt%')";
        if ($yr_ids != "")
        {
          $sqry_tot_qns .= " and addquesm_yearsm_id in ($yr_ids)";
        }
        if ($exm_ids != "")
        {
          $sqry_tot_qns .= " and addquesm_prodmnexmsm_id in ($exm_ids)";
        }
        if ($topc_ids != "")
        {
          $sqry_tot_qns .= " and addquesm_topicsm_id in ($topc_ids)";
        }
        // prodmnexmsm_name='$cat_id_qry' and exam_subcategorym_name = '$scat_id_qry' and yearsm_name = '$yr_id_qry'";
        $srs_tot_qns = mysqli_query($conn, $sqry_tot_qns);
        $tot_qns = mysqli_num_rows($srs_tot_qns);
        if ($tot_qns > 0) {
          ?>
          <div id="qns_lst_dsp_srch">
          </div>
          <?php
        } else {
          ?>
          <div align-items-center>
            No Results found for the search:
            <?php echo $srch_txt; ?>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</section>
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
    var accordion = new Accordion($('#accordion1'), false);
    var accordion = new Accordion($('#accordion2'), false);
  });
</script>