<?php
	require("config.php");
	include("includes/functions.php");
	$user = mysql_query("SELECT * FROM `users` WHERE `user_id` = '".$_SESSION["FBID"]."'");
	$user = mysql_fetch_assoc($user);
	$type = $user["user_type"];
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<title>Qnnect</title>
		<link rel="icon" href="assets/img/favicon.png" type="image/png">
		<!-- JQUERY -->
		<script src="assets/js/jquery-latest.min.js"></script>
		<script src="assets/js/jquery-ui.min.js"></script>
		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="assets/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<script src="assets/js/bootstrap.min.js"></script>
		<!-- CUSTOM -->
		<link rel="stylesheet" href="assets/css/jquery.tagit.css">
		<link rel="stylesheet" href="assets/css/jquery-ui.css">
		<link rel="stylesheet" href="assets/css/styles.css"
>		<script src="assets/js/tag-it.js"></script>
		<script src="assets/js/script.php"></script>
	</head>
	<body>

		<div class="loading-overlay">
			<img src="assets/img/ellipsis.gif">
		</div>
		<div id="splash">
			<div class="col-sm-6">
				<?php if(!isset($_SESSION["ACCESS_TOKEN"])){ ?>
				<img src="assets/img/splash-logo.png" class="img-responsive">
				<button class="facebook-login-btn" id="login-fb"><i class="fa fa-facebook"></i> Login with Facebook</button>
				<?php }else{ ?>
				<img src="assets/img/splash-logo.gif" class="img-responsive">
				<?php } ?>
			</div>
		</div>
		<?php if(isset($_SESSION["ACCESS_TOKEN"])){ ?>
		<div class="container">
			<div class="row">
				<div class="nav-bottom">
					<div class="input-group" id="chat-input">
                        <input id="btn-input" class="input-lg" placeholder="Type your message here..." type="text">
                        <span class="input-group-btn">
                            <button class="btn btn-warning btn-lg" id="btn-chat">Set Appointment</button>
                            <button class="btn btn-danger btn-lg" id="btn-chat">Send</button>
                        </span>
                    </div>
					<div class="col-xs-4" nav="home">
						<i class="fa fa-home"></i>
					</div>
					<div class="col-xs-4" nav="messages">
						<i class="fa fa-comments"></i>  <label class="label label-default">1</label>
					</div>
					<div class="col-xs-4 active" nav="profile">
						<i class="fa fa-user-plus"></i>
					</div>
				</div>
				<div class="profile row">
					<div>
						<img src="https://graph.facebook.com/<?=$_SESSION["FBID"]; ?>/picture?type=large" class="img-responsive img-circle">
						<h3>..</h3>
						<h6><i class="fa fa-map-marker"></i>&nbsp; &nbsp;<span id="location">Getting location..</span></h6>
						<div class="job-list"></div>
						<hr />
						<div class="container"><p>..</p></div>
						<hr />
						<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit-profile"><i class="fa fa-pencil"></i> Edit <?php echo (($type==1) ? "Profile" : "Company") ?></button>
						<br /><br />
						<a class="btn btn-danger" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
					</div>
				</div>
				<div class="tinder row">
					<div></div>
				</div>
				<div class="messages row">
					<ul>
					</ul>
				</div>
				<div class="home row">
					<div class="pulse"></div>
					<div class="img">
						<img src="https://graph.facebook.com/<?=$_SESSION["FBID"];?>/picture?type=large" class="img-circle">
						<img src="assets/img/finding-<?php echo (($type==1) ? "companies" : "employees") ?>.png" class="img-circle qnect-logo">
					</div>
				</div>
				<div class="message-list row">
					<div class="header">
						<div class="container">
							<div class="pull-left"><i class="fa fa-chevron-left"></i> <span class="name">Christian</span></div>
						</div>
					</div>
					<div class="chat-list">
						<div class="container">
							<ul class="chat">
		                        <li class="left clearfix"><span class="chat-img pull-left">
		                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
		                        </span>
		                            <div class="chat-body clearfix">
		                                <div class="header">
		                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
		                                        <span class="glyphicon glyphicon-time"></span>12 mins ago</small>
		                                </div>
		                                <p>
		                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
		                                    dolor, quis ullamcorper ligula sodales.
		                                </p>
		                            </div>
		                        </li>
		                        <li class="right clearfix"><span class="chat-img pull-right">
		                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
		                        </span>
		                            <div class="chat-body clearfix">
		                                <div class="header">
		                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>13 mins ago</small>
		                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
		                                </div>
		                                <p>
		                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
		                                    dolor, quis ullamcorper ligula sodales.
		                                </p>
		                            </div>
		                        </li>
		                        <li class="left clearfix"><span class="chat-img pull-left">
		                            <img src="http://placehold.it/50/55C1E7/fff&text=U" alt="User Avatar" class="img-circle" />
		                        </span>
		                            <div class="chat-body clearfix">
		                                <div class="header">
		                                    <strong class="primary-font">Jack Sparrow</strong> <small class="pull-right text-muted">
		                                        <span class="glyphicon glyphicon-time"></span>14 mins ago</small>
		                                </div>
		                                <p>
		                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
		                                    dolor, quis ullamcorper ligula sodales.
		                                </p>
		                            </div>
		                        </li>
		                        <li class="right clearfix"><span class="chat-img pull-right">
		                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
		                        </span>
		                            <div class="chat-body clearfix">
		                                <div class="header">
		                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
		                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
		                                </div>
		                                <p>
		                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
		                                    dolor, quis ullamcorper ligula sodales.
		                                </p>
		                            </div>
		                        </li>
		                        <li class="right clearfix"><span class="chat-img pull-right">
		                            <img src="http://placehold.it/50/FA6F57/fff&text=ME" alt="User Avatar" class="img-circle" />
		                        </span>
		                            <div class="chat-body clearfix">
		                                <div class="header">
		                                    <small class=" text-muted"><span class="glyphicon glyphicon-time"></span>15 mins ago</small>
		                                    <strong class="pull-right primary-font">Bhaumik Patel</strong>
		                                </div>
		                                <p>
		                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur bibendum ornare
		                                    dolor, quis ullamcorper ligula sodales.
		                                </p>
		                            </div>
		                        </li>
		                    </ul>
	                    </div>
					</div>
					<div class="footer">
						<div class="container">
	                    </div>
					</div>
				</div>
			</div>
		</div>
		<div id="edit-profile" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<form action="actions/update-profile.php" method="POST" id="edit-profile-form">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit <?php echo (($type==1) ? "Personal Account" : "Business Account") ?></h4>
					</div>
					<div class="modal-body">
					<?php if($type=="1"){ ?>
						<label for="Job Title">I am looking for jobs like:</label>
						<input name="jobs" id="jobs" value="<?=$user["user_jobs"];?>" style="opacity: 0" required>
						<ul id="jobsBox"></ul>
						<script>
						$(function() {
							var jobs = [<?php $result = mysql_query("SELECT * FROM `jobs`"); $number = mysql_num_rows($result); $i = 1; while ($row = mysql_fetch_assoc($result)) {
    			echo '"'.$row["job_title"].'"'; if ($i < $number){ echo ','; } $i++;
    		} ?>];
							$('#jobsBox').tagit({
								availableTags: jobs,
								removeConfirmation: true,
								singleField: true,
								singleFieldNode: $('#jobs')
							});
						});
						</script>	
						<br />
						<label for="skills">Skills</label>
						<input name="skills" id="skills" value="<?=$user["user_skills"];?>" style="opacity: 0" required>
						<ul id="skillsBox"></ul>
						</p>
						<script>
						$(function() {
							var skills = [<?php $result = mysql_query("SELECT * FROM `skills`"); $number = mysql_num_rows($result); $i = 1; while ($row = mysql_fetch_assoc($result)) {
    			echo '"'.$row["skill_name"].'"'; if ($i < $number){ echo ','; } $i++;
    		} ?>];
							$('#skillsBox').tagit({
								availableTags: skills,
								removeConfirmation: true,
								singleField: true,
								singleFieldNode: $('#skills')
							});
						});
						</script>	
						<br />
						<label for="about-yourself">About yourself</label>
						<textarea class="form-control" placeholder="About yourself" id="about-yourself" name="about" required><?=$user["user_about"];?></textarea>
						<br />
					<?php }else{ ?>
						<label for="comp-name">Company name</label>
						<input type="text" class="form-control" placeholder="Company name" id="comp-name" name="comp_name" value="<?=$user["comp_name"];?>">
						<br />
						<label for="comp-address">Company Address</label>
						<input type="text" class="form-control" placeholder="Address" id="comp-address" name="comp_address" value="<?=$user["comp_address"];?>">
						<br />
						<label for="about-company">About the company</label>
						<textarea class="form-control" placeholder="About the company" id="about-company" name="about_company"> <?=$user["about_company"];?></textarea>
						<br />
					<?php } ?>
					</div>
					<div class="modal-footer">
						<div class="pull-left">
							<a class="btn btn-danger btn-block" href="actions/switch.php"><i class="fa fa-exchange"></i> Switch to <?php echo (($type==1) ? "Business Account" : "Personal Account") ?></a>
						</div>
						<div class="pull-right">
							<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<?php } ?>
	</body>
</html>