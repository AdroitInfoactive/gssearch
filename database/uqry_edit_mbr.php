<?php

session_start();

if (isset($_POST['btnsbmt_edt_dtl']) && (trim($_POST['btnsbmt_edt_dtl']) == 'Submit') && isset($_POST['edttxtname']) && (trim($_POST['edttxtname']) != '') && isset($_POST['edttxtmobile']) && (trim($_POST['edttxtmobile']) != '') && isset($_POST['edttxtmobile']) && (trim($_POST['edttxtmobile']) != '')) {
    $mbrid = glb_func_chkvl($_POST['hdn_mbr_id']);
    $name = glb_func_chkvl($_POST['edttxtname']);
    $mobile = glb_func_chkvl($_POST['edttxtmobile']);
    $email = glb_func_chkvl($_POST['hdn_mbr_email']);
    $ipadrs = $_SERVER['REMOTE_ADDR'];
    //   $opwd = md5($name);
    //   $pwd = md5($mobile);
    $dt = date('Y-m-d h:i:s');
    $sts = 'a';
     $sqrymbr_mst = "SELECT mbrm_id from mbr_mst where mbrm_id = '$mbrid' and mbrm_emailid = '$email'";
    $srsmbr_mst = mysqli_query($conn, $sqrymbr_mst);
    $cntmbr_mst = mysqli_num_rows($srsmbr_mst);
    if ($cntmbr_mst <=1) {

        $uqry_mbr_mst = "UPDATE mbr_mst set mbrm_name = '$name',mbrm_mobile='$mobile' where mbrm_id = '$mbrid' and mbrm_emailid = '$email'";
        $urs_mbr_mst = mysqli_query($conn, $uqry_mbr_mst);
        if ($urs_mbr_mst == true) {
            $hdimg = "http://" . $u_prjct_mnurl . "/" . $site_logo; //Return the URL 
            //$rgster_img = "http://".$u_prjct_mnurl."/images/welcome.jpg";//Return the URL
            $subject = "Password Changed Successfully. - $usr_cmpny";
            $body = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
								<html>
								<head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
								<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
								<title>$usr_cmpny | Account Information</title>
								<style type='text/css'>
								#outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fdfbed;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block} a{color:#109547; text-decoration:none;} a:hover{color:#ea7724; text-decoration:none;}
								</style>
								</head>
								<body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
								<div style='background-color:#fff;'>
								<table width='600'  border='0' align='center' cellpadding='5' cellspacing='1' bordercolor='#4A2E2D' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px; color:#333333'>
				  <tr>
					<td align='center' bgcolor='#333333'>
						<img src='$hdimg' alt='$usr_cmpny' hspace='10' vspace='15' width='200'></td>
				  </tr>	
				</table>
				<table width='600'  border='0' align='center' cellpadding='6' cellspacing='0'>
					  <tr>
						<td><p><br>
						  Dear $name, 
						  <p>Your Account details Updated Successfully. Please find the details below.</p>
 						  <p>If not done, please contact our administrator at <a href='mailto:$u_prjct_url1s' class='style:color-000'>$u_prjct_url1s.</a></p>
						  <p>For suggestions / support please feel free to email us at <a href='mailto:$u_prjct_url1s' class='style:color-000'>$u_prjct_url1s.</a></p>
						  <p>Sincerely, <br>
									Customer Service,<br><br>
									Support &amp; Answer Center,<br>
						  <a href='http://" . $u_prjct_mnurl . "'>GS Search<br>
								  </p>
						  </td>
					  </tr>
					</table>
				</div>
					</body></html>";
            // echo $body;
            // exit;
            $to = $fromemail;
            $fromemail = $u_prjct_email;
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= "From: $fromemail" . "\r\n";
            //$headers 	.= "Cc: $fromemail" . "\r\n";	
            // echo $subject."--".$body;		
            mail($to, $subject, $body, $headers);
            // $uqry_prv_sess = "UPDATE mbr_lgntrck_mst SET mbr_lgntrckm_lgnsts = 'i' WHERE mbr_lgntrckm_lgnm_id = '$mbrid'";
            // $urs_prv_sess = mysqli_query($conn, $uqry_prv_sess) or (die(mysqli_error($conn)));
            // session_unset();
            // session_destroy();
?>
            <script language="javascript" type="text/javascript">
                alert("Congratulations \n Your account Details Updated successfully.");
                location.href = "<?php echo $rtpth . 'my-account' ?>";
            </script>
<?php
        }
        exit();
        // $greg_msg = "Congratulations <br> Your account has been created successfully";
    }
}
?>