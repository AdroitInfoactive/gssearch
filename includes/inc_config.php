<?php
global $pgtl, $usr_pgtl;
$pgtl = "GS Search";
$usr_pgtl = "GS Search";
$prefix_tl = "GS Search";
date_default_timezone_set('UTC');
$crntyr = date('Y');
if ($crntyr != 2023) {
	$prd = "2023" . '--' . $crntyr;
} else {
	$prd = 2023;
}
$pgftr = "$prd, $pgtl Designed &amp; Developed By";

$usr_cmpny = "GS Search";

$u_prjct_url = "https://gssearch.in/";
$u_prjct_mnurl = "https://gssearch.in/";
$prjct_dmn = "gssearch.in";
$u_prjct_email = "info" . "@$prjct_dmn";
$u_prjct_email_info = "info" . "@$prjct_dmn";

$rtpth = "/projects/g/gssearch/";

$site_logo = '';

/**************include files*****************/
/**************include files*****************/
$inc_nocache = "../includes/inc_nocache.php";
$adm_session = "../includes/inc_adm_session.php";
$inc_cnctn = "../includes/inc_connection.php";
$inc_usr_fnctn = "../includes/inc_usr_functions.php";
$inc_fnct_fleupld = "../includes/inc_fnct_fleupld.php";
$inc_fnct_blkupld = "../includes/inc_fnct_blkupld.php";
$inc_adm_hdr = "../includes/inc_adm_header.php";
$inc_adm_lftlnk = "../includes/inc_adm_leftlinks.php";
$inc_adm_ftr = "../includes/inc_adm_footer.php";
$inc_fnc_ajax_vdtn = "../includes/inc_fnct_ajax_validation.php";
$inc_fldr_pth = "../includes/inc_folder_path.php";
$inc_pgng_fnctns = "../includes/inc_paging_functions.php";
$inc_pgng1 = "../includes/inc_paging1.php";
$adm_scrpt = '../admin/script.php';
$vndr_session = "../includes/inc_vndr_session.php";
$inc_vndr_lftlnk = "../includes/inc_vndr_toplinks.php";
/*****************User*************************/
/*****************User*************************/
$usr_adm_scrpt = 'admin/script.php';
$inc_user_cnctn = "includes/inc_connection.php";
$inc_user_usr_fnctn = "includes/inc_usr_functions.php";
$inc_user_fnct_fleupld = "includes/inc_fnct_fleupld.php";
$inc_user_fnc_ajax_vdtn = "includes/inc_fnct_ajax_validation.php";
$inc_user_fldr_pth = "includes/inc_folder_path.php";
$inc_user_pgng_fnctns = "includes/inc_paging_functions.php";
$inc_user_pgng1 = "includes/inc_paging1.php";
$inc_user_usrsesn = "includes/inc_usr_session.php";
$inc_user_lftblck = "leftblock.php";
$inc_user_rgtblck = "rightblock.php";
$inc_user_ftr = "footer.php";
$inc_user_hdr = "header.php";
$inc_usr_nocache = "includes/inc_nocache.php";
$inc_mbr_sess = "includes/inc_membr_session.php";
?>