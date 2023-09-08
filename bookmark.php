<?php
// include('includes/inc_pagging_functions.php');
include('header.php');
$membrid = $_SESSION['sesmbrid'];
$page_title = "Bookmark Questions";
$page_seo_title = "Bookmark Questions | GS Search";
$db_seokywrd = "";
$db_seodesc = "";
$current_page = "home";
$body_class = "homepage";
$loc = "";
$rowsprpg = 5; //maximum rows per page
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
                        <li><a class="active">Bookmark Questions
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
            <!-- <div class="col-lg-3 col-sm-3 ">
        <?php
        $sqry_exmscat_nms = "SELECT exam_subcategorym_id, exam_subcategorym_name, exam_subcategorym_desc,prodmnexmsm_id, prodmnexmsm_name, addquesm_yearsm_id, yearsm_id, yearsm_name,bookmark_usr_id from exam_subcategory_mst
        inner join addques_mst on addquesm_exmscat_id = exam_subcategorym_id
        inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
        inner join years_mst on yearsm_id = addquesm_yearsm_id
        inner join bookmark_mst on bookmark_qns_id=addquesm_id
        where exam_subcategorym_sts = 'a' and yearsm_sts = 'a' and prodmnexmsm_sts = 'a' and addquesm_sts = 'a' and bookmark_usr_id= '$membrid' group by exam_subcategorym_id order by exam_subcategorym_prty asc";
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
                inner join bookmark_mst on bookmark_qns_id=addquesm_id
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
      </div> -->
            <div class="col-lg-12 col-sm-12 pr-md-12">
                <?php
                $offset = 0;
                    $sqry_tot_qns = "SELECT addquesm_id, addquesm_qnm, addquesm_prodmnexmsm_id, addquesm_exmscat_id, addquesm_typ_id, addquesm_yearsm_id, addquesm_topicsm_id, addquesm_subtopicsm_id, addquesm_optn1, addquesm_optn2, addquesm_optn3, addquesm_optn4, addquesm_crtans, addquesm_expln, addquesm_qns_typ, addquesm_qns_tag from addques_mst
        inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
        inner join exam_subcategory_mst on exam_subcategorym_id = addquesm_exmscat_id
        inner join years_mst on yearsm_id = addquesm_yearsm_id
        inner join topics_mst on topicsm_id = addquesm_topicsm_id
        inner join bookmark_mst on bookmark_qns_id=addquesm_id
       left join subtopics_mst on subtopicsm_id = addquesm_subtopicsm_id
        where addquesm_sts = 'a' and prodmnexmsm_sts = 'a' and exam_subcategorym_sts = 'a' and yearsm_sts = 'a' and bookmark_usr_id='$membrid' ";
   
    
                // prodmnexmsm_name='$cat_id_qry' and exam_subcategorym_name = '$scat_id_qry' and yearsm_name = '$yr_id_qry'";
                $srs_tot_qns = mysqli_query($conn, $sqry_tot_qns);
                $tot_qns = mysqli_num_rows($srs_tot_qns);
                if ($tot_qns > 0) {
                ?>
                    <!-- <div id="qns_lst_dsp_srch">
          </div> -->
                    <?php
                    $page = 1;
                    $i = $offset;
                    while ($srows_qns = mysqli_fetch_assoc($srs_tot_qns)) {

                        $i++;
                        $qn_id = $srows_qns['addquesm_id'];
                        $qn_qnm = html_entity_decode($srows_qns['addquesm_qnm']);
                        $qn_tag = $srows_qns['addquesm_qns_tag'];
                        $qn_crtans = $srows_qns['addquesm_crtans'];
                        $qn_expln = html_entity_decode($srows_qns['addquesm_expln']);
                        $qns_lnk = $rtpth . $cat_id . "/" . $scat_id . "/" . $yr_id . "/" . $qn_id;
                    ?>
                        <div class="courses_curriculum mt-50">
                            <h4 class="courses_details_title">Q:
                                <?php echo $i . " (" . $qn_tag . ")"; ?>
                            </h4>
                            <div class="courses_top_bar d-sm-flex justify-content-between align-items-center">
                                <div class="courses_title">
                                    <h4 class="courses_details_title">
                                        <?php echo $qn_qnm; ?>
                                    </h4>
                                    <div class="pull-right ps-product__item sub-toggle" data-toggle="tooltip" data-placement="left" title="" data-original-title="Share">
                                        <a data-toggle="modal" data-target="#shareProduct" class="sharelink"><i class="fa fa-share-square-o" onclick="get_qns_lnk('<?php echo $qns_lnk; ?>');"></i></a>
                                       <?php
                $membrid = $_SESSION['sesmbrid'];
                $sqrybok = "select bookmark_qns_id from bookmark_mst where bookmark_qns_id='$qn_id' and bookmark_usr_id='$membrid'";
                $res = mysqli_query($conn, $sqrybok);
                $result_book = mysqli_fetch_assoc($res);
             $bk_qns_id = $result_book['bookmark_qns_id'];
                if ($bk_qns_id == $qn_id) {
                
                }else{
                    ?>
                       <a data-toggle="modal" class="pull-right sharelink"><i class="fa fa-bookmark" onclick="frmprdsub('<?php echo $qn_id; ?>','b')"></i></a>
                    <?php
                  
                }
                ?>  
                                     
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                for ($j = 1; $j < 5; $j++) { ?>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="<?php echo $i; ?>customRadioInline<?php echo $j; ?>" name="<?php echo $i; ?>customRadioInline<?php echo $i; ?>" class="custom-control-input" onclick="show_ans(<?php echo $i; ?>,<?php echo $j; ?>,<?php echo $qn_id; ?>);">
                                        <label class="custom-control-label" for="<?php echo $i; ?>customRadioInline<?php echo $j; ?>">
                                            <?php echo html_entity_decode($srows_qns['addquesm_optn' . $j]); ?>
                                        </label>
                                    </div>
                                <?php
                                }
                                ?>

                                <p>
                                    <strong>
                                        <span class="text-success" style="display: none" id="crct<?php echo $i; ?>"><i class="fa fa-check"></i>
                                            Correct</span>
                                        <span class="text-danger" style="display: none" id="wrng<?php echo $i; ?>"><i class="fa fa-close"></i>
                                            Wrong</span>
                                    </strong>
                                </p>
                            </div>
                            <div class="scrolling-box" id="explnbx_<?php echo $i; ?>" style="display: none">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                <?php
                } else {
                ?>
                    <div align-items-center>
                        No Questions Found On Bookmark Plese Add: <a href="<?php echo $rtpth; ?>">Click here</a>
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
    $(function() {
        var Accordion = function(el, multiple) {
            this.el = el || {};
            this.multiple = multiple || false;
            // Variables privadas
            var links = this.el.find('.link');
            // Evento
            links.on('click', {
                el: this.el,
                multiple: this.multiple
            }, this.dropdown)
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