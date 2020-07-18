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
			$stname = $rowbiodata['studentname'];
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


<?php include_once('../../created/header1.php'); ?>

<script>
  $(document).ready(function() {
    showmonth();
    addmonthdetails();
  });

  function noofstar(id,star){
    $("."+id).val(star);
    for (var i = 1; i <= 5; i++) {
      $("#"+id+i).attr('src','../../images/star.png');
    }
    for (var i = 1; i <= star; i++) {
      $("#"+id+i).attr('src','../../images/stardone.png');
    }
  }
  function clearstar(id){
    for (var i = 1; i <= 5; i++) {
      $("#"+id+i).attr('src','../../images/star.png');
    }
    $("."+id).val("");
    $(".clickstar").attr('src','../../images/star.png');
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

  function addmonthdetails(){
    var studentid = $("#studentid").val();
    if(studentid!=""){
      $("#activitylocation").html("");
      var mystudentcsid = $("#studentcsid").val();
      var noofactivity = $("#noofactivity").val();
      var newnoofactivity = +noofactivity + 1;
      $.ajax({
        type: 'post',
        url: '../ajax.php',
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
              myhtml = myhtml + '<tr><td>'+field1name+'</td><td><img src="../../images/';
              if(field1answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'11" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"1','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field1answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'12" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"1','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field1answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'13" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"1','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field2name+'</td><td><img src="../../images/';
              if(field2answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'21" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"2','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field2answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'22" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"2','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field2answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'23" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"2','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field3name+'</td><td><img src="../../images/';
              if(field3answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'31" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"3','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field3answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'32" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"3','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field3answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'33" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"3','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field4name+'</td><td><img src="../../images/';
              if(field4answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'41" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"4','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field4answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'42" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"4','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field4answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'43" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"4','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field5name+'</td><td><img src="../../images/';
              if(field5answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'51" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"5','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field5answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'52" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"5','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field5answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'53" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"5','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field6name+'</td><td><img src="../../images/';
              if(field6answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'61" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"6','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field6answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'62" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"6','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field6answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'63" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"6','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field7name+'</td><td><img src="../../images/';
              if(field7answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'71" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"7','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field7answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'72" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"7','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field7answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'73" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"7','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field8name+'</td><td><img src="../../images/';
              if(field8answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'81" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"8','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field8answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'82" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"8','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field8answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'83" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"8','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field9name+'</td><td><img src="../../images/';
              if(field9answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'91" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"9','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field9answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'92" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"9','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field9answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'93" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"9','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + '<tr><td>'+field10name+'</td><td><img src="../../images/';
              if(field10answer=="1"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'101" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"10','1');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field10answer=="2"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'102" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"10','2');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
              if(field10answer=="3"){
                myhtml = myhtml + "stardone.png";
              }
              else{
                myhtml = myhtml + "star.png";
              }
              myhtml = myhtml + '" class="clickstar" alt="" height=20 width=20 id="field_'+i+'103" onclick="';
              myhtml = myhtml + "clickidentity('field_"+i+"10','3');";
              myhtml = myhtml + '"></td><td><img src="../../images/';
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
              myhtml = myhtml + "../../images/profile.jpg";
            }
            else{
              myhtml = myhtml + "../../images/monthfeedback/"+fielddp+".jpg";
            }
            myhtml = myhtml + '" alt="Image Unavailable!!!" id="field_image_'+i+'" style="width:100%;height:15em;"><br><br><br></div></div></div>';
            $("#activitylocation").html(myhtml);
          }

          showmonth();
        }
      }
            );

    }
  }

</script>


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
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" style="background-color: white;"> 
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light site-navbar-target" id="ftco-navbar">
      <div class="container">
        <a class="navbar-brand" href="index.html">MVA | Student Portfolio</a>
        <button class="navbar-toggler js-fh5co-nav-toggle fh5co-nav-toggle" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav nav ml-auto">
            <li class="nav-item"><a href="#home-section" class="nav-link"><span>Home</span></a></li>
            <li class="nav-item"><a href="./index.php?studentid=<?php echo $studentid; ?>#about-section" target="_blank" class="nav-link"><span>About</span></a></li>
            <li class="nav-item"><a href="./index.php?studentid=<?php echo $studentid; ?>#skills-section" target="_blank" class="nav-link"><span>Skills</span></a></li>
            <li class="nav-item"><a href="./index.php?studentid=<?php echo $studentid; ?>#projects-section" target="_blank" class="nav-link"><span>Gallery</span></a></li>
            <li class="nav-item"><a href="#skills-section" class="nav-link">Activi<span style="display:inline-block;color:white;">ties</span></a></li>
            <li class="nav-item"><a href="./index.php?studentid=<?php echo $studentid; ?>#contact-section" target="_blank" class="nav-link"><span style="color:white;">Contact</span></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <section id="home-section" class="hero" style="margin-top:-4.4em;">
      <div class="home-slider  owl-carousel">
        <div class="slider-item ">
                <!-- <h1 style="margin-top:2.7em;position: fixed;margin-left:12em;font-size:90px;font-family:candara;"><strong>E-portfolio</strong></h1> -->
                <!-- <h6 style="margin-top:2.7em;position: fixed;margin-left:12em;font-size:20px;font-family:candara;">Story Of My School Life</h6> -->
                <img src="../../images/portfolioheader.jpg" style="display:block;position: fixed;top:0px;margin-left:50em;width:69em;height:600px;">
          <div class="container">
            <div class="row d-md-flex no-gutters slider-text align-items-end justify-content-end" data-scrollax-parent="true">
              <?php 
          $sql = "select * from student_gallery where studentid='$studentid'";
          $result=$conn->query($sql);
          if($result->num_rows > 0){
            $rowgallery = $result->fetch_assoc();
            ?>              
            <div class="one-third order-md-last img" style="display:none;border:0px;width:5000px;margin-left:400px;margin-right:0px;padding:0px;">
            <?php
          }
         ?>
                <!-- <div class="overlay"></div> -->

              </div>
              <div class="one-forth d-flex  align-items-center ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
                <!-- <a href="https://vimeo.com/45830194" class="icon-video popup-vimeo d-flex justify-content-center align-items-center"> -->
                  <!-- <span class="ion-ios-play play"></span> -->
                <!-- </a> -->
                <div class="text">
                  <span class="subheading">Hello</span>
                  <h1 class="mb-4 mt-3">I'm <span><?php echo $rowbiodata['studentname']; ?></span></h1>
                  <!-- <h2 class="mb-4">A Freelance Web Developer</h2> -->
                  <p><a href="#about-section" class="btn-custom">About Me</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
<!--            <div class="counter-wrap ftco-animate d-flex mt-md-3">
              <div class="text p-4 pr-5 bg-primary">
                <p class="mb-0">
                  <span class="number" data-number="200">0</span>
                  <span>Finished Projects</span>
                </p>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </section>
    
    <section class="ftco-section bg-light" id="skills-section">
      <div class="container" style="max-width: 85em;">
        <div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Activities</span>
            <h2 class="mb-4">My Activities</h2>
            <hr>
          </div>
        </div>
        <div class="row">
              <div class="col-12">
                  <div class="card-content collapse show">
                    <div class="card-body">
                      <?php
                      $sql = "select * from student_csdetails where studentid='$studentid' order by studentcsid";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0){
                    $rowcsdetails = $result->fetch_assoc();
                    $classid = $rowcsdetails['classid'];
                    $sectionid = $rowcsdetails['sectionid'];
                    $uid = $rowcsdetails['uid'];
                    $studentcsid = $rowcsdetails['studentcsid'];
                  }else{
                    $classid = "";
                    $sectionid = "";
                    $uid = "";
                    $studentcsid = "";
                  }
                  $sql = "select * from class_entry where cid='$classid' and uid='$uid'";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0){
                    $rowclassdetails = $result->fetch_assoc();
                    $classname = $rowclassdetails['classname'];
                  }else{
                    $classname="";
                  }

                  $sql = "select * from section_entry where cid='$sectionid' and uid='$uid' and cid='$classid'";
                  $result = $conn->query($sql);
                  if($result->num_rows > 0){
                    $rowsectiondetails = $result->fetch_assoc();
                    $sectionname = $rowsectiondetails['sectionname'];
                  }else{
                    $sectionname="";
                  }
                ?>
                      <div class="functions">
                        <br>
                        <div class="row">
                          <div class="col-lg-4" style="display:none;">
                            <label for="">Name:
                            </label>
                            <input type="text" class="form-control" name="name" id="name" disabled placeholder="Name..." value="<?php echo $rowbiodata['studentname']; ?>">
                            <input type="hidden" class="form-control" name="studentid" id="studentid" value="<?php echo $studentid; ?>">
                            <input type="hidden" class="form-control" name="studentcsid" id="studentcsid" value="<?php echo $studentcsid; ?>">
                          </div>
                          <div class="col-lg-4">
                            <label for="">Class:
                            </label>
                            <input type="text" class="form-control" name="class" id="class" disabled placeholder="Class..." value="<?php echo $classname;?>">
                            <input type="hidden" class="form-control" name="classid" id="classid" value="<?php echo $classid; ?>">
                          </div>
                          <div class="col-lg-4">
                            <label for="">Section:
                            </label>
                            <input type="text" class="form-control" name="section" id="section" disabled placeholder="Section..." value="<?php echo $sectionname; ?>">
                            <input type="hidden" class="form-control" name="sectionid" id="sectionid" value="<?php echo $sectionid; ?>">
                          </div>
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
                      </div>
                      <br>
                      <div id="monthdetailsmodal">
                        <!-- Modal content -->
                        <div class="contentmonthdetails">
                          <div class="row">

                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-lg-12" id="activitylocation">
                            </div>
                          </div>
                          <hr>
                        </div>
                      </div>
                    </div>
                  </div>
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
                <li><a href="./index.php?studentid=<?php echo $studentid; ?>#about-section" target="_blank"><span class="icon-long-arrow-right mr-2"></span>About</a></li>
                <li><a href="./index.php?studentid=<?php echo $studentid; ?>#skills-section" target="_blank"><span class="icon-long-arrow-right mr-2"></span>Skills</a></li>
                <li><a href="./index.php?studentid=<?php echo $studentid; ?>#projects-section" target="_blank"><span class="icon-long-arrow-right mr-2"></span>Gallery</a></li>
                <li><a href="#skills-section"><span class="icon-long-arrow-right mr-2"></span>Activities</a></li>
                <li><a href="./index.php?studentid=<?php echo $studentid; ?>#contact-section" target="_blank"><span class="icon-long-arrow-right mr-2"></span>Contact</a></li>
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



<?php include_once('../../created/footer.php'); ?>
