<?php
session_start();
include_once 'includes/inc_config.php';
include_once $inc_user_cnctn; //Making database Connection
require_once('settings.php');
require_once('google-login-api.php');
include_once $inc_user_pswd_gnrtr;
$mbr_sid = session_id();
$ipadrs = $_SERVER['REMOTE_ADDR'];
$dt = date('Y-m-d H:i:s');
$sts = 'a';
// Google passes a parameter 'code' in the Redirect Url
function randomPassword()
{
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
if (isset($_GET['code'])) {
	try {
		$gapi = new GoogleLoginApi();
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		// print_r($data);
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);
		// echo '<pre>';print_r($user_info); echo '</pre>'; // exit;
		// Now that the user is logged in you may want to start some session variables
		// $_SESSION['logged_in'] = 1;
		// print_r($user_info['emails']['0']['value'])
		$name = $user_info['names']['0']['displayName'];
		$email = $user_info['emailAddresses']['0']['value'];
		$phone = $user_info['phoneNumbers']['0']['value'];
		$sqrymbr_mst = "SELECT mbrm_id, mbrm_name, mbrm_emailid, mbrm_pwd, mbrm_mobile from mbr_mst where mbrm_emailid = '$email'";
		$srsmbr_mst = mysqli_query($conn, $sqrymbr_mst);
		$cntmbr_mst = mysqli_num_rows($srsmbr_mst);
		// echo $sqrymbr_mst;
		if ($cntmbr_mst < 1) {
			$pwd = randomPassword();
			$rndpwd = md5($pwd);
			$iqrymbr_mst = "INSERT into mbr_mst(mbrm_emailid,mbrm_name,mbrm_mobile,mbrm_pwd,mbrm_ipadrs,mbrm_sts,mbrm_crtdon,mbrm_crtdby) values ('$email','$name','$phone','$rndpwd','$ipadrs','$sts','$dt','$email')";
			// echo $iqrymbr_mst;exit;
			$irsmbrgogl_mst = mysqli_query($conn, $iqrymbr_mst) or (die(mysqli_error()));
			if ($irsmbrgogl_mst == true) {
				$id = mysqli_insert_id($conn);
				$hdimg = "http://" . $u_prjct_mnurl . "/" . $site_logo; //Return the URL 
				//$rgster_img = "http://".$u_prjct_mnurl."/images/welcome.jpg";//Return the URL
				$subject = "Account Information - $usr_cmpny";
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
						  <p>Your Account has been created Successfully. Please find the details below.</p>
 						  <p>Your User Name <em>$email </em>.</p>
						  <p>Your Password <em>$pswd</em>.</p>
						  <p>We would like to welcome you as a new member of <a href='http://$u_prjct_mnurl' target='_blank'>$u_prjct_url</a>
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
				//echo $body;
				//exit;
				$to = $fromemail;
				$fromemail = $u_prjct_email;
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: $fromemail" . "\r\n";
				//$headers 	.= "Cc: $fromemail" . "\r\n";	
				// echo $subject."--".$body;		
				mail($to, $subject, $body, $headers);
				$_SESSION['sesmbremail'] = $email; //assing value of user id to admin session
				$_SESSION['sesmbrname'] = $name; //assing value of user id to admin session
				$_SESSION['sesmbrid'] = $id; //assing value of user id to admin session
				$iqry_mbr_mbr_lgntrck_mst = "INSERT into mbr_lgntrck_mst(mbr_lgntrckm_sesid,mbr_lgntrckm_ipadrs,mbr_lgntrckm_lgnm_id,mbr_lgntrckm_lgnsts,mbr_lgntrckm_crtdon,mbr_lgntrckm_crtdby)values('$mbr_sid','$ipadrs',$id,'a','$dt','$email')";
				$irs_mbr_lgn_trck = mysqli_query($conn, $iqry_mbr_mbr_lgntrck_mst) or (die(mysqli_error($conn)));
				$uqry_prv_sess = "UPDATE mbr_lgntrck_mst SET mbr_lgntrckm_lgnsts = 'i' WHERE mbr_lgntrckm_sesid != '$mbr_sid' and mbr_lgntrckm_lgnm_id = '$id'";
				$urs_prv_sess = mysqli_query($conn, $uqry_prv_sess) or (die(mysqli_error($conn)));
				$sqry_subs_sts = "SELECT mbrd_sbcr_id, mbrd_sbcr_paidon, mbrd_sbcr_endon from mbr_sbcr_dtl where mbr_sbcr_dtl = '$id' order by mbrd_sbcr_paidon desc limit 1";
				$srssubs_sts = mysqli_query($conn, $sqry_subs_sts);
				$cntsubs_sts = mysqli_num_rows($srssubs_sts);
				if ($cntsubs_sts > 0) {
					$rowsubs_sts = mysqli_fetch_assoc($srssubs_sts);
					$db_sbcr_id = $rowsubs_sts['mbrd_sbcr_id'];
					$db_sbcr_paidon = $rowsubs_sts['mbrd_sbcr_paidon'];
					$db_sbcr_endon = $rowsubs_sts['mbrd_sbcr_endon'];
					$db_sbcr_paidon = date('Y-m-d H:i:s', strtotime($db_sbcr_paidon));
					$db_sbcr_endon = date('Y-m-d H:i:s', strtotime($db_sbcr_endon));
					$curr_dt = date('Y-m-d H:i:s');
					if ($curr_dt >= $db_sbcr_paidon && $curr_dt <= $db_sbcr_endon) {
						$sub_sts = "y";
					} else {
						$sub_sts = "n";
					}
				} else {
					$sub_sts = "n";
				}
				$_SESSION['sesssubsts'] = $sub_sts;
				?>
				<script language="javascript" type="text/javascript">
					alert("Congratulations \n Your account has been created successfully");
					location.href = "<?php echo $rtpth . 'home' ?>";
				</script>
				<?php
			}
		} else {
			while ($srowmbr_mst = mysqli_fetch_assoc($srsmbr_mst)) {
				$db_lgnm_id = $srowmbr_mst['mbrm_id'];
				$db_lgnm_eml = $srowmbr_mst['mbrm_emailid'];
				$db_lgnm_name = $srowmbr_mst['mbrm_name'];
				$_SESSION['sesmbremail'] = $db_lgnm_eml; //assing value of user id to admin session
				$_SESSION['sesmbrid'] = $db_lgnm_id; //assing value of user id to admin session
				$_SESSION['sesmbrname'] = $db_lgnm_name;

				$iqry_mbr_mbr_lgntrck_mst = "INSERT into mbr_lgntrck_mst(mbr_lgntrckm_sesid,mbr_lgntrckm_ipadrs,mbr_lgntrckm_lgnm_id,mbr_lgntrckm_lgnsts,mbr_lgntrckm_crtdon,mbr_lgntrckm_crtdby)values('$mbr_sid','$ipadrs',$db_lgnm_id,'a','$dt','$db_lgnm_eml')";
				$irs_mbr_lgn_trck = mysqli_query($conn, $iqry_mbr_mbr_lgntrck_mst) or (die(mysqli_error($conn)));
				$uqry_prv_sess = "UPDATE mbr_lgntrck_mst SET mbr_lgntrckm_lgnsts = 'i' WHERE mbr_lgntrckm_sesid != '$mbr_sid' and mbr_lgntrckm_lgnm_id = '$db_lgnm_id'";
				$urs_prv_sess = mysqli_query($conn, $uqry_prv_sess) or (die(mysqli_error($conn)));
				$sqry_subs_sts = "SELECT mbrd_sbcr_id, mbrd_sbcr_paidon, mbrd_sbcr_endon from mbr_sbcr_dtl where mbr_sbcr_dtl = '$db_lgnm_id' order by mbrd_sbcr_paidon desc limit 1";
				$srssubs_sts = mysqli_query($conn, $sqry_subs_sts);
				$cntsubs_sts = mysqli_num_rows($srssubs_sts);
				if ($cntsubs_sts > 0) {
					$rowsubs_sts = mysqli_fetch_assoc($srssubs_sts);
					$db_sbcr_id = $rowsubs_sts['mbrd_sbcr_id'];
					$db_sbcr_paidon = $rowsubs_sts['mbrd_sbcr_paidon'];
					$db_sbcr_endon = $rowsubs_sts['mbrd_sbcr_endon'];
					$db_sbcr_paidon = date('Y-m-d H:i:s', strtotime($db_sbcr_paidon));
					$db_sbcr_endon = date('Y-m-d H:i:s', strtotime($db_sbcr_endon));
					$curr_dt = date('Y-m-d H:i:s');
					if ($curr_dt >= $db_sbcr_paidon && $curr_dt <= $db_sbcr_endon) {
						$sub_sts = "y";
					} else {
						$sub_sts = "n";
					}
				} else {
					$sub_sts = "n";
				}
				$_SESSION['sesssubsts'] = $sub_sts;
				?>
				<script language="javascript" type="text/javascript">
					// alert("User account already exist with the provided email address");
					location.href = "<?php echo $rtpth . 'home' ?>";
				</script>
				<?php
			}
		}
	} catch (Exception $e) {
		echo $e->getMessage();
		exit();
	}
}
?>