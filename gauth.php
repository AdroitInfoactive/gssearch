<?php
session_start();
require_once 'includes/inc_connection.php';//Make connection with the database  	
include_once 'includes/inc_config.php';
require_once('settings.php');
require_once('google-login-api.php');
include_once 'includes/inc_password_generator.php';
// Google passes a parameter 'code' in the Redirect Url
function randomPassword()
{
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < 8; $i++)
	{
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
if(isset($_GET['code']))
{
	try
	{
		$gapi = new GoogleLoginApi();
		// Get the access token 
		$data = $gapi->GetAccessToken(CLIENT_ID, CLIENT_REDIRECT_URL, CLIENT_SECRET, $_GET['code']);
		// Get user information
		$user_info = $gapi->GetUserProfileInfo($data['access_token']);
		//echo '<pre>';print_r($user_info); echo '</pre>';
		// Now that the user is logged in you may want to start some session variables
		$_SESSION['logged_in'] = 1;
	  // print_r($user_info['emails']['0']['value'])
		$displayName = $user_info['displayName'];
		$email = $user_info['emails']['0']['value'];
		$sqrymbr_mst = "SELECT mbrm_id,mbrm_emailid,mbrd_fstname, mbrd_lstname,mbrd_badrs,mbrd_bmbrcntrym_id, mbrd_bcty_id,mbrd_bmbrcntym_id,mbrd_bzip, mbrd_bdayphone,mbrd_dfltshp,mbrinfm_id,mbrinfm_email from vw_mbr_mst_bil left join mbrinf_mst on mbrm_id = mbrinfm_mbrm_id where mbrm_emailid = '$email'";
		$srsmbr_mst = mysqli_query($conn,$sqrymbr_mst);
		$cntmbr_mst = mysqli_num_rows($srsmbr_mst);
		// echo $sqrymbr_mst;
		if($cntmbr_mst < 1)
		{
			$ipadrs = $_SERVER['REMOTE_ADDR'];
			$dt = date('Y-m-d H:i:s');
			$sts = 'a'; 
			$pwd = randomPassword();
			$rndpwd =	md5($pwd);
			$iqrymbr_mst = "INSERT into mbr_mst(mbrm_emailid,mbrm_name,mbrm_pwd,mbrm_ipadrs,mbrm_sts,mbrm_crtdon,mbrm_crtdby) values ('$email','$displayName','$rndpwd','$ipadrs','$sts','$dt','$email')";						 
		  // echo $iqrymbr_mst;exit;
			$irsmbrgogl_mst = mysqli_query($conn,$iqrymbr_mst) or(die(mysqli_error()));
			if($irsmbrgogl_mst == true)
			{
				$id = mysqli_insert_id($conn);
				/* $iqrymbrinfo_mst="insert into mbrinf_mst(
							 mbrinfm_email,mbrinfm_name,mbrinfm_mbrm_id,mbrinfm_sts,
							 mbrinfm_gndr,mbrinfm_crtdon,mbrinfm_crtdby)
							 values('$email','$gsfullname','$id','$sts',
							 '$dsgndrpval','$dt','$email')";						 
				$irsmbrinfo_mst = mysqli_query($conn,$iqrymbrinfo_mst) or(die(mysqli_error()));*/
				$_SESSION['sesmbremail'] = $email;
				//assing value of user id to admin session
				$_SESSION['sesmbrid'] = $id;
				//assing value of user id to admin session	
				$_SESSION['sesmbrdname'] = $displayName;
				$filepath = explode("signin.php",$_SERVER['PHP_SELF']);  //Stores the file path
				$hdimg = "http://".$u_prjct_mnurl."/".$site_logo; //Return the URL
				$subject = "Account Information - $usr_cmpny"; 
				$body ="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.01//EN' 'http://www.w3.org/TR/html4/strict.dtd'>
				<html>
					<head>
						<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
						<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
						<title>$usr_cmpny | Order Information</title>
						<style type='text/css'>
							#outlook a{padding:0}body{width:100% !important;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;margin:0;padding:0;background-color:#fdfbed;font-family:Arial,Helvetica,sans-serif;font-size:12px}p{margin-top:0;margin-bottom:10px}table td{border-collapse:collapse}table{border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt}img{outline:none;text-decoration:none;-ms-interpolation-mode:bicubic}a img{border:none}.image_fix{display:block} a{color:#109547; text-decoration:none;} a:hover{color:#ea7724; text-decoration:none;}
						</style>
					</head>
					<body style='margin:0; background-color:#ffffff;' marginheight='0' topmargin='0' marginwidth='0' leftmargin='0'>
						<div style='background-color:#fff;'>
							<table width='600' border='0' align='center' cellpadding='5' cellspacing='1' bordercolor='#4A2E2D' style='font-family:Verdana, Arial, Helvetica, sans-serif;font-size:12px; color:#333333'>
								<tr>
									<td align='center' bgcolor='#333333'>
										<img src='$hdimg' alt='$usr_cmpny' hspace='10' vspace='15' width='200'>
									</td>
								</tr>	
							</table>
							<table width='600'  border='0' align='center' cellpadding='6' cellspacing='0'>
								<tr>
									<td><p><br>
										Dear Customer, 
										<p>Thank you for registering with us and choosing products from <em>$usr_cmpny</em>.</p>
										<p>Your User Name <em>$email </em>.</p>
										<p>Your Password <em>$pwd</em>.</p>
										<p>We would like to welcome you as a new member of <a href='http://$u_prjct_mnurl' target='_blank'>$u_prjct_url</a>
										<p>For suggestions / support please feel free to email us at <a href='mailto:$u_prjct_url1s' class='style:color-000'>$u_prjct_url1s.</a></p>
										<p>Sincerely, <br>
											Customer Service,<br><br>
											Support &amp; Answer Center,<br>
											<a href='http://".$u_prjct_mnurl."'>Mangatrai Pearls &amp; Jewellers<br>
										</p>
									</td>
								</tr>
							</table>
						</div>
					</body>
				</html>";
				$to = $email;
				$fromemail = "$u_prjct_email";
				$headers = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= "From: $fromemail" . "\r\n";
				$headers .= "Cc: $email" . "\r\n";
				mail($to,$subject,$body,$headers);
				if(isset($_SESSION['cartcode']) && (trim($_SESSION['cartcode']) != ""))
				{
					//header("Location: ".$rtpth."add-member-address");
					?>
					<script type="text/javascript">
						location.href = "<?php echo $rtpth;?>add-member-address";
					</script>
					<?php
				}
				elseif(isset($_SESSION['pgname']) && ($_SESSION['pgname'] == "y") )
				{
					$_SESSION['sesmbrmenu'] = "wshlst";
					?>
					<script type="text/javascript">
						location.href = "<?php echo $rtpth;?>wishlist";
					</script>
					<?php
					exit();	
				}			
				else
				{ ?>
					<script language="javascript" type="text/javascript">
						alert("Congratulations \n Your account has been created successfully");
						location.href = "<?php echo $rtpth.'add-member-address'?>";
					</script>						
					<?php					
				}
				exit();								
				$greg_msg = "Congratulations <br> Your account has been created successfully";
			}
		}
		else
		{
			while($srowmbr_mst = mysqli_fetch_assoc($srsmbr_mst))
			{
				$_SESSION['sesmbremail'] = $srowmbr_mst['mbrm_emailid'];//assing value of user id to admin session
				$_SESSION['sesmbrid'] = $srowmbr_mst['mbrm_id'];//assing value of user id to admin session	
				$_SESSION['sesmbrphn'] = $srowmbr_mst['mbrd_bdayphone'];//assing value of user id to admin session
				$_SESSION['sesmbrdname'] = $srowmbr_mst['mbrd_fstname']." ".$srowmbr_mst['mbrd_lstname'];
				$mbrinfm_email = $srowmbr_mst['mbrinfm_email'];
				if($srowmbr_mst['mbrd_dfltshp'] == "y")
				{
					$_SESSION['sesmbrdcity']   = $srowmbr_mst['mbrd_bcty_id'];				    
					$frstnm = $srowmbr_mst['mbrd_fstname'];
					$lstnm = $srowmbr_mst['mbrd_lstname'];
					$adrs = $srowmbr_mst['mbrd_badrs'];
					$cntry = $srowmbr_mst['mbrd_bmbrcntrym_id'];
					$cty = $srowmbr_mst['mbrd_bcty_id'];
					$cnty = $srowmbr_mst['mbrd_bmbrcntym_id'];
					$zip = $srowmbr_mst['mbrd_bzip'];	
					$mbrinfm_id = $srowmbr_mst['mbrinfm_id'];				
				}
			}
			if(isset($_SESSION['prodid']) && (trim($_SESSION['prodid'] != "")))
			{
				if((trim($frstnm) != "")  && (trim($adrs) != "") && (trim($cty) != "") && (trim($zip) != ""))
				{ ?>
					<script type="text/javascript">
						// location.href = "<?php echo $rtpth;?>delivery-address";
						location.href = "<?php echo $rtpth;?>confirm-and-pay?sts=u";
					</script>
					<?php
					exit();
				}
				else
				{	?>
					<script type="text/javascript">
						location.href = "<?php echo $rtpth;?>add-member-address";
					</script>
					<?php
					exit();
				}
			}
			else
			{
				if($prdrvw =='')
				{ ?>
					<script type="text/javascript">
						location.href = "<?php echo $rtpth;?>my-account";
					</script>
					<?php
					exit();
				}
				else
				{ ?>
					<script type="text/javascript">
						window.history.go(-2);	
					</script>
					<?php		
					exit();
				}
			}
		}		
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		exit();
	}
}
?>