    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true" data-img="../assets/images/backgrounds/02.jpg">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="index.html"><img class="brand-logo" alt="Chameleon admin logo" src="../assets/images/logo/logo.png" />
                        <h3 class="brand-text">E-Portfolio</h3></a>
                </li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        <?php $filename = basename($_SERVER['PHP_SELF']) ?>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="<?php if($filename=='index.php' || $filename=="indexnew.php"){echo 'active';} ?>"><a href="index.php"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
                </li>
<!--                 <li class="<?php if($filename=='class.php'){echo 'active';} ?> nav-item"><a href="class.php"><i class="ft-pie-chart"></i><span class="menu-title" data-i18n="">Class Management</span></a>
                </li> -->
                <li class="<?php if($filename=='activity.php'){echo 'active';} ?> nav-item"><a href="activity.php"><i class="ft-layout"></i><span class="menu-title" data-i18n="">Activity Details</span></a>
                </li>
                <li class="<?php if($filename=='teacherentry.php'){echo 'active';} ?> nav-item"><a href="teacherentry.php"><i class="ft-box"></i><span class="menu-title" data-i18n="">Teacher Entry</span></a>
                </li>
                <!-- <li class=" nav-item"><a href="typography.html"><i class="ft-bold"></i><span class="menu-title" data-i18n="">Generate Report</span></a> -->
                <!-- </li> -->
                <!-- <li class=" nav-item"><a href="tables.html"><i class="ft-credit-card"></i><span class="menu-title" data-i18n="">Tables</span></a>
                </li>
                <li class=" nav-item"><a href="form-elements.html"><i class="ft-layout"></i><span class="menu-title" data-i18n="">Form Elements</span></a>
                </li> -->
            </ul>
        </div>
        <div class="navigation-background"></div>
    </div>