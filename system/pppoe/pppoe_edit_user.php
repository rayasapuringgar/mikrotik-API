<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');	
			//include_once('../phpqrcode/qrlib.php');	
			$ARRAY = $API->comm("/ppp/profile/print");		
			
				
				if(!empty($_REQUEST['username'])){

					if($_REQUEST['username']==$_GET['id']){
						$user=$_GET['id'];
						$password=$_REQUEST['password'];					
						$username=$_REQUEST['username'];
						$profile=$_REQUEST['profile'];
						//$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
						//$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
						//$mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
						//$email=$_REQUEST['email']; if($email==""){$email = "";}
						$comment=$_REQUEST['comment']; if($comment==""){$comment = "";}
	                    $img=$user.".png";
						$file=$username.".png";
						@unlink("../qrcode/".$img);
						//QRcode::png('http://'.$ip.'/login?username='.$username.'&password='.$password.'', '../qrcode/'.$file.'');
						mysql_query("UPDATE pppoe_gen SET user='".$_REQUEST['username']."', pass='".$_REQUEST['password']."', profile='".$_REQUEST['profile']."',comment='".$_REQUEST['comment']."' WHERE user='".$user."'");
						
						$ARRAY = $API->comm("/ppp/secret/set", array(											
											"name"		=> $username,
											"password"  => $password,
											"profile"	=> $profile,
							                "comment"	=> $comment,
											//"limit-uptime" => $limit_uptime,
							                //"mac-address"  => $mac ,
		                                    //"address"  => $ip ,
			                               // "email"  => $email ,
									        "numbers"	=> $user,
								));		
						
						echo "<script>alert('แก้ไข  ".$username." สำเร็จแล้ว')</script>";
						//echo "<script>history.back();</script>";
						echo "<meta http-equiv='refresh' content='0;url=index.php?page=pppoe_dtb_user' />";
						exit();
					}else{

						$sql=mysql_query("SELECT user FROM pppoe_gen where user='".$_REQUEST['username']."'");
						$num=mysql_num_rows($sql);						

						if($num==0){
							$user=$_GET['id'];
							$password=$_REQUEST['password'];					
							$username=$_REQUEST['username'];
							$profile=$_REQUEST['profile'];
							//$limit_uptime=$_REQUEST['limit_uptime']; if($limit_uptime==""){$limit_uptime = "00:00:00";}
							//$ip=$_REQUEST['ip']; if($ip==""){$ip = "0.0.0.0";}
						   // $mac=$_REQUEST['mac']; if($mac==""){$mac = "00:00:00:00:00:00";}
						    //$email=$_REQUEST['email']; if($email==""){$email = "";}
							$comment=$_REQUEST['comment']; if($comment==""){$comment = "";}
	                        $img=$user.".png";
							$file=$username.".png";
							@unlink("qrcode/".$img);
							//QRcode::png('http://'.$ip.'/login?username='.$username.'&password='.$password.'', 'qrcode/'.$file.'');
							mysql_query("UPDATE pppoe_gen SET user='".$_REQUEST['username']."', pass='".$_REQUEST['password']."',  profile='".$_REQUEST['profile']."',comment ='".$_REQUEST['comment']."' WHERE user='".$user."'");
							
							$ARRAY = $API->comm("/ppp/secret/set", array(											
												"name"		=> $username,
												"password"  => $password,
												"profile"	=> $profile,
								                "comment"	=> $comment,
												//"limit-uptime" => $limit_uptime,
								                //"mac-address"  => $mac ,
		                                       // "address"  => $ip ,
			                                   // "email"  => $email ,
									            "numbers"	=> $user,
									));		
							
							echo "<script>alert('แก้ไข  ".$username." สำเร็จแล้ว')</script>";
							//echo "<script>history.back();</script>";
							echo "<meta http-equiv='refresh' content='0;url=index.php?page=pppoe_dtb_user' />";
							exit();
						}else{							
							echo "<script>alert('Can Not Change Hotspot User<".$username.">')</script>";							
						}
					}
				}
			
									   								
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.style1 {
	color: #0000FF;
	font-weight: bold;
}
.style2 {color: #0000FF}
.style3 {color: #990000}
-->
</style>
</head>
<div class="col-xs-12 col-md-5" style="margin:0 auto;">
<!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-black">
                <div class="panel-heading" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" ><span style="padding: 0px 0px 0px 1em;
                        font-size: 16px;"><i class="fa fa-user"></i>&nbsp;&nbsp;PPPOE Edit user - แก้ไขยูสเซอร์</h3></span>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form name="login" action="" method="post">
					<?php
					$result=mysql_fetch_array(mysql_query("SELECT * FROM pppoe_gen WHERE user='".$_REQUEST['id']."'"));
					?>
					 <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber"><span class="style2">เลือก Package</span></label>
                                    <div class="input-group">
                                        <select name="profile"  id="profile" class="form-control" required>
					      <option value="<?php echo $result['profile']; ?>"><?php echo $result['profile']; ?></option>
                                            	<?php
													$num =count($ARRAY);
													for($i=0; $i<$num; $i++){
														$seleceted = ($i == 0) ? 'selected="selected"' : '';
														if($ARRAY[$i]['name']!=$result['profile']){
															echo '<option value="'.$ARRAY[$i]['name'].$selected.'">'.$ARRAY[$i]['name'].'</option>';
														}
														
													}
												?>						 
							</select>
                                        <span class="input-group-addon"><i class="fa fa-help"></i></span>
                                    </div>
                                </div>                            
                            </div>
                        </div>
						  <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs style2">Username</span></label>
                                   <input name="username" type="text" placeholder="Username" class="form-control" value="<?php echo $result['user']; ?>" required>  
								 </div>	
                                </div>
                            </div>
							<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style2">Password</span></label>
                                    <input name="password" type="text" placeholder="Password" class="form-control" value="<?php echo $result['pass']; ?>" required>  
									
                                </div>
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="hidden-xs style2">Comment</span></label>
                                   <input name="comment" type="comment" class="form-control" value="<?php echo $result['comment']; ?>">  
							  </div>
                                </div>
                            </div>
                        <center><div class="form-group input-group">                                        
                                        <button id="btnSave" class="btn btn-success" type="submit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-check"></i>&nbsp;Save&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button id="btnCancel" class="btn btn-danger" type="reset"  Onclick="javascript:history.back()">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times"></i>&nbsp;Cancel&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                        </div>
                        <div class="row" style="display:none;">
                            <div class="col-xs-12">
                                <p class="payment-errors"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>            </div>
            <!-- CREDIT CARD FORM ENDS HERE -->   
		<?
		 $API->disconnect();
?>


 <div class="col-xs-12 col-md-7" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style3">&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
                    <li>เลือก Package</li>
                    <li>ตัวเลือก ที่ไม่กำหนดจะเป็นค่า<strong> default .</strong></li>
                    </ul>
            </p>
     
            
            <!-- <p>Built upon: Bootstrap, jQuery, 
                <a href="http://jqueryvalidation.org/">jQuery Validation Plugin</a>, 
                <a href="https://github.com/stripe/jquery.payment">jQuery.payment library</a>,
                and <a href="https://stripe.com/docs/stripe.js">Stripe.js</a>
            </p> -->
</div>