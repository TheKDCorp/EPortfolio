<?php 
    $uid = $_COOKIE['teacher_id'];
    $sql = "SELECT * FROM teacher_entry where uid='$uid'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row=$result->fetch_assoc();
    }else{
        exit();
    }
 ?>
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-light">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="collapse navbar-collapse show" id="navbar-mobile">
                    <ul class="nav navbar-nav mr-auto float-left">
                        <?php $myfilename = basename($_SERVER['PHP_SELF']) ?>
                        <li class="nav-item d-block d-md-none"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                        <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="<?php 
                        if($myfilename == "class.php"){echo "./index.php";}elseif($myfilename == "section.php"){echo "./class.php";}elseif($myfilename == "portfolio.php"){echo "./section.php";}
                         ?>"><i class="ficon ft-arrow-left"></i></a></li>
                        
                        <!-- <li class="nav-item dropdown navbar-search"><a class="nav-link dropdown-toggle hide" data-toggle="dropdown" href="#"><i class="ficon ft-search"></i></a>
                            <ul class="dropdown-menu">
                                <li class="arrow_box">
                                    <form>
                                        <div class="input-group search-box">
                                            <div class="position-relative has-icon-right full-width">
                                                <input class="form-control" id="search" type="text" placeholder="Search here...">
                                                <div class="form-control-position navbar-search-close"><i class="ft-x">   </i></div>
                                            </div>
                                        </div>
                                    </form>
                                </li>
                            </ul>
                        </li> -->
                    </ul>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-in"></i><span class="selected-language"></span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag">
                                <div class="arrow_box"><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> English</a><!-- <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> Chinese</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-ru"></i> Russian</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a><a class="dropdown-item" href="#"><i class="flag-icon flag-icon-es"></i> Spanish</a> --></div>
                            </div>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav float-right">
<!--                         <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon ft-mail">             </i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item" href="#"><i class="ft-book"></i> Read Mail</a><a class="dropdown-item" href="#"><i class="ft-bookmark"></i> Read Later</a><a class="dropdown-item" href="#"><i class="ft-check-square"></i> Mark all Read       </a></div>
                            </div>
                        </li> -->
                        <li class="dropdown dropdown-user nav-item">
                            <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown"> <span class="avatar avatar-online"><?php 
                                    if($row['dp']==""){
                                        echo '<img alt="avatar" src="../images/profile.jpg">';
                                    }else{
                                        echo '<img alt="avatar" src="../images/teacher/'.$row['dp'].'.jpg">';
                                    }
                                ?><i></i></span></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="arrow_box_right"><a class="dropdown-item" href="#"><span class="avatar avatar-online">
                                <?php 
                                    if($row['dp']==""){
                                        echo '<img alt="avatar" src="../images/profile.jpg">';
                                    }else{
                                        echo '<img alt="avatar" src="../images/teacher/'.$row['dp'].'.jpg">';
                                    }
                                ?>
                                <span class="user-name text-bold-700 ml-1"><?php echo $row['name']; ?></span></span></a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="./profile.php"><i class="ft-user"></i> Edit Profile</a>
                                    <div class="dropdown-divider"></div><a class="dropdown-item" href="./logout.php"><i class="ft-power"></i> Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- ////////////////////////////////////////////////////////////////////////////-->

    <div class="app-content content">
        <div class="content-wrapper">