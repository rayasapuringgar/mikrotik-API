<?php
		
			include_once('../config/routeros_api.class.php');			
			include_once('../include/conn.php');																																			
			$ARRAY1 = $API->comm("/ip/hotspot/print");
				
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--
.style1 {color: #0000FF}
.style2 {color: #990000}
-->
</style>
</head>
<body>
<div class="col-xs-12 col-md-5" style="margin:0 auto;">

		<!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-black">
                <div class="panel-heading" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" ><span style="padding: 0px 0px 0px 1em;
                         font-size: 16px;"><i class="fa fa-folder-open"></i>&nbsp;&nbsp;สร้าง Profile</h3></span>
                    </div>                    
                </div>
                <div class="panel-body">
                    <form name="login" action="index.php?page=con_addprofile_process" method="post">
					 <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="couponCode"><span class="style1">Profile Name</span></label>
                                    <input name="name" type="text" placeholder="Profile Name"  class="form-control" required >
                                </div>                            
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><label for="cardExpiry"><span class="hidden-xs style1">Session Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลาเชื่อมต่อ สูงสุด"></label>
                                    <input name="session" type="text" placeholder="Ex.04:00:00"   class="form-control" >
                               </div>                            
                            </div>
                        <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><label for="cardExpiry"><span class="hidden-xs style1">Idle Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา logout userออกจากระบบถ้าไม่ได้ใช้งาน"></label>
                                    <input name="idle" type="text" placeholder="Ex.00:02:00" class="form-control" value="none" >
                               </div>
							   </div>
                        </div>
						<div class="row">
                            <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="couponCode"><label for="cardExpiry"><span class="hidden-xs style1">Keepalive Timeout</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดเวลา logout userออกจากระบบถ้าไม่ได้เชื่อมต่อ"></label>
                                    <input name="keep" type="text" placeholder="Ex.00:02:00" class="form-control" value="00:02:00" >
                               </div>
                            </div>
							<div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="cardExpiry"><span class="style1 hidden-xs">Status Autorefresh</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="ตั้งเวลาอัพเดทสถานะ ของ user"></label>
                                   <input name="auto" type="text" placeholder="Ex.00:01:00" value="00:01:00"  class="form-control">  
									
                                </div>
                            </div>
                            <div class="col-xs-6 col-md-6">
                                <div class="form-group">
                                    <label for="cardCVC"><span class="style1">Shared Users</span><img src="../img/help.png" width="16" height="16"  class="no2" data-toggle="tooltip" data-placement="right" title="กำหนดจำนวนเครื่องที่สามารถใช้พร้อมกันได้ ต่อ 1user"></label>
                                    <input name="use" type="text" value="1"  class="form-control">  
								</div>                            
                            </div>
                        </div>
						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="couponCode"><label for="cardExpiry"><span class="hidden-xs style1">Scheduler Aoto Remove</span> <img src="../img/help.png" width="16" height="16"  class="no1"  title="กำหนดเวลา ในการลบuserออกจากระบบ"></label>
                                    <input name="uptime" type="text" placeholder="Ex.1d,1h" class="form-control" value="30d" required >
                               </div>
							   </div>
                        </div>
						<div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="couponCode"><label for="cardExpiry"><span class="hidden-xs style1">Rate Limit (rx/tx)</span> <img src="../img/help.png" width="16" height="16"  class="no1" data-toggle="tooltip" data-placement="right" title="กำหนดค่าความเร็วอินเตอร์เน็ต ของแพ็คเกจ Ex.512K/5M"></label>
                                    <input name="limit" type="text"  placeholder="upload/download" class="form-control"  >
                               </div>
                            </div>                        
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-success btn-lg btn-block" type="submit">SAVE</button>
                            </div>
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
		mysql_close();
		 $API->disconnect();
?>


 <div class="col-xs-12 col-md-7" style="font-size: 12pt; line-height: 2em;">
            <p><h1 class="style2">&nbsp;&nbsp;&nbsp;ข้อแนะนำการใช้งาน :</h1>
                <ul>
                    <li><strong>Scheduler Aoto Remove</strong> คือตั้งเวลานับถอยหลัง เพื่อที่จะลบ userเช่น  1h= 1ชั่วโมง , 1d= 1วัน </li>
                    <li>ตัวเลือกที่ไม่ตั้งค่า จะเป็นค่า  Default.
                </ul>
            <!-- <p>Built upon: Bootstrap, jQuery, 
                <a href="http://jqueryvalidation.org/">jQuery Validation Plugin</a>, 
                <a href="https://github.com/stripe/jquery.payment">jQuery.payment library</a>,
                and <a href="https://stripe.com/docs/stripe.js">Stripe.js</a>
            </p> -->
</div>