<?php
session_start();
error_reporting(0);
include_once 'includes/inc_config.php'; //Making paging validation	
include_once $inc_user_cnctn; //Making database Connection
include_once $inc_user_usr_fnctn; //checking for session	
include_once $inc_user_fldr_pth;
?>

<?php
if ((isset($_GET['catid']) && $_GET['catid'] != "") && (isset($_GET['scatid']) && $_GET['scatid'] != "")) {
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $qnsperpg = 2;
  $offset = ($page - 1) * $qnsperpg;
  $sqry_qns1 = "SELECT addquesm_id, addquesm_qnm, addquesm_prodmnexmsm_id, addquesm_exmscat_id, addquesm_typ_id, addquesm_yearsm_id, addquesm_topicsm_id, addquesm_subtopicsm_id, addquesm_optn1, addquesm_optn2, addquesm_optn3, addquesm_optn4, addquesm_crtans, addquesm_expln, addquesm_qns_typ, addquesm_qns_tag from addques_mst
  inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
  inner join exam_subcategory_mst on exam_subcategorym_id = addquesm_exmscat_id
  inner join years_mst on yearsm_id = addquesm_yearsm_id
  inner join topics_mst on topicsm_id = addquesm_topicsm_id
  left join subtopics_mst on subtopicsm_id = addquesm_subtopicsm_id where addquesm_sts = 'a' and prodmnexmsm_sts = 'a' and exam_subcategorym_sts = 'a'";
  if (isset($_GET['catid']) && $_GET['catid'] != "") {
    $cat_id = ($_GET['catid']);
    $cat_id_qry = funcStrUnRplc($cat_id);
    $sqry_qns1 .= " and prodmnexmsm_name = '$cat_id_qry'";
  }
  if (isset($_GET['scatid']) && $_GET['scatid'] != "") {
    $scat_id = ($_GET['scatid']);
    $scat_id_qry = funcStrUnRplc($scat_id);
    $sqry_qns1 .= " and exam_subcategorym_name = '$scat_id_qry'";
  }
  if (isset($_GET['yr']) && $_GET['yr'] != "") {
    $yr_id = ($_GET['yr']);
    $yr_id_qry = funcStrUnRplc($yr_id);
    $sqry_qns1 .= " and  yearsm_name= '$yr_id_qry'";
  }
  $sqry_qns2 = " group by addquesm_id order by addquesm_prty asc limit $offset,$qnsperpg";
  $sqry_qns = $sqry_qns1 . $sqry_qns2;
  $srs_tot_qns = mysqli_query($conn, $sqry_qns1);
  $cnt_tot_qns = mysqli_num_rows($srs_tot_qns);
  $pages = ceil($cnt_tot_qns / $qnsperpg);
  $srs_qns = mysqli_query($conn, $sqry_qns);
  $cntrec_qns = mysqli_num_rows($srs_qns);
  if ($cntrec_qns > 0) { ?>
    <div class="single_courses_details mb-60">
      <?php
      $page = 1;
      $i = $offset;
      while ($srows_qns = mysqli_fetch_assoc($srs_qns)) {
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
              <div class="ps-product__item sub-toggle" data-toggle="tooltip" data-placement="left" title="" data-original-title="Share">
                <a data-toggle="modal" class="pull-right sharelink" data-target="#shareProduct"><i class="fa fa-share-square-o" onclick="get_qns_lnk('<?php echo $qns_lnk; ?>');"></i></a>
                <?php
                $membrid = $_SESSION['sesmbrid'];
                $sqrybok = "select bookmark_qns_id from bookmark_mst where bookmark_qns_id='$qn_id' and bookmark_usr_id='$membrid'";
                $res = mysqli_query($conn, $sqrybok);
                $result_book = mysqli_fetch_assoc($res);
             $bk_qns_id = $result_book['bookmark_qns_id'];
                if ($bk_qns_id == $qn_id) {
                  $cls="cursor-not-allowed";
                }else{
                  $cls="";
                }
                ?> 
                  <a href="javascript:;" class="pull-right sharelink" id="bookmark" onclick="frmprdsub('<?php echo $qn_id; ?>','b')"><i class="fa fa-bookmark "></i></a>
               
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
            <!-- <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline1">World Bank</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline2">Asian Development Bank</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline3">International Monetary Fund</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline4" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline4">United Nations Environment Programme
                Finance Initiative</label>
            </div> -->
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
    </div>
  <?php
  }
}

if ((isset($_GET['srch']) && $_GET['srch'] != "")) {
  $srch_txt_1 = funcStrUnRplc($_GET['srch']);
  $page = isset($_GET['page']) ? $_GET['page'] : 1;
  $qnsperpg = 2;
  $offset = ($page - 1) * $qnsperpg;
  $sqry_qns_srch1 = "SELECT addquesm_id, addquesm_qnm, addquesm_prodmnexmsm_id, addquesm_exmscat_id, addquesm_typ_id, addquesm_yearsm_id, addquesm_topicsm_id, addquesm_subtopicsm_id, addquesm_optn1, addquesm_optn2, addquesm_optn3, addquesm_optn4, addquesm_crtans, addquesm_expln, addquesm_qns_typ, addquesm_qns_tag, CASE WHEN (addquesm_qnm LIKE '%$srch_txt_1%' or addquesm_optn1 LIKE '%$srch_txt_1%' or addquesm_optn2 LIKE '%$srch_txt_1%' or addquesm_optn3 LIKE '%$srch_txt_1%' or addquesm_optn4 LIKE '%$srch_txt_1%') THEN 1 ELSE 2 END AS result_priority
  from addques_mst
  inner join prodmnexms_mst on prodmnexmsm_id = addquesm_prodmnexmsm_id
  inner join exam_subcategory_mst on exam_subcategorym_id = addquesm_exmscat_id
  inner join years_mst on yearsm_id = addquesm_yearsm_id
  inner join topics_mst on topicsm_id = addquesm_topicsm_id
  left join subtopics_mst on subtopicsm_id = addquesm_subtopicsm_id where addquesm_sts = 'a' and prodmnexmsm_sts = 'a' and exam_subcategorym_sts = 'a'";
  if (isset($_GET['srch']) && $_GET['srch'] != "") {
    $srch = ($_GET['srch']);
    $srch_txt = funcStrUnRplc($srch);
    $sqry_qns_srch1 .= " and (addquesm_qnm LIKE '%$srch_txt%' or addquesm_optn1 LIKE '%$srch_txt%' or addquesm_optn2 LIKE '%$srch_txt%' or addquesm_optn3 LIKE '%$srch_txt%' or addquesm_optn4 LIKE '%$srch_txt%'";
    $searchWords = explode(' ', $srch_txt);
    $likeConditions = [];
    foreach ($searchWords as $word) {
      $likeConditions[] = "addquesm_optn1 LIKE '%$word%' OR addquesm_optn2 LIKE '%$word%' or addquesm_optn3 LIKE '%$word%' OR addquesm_optn4 LIKE '%$word%'";
    }
    $sqry_qns_srch1 .= " or " . implode(' OR ', $likeConditions) . ")";
  }
  $sqry_qns_srch2 = " group by addquesm_id order by result_priority, CASE WHEN (addquesm_qnm LIKE '%$srch_txt_1%' or addquesm_optn1 LIKE '%$srch_txt_1%' or addquesm_optn2 LIKE '%$srch_txt_1%' or addquesm_optn3 LIKE '%$srch_txt_1%' or addquesm_optn4 LIKE '%$srch_txt_1%') THEN 1 ELSE 2 END, addquesm_prty asc limit $offset,$qnsperpg";
  $sqry_qns_srch = $sqry_qns_srch1 . $sqry_qns_srch2;
  $srs_tot_qns = mysqli_query($conn, $sqry_qns_srch1);
  $cnt_tot_qns = mysqli_num_rows($srs_tot_qns);
  $pages = ceil($cnt_tot_qns / $qnsperpg);
  $srs_qns_srch = mysqli_query($conn, $sqry_qns_srch);
  $cntrec_qns_srch = mysqli_num_rows($srs_qns_srch);
  if ($cntrec_qns_srch > 0) { ?>
    <div class="single_courses_details mb-60">
      Search Results for: "<?php echo $srch_txt_1; ?>"
      <?php
      $page = 1;
      $i = $offset;
      while ($srows_qns = mysqli_fetch_assoc($srs_qns_srch)) {
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
              <div class="ps-product__item sub-toggle" data-toggle="tooltip" data-placement="left" title="" data-original-title="Share">
                <a data-toggle="modal" data-target="#shareProduct" class="sharelink"><i class="fa fa-share-square-o" onclick="get_qns_lnk('<?php echo $qns_lnk; ?>');"></i></a>

                <a data-toggle="modal" class="pull-right sharelink active"><i class="fa fa-bookmark" onclick="frmprdsub('<?php echo $qn_id; ?>','b')"></i></a>
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
            <!-- <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline1">World Bank</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline2">Asian Development Bank</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline3" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline3">International Monetary Fund</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline4" name="customRadioInline1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline4">United Nations Environment Programme
                Finance Initiative</label>
            </div> -->
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
    </div>
<?php
  }
}
//bookmark questions start

       /*   $page = 1;
          $i = $offset;
          while ($srows_qns = mysqli_fetch_assoc($srs_tot_qns1)) {

            $i++;
            $bkmrk_id = $srows_qns['bookmark_id'];
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

                    ?>

                      <a data-toggle="modal" class="pull-right sharelink"><i class="fa fa-trash-o" onClick="remvbkmrkqns('<?php echo $bkmrk_id ?>','d')"></i></a>

                    <?php
                    } else {
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
          ?> */
