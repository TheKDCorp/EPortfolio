<?php include_once('../created/header.php'); ?>
<?php include_once('../created/sidebar.php'); ?>
<?php include_once('../created/pageheader.php'); ?>
<?php include_once('../includes/dbcon.php'); ?>
<?php 

if (isset($_SERVER['HTTP_REFERER'])) {
    $page = basename($_SERVER['HTTP_REFERER']);
    $page = substr($page, 0, 11);
    if ($page == "section.php") {
    } else {
          ?>
          <script>
            window.location.href = "./class.php";
          </script>
          <?php
                  header('Location: ./class.php');
          exit();
    }
  } else {
      ?>
          <script>
            window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
      exit();
  }

if(!isset($_GET['class'])){
?>
          <script>
            window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
}else{
}

if(empty($_GET['class'])){
?>
          <script>
            window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
}else{
}

if(!isset($_GET['section'])){
?>
          <script>
            window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
}else{
}

if(empty($_GET['section'])){
?>
          <script>
            window.location.href = "./class.php";
          </script>
        <?php
        header('Location: ./class.php');
}else{
}


$uid = $_COOKIE['teacher_id'];
$cid=$_GET['class'];
$sid=$_GET['section'];
$classname = "";
$sql = "select * from class_entry where cid='$cid'";
$result=$conn->query($sql);
if($result->num_rows > 0){
$row = $result->fetch_assoc();
$classname = $row['classname'];
}
$sql = "select * from section_entry where sid='$sid'";
$result=$conn->query($sql);
if($result->num_rows > 0){
$row = $result->fetch_assoc();
$sectionname = $row['sectionname'];
}

$sql = "SELECT * FROM student_csdetails where uid='$uid' and classid='$cid' and sectionid='$sid'";
$result = $conn->query($sql);
?>
<style>

  .progress-bar {
    height: 2em;
    line-height: 2em;
  }

  .skill {
    margin-top: .25em;
  }


  .modal-contentaddstudent {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeaddstudent{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeaddstudent:hover,
  .closeaddstudent:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  .modal-contentmonthdetails {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closemonthdetails{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closemonthdetails:hover,
  .closemonthdetails:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  .modal-contentbiodata {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closebiodata{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closebiodata:hover,
  .closebiodata:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  .modal-contentskills {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeskills{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeskills:hover,
  .closeskills:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  .modal-contentcontact {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closecontact{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closecontact:hover,
  .closecontact:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  .modal-contentclassabout {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeclassabout{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeclassabout:hover,
  .closeclassabout:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  .modal-contentimages {
    background-color: #fefefe;
    margin: 5% 20%;
    /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 70%;
    /* Could be more or less, depending on screen size */
    left: 20%;
  }
  .closeimages{
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .closeimages:hover,
  .closeimages:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }

</style>
<script>
  $(document).ready(function() {
    showmonth();
    setheight();
  });

  function animateprogressbar1(totalpercent) {
    var mypercent = "1"
    var totalpercent = totalpercent;
    function updatePercent() {
      if(mypercent < totalpercent){
        mypercent = +mypercent + 1;        
      }else{
        mypercent = mypercent;
      }
      $(this).text(parseInt(mypercent));
    }
    if(totalpercent<30 && totalpercent>10){
      $("#html-progress1").css("background-color","#FFC106");
    }else if(totalpercent<=10 && totalpercent>=0){
      $("#html-progress1").css("background-color","#fa626b");
    }else if(totalpercent<90 && totalpercent>=30){
      $("#html-progress1").css("background-color","#28afd0");
    }else if(totalpercent<=100 && totalpercent>=90){
      $("#html-progress1").css("background-color","#6967ce");
    }

    $('#html-progress1').animate({width: totalpercent+"%"}, {duration: 2000, step: updatePercent});
  }
  function animateprogressbar2(totalpercent) {
    var mypercent = "1"
    var totalpercent = totalpercent;
    function updatePercent() {
      if(mypercent < totalpercent){
        mypercent = +mypercent + 1;        
      }else{
        mypercent = mypercent;
      }
      $(this).text(parseInt(mypercent));
    }

    if(totalpercent<30 && totalpercent>10){
      $("#html-progress2").css("background-color","#FFC106");
    }else if(totalpercent<=10 && totalpercent>=0){
      $("#html-progress2").css("background-color","#fa626b");
    }else if(totalpercent<90 && totalpercent>=30){
      $("#html-progress2").css("background-color","#28afd0");
    }else if(totalpercent<=100 && totalpercent>=90){
      $("#html-progress2").css("background-color","#6967ce");
    }

    $('#html-progress2').animate({width: totalpercent+"%"}, {duration: 2300, step: updatePercent});
  }
  function animateprogressbar3(totalpercent) {
    var mypercent = "1"
    var totalpercent = totalpercent;
    function updatePercent() {
      if(mypercent < totalpercent){
        mypercent = +mypercent + 1;        
      }else{
        mypercent = mypercent;
      }
      $(this).text(parseInt(mypercent));
    }

    if(totalpercent<30 && totalpercent>10){
      $("#html-progress3").css("background-color","#FFC106");
    }else if(totalpercent<=10 && totalpercent>=0){
      $("#html-progress3").css("background-color","#fa626b");
    }else if(totalpercent<90 && totalpercent>=30){
      $("#html-progress3").css("background-color","#28afd0");
    }else if(totalpercent<=100 && totalpercent>=90){
      $("#html-progress3").css("background-color","#6967ce");
    }

    $('#html-progress3').animate({width: totalpercent+"%"}, {duration: 2600, step: updatePercent});
  }
  function animateprogressbar4(totalpercent) {
    var mypercent = "1"
    var totalpercent = totalpercent;
    function updatePercent() {
      if(mypercent < totalpercent){
        mypercent = +mypercent + 1;        
      }else{
        mypercent = mypercent;
      }
      $(this).text(parseInt(mypercent));
    }

    if(totalpercent<30 && totalpercent>10){
      $("#html-progress4").css("background-color","#FFC106");
    }else if(totalpercent<=10 && totalpercent>=0){
      $("#html-progress4").css("background-color","#fa626b");
    }else if(totalpercent<90 && totalpercent>=30){
      $("#html-progress4").css("background-color","#28afd0");
    }else if(totalpercent<=100 && totalpercent>=90){
      $("#html-progress4").css("background-color","#6967ce");
    }

    $('#html-progress4').animate({width: totalpercent+"%"}, {duration: 2900, step: updatePercent});
  }
  function animateprogressbar5(totalpercent) {
    var mypercent = "1"
    var totalpercent = totalpercent;
    function updatePercent() {
      if(mypercent < totalpercent){
        mypercent = +mypercent + 1;        
      }else{
        mypercent = mypercent;
      }
      $(this).text(parseInt(mypercent));
    }

    if(totalpercent<30 && totalpercent>10){
      $("#html-progress5").css("background-color","#FFC106");
    }else if(totalpercent<=10 && totalpercent>=0){
      $("#html-progress5").css("background-color","#fa626b");
    }else if(totalpercent<90 && totalpercent>=30){
      $("#html-progress5").css("background-color","#28afd0");
    }else if(totalpercent<=100 && totalpercent>=90){
      $("#html-progress5").css("background-color","#6967ce");
    }

    $('#html-progress5').animate({width: totalpercent+"%"}, {duration: 3200, step: updatePercent});
  }


  function setheight(){
    $("#stlist").css("height","100%");
  }
  function studentname(name,studentid,classid,sectionid,studentcsid){
    var myname = $("#name").val();
    if(myname == name){
    }
    else{
      $("#name").val(name);
      $("#studentid").val(studentid);
      $("#studentcsid").val(studentcsid);
      $("#class").val('<?php echo $classname; ?>');
      $("#classid").val(classid);
      $("#section").val('<?php echo $sectionname; ?>');
      $("#sectionid").val(sectionid);
      clearstar("ls");
      clearstar("rs");
      clearstar("ws");
      clearstar("ss");
    }


    animateprogressbar1(95);
    animateprogressbar2(65);
    animateprogressbar3(45);
    animateprogressbar4(25);
    animateprogressbar5(5);

  }
  function deleteme(){
  }
  function noofstar(id,star){
    $("."+id).val(star);
    for (var i = 1; i <= 5; i++) {
      $("#"+id+i).attr('src','../images/star.png');
    }
    for (var i = 1; i <= star; i++) {
      $("#"+id+i).attr('src','../images/stardone.png');
    }
  }
  function clearstar(id){
    for (var i = 1; i <= 5; i++) {
      $("#"+id+i).attr('src','../images/star.png');
    }
    $("."+id).val("");
    $(".clickstar").attr('src','../images/star.png');
    $(".clickstarfield").attr("value", "");
  }
  function hideall(){
    $(".June").hide();
    $(".July").hide();
    $(".August").hide();
    $(".September").hide();
    $(".October").hide();
    $(".November").hide();
    $(".December").hide();
    $(".January").hide();
    $(".February").hide();
  }
  function clickidentity(id,no){
    $("."+id).attr("value", no);
    $("#"+id+"1").attr('src','../images/star.png');
    $("#"+id+"2").attr('src','../images/star.png');
    $("#"+id+"3").attr('src','../images/star.png');
    $("#"+id+"4").attr('src','../images/star.png');
    $("#"+id+no).attr('src','../images/stardone.png');
  }
  function showmonth(){
    var mymonth = $("#month").val();
    hideall();
    $("."+mymonth).show();
  }
  function genpdf(){
    var studentid = $("#studentid").val();
    var currentmonth = $("#month").val();
    var link="generatepdf.php?studentid='"+studentid+"'&month='"+currentmonth+"'";
    $("#link").val(link);
    $("#myform").submit();
  }
  function addnewstudent(){
    var modal = document.getElementById('addstudentmodal');
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closeaddstudent")[0];
    span.onclick = function() {
      modal.style.display = "none";
    }
    modal.style.display = "block";
  }
  function performstentry_addnew(){
    var stentry_name = $("#stentry_name").val();
    var stentry_dateofadmission = $("#stentry_dateofadmission").val();
    var stentry_dateofadmissiondate = new Date($("#stentry_dateofadmission").val());
    var myclassid = "<?php echo $cid; ?>";
    var mysectionid = "<?php echo $sid; ?>";
    var myuid = "<?php echo $uid; ?>";
    if (stentry_name == ""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Student Name Cannot Be Empty!!!");
      error = "true";
    }else if (stentry_dateofadmission == ""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Date of Admission Cannot Be Empty!!!");
      error = "true";
    }
    else{
      error = "false";
      if(stentry_dateofadmission!=""){
        var now = new Date();
        var mindate = new Date("2010-01-01");
        if (stentry_dateofadmissiondate <= now && stentry_dateofadmissiondate > mindate) {
          error = "false";
        }else{
          var modal = document.getElementById('blankmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeblank")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          $("#blankmodaltext").text("Date must be in between 2010 - Current Date!!!");
          error = "true";
        }
      }
      if(error=="false"){
          $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {
            method: 'stentry_addnew',st_name:stentry_name,uid:myuid,classid:myclassid,sectionid:mysectionid,st_dateofadmission: stentry_dateofadmission}
          ,
          success: function(data) {
            var modal = document.getElementById('addmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeadd")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#stentry_name").val("");
            $("#stentry_dateofadmission").val("");
            refreshtable();
          }
        }
              );
      }
    }
  }
  function addbiodatadetails(){
    var studentid = $("#studentid").val();
    if(studentid!=""){
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          method: 'biodata_getdetails',stid:studentid}
        ,
        success: function(data) {
          var biodata_name = data.name;
          var biodata_fathersname = data.fathersname;
          var biodata_mothersname = data.mothersname;
          var biodata_dob = data.dob;
          var biodata_gender = data.gender;
          var biodata_dp = data.dp;
          var biodata_abouthim = data.abouthim;
          $("#biodata_name").val("");
          $("#biodata_fathersname").val("");
          $("#biodata_mothersname").val("");
          $("#biodata_dob").val("");
          $("#biodata_gender").val("");
          $("#biodata_abouthim").html("");
          $("#biodata_name").val(biodata_name);
          $("#biodata_fathersname").val(biodata_fathersname);
          $("#biodata_mothersname").val(biodata_mothersname);
          $("#biodata_dob").val(biodata_dob);
          $("#biodata_gender").val(biodata_gender);
          $("#biodata_abouthim").val(biodata_abouthim);
          if((biodata_dp)==""){
            $("#biodata_image").attr("src","../images/profile.jpg");
          }
          else{
            $("#biodata_image").attr("src","../images/profile/"+biodata_dp+".jpg");
          }
          var modal = document.getElementById('biodatamodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closebiodata")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
        }
      }
            );
    }
    else{
    }
  }
  function performbiodata_save(){
    var biodata_name = $("#biodata_name").val();
    var biodata_fathersname = $("#biodata_fathersname").val();
    var biodata_mothersname = $("#biodata_mothersname").val();
    var biodata_dob = $("#biodata_dob").val();
    var biodata_dobdate = new Date($("#biodata_dob").val());
    var biodata_gender = $("#biodata_gender").val();
    var biodata_abouthim = $("#biodata_abouthim").val();
    var studentid = $("#studentid").val();
    if (biodata_name == ""){
      var modal = document.getElementById('blankmodal');
      // Get the <span> element that closes the modal
      var span = document.getElementsByClassName("closeblank")[0];
      span.onclick = function() {
        modal.style.display = "none";
      }
      modal.style.display = "block";
      $("#blankmodaltext").text("Student Name Cannot Be Empty!!!");
    }
    else{
      error = "false";
      if(biodata_dob!=""){
        var now = new Date();
        var mindate = new Date("1990-01-01");
        if (biodata_dobdate <= now && biodata_dobdate > mindate) {
          error = "false";
        }else{
          var modal = document.getElementById('blankmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeblank")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          $("#blankmodaltext").text("Date must be in between 1990 - Current Date!!!");
          error = "true";
        }
      }
      if(error=="false"){
        var fd = new FormData();
        fd.append('method',"biodata_update");
        fd.append('stid',studentid);
        fd.append('bio_name',biodata_name);
        fd.append('bio_fathersname',biodata_fathersname);
        fd.append('bio_mothersname',biodata_mothersname);
        fd.append('bio_dob',biodata_dob);
        fd.append('bio_gender',biodata_gender);
        fd.append('bio_abouthim',biodata_abouthim);
        var files = $('#biodata_dp')[0].files[0];
        fd.append('dp',files);
        $.ajax({
          url: 'ajax.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(data){
            var modal = document.getElementById('addmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeadd")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#addmodaltext").text("Record Updated Successfully!!!");
            refreshtable();
            refreshbiodatadetails();
          }
          ,
        }
              );
      }
    }
  }
  function refreshbiodatadetails(){
    var studentid = $("#studentid").val();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {
        method: 'biodata_getdetails',stid:studentid}
      ,
      success: function(data) {
        var biodata_name = data.name;
        $("#name").val(biodata_name);
      }
    }
          );
  }
  function performcancel(){
    var modal = document.getElementById('deletemodal');
    modal.style.display = "none";
    var modal = document.getElementById('addmodal');
    modal.style.display = "none";
    var modal = document.getElementById('blankmodal');
    modal.style.display = "none";
    var modal = document.getElementById('deletesuccessmodal');
    modal.style.display = "none";
    var modal = document.getElementById('editmodal');
    modal.style.display = "none";
    var modal = document.getElementById('editsuccessmodal');
    modal.style.display = "none";
    var modal = document.getElementById('addstudentmodal');
    modal.style.display = "none";
    var modal = document.getElementById('monthdetailsmodal');
    modal.style.display = "none";
    var modal = document.getElementById('biodatamodal');
    modal.style.display = "none";
    var modal = document.getElementById('contactmodal');
    modal.style.display = "none";
    var modal = document.getElementById('skillsmodal');
    modal.style.display = "none";
    var modal = document.getElementById('classaboutmodal');
    modal.style.display = "none";
    var modal = document.getElementById('imagesmodal');
    modal.style.display = "none";
  }

  function performcancelok(){
    var modal = document.getElementById('addmodal');
    modal.style.display = "none";

    var modal = document.getElementById('deletesuccessmodal');
    modal.style.display = "none";

    var modal = document.getElementById('blankmodal');
    modal.style.display = "none";

    var modal = document.getElementById('editsuccessmodal');
    modal.style.display = "none";
  }

  function addmonthdetails(){
    var studentid = $("#studentid").val();
    if(studentid!=""){
      $("#activitylocation").html("");
      var mystudentcsid = $("#studentcsid").val();
      var noofactivity = $("#noofactivity").val();
      var newnoofactivity = +noofactivity + 1;
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          method: 'monthfeedback_getdata',studentcsid:mystudentcsid}
        ,
        success: function(data) {
          var mydata = eval(data.activity);
          $("#noofactivity").val(data.noofactivity);
          for (var i = 1; i <=data.noofactivity ; i++){
            var myhtml = $("#activitylocation").html();
            myhtml = myhtml + '<div class="'+mydata[i-1].month+'" id="monthfeedback_'+i+'"><div class="row"><div class="col-lg-9"><input type="hidden" value="'+mydata[i-1].activityid+'" id="activityid_'+i+'"><input type="hidden" value="'+mydata[i-1].mfid+'" id="mfid_'+i+'"><input type="hidden" value="'+mydata[i-1].month+'" id="monthname_'+i+'"><table class="table table-hover" id="activityfield"><tr><th style="width:30em;">'+mydata[i-1].activityname+'</th><th>I Can</th><th>In The Process</th><th>Not Yet</th><th>Entry#</th></tr>';
            var field1name = mydata[i-1].field1name;
            var field1type = mydata[i-1].field1type;
            var field1answer = mydata[i-1].field1answer;
            var fielddp = mydata[i-1].dp;
            if(field1type == "status"){
              myhtml = myhtml + '<tr><td>'+field1name+'</td><td><img src="../images/';
              if(field1answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'11" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"1','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field1answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'12" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"1','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field1answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'13" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"1','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field1answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'14" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"1','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'1 clickstarfield" id="field_'+i+'1" value="'+field1answer+'"></tr>';
            }
            var field2name = mydata[i-1].field2name;
            var field2type = mydata[i-1].field2type;
            var field2answer = mydata[i-1].field2answer;
            if(field2type == "status"){
              myhtml = myhtml + '<tr><td>'+field2name+'</td><td><img src="../images/';
              if(field2answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'21" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"2','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field2answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'22" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"2','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field2answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'23" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"2','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field2answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'24" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"2','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'2 clickstarfield" id="field_'+i+'2" value="'+field2answer+'"></tr>';
            }
            var field3name = mydata[i-1].field3name;
            var field3type = mydata[i-1].field3type;
            var field3answer = mydata[i-1].field3answer;
            if(field3type == "status"){
              myhtml = myhtml + '<tr><td>'+field3name+'</td><td><img src="../images/';
              if(field3answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'31" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"3','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field3answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'32" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"3','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field3answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'33" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"3','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field3answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'34" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"3','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'3 clickstarfield" id="field_'+i+'3" value="'+field3answer+'"></tr>';
            }
            var field4name = mydata[i-1].field4name;
            var field4type = mydata[i-1].field4type;
            var field4answer = mydata[i-1].field4answer;
            if(field4type == "status"){
              myhtml = myhtml + '<tr><td>'+field4name+'</td><td><img src="../images/';
              if(field4answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'41" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"4','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field4answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'42" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"4','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field4answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'43" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"4','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field4answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'44" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"4','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'4 clickstarfield" id="field_'+i+'4" value="'+field4answer+'"></tr>';
            }
            var field5name = mydata[i-1].field5name;
            var field5type = mydata[i-1].field5type;
            var field5answer = mydata[i-1].field5answer;
            if(field5type == "status"){
              myhtml = myhtml + '<tr><td>'+field5name+'</td><td><img src="../images/';
              if(field5answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'51" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"5','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field5answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'52" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"5','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field5answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'53" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"5','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field5answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'54" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"5','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'5 clickstarfield" id="field_'+i+'5" value="'+field5answer+'"></tr>';
            }
            var field6name = mydata[i-1].field6name;
            var field6type = mydata[i-1].field6type;
            var field6answer = mydata[i-1].field6answer;
            if(field6type == "status"){
              myhtml = myhtml + '<tr><td>'+field6name+'</td><td><img src="../images/';
              if(field6answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'61" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"6','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field6answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'62" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"6','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field6answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'63" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"6','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field6answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'64" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"6','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'6 clickstarfield" id="field_'+i+'6" value="'+field6answer+'"></tr>';
            }
            var field7name = mydata[i-1].field7name;
            var field7type = mydata[i-1].field7type;
            var field7answer = mydata[i-1].field7answer;
            if(field7type == "status"){
              myhtml = myhtml + '<tr><td>'+field7name+'</td><td><img src="../images/';
              if(field7answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'71" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"7','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field7answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'72" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"7','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field7answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'73" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"7','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field7answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'74" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"7','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'7 clickstarfield" id="field_'+i+'7" value="'+field7answer+'"></tr>';
            }
            var field8name = mydata[i-1].field8name;
            var field8type = mydata[i-1].field8type;
            var field8answer = mydata[i-1].field8answer;
            if(field8type == "status"){
              myhtml = myhtml + '<tr><td>'+field8name+'</td><td><img src="../images/';
              if(field8answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'81" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"8','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field8answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'82" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"8','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field8answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'83" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"8','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field8answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'84" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"8','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'8 clickstarfield" id="field_'+i+'8" value="'+field8answer+'"></tr>';
            }
            var field9name = mydata[i-1].field9name;
            var field9type = mydata[i-1].field9type;
            var field9answer = mydata[i-1].field9answer;
            if(field9type == "status"){
              myhtml = myhtml + '<tr><td>'+field9name+'</td><td><img src="../images/';
              if(field9answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'91" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"9','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field9answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'92" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"9','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field9answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'93" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"9','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field9answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'94" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"9','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'9 clickstarfield" id="field_'+i+'9" value="'+field9answer+'"></tr>';
            }
            var field10name = mydata[i-1].field10name;
            var field10type = mydata[i-1].field10type;
            var field10answer = mydata[i-1].field10answer;
            if(field10type == "status"){
              myhtml = myhtml + '<tr><td>'+field10name+'</td><td><img src="../images/';
              if(field10answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'101" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"10','1');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field10answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'102" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"10','2');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field10answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'103" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"10','3');";
              myhtml = myhtml + '"></td><td><img src="../images/';
              if(field10answer=="4"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'104" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"10','4');";
              myhtml = myhtml + '"></td><input type="hidden" class="field_'+i+'10 clickstarfield" id="field_'+i+'10" value="'+field10answer+'"></tr>';
            }
            myhtml = myhtml + '</table></div><div class="col-lg-3"><img src="';
            if(fielddp==""){
              myhtml = myhtml + "../images/profile.jpg";
            }
            else{
              myhtml = myhtml + "../images/monthfeedback/"+fielddp+".jpg";
            }
            myhtml = myhtml + '" alt="Image Unavailable!!!" id="field_image_'+i+'" style="width:100%;height:10em;"><input type="file" class="form-control" id="field_dp_'+i+'"><a class="btn btn-danger btn-sm form-control" onclick="deletemonthfeedback('+i+');" style="margin-top:1em;color:white;">Delete</a><br><br></div></div></div>';
            $("#activitylocation").html(myhtml);
          }
          var modal = document.getElementById('monthdetailsmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closemonthdetails")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          showmonth();
        }
      }
            );
    }
  }


  function deletemonthfeedback(id){
      var mymonthfeedbackid = $("#mfid_"+id).val();
      if(mymonthfeedbackid==""){
       $("#monthfeedback_"+id).remove();
      }else{
       var fd = new FormData();
        fd.append('method',"monthfeedback_delete");
        fd.append('monthfeedback_id',mymonthfeedbackid);
        $.ajax({
          url: 'ajax.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(data){

            performcancel();
            addmonthdetails();

            var modal = document.getElementById('deletesuccessmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeadd")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#deletesuccessmodaltext").text("Record Deleted Successfully!!!");

            $("#monthfeedback_"+id).remove();
          }
          ,
        });
      }
  }

  function addactivity(){
    var myactivityid = $("#activity").val();
    var noofactivity = $("#noofactivity").val();
    var monthname = $("#month").val();
    var newnoofactivity = +noofactivity + 1;
    $("#noofactivity").val(newnoofactivity);
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {
        method: 'activity_get',activityid: myactivityid}
      ,
      success: function(data) {
        var mydata = eval(data.response);
        var myhtml = $("#activitylocation").html();
        myhtml = myhtml + '<div class="'+monthname+'" id="monthfeedback_'+newnoofactivity+'"><div class="row"><div class="col-lg-9"><input type="hidden" value="'+data.activityid+'" id="activityid_'+newnoofactivity+'"><input type="hidden" value="" id="mfid_'+newnoofactivity+'"><input type="hidden" value="'+monthname+'" id="monthname_'+newnoofactivity+'"><table class="table table-hover" id="activityfield"><tr><th style="width:30em;">'+data.activityname+'</th><th>I Can</th><th>In The Process</th><th>Not Yet</th><th>Entry#</th></tr>';
        for (var i = 1; i <= data.nooffields ; i++) {
          var fieldname = mydata[i-1].fieldname;
          var fieldtype = mydata[i-1].fieldtype;
          var fieldtext = mydata[i-1].fieldtext;
          if(fieldtype == "status"){
            myhtml = myhtml + '<tr><td>'+fieldname+'</td><td><img src="../images/star.png" class="clickstar" alt="" height=20 width=20 id="field_'+newnoofactivity+i+'1" onclick="';
            myhtml = myhtml + "clickidentity('field_"+newnoofactivity+i+"','1');";
            myhtml = myhtml + '"></td><td><img src="../images/star.png" class="clickstar" alt="" height=20 width=20 id="field_'+newnoofactivity+i+'2" onclick="';
            myhtml = myhtml + "clickidentity('field_"+newnoofactivity+i+"','2');";
            myhtml = myhtml + '"></td><td><img src="../images/star.png" class="clickstar" alt="" height=20 width=20 id="field_'+newnoofactivity+i+'3" onclick="';
            myhtml = myhtml + "clickidentity('field_"+newnoofactivity+i+"','3');";
            myhtml = myhtml + '"></td><td><img src="../images/star.png" class="clickstar" alt="" height=20 width=20 id="field_'+newnoofactivity+i+'4" onclick="';
            myhtml = myhtml + "clickidentity('field_"+newnoofactivity+i+"','4');";
            myhtml = myhtml + '"></td><input type="hidden" class="field_'+newnoofactivity+i+' clickstarfield" id="field_'+newnoofactivity+i+'" value=""></tr>';
          }
        }
        myhtml = myhtml + '</table></div><div class="col-lg-3"><img src="../images/profile.jpg" alt="Image Unavailable!!!" id="field_image_'+newnoofactivity+'" style="width:100%;height:10em;"><input type="file" class="form-control" id="field_dp_'+newnoofactivity+'"><a class="btn btn-danger btn-sm form-control" onclick="deletemonthfeedback('+newnoofactivity+');" style="margin-top:1em;color:white;">Delete</a><br><br></div></div></div>';
        $("#activitylocation").html(myhtml);
      }
    }
          );
  }
  function performmonthfeedback_save(){
    var noofactivity = $("#noofactivity").val();
    for(var i=1; i <= noofactivity; i++){
      var myactivityid = $("#activityid_"+i).val();
      var mystudentcsid = $("#studentcsid").val();
      var mymonth = $("#monthname_"+i).val();
      var myfield1answer = $("#field_"+i+"1").val();
      var myfield2answer = $("#field_"+i+"2").val();
      var myfield3answer = $("#field_"+i+"3").val();
      var myfield4answer = $("#field_"+i+"4").val();
      var myfield5answer = $("#field_"+i+"5").val();
      var myfield6answer = $("#field_"+i+"6").val();
      var myfield7answer = $("#field_"+i+"7").val();
      var myfield8answer = $("#field_"+i+"8").val();
      var myfield9answer = $("#field_"+i+"9").val();
      var myfield10answer = $("#field_"+i+"10").val();
      var fd = new FormData();
      fd.append('method',"monthfeedback_save");
      fd.append('activityid',myactivityid);
      fd.append('studentcsid',mystudentcsid);
      fd.append('month',mymonth);
      fd.append('field1answer',myfield1answer);
      fd.append('field2answer',myfield2answer);
      fd.append('field3answer',myfield3answer);
      fd.append('field4answer',myfield4answer);
      fd.append('field5answer',myfield5answer);
      fd.append('field6answer',myfield6answer);
      fd.append('field7answer',myfield7answer);
      fd.append('field8answer',myfield8answer);
      fd.append('field9answer',myfield9answer);
      fd.append('field10answer',myfield10answer);
      var files = $('#field_dp_'+i)[0].files[0];
      fd.append('dp',files);
      $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(data){

          performcancel();
          addmonthdetails();

          var modal = document.getElementById('addmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeadd")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          $("#addmodaltext").text("Record Submitted!!!");
        }
        ,
      }
            );
    }
  }
  function addcontactdetails(){
    var studentid = $("#studentid").val();
    if(studentid!=""){
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          method: 'contact_getdetails',stid:studentid}
        ,
        success: function(data) {
          var contact_mobileno1 = data.mobileno1;
          var contact_mobileno2 = data.mobileno2;
          var contact_emailid = data.emailid;
          var contact_address = data.address;
          var contact_hometown = data.hometown;
          $("#contact_mobileno1").val("");
          $("#contact_mobileno2").val("");
          $("#contact_emailid").val("");
          $("#contact_address").val("");
          $("#contact_hometown").val("");
          $("#contact_mobileno1").val(data.mobileno1);
          $("#contact_mobileno2").val(data.mobileno2);
          $("#contact_emailid").val(data.emailid);
          $("#contact_address").val(data.address);
          $("#contact_hometown").val(data.hometown);
          var modal = document.getElementById('contactmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closecontact")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
        }
      }
            );
    }
    else{
    }
  }
  function performcontact_save(){
    var contact_mobileno1 = $("#contact_mobileno1").val();
    var contact_mobileno2 = $("#contact_mobileno2").val();
    var contact_emailid = $("#contact_emailid").val();
    var contact_address = $("#contact_address").val();
    var contact_hometown = $("#contact_hometown").val();
    var studentid = $("#studentid").val();
    var fd = new FormData();
    fd.append('method',"contact_update");
    fd.append('stid',studentid);
    fd.append('contact_mobileno1',contact_mobileno1);
    fd.append('contact_mobileno2',contact_mobileno2);
    fd.append('contact_emailid',contact_emailid);
    fd.append('contact_address',contact_address);
    fd.append('contact_hometown',contact_hometown);
    error = "false";
    if(contact_mobileno1!=""){
      if (contact_mobileno1.length == 10) {
        error = "false";
      }else{
        var modal = document.getElementById('blankmodal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeblank")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        modal.style.display = "block";
        $("#blankmodaltext").text("Mobile Number must be of 10 Digits.");
        error = "true";
      }
    }
    if(contact_mobileno2!=""){
      if (contact_mobileno2.length == 10) {
        error = "false";
      }else{
        var modal = document.getElementById('blankmodal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeblank")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        modal.style.display = "block";
        $("#blankmodaltext").text("Alternate Mobile Number must be of 10 Digits.");
        error = "true";
      }
    }
    if(error == "false"){
        $.ajax({
        url: 'ajax.php',
        type: 'post',
        data: fd,
        contentType: false,
        processData: false,
        success: function(data){
          var modal = document.getElementById('addmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeadd")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          $("#addmodaltext").text("Record Updated Successfully!!!");

        }
        ,
      }
            );
    }
  }
  function addnewskills(){
    var noofskills = $("#noofskills").val();
    var newnoofskills = +noofskills + 1;
    $("#noofskills").val(newnoofskills);
    myhtml = '<div class="row" id="skillsno_'+newnoofskills+'"><div class="col-lg-9"><div class="row"><div class="col-lg-12"><input type="hidden" id="skills_id_'+newnoofskills+'" value=""><table style="width:100%;"><tr><th></th><th></th></tr><tr><td>Skill Name: </td><td><input type="text" id="skills_name_'+newnoofskills+'" class="form-control" placeholder="Enter Skill Name..."></td></tr><tr><td><br></td><td><br></td></tr><tr><td>Description:</td><td><textarea class="form-control" id="skills_description_'+newnoofskills+'" cols="30" rows="10" placeholder="Enter Skill Description"></textarea></td></tr></table></div></div></div><div class="col-lg-3"><img src="../images/jason-leung-705076-unsplash.jpg" alt="Image Unavailable!!!" id="skills_image_'+newnoofskills+'" style="width:100%;height:12em;"><input type="file" class="form-control" id="skills_dp_'+newnoofskills+'"><a class="btn btn-danger btn-sm form-control" onclick="deleteskills('+newnoofskills+');" style="margin-top:1em;color:white;">Delete</a></div></div><hr>';
    $("#skillslist").before(myhtml);
  }
  function performskills_save(){
    var noofskills = $("#noofskills").val();
    var mystudentid = $("#studentid").val();
    for(var i=1; i <= noofskills; i++){
      var myskillsname = $("#skills_name_"+i).val();
      var myskillsdescription = $("#skills_description_"+i).val();
      var myskillsid = $("#skills_id_"+i).val();
      if (myskillsname == ""){
        var modal = document.getElementById('blankmodal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeblank")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        modal.style.display = "block";
        $("#blankmodaltext").text("Skill Cannot Be Empty!!!");
      }
      else{
        var fd = new FormData();
        fd.append('method',"skills_save");
        fd.append('studentid',mystudentid);
        fd.append('skills_name',myskillsname);
        fd.append('skills_description',myskillsdescription);
        fd.append('skills_id',myskillsid);
        var files = $('#skills_dp_'+i)[0].files[0];
        fd.append('dp',files);
        $.ajax({
          url: 'ajax.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(data){

            $("#skills_name_"+i).val("");
            $("#skills_description_"+i).val("");
            $("#skills_id_"+i).val("");

            performcancel();
            addskillsdetails();

            var modal = document.getElementById('addmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeadd")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#addmodaltext").text("Record Added Successfully!!!");
          }
          ,
        }
              );
      }
    }
  }

   function deleteskills(skillno){
      var myskillsid = $("#skills_id_"+skillno).val();
      if(myskillsid==""){
       $("#skillsno_"+skillno).remove();
      }else{
       var fd = new FormData();
        fd.append('method',"skills_delete");
        fd.append('skills_id',myskillsid);
        $.ajax({
          url: 'ajax.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(data){

            $("#skillsno_"+skillno).remove();

            performcancel();
            addskillsdetails();

            var modal = document.getElementById('deletesuccessmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeadd")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#deletesuccessmodaltext").text("Record Deleted Successfully!!!");
          }
          ,
        });
      }
    }

  function addskillsdetails(){
    var mystudentid = $("#studentid").val();
    if(mystudentid == ""){
    }
    else{
      $("#student_skillslist").html("");
      myhtml = $("#student_skillslist").html();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          method: 'skills_getdetails',studentid: mystudentid}
        ,
        success: function(data) {
          var mydata = eval(data.skills);
          $("#noofskills").val(data.noofskills);
          for(var i = 1; i <= data.noofskills ; i++) {
            var skillsname = mydata[i-1].skillsname;
            var skillsdescription = mydata[i-1].skillsdescription;
            var skillsdp = mydata[i-1].skillsdp;
            var skillsid = mydata[i-1].skillsid;
            myhtml = myhtml + '<div class="row" id="skillsno_'+i+'"><div class="col-lg-9"><div class="row"><div class="col-lg-12"><input type="hidden" id="skills_id_'+i+'" value="'+skillsid+'"><table style="width:100%;"><tr><th></th><th></th></tr><tr><td>Skill Name: </td><td><input type="text" id="skills_name_'+i+'" class="form-control" placeholder="Enter Skill Name..." value="'+skillsname+'"></td></tr><tr><td><br></td><td><br></td></tr><tr><td>Description:</td><td><textarea class="form-control" id="skills_description_'+i+'" cols="30" rows="10" placeholder="Enter Skill Description">'+skillsdescription+'</textarea></td></tr></table></div></div></div><div class="col-lg-3"><img src="';
            if(skillsdp==""){
              myhtml = myhtml + "../images/jason-leung-705076-unsplash.jpg";
            }
            else{
              myhtml = myhtml + "../images/skills/"+skillsdp+".jpg";
            }
            myhtml = myhtml + '" alt="Image Unavailable!!!" id="skills_image_'+i+'" style="width:100%;height:12em;"><input type="file" class="form-control" id="skills_dp_'+i+'"><a class="btn btn-danger btn-sm form-control" onclick="deleteskills('+i+');" style="margin-top:1em;color:white;">Delete</a></div></div><hr>';
          }
          myhtml = myhtml + '<div id="skillslist"></div>';
          $("#student_skillslist").html(myhtml);
          var modal = document.getElementById('skillsmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeskills")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          var noofskills = $("#noofskills").val();
          if(noofskills=="0"){
            addnewskills();
          }
        }
      }
            );
    }
  }
  function addclassaboutdetails(){
    var myclassid = "<?php echo $cid; ?>";
    var mysectionid = "<?php echo $sid; ?>";
    var myuid = "<?php echo $uid; ?>";
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {
        method: 'classabout_getdetails',classid:myclassid,sectionid:mysectionid,uid:myuid}
      ,
      success: function(data) {
        var classabout_classname = data.classname;
        var classabout_sectionname = data.sectionname;
        var classabout_session = data.session;
        var classabout_classteacher = data.classteacher;
        var classabout_academiccoordinator = data.academiccoordinator;
        var classabout_principal = data.principal;
        var classabout_dp = data.dp;
        $("#classabout_classname").val("");
        $("#classabout_sectionname").val("");
        $("#classabout_session").val("");
        $("#classabout_classteacher").val("");
        $("#classabout_academiccoordinator").val("");
        $("#classabout_principal").val("");
        $("#classabout_classname").val(classabout_classname);
        $("#classabout_sectionname").val(classabout_sectionname);
        $("#classabout_session").val(classabout_session);
        $("#classabout_classteacher").val(classabout_classteacher);
        $("#classabout_academiccoordinator").val(classabout_academiccoordinator);
        $("#classabout_principal").val(classabout_principal);
        if(classabout_dp=="" || classabout_dp=="null"){
          $("#classabout_image").attr("src","../images/profile.jpg");
        }
        else{
          $("#classabout_image").attr("src","../images/classdp/"+classabout_dp+".jpg");
        }
        var modal = document.getElementById('classaboutmodal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeclassabout")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        modal.style.display = "block";

        // $("#classabout_session").inputmask();
        // alert("jt");

      }
    }
          );
  }
  function performclassabout_save(){
    var classabout_classname = $("#classabout_classname").val();
    var classabout_sectionname = $("#classabout_sectionname").val();
    var classabout_session = $("#classabout_session").val();
    var classabout_classteacher = $("#classabout_classteacher").val();
    var classabout_academiccoordinator = $("#classabout_academiccoordinator").val();
    var classabout_principal = $("#classabout_principal").val();
    var myclassid = "<?php echo $cid; ?>";
    var mysectionid = "<?php echo $sid; ?>";
    var myuid = "<?php echo $uid; ?>";
    var fd = new FormData();
    fd.append('method',"classabout_update");
    fd.append('classid',myclassid);
    fd.append('sectionid',mysectionid);
    fd.append('uid',myuid);
    fd.append('classabout_classname',classabout_classname);
    fd.append('classabout_sectionname',classabout_sectionname);
    fd.append('classabout_session',classabout_session);
    fd.append('classabout_classteacher',classabout_classteacher);
    fd.append('classabout_academiccoordinator',classabout_academiccoordinator);
    fd.append('classabout_principal',classabout_principal);
    var files = $('#classabout_dp')[0].files[0];
    fd.append('dp',files);
    $.ajax({
      url: 'ajax.php',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(data){
        var modal = document.getElementById('addmodal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeadd")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        modal.style.display = "block";
        $("#addmodaltext").text("Record Updated Successfully!!!");
      }
      ,
    }
          );
  }
  function addimagesdetails(){
    var mystudentid = $("#studentid").val();
    if(mystudentid == ""){
    }
    else{
      $("#student_imageslist").html("");
      myhtml = $("#student_imageslist").html();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {
          method: 'images_getdetails',studentid: mystudentid}
        ,
        success: function(data) {
          var mydata = eval(data.images);
          $("#noofimages").val(data.noofimages);
          for(var i = 1; i <= data.noofimages ; i++) {
            var imagesname = mydata[i-1].imagesname;
            var imagesdescription = mydata[i-1].imagesdescription;
            var imagesdp = mydata[i-1].imagesdp;
            var imagesdate = mydata[i-1].imagesdate;
            var imagesid = mydata[i-1].imagesid;
            myhtml = myhtml + '<div class="row" id="imagesno_'+i+'"><div class="col-lg-9"><div class="row"><div class="col-lg-12"><input type="hidden" id="images_id_'+i+'" value="'+imagesid+'"><table style="width:100%;"><tr><th></th><th></th></tr><tr><td>Image Title: </td><td><input type="text" id="images_name_'+i+'" class="form-control" placeholder="Enter Image Title..." value="'+imagesname+'"></td></tr><tr><td><br></td><td><br></td></tr><tr><td>Description:</td><td><textarea class="form-control" id="images_description_'+i+'" cols="30" rows="10" placeholder="Enter Image Description">'+imagesdescription+'</textarea></td></tr></tr><tr><td><br></td><td><br></td></tr><tr><td>Date: </td><td><input type="date" id="images_date_'+i+'" class="form-control" placeholder="Enter Image Date..." value="'+imagesdate+'"></td></tr></table></div></div></div><div class="col-lg-3"><img src="';
            if(imagesdp==""){
              myhtml = myhtml + "../images/jason-leung-705076-unsplash.jpg";
            }
            else{
              myhtml = myhtml + "../images/gallery/"+imagesdp+".jpg";
            }
            myhtml = myhtml + '" alt="Image Unavailable!!!" id="images_image_'+i+'" style="width:100%;height:17em;"><input type="file" class="form-control" id="images_dp_'+i+'"><a class="btn btn-danger btn-sm form-control" onclick="deleteimages('+i+');" style="margin-top:1em;color:white;">Delete</a></div></div><hr>';
          }
          myhtml = myhtml + '<div id="imageslist"></div>';
          $("#student_imageslist").html(myhtml);
          var modal = document.getElementById('imagesmodal');
          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("closeimages")[0];
          span.onclick = function() {
            modal.style.display = "none";
          }
          modal.style.display = "block";
          var noofimages = $("#noofimages").val();
          if(noofimages=="0"){
            addnewimages();
          }
        }
      }
            );
    }
  }
  function addnewimages(){
    var noofimages = $("#noofimages").val();
    var newnoofimages = +noofimages + 1;
    $("#noofimages").val(newnoofimages);
    myhtml = '<div class="row" id="imagesno_'+newnoofimages+'"><div class="col-lg-9"><div class="row"><div class="col-lg-12"><input type="hidden" id="images_id_'+newnoofimages+'" value=""><table style="width:100%;"><tr><th></th><th></th></tr><tr><td>Image Title: </td><td><input type="text" id="images_name_'+newnoofimages+'" class="form-control" placeholder="Enter Image Title..."></td></tr><tr><td><br></td><td><br></td></tr><tr><td>Description:</td><td><textarea class="form-control" id="images_description_'+newnoofimages+'" cols="30" rows="10" placeholder="Enter Image Description"></textarea></td></tr></tr><tr><td><br></td><td><br></td></tr><tr><td>Date: </td><td><input type="date" id="images_date_'+newnoofimages+'" class="form-control" placeholder="Enter Image Date..."></td></tr></table></div></div></div><div class="col-lg-3"><img src="../images/jason-leung-705076-unsplash.jpg" alt="Image Unavailable!!!" id="images_image_'+newnoofimages+'" style="width:100%;height:17em;"><input type="file" class="form-control" id="images_dp_'+newnoofimages+'"><a class="btn btn-danger btn-sm form-control" onclick="deleteimages('+newnoofimages+');" style="margin-top:1em;color:white;">Delete</a></div></div><hr>';
    $("#imageslist").before(myhtml);
  }


  function deleteimages(skillno){
      var myimagesid = $("#images_id_"+skillno).val();
      if(myimagesid==""){
       $("#imagesno_"+skillno).remove();
      }else{
       var fd = new FormData();
        fd.append('method',"images_delete");
        fd.append('images_id',myimagesid);
        $.ajax({
          url: 'ajax.php',
          type: 'post',
          data: fd,
          contentType: false,
          processData: false,
          success: function(data){

            performcancel();
            addimagesdetails();


            var modal = document.getElementById('deletesuccessmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeadd")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#deletesuccessmodaltext").text("Record Deleted Successfully!!!");

            $("#imagesno_"+skillno).remove();
          }
          ,
        });
      }
    }


  function performimages_save(){
    var noofimages = $("#noofimages").val();
    var mystudentid = $("#studentid").val();
    for(var i=1; i <= noofimages; i++){
      var myimagesname = $("#images_name_"+i).val();
      var myimagesdescription = $("#images_description_"+i).val();
      var myimagesdate = $("#images_date_"+i).val();
      var myimagesdatedate = new Date($("#images_date_"+i).val());
      var myimagesid = $("#images_id_"+i).val();
      if (myimagesname == ""){
        var modal = document.getElementById('blankmodal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closeblank")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        modal.style.display = "block";
        $("#blankmodaltext").text("Image Title Cannot Be Empty!!!");
      }
      else{
        error = "false";
        if(myimagesdate!=""){
          var now = new Date();
          var mindate = new Date("2010-01-01");
          if (myimagesdatedate <= now && myimagesdatedate > mindate) {
            error = "false";
          }else{
            var modal = document.getElementById('blankmodal');
            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("closeblank")[0];
            span.onclick = function() {
              modal.style.display = "none";
            }
            modal.style.display = "block";
            $("#blankmodaltext").text("Date must be in between 2010 - Current Date!!!");
            error = "true";
          }
        }
        if(error=="false"){
          var fd = new FormData();
          if(myimagesid==""){
            fd.append('method',"images_save");
          }
          else{
            fd.append('method',"images_update");
          }
          fd.append('studentid',mystudentid);
          fd.append('images_name',myimagesname);
          fd.append('images_description',myimagesdescription);
          fd.append('images_date',myimagesdate);
          fd.append('images_id',myimagesid);
          var files = $('#images_dp_'+i)[0].files[0];
          fd.append('dp',files);
          $.ajax({
            url: 'ajax.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(data){
              performcancel();
              addimagesdetails();

              var modal = document.getElementById('addmodal');
              // Get the <span> element that closes the modal
              var span = document.getElementsByClassName("closeadd")[0];
              span.onclick = function() {
                modal.style.display = "none";
              }
              modal.style.display = "block";
              $("#addmodaltext").text("Record Added Successfully!!!");

            }
            ,
          }
                );
        }
      }
    }
  }


  function redirect(){
    var mystudentid = $("#studentid").val();
    if(mystudentid==""){
      return false;
    }else{
      var url = "./portfolio1/index.php?studentid="+mystudentid;
      var win = window.open(url, '_blank');
      win.focus();
      return true;
    }
  }

</script>
<div class="content-wrapper-before">
</div>
<div class="content-header row">
  <div class="content-header-left col-md-4 col-12 mb-2">
    <h3 class="content-header-title">Portfolio Management
    </h3>
  </div>
  <div class="content-header-right col-md-8 col-12">
    <div class="breadcrumbs-top float-md-right">
      <div class="breadcrumb-wrapper mr-1">
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index.html">Home
            </a>
          </li>
          <li class="breadcrumb-item active">Portfolio Management
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
<div class="content-body">
  <!-- Striped rows start -->
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Student Entry
          </h4>
          <a class="heading-elements-toggle">
            <i class="la la-ellipsis-v font-medium-3">
            </i>
          </a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li>
                <a data-action="collapse">
                  <i class="ft-minus">
                  </i>
                </a>
              </li>
              <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
              <!-- <li><a data-action="expand"><i class="ft-maximize"></i></a></li> -->
              <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
            </ul>
          </div>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <span class="card-text">Click the 
              <code>Add Student
              </code> button to Create a New Student.
            </span>
            <a class="btn btn-primary" onclick="addnewstudent();" style="color:white;float:right;">
              <i class="ft-user-plus">
              </i>&nbspAdd Student
            </a>
          </div>
          <fieldset class="form-group">
          </fieldset>
        </div>
      </div>
    </div>
    <div class="col-3">
      <div class="card" id="stlist">
        <div class="card-header">
          <h4 class="card-title">Student List
          </h4>
          <a class="heading-elements-toggle">
            <i class="la la-ellipsis-v font-medium-3">
            </i>
          </a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li>
                <a data-action="collapse">
                  <i class="ft-minus">
                  </i>
                </a>
              </li>
              <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
              <li>
                <a data-action="expand">
                  <i class="ft-maximize">
                  </i>
                </a>
              </li>
              <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
            </ul>
          </div>
        </div>
        <div class="card-content collapse show" id="portdetails">
          <div class="card-body">
            <p class="card-text">Click the 
              <code>Student Name
              </code> To Modify its Portfolio.
              <a onclick="addclassaboutdetails();" class="btn btn-info btn-sm" style="color:white;float:right;">Edit Class Info.
              </a>
            </p>
          </div>
          <div class="table-responsive" id="stable">
            <table class="table table-striped table-hover" id="example">
              <thead>
                <tr>
                  <th>Student Name
                  </th>
                  <th>Functions
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php 
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
$studentiddummy = $row['studentid'];
$sql1 = "SELECT * FROM student_biodata where studentid = '$studentiddummy'";
$result1 = $conn->query($sql1);
if($result1->num_rows > 0){
$row1 = $result1->fetch_assoc();
$stname = $row1['studentname'];
}else{
$stname = "";
}
?>
                <tr>
                  <td style='min-width:50em;' onclick='studentname("<?php echo $stname; ?>","<?php echo $row['studentid']; ?>","<?php echo $row['classid']; ?>","<?php echo $row['sectionid']; ?>","<?php echo $row['studentcsid']; ?>");'>
                    <?php echo $stname; ?>
                  </td>
                  <td style="min-width:30em;">
                    <a class='btn btn-info btn-sm' style='color:white;' onclick='studentname("<?php echo $stname; ?>","<?php echo $row['studentid']; ?>","<?php echo $row['classid']; ?>","<?php echo $row['sectionid']; ?>","<?php echo $row['studentcsid']; ?>");'>
                      <i class="ft-check">
                      </i>&nbspSelect
                    </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a class='btn btn-warning btn-sm' style='color:white;'onclick='studentname("<?php echo $stname; ?>","<?php echo $row['studentid']; ?>","<?php echo $row['classid']; ?>","<?php echo $row['sectionid']; ?>","<?php echo $row['studentcsid']; ?>"),addbiodatadetails();'>
                      <i class="ft-edit-2">
                      </i>&nbspEdit
                    </a>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    <a class='btn btn-danger btn-sm' style='color:white;' onclick='deleteme(<?php echo $row['biodataid']; ?>);'>
                      <i class="ft-delete">
                      </i>&nbspDelete
                    </a>
                  </td>
                </tr>
                <?php
}
}
?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-9">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Portfolio Creation
          </h4>
          <a class="heading-elements-toggle">
            <i class="la la-ellipsis-v font-medium-3">
            </i>
          </a>
          <div class="heading-elements">
            <ul class="list-inline mb-0">
              <li>
                <a data-action="collapse">
                  <i class="ft-minus">
                  </i>
                </a>
              </li>
              <!-- <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li> -->
              <li>
                <a data-action="expand">
                  <i class="ft-maximize">
                  </i>
                </a>
              </li>
              <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
            </ul>
          </div>
        </div>
        <div class="card-content collapse show">
          <div class="card-body">
            <p class="card-text">Enter the Particular
              <code>Month
              </code> Details to be Entered in the Portfolio.
            </p>
            <hr>
            <div class="functions">
              <br>
              <div class="row">
                <div class="col-lg-4">
                  <label for="">Name:
                  </label>
                  <input type="text" class="form-control" name="name" id="name" disabled placeholder="Name...">
                  <input type="hidden" class="form-control" name="studentid" id="studentid">
                  <input type="hidden" class="form-control" name="studentcsid" id="studentcsid">
                </div>
                <div class="col-lg-4">
                  <label for="">Class:
                  </label>
                  <input type="text" class="form-control" name="class" id="class" disabled placeholder="Class...">
                  <input type="hidden" class="form-control" name="classid" id="classid">
                </div>
                <div class="col-lg-4">
                  <label for="">Section:
                  </label>
                  <input type="text" class="form-control" name="section" id="section" disabled placeholder="Section...">
                  <input type="hidden" class="form-control" name="sectionid" id="sectionid">
                </div>
              </div>
              <br>
              <div class="row">
                <table class="table table-hover">
                    <tr>
                      <th></th>
                      <th></th>
                    </tr>
                    <tr>
                      <td onclick="addbiodatadetails();" style="width:60%;cursor:pointer;">Biodata</td>
                      <td>
                        <div class="row skill">
                          <div class="col-12">
                            <div class="progress" style="height:2em;">
                              <div id="html-progress1" class="progress-bar" style="height:2em;background-color: #5BC0DD;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                     <tr>
                      <td onclick="addmonthdetails();" style="width:60%;cursor:pointer;">Month Feedback</td>
                      <td>
                        <div class="row skill">
                          <div class="col-12">
                            <div class="progress" style="height:2em;">
                              <div id="html-progress2" class="progress-bar" style="height:2em;background-color: #5BC0DD;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td onclick="addskillsdetails();" style="width:60%;cursor:pointer;">Skills Management</td>
                      <td>
                        <div class="row skill">
                          <div class="col-12">
                            <div class="progress" style="height:2em;">
                              <div id="html-progress3" class="progress-bar" style="height:2em;background-color: #5BC0DD;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td onclick="addimagesdetails();" style="width:60%;cursor:pointer;">Student Gallery</td>
                      <td>
                        <div class="row skill">
                          <div class="col-12">
                            <div class="progress" style="height:2em;">
                              <div id="html-progress4" class="progress-bar" style="height:2em;background-color: #5BC0DD;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td onclick="addcontactdetails();" style="width:60%;cursor:pointer;">Contact Details</td>
                      <td>
                        <div class="row skill">
                          <div class="col-12">
                            <div class="progress" style="height:2em;">
                              <div id="html-progress5" class="progress-bar" style="height:2em;background-color: #5BC0DD;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                </table>
              </div>
              <div style="text-align:right;">
                  <a class="btn btn-info btn-sm" style="color:white;" onclick="redirect();">Generate Class Report</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Striped rows end -->
</div>
<!-- The Edit Modal -->
<div id="addstudentmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentaddstudent">
    <span class="closeaddstudent">&times;
    </span>
    <p>Add New Student...
    </p>
    <hr>
    <div class="row">
      <div class="col-lg-12">
        <table style="width:100%;">
          <tr>
            <th>
            </th>
            <th>
            </th>
          </tr>
          <tr>
            <td>Name: 
            </td>
            <td>
              <input type="text" id="stentry_name" class="form-control" placeholder="Enter Student Name...">
            </td>
          </tr>
          <tr>
            <td>
              <br>
            </td>
            <td>
              <br>
            </td>
          </tr>
          <tr>
            <td>Admission Date: 
            </td>
            <td>
              <input type="date" id="stentry_dateofadmission" class="form-control" placeholder="Admission Date...">
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performstentry_addnew();" class="btn btn-primary" style="color:white;">Submit
        </a>
      </div>
    </div>
  </div>
</div>
<!-- The Edit Modal -->
<div id="monthdetailsmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentmonthdetails">
    <span class="closemonthdetails">&times;
    </span>
    <p>Month Wise Progress Report & Feedback...
    </p>
    <hr>
    <div class="row">
      <div class="col-lg-4">
        <label for="">Month:
        </label>
        <select name="month" class="form-control" id="month" onchange="showmonth();">
          <option value="June">June
          </option>
          <option value="July">July
          </option>
          <option value="August">August
          </option>
          <option value="September">September
          </option>
          <option value="October">October
          </option>
          <option value="November">November
          </option>
          <option value="December">December
          </option>
          <option value="January">January
          </option>
          <option value="February">February
          </option>
        </select>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-6">
        <select id="activity" class="form-control">
          <?php 
$sql = "select * from activity";
$result=$conn->query($sql);
if($result->num_rows > 0){
while($row = $result->fetch_assoc()){
?>
          <option value="<?php echo $row['activityid']; ?>">
            <?php echo $row['activityname']; ?>
          </option>
          <?php
}
}
?>
        </select>
        <input type="hidden" id="noofactivity" value="0">
      </div>
      <div class="col-lg-6">
        <a class="btn btn-info" onclick="addactivity();" style="color:white;">Add Activity
        </a>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" id="activitylocation">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performmonthfeedback_save();" class="btn btn-primary" style="color:white;">Save
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<div id="biodatamodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentbiodata">
    <span class="closebiodata">&times;
    </span>
    <p>Student Biodata
    </p>
    <hr>
    <div class="row">
      <div class="col-lg-10">
        <div class="row">
          <div class="col-lg-12">
            <table style="width:100%;">
              <tr>
                <th>
                </th>
                <th>
                </th>
              </tr>
              <tr>
                <td>Name: 
                </td>
                <td>
                  <input type="text" id="biodata_name" class="form-control" placeholder="Enter Student Name...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Father's Name: 
                </td>
                <td>
                  <input type="text" id="biodata_fathersname" class="form-control" placeholder="Enter Father's Name...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Mother's Name: 
                </td>
                <td>
                  <input type="text" id="biodata_mothersname" class="form-control" placeholder="Enter Mother's Name...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>D.O.B: 
                </td>
                <td>
                  <input type="date" id="biodata_dob" class="form-control" placeholder="Enter Date of Birth...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Gender: 
                </td>
                <td>
                  <select id="biodata_gender" class="form-control">
                    <option value="male">Male
                    </option>
                    <option value="female">Female
                    </option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>About Him: 
                </td>
                <td>
                  <textarea id="biodata_abouthim" cols="30" rows="10" placeholder="Enter Details About Him" class="form-control">
                  </textarea>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-2">
        <img src="../images/profile.jpg" alt="Image Unavailable!!!" id="biodata_image" style="width:100%;height:15em;">
        <input type="file" class="form-control" id="biodata_dp">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performbiodata_save();" class="btn btn-primary" style="color:white;">Update
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<div id="skillsmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentskills">
    <span class="closeskills">&times;
    </span>
    <p>Student Skills
    </p>
    <hr>
    <div style="text-align:right;">		    	
      <a onclick="addnewskills();" class="btn btn-info" style="color:white;">Add New Skill
      </a>
    </div>
    <hr>
    <input type="hidden" value="0" id="noofskills">
    <div id="student_skillslist">
      <div id="skillslist">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performskills_save();" class="btn btn-primary" style="color:white;">Update
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<div id="contactmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentcontact">
    <span class="closecontact">&times;
    </span>
    <p>Student Contact Details
    </p>
    <hr>
    <div class="row">
      <div class="col-lg-12">
        <table style="width:100%;">
          <tr>
            <th>
            </th>
            <th>
            </th>
          </tr>
          <tr>
            <td>Mobile No: 
            </td>
            <td>
              <input type="number" id="contact_mobileno1" class="form-control" placeholder="Enter Mobile No...">
            </td>
          </tr>
          <tr>
            <td>
              <br>
            </td>
            <td>
              <br>
            </td>
          </tr>
          <tr>
            <td>Alternate Mobile No: 
            </td>
            <td>
              <input type="number" id="contact_mobileno2" class="form-control" placeholder="Enter Alternate Mobile No...">
            </td>
          </tr>
          <tr>
            <td>
              <br>
            </td>
            <td>
              <br>
            </td>
          </tr>
          <tr>
            <td>Email ID: 
            </td>
            <td>
              <input type="email" id="contact_emailid" class="form-control" placeholder="Enter Email ID...">
            </td>
          </tr>
          <tr>
            <td>
              <br>
            </td>
            <td>
              <br>
            </td>
          </tr>
          <tr>
            <td>Address: 
            </td>
            <td>
              <textarea id="contact_address" cols="30" rows="10" placeholder="Enter Address..." class="form-control">
              </textarea>
            </td>
          </tr>
          <tr>
            <td>
              <br>
            </td>
            <td>
              <br>
            </td>
          </tr>
          <tr>
            <td>Hometown: 
            </td>
            <td>
              <input type="text" id="contact_hometown" class="form-control" placeholder="Enter Hometown...">
            </td>
          </tr>
        </table>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performcontact_save();" class="btn btn-primary" style="color:white;">Update
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<div id="classaboutmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentclassabout">
    <span class="closeclassabout">&times;
    </span>
    <p>Class Information
    </p>
    <hr>
    <div class="row">
      <div class="col-lg-9">
        <div class="row">
          <div class="col-lg-12">
            <table style="width:100%;">
              <tr>
                <th>
                </th>
                <th>
                </th>
              </tr>
              <tr>
                <td>Class Name: 
                </td>
                <td>
                  <input type="text" id="classabout_classname" class="form-control" placeholder="Enter Class Name..." value="">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Section Name: 
                </td>
                <td>
                  <input type="text" id="classabout_sectionname" class="form-control" placeholder="Enter Section Name...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Session Name: 
                </td>
                <td>
                  <input type="number" id="classabout_session" class="form-control" data-inputmask="'mask': '9999 9999 9999 9999'" placeholder="Enter Session...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Class Teacher: 
                </td>
                <td>
                  <input type="text" id="classabout_classteacher" class="form-control" placeholder="Enter Class Teacher Name...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Academic Coordinator: 
                </td>
                <td>
                  <input type="text" id="classabout_academiccoordinator" class="form-control" placeholder="Enter Academic Coordinator Name...">
                </td>
              </tr>
              <tr>
                <td>
                  <br>
                </td>
                <td>
                  <br>
                </td>
              </tr>
              <tr>
                <td>Principal: 
                </td>
                <td>
                  <input type="text" id="classabout_principal" class="form-control" placeholder="Enter Academic Coordinator Name...">
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-3">
        <img src="../images/profile.jpg" alt="Image Unavailable!!!" id="classabout_image" style="width:100%;height:15em;">
        <input type="file" class="form-control" id="classabout_dp">
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performclassabout_save();" class="btn btn-primary" style="color:white;">Update
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<div id="imagesmodal" class="modal">
  <!-- Modal content -->
  <div class="modal-contentimages">
    <span class="closeimages">&times;
    </span>
    <p>Student Gallery
    </p>
    <hr>
    <div style="text-align:right;">		    	
      <a onclick="addnewimages();" class="btn btn-info" style="color:white;">Add New Image
      </a>
    </div>
    <hr>
    <input type="hidden" value="0" id="noofimages">
    <div id="student_imageslist">
      <div id="imageslist">
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12" style="text-align:right;">
        <a onclick="performcancel();" class="btn btn-info" style="color:white;">Cancel
        </a>
        <a onclick="performimages_save();" class="btn btn-primary" style="color:white;">Update
        </a>
      </div>
    </div>
  </div>
</div>
</div>
<script>
  function refreshtable(){
    $.get("studentlist.php?cid=<?php echo $cid; ?>&sid=<?php echo $sid; ?>", function( data ) {
      $( "#stable" ).html("");
      $( "#stable" ).html(data);
    }
         );
  }
  $(document).ready(function() {
    setInterval(function () {
      refreshtable();
    }
                ,5000);
  }
                   );
  var valperformdelete = "";
  function deleteme(sid){
    valperformdelete = sid;
    // alert(cid);
    // Get the modal
    var modal = document.getElementById('deletemodal');
    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("closedelete")[0];
    modal.style.display = "block";
    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }
    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  }
  function performdelete(){
    var myuid = <?php echo $uid;
    ?>;
    var modal = document.getElementById('deletemodal');
    modal.style.display = "none";
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {
        method: 'deletesection',sectionid:valperformdelete,uid:myuid}
      ,
      success: function(data) {
        var modal = document.getElementById('deletesuccessmodal');
        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("closedeletesuccess")[0];
        span.onclick = function() {
          modal.style.display = "none";
        }
        modal.style.display = "block";
        refreshtable();
      }
    }
          );
  }
</script>
<?php include_once('../created/pagefooter.php'); ?>
<?php include_once('../created/footer.php'); ?>
