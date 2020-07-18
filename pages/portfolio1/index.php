<?php 
	include_once('../../includes/dbcon.php');
	$studentid = $_GET['studentid'];
	$sql = "SELECT * FROM student_admission where studentid='$studentid'";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$rowadmission = $result->fetch_assoc();
		$firstclassid = $rowadmission['classid'];
		$firstuid = $rowadmission['uid'];

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

		$sql = "select * from student_csdetails where studentid='$studentid' order by studentcsid desc";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			$rowcsdetails = $result->fetch_assoc();
			$lastclassid = $rowcsdetails['classid'];
			$lastclassname = $rowcsdetails['classname'];
			$lastsectionid = $rowcsdetails['sectionid'];
			$lastuid = $rowcsdetails['uid'];
		}else{
			$lastclassid = "";
			$lastsectionid = "";
			$lastuid = "";
		}
	}else{
		exit();
	}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title><?php echo $rowbiodata['studentname']; ?> - Student Portfolio</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">
    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/ionicons.min.css">
    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">
	  
	  
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.html">MVA | Student Portfolio</a>
	      <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav nav ml-auto">
	          <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
	          <li class="nav-item"><a href="#about-section" class="nav-link"><span>About</span></a></li>
	          <li class="nav-item"><a href="#skills-section" class="nav-link"><span>Skills</span></a></li>
	          <li class="nav-item"><a href="#projects-section" class="nav-link"><span>Gallery</span></a></li>
	          <li class="nav-item"><a href="./activities.php?studentid=<?php echo $studentid; ?>" target="_blank" class="nav-link">Activi<span style="display:inline-block;color:white;">ties</span></a></li>
	          <li class="nav-item"><a href="#contact-section" class="nav-link"><span style="color:white;">Contact</span></a></li>
	        </ul>
	      </div>
	    </div>
	  </nav>
	<section id="home-section" class="hero">
		<div style="height:30em;">
			<img src="../../images/portfolioheader.jpg" style="display:block;position: absolute;top:0px;margin-left:50em;width:70em;height:600px;">
			<div style="margin-left:20em;margin-top:15em;">
				<span>Hello!!!</span>
	            <h1>I'm <span style="color:#0075F5;"><strong><?php echo $rowbiodata['studentname']; ?></strong></span></h1>
	            <!-- <h2 class="mb-4">A Freelance Web Developer</h2> -->
	            <br>
	            <p><a href="#about-section" class="btn-custom" style="border:3px solid #0075F5;padding:0.4em;padding-left:0.8em;padding-right:0.8em;border-radius:5%;color:black;">About Me</a></p>
			</div>
		</div>
		<br>
		<br>
    </section>

    <section class="ftco-about ftco-counter img ftco-section" id="about-section">
    	<div class="container">
    		<div class="row d-flex">
    			<div class="col-md-6 col-lg-5 d-flex">
    				<div class="img-about img d-flex align-items-stretch">
    					<div class="overlay"></div>
	    				<div class="img d-flex align-self-stretch align-items-center" style="background-image:url('../../images/profile/<?php echo $rowbiodata['dp']; ?>.jpg');">
	    				</div>
    				</div>
    			</div>
    			<div class="col-md-6 col-lg-7 pl-lg-5 py-5">
    				<div class="row justify-content-start pb-3">
		          <div class="col-md-12 heading-section ftco-animate">
		          	<span class="subheading">Welcome</span>
		            <h2 class="mb-4" style="font-size: 34px; text-transform: capitalize;">About Me</h2>
		            <p><?php echo $rowbiodata['abouthim']; ?></p>
		          </div>
		        </div>
		        <div class="row">
		        	<div class="col-md-6">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Gained Knowledge At</h3>
		                <p>Macro Vision Academy</p>
		              </div>
		            </div> 
		        	</div>
		        	<div class="col-md-6">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">

		                <h3 class="heading mb-3">Currently in <?php echo $lastclassname ?></h3>
		                <p>Got Positive Reviews from Faculties.</p>
		              </div>
		            </div> 
		        	</div>
		        </div>
<!-- 	          <div class="counter-wrap ftco-animate d-flex mt-md-3">
              <div class="text p-4 pr-5 bg-primary">
              	<p class="mb-0">
	                <span class="number" data-number="200">0</span>
	                <span>Finished Projects</span>
                </p>
              </div>
	          </div> -->
	        </div>
        </div>
        <br>
        <br>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="row">
		        	<div class="col-md-4" style="text-align:center;">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Full Name</h3>
		                <p><?php echo $rowbiodata['studentname']; ?></p>
		              </div>
		            </div> 
		        	</div>
		        	<div class="col-md-4" style="text-align:center;">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">

		                <h3 class="heading mb-3">Date of Birth</h3>
		                <p><?php echo date('d-M-Y',strtotime($rowbiodata['dob'])); ?></p>
		              </div>
		            </div> 
		        	</div>
		        	<div class="col-md-4" style="text-align:center;">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Gender</h3>
		                <p><?php echo strtoupper($rowbiodata['gender']); ?></p>
		              </div>
		            </div> 
		        	</div>
		        </div>
        	</div>
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="row">
		        	<div class="col-md-4" style="text-align:center;">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">
		                <h3 class="heading mb-3">Father's Name</h3>
		                <p><?php echo $rowbiodata['fathersname']; ?></p>
		              </div>
		            </div> 
		        	</div>
		        	<div class="col-md-4" style="text-align:center;">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">

		                <h3 class="heading mb-3">Mother's Name</h3>
		                <p><?php echo $rowbiodata['mothersname']; ?></p>
		              </div>
		            </div> 
		        	</div>
		        	<div class="col-md-4" style="text-align:center;">
		        		<div class="media block-6 services d-block ftco-animate">
		              <div class="icon"><span class="flaticon-analysis"></span></div>
		              <div class="media-body">

		                <h3 class="heading mb-3">Mobile No</h3>
		                <p><?php echo $rowcontact['mobileno1']; ?></p>
		              </div>
		            </div> 
		        	</div>
		        </div>
        	</div>
        </div>
    	</div>
    </section>
		
		<section class="ftco-section bg-light" id="skills-section">
			<div class="container">
				<div class="row justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Skills</span>
            <h2 class="mb-4">My Skills</h2>
           <!--  <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> -->
          </div>
        </div>
				<div class="row">
					<?php 
						$sql = "select * from student_skills where studentid='$studentid'";
						$result=$conn->query($sql);
						if($result->num_rows > 0){
							while($rowskills = $result->fetch_assoc()){
								?>
								<div class="col-md-4">
				    				<div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url('../../images/skills/<?php echo $rowskills['dp']; ?>.jpg');">
				    					<div class="overlay"></div>
					    				<div class="text text-center p-4">
					    					<h3><a href="#"><?php echo $rowskills['skillsname']; ?></a></h3>
					    					<span><?php echo $rowskills['skillsdescription']; ?></span>
					    				</div>
				    				</div>
				  				</div>
								<?php
							}
						}
					 ?>
				</div>
<!-- 				<div class="row justify-content-center py-5 mt-5">
		          <div class="col-md-12 heading-section text-center ftco-animate">
		          	<span class="subheading">What I Do</span>
		            <h2 class="mb-4">Strategy, design and a bit of magic</h2>
		          </div>
		        </div>

        		<div class="row">
					<div class="col-md-4 text-center d-flex ftco-animate">
						<div class="services-1">
							<span class="icon">
								<i class="flaticon-analysis"></i>
							</span>
							<div class="desc">
								<h3 class="mb-5"><a href="#">Explore</a></h3>
								<h4>Design Sprints</h4>
								<h4>Product Strategy</h4>
								<h4>UX Strategy</h4>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center d-flex ftco-animate">
						<div class="services-1">
							<span class="icon">
								<i class="flaticon-flasks"></i>
							</span>
							<div class="desc">
								<h3 class="mb-5"><a href="#">Create</a></h3>
								<h4>Information</h4>
								<h4>UX/UI Design</h4>
								<h4>Branding</h4>
							</div>
						</div>
					</div>
					<div class="col-md-4 text-center d-flex ftco-animate">
						<div class="services-1">
							<span class="icon">
								<i class="flaticon-ideas"></i>
							</span>
							<div class="desc">
								<h3 class="mb-5"><a href="#">Learn</a></h3>
								<h4>Prototyping</h4>
								<h4>User Testing</h4>
								<h4>UI Testing</h4>
							</div>
						</div>
					</div>
				</div>
			</div> -->
		</section>

		<section class="ftco-section ftco-hireme">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-12 d-flex align-items-center ftco-animate">
						<h2><q><span>Parishram Parishram</span> aur itna Parishram ki chah kr bhi aap galat na kar paye...!!!</q></h2>
					</div>
				</div>
			</div>
		</section>
 

    <section class="ftco-section ftco-project" id="projects-section">
    	<div class="container">
    		<div class="row justify-content-center pb-5">
          <div class="col-md-12 heading-section text-center ftco-animate">
          	<span class="subheading">Accomplishments</span>
            <h2 class="mb-4">My Gallery</h2>
            <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> -->
          </div>
        </div>
    		<div class="row">
    			<?php 
					$sql = "select * from student_gallery where studentid='$studentid'";
					$result=$conn->query($sql);
					if($result->num_rows > 0){
						while($rowgallery = $result->fetch_assoc()){
							?>
							<div class="col-md-4">
			    				<div class="project img ftco-animate d-flex justify-content-center align-items-center" style="background-image: url('../../images/gallery/<?php echo $rowgallery['dp']; ?>.jpg');">
			    					<div class="overlay"></div>
				    				<div class="text text-center p-4">
				    					<h3><a href="#"><?php echo $rowgallery['imagesname']; ?></a></h3>
				    					<span><?php echo $rowgallery['imagesname']; ?></span>
				    				</div>
			    				</div>
			  				</div>
							<?php
						}
					}
				 ?>
    		</div>
    	</div>
    </section>


<!--     <section class="ftco-section bg-light" id="blog-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-5">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading">Month Feedback</span>
            <h2 class="mb-4">Activities</h2>
          </div>
        </div>
        <div class="row d-flex"> -->
<!--           <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
              </a>
              <div class="text mt-3 float-right d-block">
              	<div class="d-flex align-items-center mb-3 meta">
	                <p class="mb-0">
	                	<span class="mr-2">March 23, 2019</span>
	                	<a href="#" class="mr-2">Admin</a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
	                </p>
                </div>
                <h3 class="heading"><a href="single.html">Why Lead Generation is Key for Business Growth</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div> -->
<!--           <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry justify-content-end">
              <a href="single.html" class="block-20" style="background-image: url('images/image_2.jpg');">
              </a>
              <div class="text mt-3 float-right d-block">
              	<div class="d-flex align-items-center mb-3 meta">
	                <p class="mb-0">
	                	<span class="mr-2">March 23, 2019</span>
	                	<a href="#" class="mr-2">Admin</a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
	                </p>
                </div>
                <h3 class="heading"><a href="single.html">Why Lead Generation is Key for Business Growth</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div> -->
<!--           <div class="col-md-4 d-flex ftco-animate">
          	<div class="blog-entry">
              <a href="single.html" class="block-20" style="background-image: url('images/image_3.jpg');">
              </a>
              <div class="text mt-3 float-right d-block">
              	<div class="d-flex align-items-center mb-3 meta">
	                <p class="mb-0">
	                	<span class="mr-2">March 23, 2019</span>
	                	<a href="#" class="mr-2">Admin</a>
	                	<a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a>
	                </p>
                </div>
                <h3 class="heading"><a href="single.html">Why Lead Generation is Key for Business Growth</a></h3>
                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
              </div>
            </div>
          </div> -->
<!--         </div>
      </div>
    </section> -->
 
    <section class="ftco-section contact-section ftco-no-pb" id="contact-section">
      <div class="container">
      	<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Contact</span>
            <h2 class="mb-4">Contact Me</h2>
            <!-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> -->
          </div>
        </div>

        <div class="row no-gutters block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form class="bg-light p-4 p-md-5 contact-form">
              <div class="form-group">
                <h5>Address: </h5><?php echo $rowcontact['address']; ?>
              </div>
              <div class="form-group">
                <h5>Mobile No: </h5><?php echo $rowcontact['mobileno1']; ?>
              </div>
              <div class="form-group">
                <h5>Alternative Mobile No: </h5><?php echo $rowcontact['mobileno2']; ?>
              </div>
              <div class="form-group">
                <h5>Email ID: </h5><?php echo $rowcontact['emailid']; ?>
              </div>
              <div class="form-group">
                <h5>Home Town: </h5><?php echo $rowcontact['hometown']; ?>
              </div>
            </form>
          </div>
          <div class="col-md-6 d-flex">
          	<div class="img" style="background-image: url('../../images/profile/<?php echo $rowbiodata['dp']; ?>.jpg');"></div>
          </div>
        </div>
      </div>
    </section>
		

    <footer class="ftco-footer ftco-section">
      <div class="container">
        <div class="row mb-5">
<!--           <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Lets talk about</h2>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
              <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
              </ul>
            </div>
          </div> -->
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Links</h2>
              <ul class="list-unstyled">
                <li><a href="#home-section"><span class="icon-long-arrow-right mr-2"></span>Home</a></li>
                <li><a href="#about-section"><span class="icon-long-arrow-right mr-2"></span>About</a></li>
                <li><a href="#skills-section"><span class="icon-long-arrow-right mr-2"></span>Skills</a></li>
                <li><a href="#projects-section"><span class="icon-long-arrow-right mr-2"></span>Gallery</a></li>
                <li><a href="./activities.php?studentid=<?php echo $studentid; ?>" target="_blank"><span class="icon-long-arrow-right mr-2"></span>Activities</a></li>
                <li><a href="#contact-section"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
              </ul>
            </div>
          </div>
<!--           <div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">Services</h2>
              <ul class="list-unstyled">
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Web Design</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Web Development</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Business Strategy</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Data Analysis</a></li>
                <li><a href="#"><span class="icon-long-arrow-right mr-2"></span>Graphic Design</a></li>
              </ul>
            </div>
          </div> -->
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">About Me!!!</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text"><?php echo $rowcontact['address']; ?></span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text"><?php echo $rowcontact['mobileno1']; ?></span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text"><?php echo $rowcontact['emailid']; ?></span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">

            <p>
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This Portfolio is made with by <a href="#">Jatin Gangwani.</a></p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  
  <script src="js/main.js"></script>
    
  </body>
</html>