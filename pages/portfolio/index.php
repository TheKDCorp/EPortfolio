<?php 
	include_once('./created/header.php');

	$studentid = $_GET['studentid'];
	$sql = "SELECT * FROM student_admission where studentid='$studentid'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$rowadmission = $result->fetch_assoc();
		$sql = "select * from student_biodata where studentid='$studentid'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$rowbiodata = $result->fetch_assoc();
		}

		$sql = "select * from student_contact where studentid='$studentid'";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$rowcontact = $result->fetch_assoc();
		}
	}else{
		exit();
	}
?>

<body>
<!--Preloader Start-->
<div id="preloader">
	<div id="status">
		<img src="images/header/loader.gif" alt="loader">
	</div>
</div>
<!--Main Wrapper Start-->
<div class="prt_main_wrapper">
	<div class="prt_home_wrapper">
		<div class="prt_logo_wrapper">
			<a><img src="images/header/logo.png" alt="Logo" id="prt_close_tab"></a>
		</div>
		<div class="prt_menu_wrapper">
			<a href="#about" class="prt_top">About Me</a>
			<a href="#contact" class="prt_right">Contact</a>
			<a href="#services" class="prt_bottom">Portfolio</a>
			<a href="#portfolio" class="prt_left">Gallery</a>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-7 col-sm-10 col-xs-12 col-lg-offset-6 col-md-offset-5 col-sm-offset-2 col-xs-offset-0">
					<h1>I`m <?php echo $rowbiodata['studentname']; ?></h1>
				</div>
			</div>
		</div>
	</div>
<!--About Wrapper Start-->
	<div class="prt_about_wrapper prt_toppadder115">
		<div class="prt_close_wrapper">
			<img src="images/header/down_arrow.png" alt="Close" class="prt_close">
		</div>
		<div class="container">
			<div class="row">
				<div class="prt_about_info prt_bottompadder80">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="prt_about_img">
							<img src="images/content/about.jpg" alt="About">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="prt_heading_wrapper_2">
							<div class="prt_heading prt_toppadder50">
								<h1>About ME</h1>
								<p>WHo AM i</p>
							</div>
						</div>
						<div class="prt_about_details" >
							<p><?php echo $rowbiodata['abouthim']; ?></p>
							<a href="#" class="prt_btn">Download Resume</a> <a href="#" class="prt_btn">Hire Me</a>
						</div>
					</div>
				</div>
				<div class="prt_about_edulearn_wrapper prt_bottompadder115">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="prt_heading_wrapper">
							<div class="prt_heading">
								<h1>EDucation</h1>
								<p>learning</p>
							</div>
						</div>
						<div class="prt_about_learnsection">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-0 col-xs-offset-0">
									<div class="prt_about_learnbox_right">
										<div class="prt_about_learnbox_year">
											<h1>2004</h1>
										</div>
										<div class="prt_about_learnbox_info">
											<h4>Diploma In UI/UX Design</h4>
											<span>New York</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="prt_about_learnbox_left">
										<div class="prt_about_learnbox_year">
											<h1>2006</h1>
										</div>
										<div class="prt_about_learnbox_info">
											<h4>Diploma In Web Design</h4>
											<span>New York</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-6 col-md-offset-6 col-sm-offset-0 col-xs-offset-0">
									<div class="prt_about_learnbox_right">
										<div class="prt_about_learnbox_year">
											<h1>2008</h1>
										</div>
										<div class="prt_about_learnbox_info">
											<h4>Diploma In UI/UX Design</h4>
											<span>New York</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="prt_about_learnbox_left">
										<div class="prt_about_learnbox_year">
											<h1>2010</h1>
										</div>
										<div class="prt_about_learnbox_info">
											<h4>Diploma In Web Design</h4>
											<span>New York</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="prt_about_experience_wrapper prt_bottompadder60">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="prt_heading_wrapper">
							<div class="prt_heading">
								<h1>Experience</h1>
								<p>involvement</p>
							</div>
						</div>
						<div class="prt_about_experience">
							<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="prt_about_experiencebox">
										<div class="prt_about_experience_year">
											<h1>2012</h1>
											<h4>July to 2013 Sep</h4>
										</div>
										<div class="prt_about_experience_info">
											<h4>Junior Ui/Ux Designer</h4>
											<span>Amazon</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="prt_about_experiencebox">
										<div class="prt_about_experience_year">
											<h1>2013</h1>
											<h4>Oct to 2014 Dec</h4>
										</div>
										<div class="prt_about_experience_info">
											<h4>Senior Ui/Ux Designer</h4>
											<span>Adobe</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="prt_about_experiencebox">
										<div class="prt_about_experience_year">
											<h1>2015</h1>
											<h4>Jun to 2015 Mar</h4>
										</div>
										<div class="prt_about_experience_info">
											<h4>Senior Ui/Ux Designer</h4>
											<span>Google</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
									<div class="prt_about_experiencebox">
										<div class="prt_about_experience_year">
											<h1>2016</h1>
											<h4>Apr to Present</h4>
										</div>
										<div class="prt_about_experience_info">
											<h4>Lead Ui/Ux Designer</h4>
											<span>Google</span>
											<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="prt_profile_info">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="prt_profile_slider">
							<div class="owl-carousel owl-theme">
								<div class="item">
									<i class="fa fa-behance pl_clr1" aria-hidden="true"></i>
									<h4>Behance</h4>
								</div>
								<div class="item">
									<i class="fa fa-dribbble pl_clr2" aria-hidden="true"></i>
									<h4>Dribbble</h4>
								</div>
								<div class="item">
									<i class="fa fa-envira pl_clr3" aria-hidden="true"></i>
									<h4>envira</h4>
								</div>
								<div class="item">
									<i class="fa fa-behance pl_clr1" aria-hidden="true"></i>
									<h4>Behance</h4>
								</div>
								<div class="item">
									<i class="fa fa-dribbble pl_clr2" aria-hidden="true"></i>
									<h4>Dribbble</h4>
								</div>
								<div class="item">
									<i class="fa fa-envira pl_clr3" aria-hidden="true"></i>
									<h4>envira</h4>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="prt_heading_wrapper_2">
							<div class="prt_heading">
								<h1>PROFILES</h1>
								<p>WOrks At</p>
							</div>
						</div>
						<div class="prt_profile_details">
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. </p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('./created/pagefooter.php'); ?>
	</div>
<!--Contact Wrapper Start-->
	<div class="prt_contact_wrapper prt_toppadder115">
		<div class="prt_close_wrapper">
			<img src="images/header/right_arrow.png" alt="Close" class="prt_close">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="prt_heading_wrapper">
						<div class="prt_heading">
							<h1>get in touch</h1>
							<p>contact us</p>
						</div>
					</div>
				</div>
				<div class="prt_contact_box">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="prt_contact_info">
							<h1>How we can help you ?</h1>
							<div class="prt_contact_form">
								<div class="row">
									<form>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="first_name" placeholder="Your Name" class="require">
										</div>
										<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
											<input type="text" name="email" placeholder="Your Email" class="require" data-valid="email" data-error="Email should be valid.">
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<input type="text" name="subject" placeholder="Subject" class="require">
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<textarea rows="4" name="message" placeholder="Message" class="require"></textarea>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="response"></div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<button type="button" class="prt_btn submitForm" form-type="contact" onclick="window.open('mailto:<?php echo $rowcontact["emailid"]; ?>');">submit</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="prt_contact_details">
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="prt_contact_details_box details_box1">
							<h4>Phone</h4>
							<p><?php echo $rowcontact['mobileno1']; ?><br><?php echo $rowcontact['mobileno2']; ?></p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="prt_contact_details_box details_box2">
							<h4>Email</h4>
							<p><a onclick="window.open('mailto:<?php echo $rowcontact["emailid"]; ?>');"><?php echo $rowcontact['emailid']; ?></a></p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
						<div class="prt_contact_details_box details_box3">
							<h4>Address</h4>
							<p><?php echo $rowcontact['address']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php include('./created/pagefooter.php'); ?>
	</div>
<!--Services Wrapper Start-->
	<div class="prt_services_wrapper prt_toppadder115">
		<div class="prt_close_wrapper">
			<img src="images/header/up_arrow.png" alt="Close" class="prt_close">
		</div>
		<div class="prt_services_slider_wrapper prt_bottompadder115">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="prt_heading_wrapper">
							<div class="prt_heading">
								<h1>What I do / Who am I</h1>
								<p>take a look</p>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="prt_services_slider_imgs">
							<img class="img_1 active" src="images/content/serv1.jpg" alt="Service">
							<img class="img_2" src="images/content/serv2.jpg" alt="Service">
							<img class="img_3" src="images/content/serv3.jpg" alt="Service">
							<img class="img_4" src="images/content/serv4.jpg" alt="Service">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="prt_services_slider_box">
							<div class="prt_services_slider_text prt_img_click active" id="1">
								<img src="images/content/serv_icon1.png" alt="Service icon">
								<h4>Website Design</h4>
								<p>It is a long established fact that a reader will be distracted</p>
							</div>
							<div class="prt_services_slider_text prt_img_click" id="2">
								<img src="images/content/serv_icon2.png" alt="Service icon">
								<h4>Graphic Design</h4>
								<p>It is a long established fact that a reader will be distracted</p>
							</div>
							<div class="prt_services_slider_text prt_img_click" id="3">
								<img src="images/content/serv_icon3.png" alt="Service icon">
								<h4>Logo Design</h4>
								<p>It is a long established fact that a reader will be distracted</p>
							</div>
							<div class="prt_services_slider_text prt_img_click" id="4">
								<img src="images/content/serv_icon4.png" alt="Service icon">
								<h4>Web Development</h4>
								<p>It is a long established fact that a reader will be distracted</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="prt_couter_wrapper prt_toppadder80 prt_bottompadder50">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="prt_counter_box">
							<img src="images/content/counter_1.png" alt="Clients">
							<h3 class="timer" data-from="0" data-to="95" data-speed="5000"></h3>
							<p>Happy Clients</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="prt_counter_box">
							<img src="images/content/counter_2.png" alt="Projects">
							<h3 class="timer" data-from="0" data-to="165" data-speed="5000"></h3>
							<p>Project Done</p>
						</div>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						<div class="prt_counter_box">
							<img src="images/content/counter_3.png" alt="Awards">
							<h3 class="timer" data-from="0" data-to="16" data-speed="5000"></h3>
							<p>Award Won</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="prt_skills_wrapper prt_toppadder115 prt_bottompadder115">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="prt_heading_wrapper">
							<div class="prt_heading">
								<h1>My Skills</h1>
								<p>Expert in</p>
							</div>
						</div>
					</div>
					<div id="canvas">

						<?php
						 $sql = "select * from student_skills where studentid='$studentid'";
						 $result=$conn->query($sql);
						 if($result->num_rows > 0){
						 	$no = 0;
						 	while($rowskills = $result->fetch_assoc()){
						 		$no = $no + 1;
						 		echo '<div class="prt_services_slider_text prt_img_click" id="'.$no.'"><img src="images/content/serv_icon2.png" alt="Service icon">
								<h4>'.$rowskills['skillsname'].'</h4>
								<p>'.$rowskills['skillsdescription'].'</p>
							</div>';
						 	}
						 } 
						?>
					</div>
				</div>
			</div>
		</div>
<!-- 		<div class="prt_client_slider_wrapper">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="prt_heading_wrapper">
							<div class="prt_heading">
								<h1>Clients</h1>
								<p>Worked With</p>
							</div>
						</div>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="prt_client_slider">
							<div class="owl-carousel owl-theme">
								<div class="item">
									<a href="#"><img src="images/content/client1.png" alt="Client"></a>
								</div>
								<div class="item">
									<a href="#"><img src="images/content/client2.png" alt="Client"></a>
								</div>
								<div class="item">
									<a href="#"><img src="images/content/client3.png" alt="Client"></a>
								</div>
								<div class="item">
									<a href="#"><img src="images/content/client4.png" alt="Client"></a>
								</div>
								<div class="item">
									<a href="#"><img src="images/content/client5.png" alt="Client"></a>
								</div>
								<div class="item">
									<a href="#"><img src="images/content/client3.png" alt="Client"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<?php include('./created/pagefooter.php'); ?>
	</div>
<!--Portfolio Wrapper Start-->
	<div class="prt_portfolio_wrapper prt_toppadder115">
		<div class="prt_close_wrapper">
			<img src="images/header/left_arrow.png" alt="Close" class="prt_close">
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="prt_heading_wrapper">
						<div class="prt_heading">
							<h1>Gallery</h1>
							<p>MY work</p>
						</div>
					</div>
				</div>
				<div class="prt_portfolio_box popup-gallery">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 prt_loadmore">
					<?php
						 $sql = "select * from student_gallery where studentid='$studentid' order by date desc";
						 $result=$conn->query($sql);
						 if($result->num_rows > 0){
						 	$no = 0;
						 	while($rowgallery = $result->fetch_assoc()){
						 		$no = $no + 1;
						 		echo '<a class="imageopen" href="images/content/port1_big.jpg" title="" style="display:inline;">
											<div class="prt_portfolio_img">
												<img src="images/content/port1.jpg" alt="Portfolio">
												<div class="prt_portfolio_text">
													<h4>'.$rowgallery['imagesname'].'</h4>
													<p>'.$rowgallery['imagesdescription'].'</p>
												</div>
											</div>
										</a>';

						 	}
						 } 
					?>
					</div>
					<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="imageopen" href="images/content/port1_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port1.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port2.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port3.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
						<a class="imageopen" href="images/content/port4_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port4.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port5.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
						<a class="imageopen" href="images/content/port6_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port6.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 prt_loadmore">
						<a class="imageopen" href="images/content/port7_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port7.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port8.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="imageopen" href="images/content/port1_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port1.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port2.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port3.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
						<a class="imageopen" href="images/content/port4_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port4.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port5.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
						<a class="imageopen" href="images/content/port6_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port6.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 prt_loadmore">
						<a class="imageopen" href="images/content/port7_big.jpg" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port7.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>box mockup design</h4>
									<p>Mockup</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 prt_loadmore">
						<a class="popup-youtube" href="https://www.youtube.com/watch?v=6yWzKvQXsYM" title="">
							<div class="prt_portfolio_img">
								<img src="images/content/port8.jpg" alt="Portfolio">
								<div class="prt_portfolio_text">
									<h4>Click and open video</h4>
									<p>video</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
						<button class="prt_btn" id="loadMore">load more</button>
					</div> -->
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
					<br>
				</div>
			</div>
		</div>
		<?php include('./created/pagefooter.php'); ?>
	</div>
</div>
<?php include_once('./created/footer.php'); ?>