<?php
include('header.php');
if ((isset($_REQUEST['catid']) && $_REQUEST['catid'] != "") && (isset($_REQUEST['scatid']) && $_REQUEST['scatid'] != "")) {
  $sqry_exm_scat1 = "SELECT exam_subcategorym_id, exam_subcategorym_name, exam_subcategorym_desc,prodmnexmsm_name from exam_subcategory_mst
  inner join addques_mst on addquesm_exmscat_id = exam_subcategorym_id
  inner join prodmnexms_mst on prodmnexmsm_id = exam_subcategorym_prodmnexmsm_id
  inner join years_mst on yearsm_id = addquesm_yearsm_id
  where exam_subcategorym_sts = 'a'";
  if (isset($_REQUEST['catid']) && $_REQUEST['catid'] != "") {
    $cat_id = glb_func_chkvl($_REQUEST['catid']);
    $cat_id_qry = funcStrUnRplc($cat_id);
    $sqry_exm_scat1 .= " and prodmnexmsm_name = '$cat_id_qry'";
  }
  if (isset($_REQUEST['scatid']) && $_REQUEST['scatid'] != "") {
    $scat_id = glb_func_chkvl($_REQUEST['scatid']);
    $scat_id_qry = funcStrUnRplc($scat_id);
    $sqry_exm_scat1 .= " and exam_subcategorym_name = '$scat_id_qry'";
  }
  if (isset($_REQUEST['yr']) && $_REQUEST['yr'] != "") {
    $yr_id = glb_func_chkvl($_REQUEST['yr']);
    $yr_id_qry = funcStrUnRplc($yr_id);
    $sqry_exm_scat1 .= " and  yearsm_name= '$yr_id_qry'";
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
$current_page = "home";
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
                <?php echo $exm_catnm." / ".$page_title; ?>
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
        left join subtopics_mst on subtopicsm_id = addquesm_subtopicsm_id where addquesm_sts = 'a' and prodmnexmsm_sts = 'a' and exam_subcategorym_sts = 'a' and prodmnexmsm_name='$cat_id_qry' and exam_subcategorym_name = '$scat_id_qry' and yearsm_name = '$yr_id_qry'";
        $srs_tot_qns = mysqli_query($conn, $sqry_tot_qns);
        $tot_qns = mysqli_num_rows($srs_tot_qns);
        ?>
        <div id="qns_lst_dsp">
        </div>
      </div>
    </div>
  </div>
</section>
<?php include('footer.php'); ?>
<!-- <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"> -->
</script>
<!-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> -->
<script>
  function show_ans(sno, optnid, qtnid) {
    $.ajax({
      url: `<?php echo $rtpth; ?>get_ans.php?sno=${sno}&optnid=${optnid}&qtnid=${qtnid}`,
      type: 'GET',
      success: function (data) {
        var data_arr = data.split("<-->");
        var crct_ans = data_arr[0];
        var expl = data_arr[1];
        if (Number(optnid) == Number(crct_ans))
        {
          $('#crct'+sno).css('display', 'block');
          $('#wrng'+sno).css('display', 'none');
        }
        else
        {
          $('#crct'+sno).css('display', 'none');
          $('#wrng'+sno).css('display', 'block');
        }
        if(expl != '')
        {
          expl_cntnt = '<h4 class="courses_details_title">Explanation</h4><p style="text-align: left;">'+expl+'</p >';
          $('#explnbx_'+sno).html(expl_cntnt);
          $('#explnbx_'+sno).css('display', 'block');
        }
      }
    });
  }
  $(document).ready(function () {
    // Initial page load
    var cat_id = "<?php echo $cat_id; ?>";
    var scat_id = "<?php echo $scat_id; ?>";
    var yr_id = "<?php echo $yr_id; ?>";
    var tot_qns = <?php echo $tot_qns; ?>;
    loadPage(1, cat_id, scat_id, yr_id);
    // Load next page
    $('#qns_lst_dsp').on('click', '.next', function () {
      let nextPage = parseInt($(this).data('page'))
      loadPage(nextPage, cat_id, scat_id, yr_id);
    });

    // Load previous page
    $('#qns_lst_dsp').on('click', '.prev', function () {
      let prevPage = parseInt($(this).data('page'))
      loadPage(prevPage, cat_id, scat_id, yr_id);
    });
    function loadPage(page, cat_id, scat_id, yr_id) {
      $.ajax({
        url: `<?php echo $rtpth; ?>get_qns.php?page=${page}&catid=${cat_id}&scatid=${scat_id}&yr=${yr_id}`,
        type: 'GET',
        success: function (data) {
          var content = '';
          content += data;
          // Append pagination controls
          content += '<div class="row">';
          if (page > 1) {
            content += `<div class="col-6"><div class="single_form"><button class="prev main-btn" data-page="${page - 1}">Prev</button></div></div>`;
          }
          if (page * 2 < tot_qns) {
            content += `<div class="col-6 text-right"><div class="single_form"><button class="next main-btn" data-page="${page + 1}">Next</button></div>`;
          }
          content += '</div></div>';
          $('#qns_lst_dsp').html(content);
        }
      });
    }
  });
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