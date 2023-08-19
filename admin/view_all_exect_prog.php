<?php
$pagetitle = "View All Categories";
include_once '../includes/inc_config.php'; //Making paging validation
include_once $inc_nocache; //Clearing the cache information
include_once $adm_session; //checking for session
include_once $inc_cnctn; //Making database Connection
include_once $inc_usr_fnctn; //checking for session	
include_once $inc_pgng_fnctns; //Making paging validation 
include_once $inc_fldr_pth; //Making paging validation
/***************************************************************
Programm : view_product_category.php	
Purpose : For Viewing all Categories
Created By : Bharath
Created On : 20-01-2022
Modified By : 
Modified On : 
Purpose : 
Company : Adroit
************************************************************/
global $msg, $loc, $rowsprpg, $dispmsg, $disppg;
$clspn_val = "6";
$rd_adpgnm = "add_exect_prog.php";
$rd_edtpgnm = "edit_exect_prog.php";
$rd_crntpgnm = "view_all_exect_prog.php";
$rd_vwpgnm = "view_detail_exect_prog.php";
$loc = "";
/*****header link********/
$pagemncat = "Executive Programs";
$pagecat = "Executive Programs";
$pagenm = "Executive Programs";
/*****header link********/
if (isset($_POST['hdnchksts']) && (trim($_POST['hdnchksts']) != "")) {
  $dchkval = substr($_POST['hdnchksts'], 1);
  $id = glb_func_chkvl($dchkval);

  $updtsts = funcUpdtAllRecSts('exect_prog_mst', 'exect_progm_id', $id, 'exect_progm_sts');
  if ($updtsts == 'y') {
    $msg = "<font color=red>Record updated successfully</font>";
  } elseif ($updtsts == 'n') {
    $msg = "<font color=red>Record not updated</font>";
  }
}
if (($_POST['hdnchkval'] != "") && isset($_REQUEST['hdnchkval'])) {
  $dchkval = substr($_POST['hdnchkval'], 1);
  $did = glb_func_chkvl($dchkval);
  $del = explode(',', $did);
  $count = sizeof($del);
  $bnrimg = array();
  $bnrimgpth = array();
  for ($i = 0; $i < $count; $i++) {
    $sqryexect_prog_mst = "SELECT exect_progm_img from exect_prog_mst where exect_progm_id=$del[$i]";
    $srsexect_prog_mst = mysqli_query($conn, $sqryexect_prog_mst);
    $cntrec_exect_prog = mysqli_num_rows($srsexect_prog_mst);
    if ($cntrec_exect_prog > 0) {
      $srowexect_prog_mst = mysqli_fetch_assoc($srsexect_prog_mst);
      $bnrimg[$i] = glb_func_chkvl($srowexect_prog_mst['exect_progm_img']);
      $bnrimgpth[$i] = $a_exec_prog . $bnrimg[$i];
    }
  }
  $delsts = funcDelAllRec($conn, 'exect_prog_mst', 'exect_progm_id', $did);
  $delsts = funcDelAllRec($conn, 'prog_curr_mst', 'prog_currm_prog_id', $did);
  $delsts = funcDelAllRec($conn, 'prog_fac_mst', 'prog_facm_prog_id', $did);
  $delsts = funcDelAllRec($conn, 'prog_ps_mst', 'prog_psm_prog_id', $did);
  if ($delsts == 'y') {
    for ($i = 0; $i < $count; $i++) {
      if (($bnrimg[$i] != "") && file_exists($bnrimgpth[$i])) {
        unlink($bnrimgpth[$i]);
      }
    }
    $msg = "<font color=red>Record deleted successfully</font>";
  } elseif ($delsts == 'n') {
    $msg = "<font color=red>Record can't be deleted(child records exist)</font>";
  }
}
if (isset($_REQUEST['sts']) && (trim($_REQUEST['sts']) != '')) {
  if ($_REQUEST['sts'] == 'y') {
    $msg = "<font color=red>Record updated successfully</font>";
  } elseif ($_REQUEST['sts'] == 'n') {
    $msg = "<font color=red>Record not updated</font>";
  } elseif ($_REQUEST['sts'] == 'd') {
    $msg = "<font color=red>Duplicate Record Exists & Record Not updated</font>";
  }
}
$rowsprpg = 20; //maximum rows per page
include_once "../includes/inc_paging1.php"; //Includes pagination
include_once 'script.php'; ?>
<script language="javascript">
  function addnew() {
    document.frmproductcat.action = "<?php echo $rd_adpgnm; ?>";
    document.frmproductcat.submit();
  }

  function chng() {
    var div1 = document.getElementById("div1");
    var div2 = document.getElementById("div2");
    if (document.frmproductcat.lstsrchby.value == 'n') {
      div1.style.display = "block";
      div2.style.display = "none";
    } else if (document.frmproductcat.lstsrchby.value == 't') {
      div1.style.display = "none";
      div2.style.display = "block";
    }
  }

  function onload() {
    <?php
    if (isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 'n') { ?>
      div1.style.display = "block";
      div2.style.display = "none";
      <?php
    } elseif (isset($_POST['lstsrchby']) && $_POST['lstsrchby'] == 't') { ?>
      div1.style.display = "none";
      div2.style.display = "block";
      <?php
    }
    ?>
  }

  function srch() {
    var urlval = "";
    if ((document.frmproductcat.lstprodmcat.value == "") && (document.frmproductcat.txtsrchval.value == "")) {
      alert("Select Search Criteria");
      document.frmproductcat.lstprodmcat.focus();
      return false;
    }
    var lstprodmcat = document.frmproductcat.lstprodmcat.value;
    var txtsrchval = document.frmproductcat.txtsrchval.value;
    if (lstprodmcat != '') {
      if (urlval == "") {
        urlval += "lstprodmcat=" + lstprodmcat;
      } else {
        urlval += "&lstprodmcat=" + lstprodmcat;
      }
    }
    if (txtsrchval != '') {
      if (urlval == "") {
        urlval += "txtsrchval=" + txtsrchval;
      } else {
        urlval += "&txtsrchval=" + txtsrchval;
      }
    }
    if (document.frmproductcat.chkexact.checked == true) {
      document.frmproductcat.action = "<?php echo $rd_crntpgnm; ?>?" + urlval + "&chk=y";
      document.frmproductcat.submit();
    } else {
      document.frmproductcat.action = "<?php echo $rd_crntpgnm; ?>?" + urlval;
      document.frmproductcat.submit();
    }
  }
</script>
<script language="javascript" type="text/javascript" src="../includes/chkbxvalidate.js"></script>
<?php
include_once $inc_adm_hdr;
//include_once $inc_adm_lftlnk;
?>
<section class="content">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">View All Executive Programs</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">View All Executive Programs</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- Default box -->
  <div class="card">

    <div class="alert alert-warning alert-dismissible fade show" role="alert" id="updid" style="display:none">
      <strong>Updated Successfully !</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="alert alert-info alert-dismissible fade show" role="alert" id="sucid" style="display:none">
      <strong>Added Successfully !</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="card-body p-0">
      <form method="post" action="<?php $_SERVER['SCRIPT_NAME']; ?>" name="frmproductcat" id="frmproductcat">
        <input type="hidden" name="hdnchkval" id="hdnchkval">
        <input type="hidden" name="hdnchksts" id="hdnchksts">
        <input type="hidden" name="hdnallval" id="hdnallval">
        <div class="col-md-12">
          <div class="row justify-content-left align-items-center">
            <div class="col-sm-3">
              <div class="form-group">
              <?php
                  $sqryprodmcat_mst = "select 
                  exect_catm_id,exect_catm_name						
                  from 
                  exect_cat_mst 
                    where	 
                  exect_catm_sts = 'a'
                  order by
                  exect_catm_name";
                  $srsprodmcat_mst = mysqli_query($conn, $sqryprodmcat_mst);
                  $cnt_prodmcat = mysqli_num_rows($srsprodmcat_mst);
                  ?>
                  <select name="lstprodmcat" class="form-control">
                    <option value="">--Select Main Category--</option>
                    <?php
                    if ($cnt_prodmcat > 0) {
                      while ($rowsprodmcat_mst = mysqli_fetch_assoc($srsprodmcat_mst)) {
                        $exect_catm_id = $rowsprodmcat_mst['exect_catm_id'];
                        $exect_catm_name = $rowsprodmcat_mst['exect_catm_name'];
                        ?>
                        <option value="<?php echo $exect_catm_id; ?>" <?php if (isset($_REQUEST['lstprodmcat']) && trim($_REQUEST['lstprodmcat']) == $exect_catm_id) {
                            echo 'selected';
                          } ?>><?php echo $exect_catm_name; ?></option>
                    <?php
                      }
                    }
                    ?>
                </select>
              </div>
            </div>
            <div class="col-sm-3">
              <div class="form-group">
                <label for="txtsrchval"></label>
                <div id="div1" style="display:block">
                  <input type="text" name="txtsrchval" class="form-control" value="<?php if (isset($_POST['txtsrchval']) && ($_POST['txtsrchval'] != "")) {
                    echo $_POST['txtsrchval'];
                  } elseif (isset($_REQUEST['val']) && ($_REQUEST['txtsrchval'] != "")) {
                    echo $_REQUEST['txtsrchval'];
                  } ?>" placeholder="Search By Name">
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="form-group">Exact
                <input type="checkbox" name="chkexact" value="1" <?php if (isset($_POST['chkexact']) && ($_POST['chkexact'] == 1)) {
                  echo 'checked';
                } elseif (isset($_REQUEST['chk']) && ($_REQUEST['chk'] == 'y')) {
                  echo 'checked';
                } ?>>
                &nbsp;&nbsp;&nbsp;
                <input name="button" type="button" class="btn btn-primary" onClick="srch()" value="Search">
                <a href="<?php echo $rd_crntpgnm; ?>" class="btn btn-primary">Refresh</a>
                <button type="submit" class="btn btn-primary" onClick="addnew();">+ Add</button>
              </div>
            </div>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table width="100%" border="0" cellpadding="3" cellspacing="1" class="table table-striped projects">
              <tr>
                <td colspan="<?php echo $clspn_val +1 ; ?>">&nbsp;</td>
                <td align="center">
                  <input name="btnsts" id="btnsts" type="button" value="Status" class="btn btn-xs btn-primary"
                    onClick="updatests('hdnchksts','frmproductcat','chksts')">
                </td>
                <td align="center">
                  <input name="btndel" id="btndel" type="button" value="Delete" class="btn btn-xs btn-primary"
                    onClick="deleteall('hdnchkval','frmproductcat','chkdlt');">
                </td>
              </tr>
              <tr>
                <td width="7%"><strong>SL.No.</strong></td>
                <td width="15%" class="td_bg"><strong>Name</strong></td>
                <td width="21%"><strong>Category</strong></td>
                <td width="21%"><strong>Sub Category</strong></td>
                <td width="21%"><strong>Image</strong></td>
                <td width="9%" align="center"><strong>Rank</strong></td>
                <td width="6%" align="center"><strong>Edit</strong></td>
                <td width="7%" align="center"><strong>
                    <input type="checkbox" name="Check_ctr" id="Check_ctr" value="yes"
                      onClick="Check(document.frmproductcat.chksts,'Check_ctr','hdnallval')"></strong>
                </td>
                <td width="7%" align="center"><strong>
                    <input type="checkbox" name="Check_dctr" id="Check_dctr" value="yes"
                      onClick="Check(document.frmproductcat.chkdlt,'Check_dctr')"></strong>
                </td>
              </tr>
              <?php
              $sqryexect_prog_mst1 = "SELECT exect_progm_id,exect_progm_name,exect_progm_img,exect_progm_sts,exect_progm_prty, exect_catm_name,exect_scatm_name from exect_prog_mst
               inner join exect_cat_mst on		exect_cat_mst.exect_catm_id=exect_prog_mst.exect_progm_catm_id
               inner join exect_scat_mst on		exect_scat_mst.exect_scatm_id=exect_prog_mst.exect_progm_scatm_id
              ";
              //echo "here".$sqryexect_prog_mst1 ;
              if (isset($_REQUEST['lstprodmcat']) && (trim($_REQUEST['lstprodmcat']) != "")) {
                $lstprodmcat = glb_func_chkvl($_REQUEST['lstprodmcat']);
                $loc .= "&lstprodmcat=" . $lstprodmcat;
                if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
                  $sqryexect_prog_mst1 .= " and exect_catm_id = '$lstprodmcat'";
                } else {
                  $sqryexect_prog_mst1 .= " and exect_catm_name like '%$lstprodmcat%'";
                }
              }
              if (isset($_REQUEST['txtsrchval']) && (trim($_REQUEST['txtsrchval']) != "")) {
                $txtsrchval = glb_func_chkvl($_REQUEST['txtsrchval']);
                $loc .= "&txtsrchval=" . $txtsrchval;
                if (isset($_REQUEST['chk']) && (trim($_REQUEST['chk']) == 'y')) {
                  $sqryexect_prog_mst1 .= " and exect_progm_name ='$txtsrchval'";
                } else {
                  $sqryexect_prog_mst1 .= " and exect_progm_name like '%$txtsrchval%'";
                }
              }
              $sqryexect_prog_mst = $sqryexect_prog_mst1 . " order by exect_progm_name asc limit $offset,$rowsprpg";
              $srsexect_prog_mst = mysqli_query($conn, $sqryexect_prog_mst);
              $cnt_recs = mysqli_num_rows($srsexect_prog_mst);
              $cnt = $offset;
              if ($cnt_recs > 0) {
                while ($srowexect_prog_mst = mysqli_fetch_assoc($srsexect_prog_mst)) {
                  $cnt += 1;
                  $pgval_srch = $pgnum . $loc;
                  $db_catid = $srowexect_prog_mst['exect_progm_id'];
                  $db_catname = $srowexect_prog_mst['exect_catm_name'];
                  $db_mncatname = $srowexect_prog_mst['exect_progm_name'];
                  $db_scatname = $srowexect_prog_mst['exect_scatm_name'];
                  $db_catimg = $srowexect_prog_mst['exect_progm_img'];
                  $db_prty = $srowexect_prog_mst['exect_progm_prty'];
                  $db_cattyp = $srowexect_prog_mst['exect_progm_typ'];
                  $db_dplytyp = $srowexect_prog_mst['exect_progm_dsplytyp'];
                  $db_sts = $srowexect_prog_mst['exect_progm_sts'];
                  $db_hmprty = $srowexect_prog_mst['exect_progm_hmprty'];
                  //$db_catimg = $srowexect_prog_mst['exect_progm_smlimg'];
                  //$db_catbnrimg = $srowexect_prog_mst['exect_progm_bnrimg'];
                  ?>
                  <tr <?php if ($cnt % 2 == 0) {
                    echo "";
                  } else {
                    echo "";
                  } ?>>
                    <td>
                      <?php echo $cnt; ?>
                    </td>
                    <td>
                      <a href="<?php echo $rd_vwpgnm; ?>?vw=<?php echo $db_catid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
                        class="links"><?php echo $db_mncatname; ?></a>
                    </td>
                    <td>
                      <?php echo $db_catname; ?>
                    </td>
                    <td>
                      <?php echo $db_scatname; ?>
                    </td>
                    <!-- <td><?php echo $db_mncatname; ?></td> -->
                    <td align="left">
                      <?php
                      $bnrimgnm = $db_catbnrimg;
                      $bnrimgpath = $gcat_fldnm . $bnrimgnm;
                      $imgnm = $srowexect_prog_mst['exect_progm_img'];
                      $imgpath = $a_exec_prog . $imgnm;
                      if (($imgnm != "") && file_exists($imgpath)) {
                        echo "<img src='$imgpath' width='80pixel' height='80pixel'>";
                      } else {
                        echo "N.A";
                      }
                      ?>
                    </td>
                    <td align="center">
                      <?php echo $db_prty; ?>
                    </td>
                    <td align="center">
                      <a href="<?php echo $rd_edtpgnm; ?>?edit=<?php echo $db_catid; ?>&pg=<?php echo $pgnum; ?>&countstart=<?php echo $cntstart . $loc; ?>"
                        class="orongelinks">Edit</a>
                    </td>
                    <td align="center">
                      <input type="checkbox" name="chksts" id="chksts" value="<?php echo $db_catid; ?>" <?php if ($db_sts == 'a') {
                           echo "checked";
                         } ?>
                        onClick="addchkval(<?php echo $db_catid; ?>,'hdnchksts','frmproductcat','chksts');">
                    </td>
                    <td align="center">
                      <input type="checkbox" name="chkdlt" id="chkdlt" value="<?php echo $db_catid; ?>">
                    </td>
                  </tr>
                  <?php
                }
              } else {
                $msg = "<font color=red>No Records In Database</font>";
              }
              ?>
              <tr>
                <td colspan="<?php echo $clspn_val+1 ; ?>">&nbsp;</td>
                <td width="7%" align="center" valign="bottom">
                  <input name="btnsts" id="btnsts" type="button" value="Status"
                    onClick="updatests('hdnchksts','frmproductcat','chksts')" class="btn btn-xs btn-primary">
                </td>
                <td width="7%" align="center" valign="bottom">
                  <input name="btndel" id="btndel" type="button" value="Delete"
                    onClick="deleteall('hdnchkval','frmproductcat','chkdlt');" class="btn btn-xs btn-primary">
                </td>
              </tr>
              <?php
              $disppg = funcDispPag($conn, 'links', $loc, $sqryexect_prog_mst1, $rowsprpg, $cntstart, $pgnum);
              $colspanval = $clspn_val + 2;
              if ($disppg != "") {
                $disppg = "<br><tr><td colspan='$colspanval' align='center' >$disppg</td></tr>";
                echo $disppg;
              }
              if ($msg != "") {
                $dispmsg = "<tr><td colspan='$colspanval' align='center' >$msg</td></tr>";
                echo $dispmsg;
              }
              ?>
            </table>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</section>
<?php include_once "../includes/inc_adm_footer.php"; ?>