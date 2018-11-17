<?php
include_once "db_connection.php";
// if (!isset($_SESSION['userid'])) {
//   echo "<script>window.location.href = './';</script>";
// }else if(!$_SESSION['u_type']==2){
//   echo "<script>window.location.href = 'console.php';</script>";
// }
$departments_array=array();
$department_select=mysqli_query($moodle_con,"SELECT * FROM `moodle_departments` ORDER BY `department_short_name` ASC");
while($department_select_row=mysqli_fetch_array($department_select)){
  array_push($departments_array, array("department_id"=>$department_select_row['department_id'],"department_short_name"=>$department_select_row['department_short_name']));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quiz Console</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" href="css/bootstrap.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="css/font-awesome.css" crossorigin="anonymous">
  <link rel="stylesheet" href="css/jquery.dataTables.min.css" crossorigin="anonymous">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
  <style>
  /* The container */
  .container {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 16px;
    display: inline;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  .mq_action_buttons{display: inline-block;}
  /* Hide the browser's default radio button */
  .container input {
    position: absolute;
    display: inline;
    opacity: 0;
    cursor: pointer;
  }

  /* Create a custom radio button */
  .checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 18px;
    width: 18px;
    background-color: #eee;
    border-radius: 50%;
  }

  /* On mouse-over, add a grey background color */
  .container:hover input ~ .checkmark {
    background-color: #ccc;
  }

  /* When the radio button is checked, add a blue background */
  .container input:checked ~ .checkmark {
    background-color: #2196F3;
  }

  /* Create the indicator (the dot/circle - hidden when not checked) */
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }

  /* Show the indicator (dot/circle) when checked */
  .container input:checked ~ .checkmark:after {
    display: block;
  }

  /* Style the indicator (dot/circle) */
  .container .checkmark:after {
    top: 5.7px;
    left: 5.7px;
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: white;
  }
</style>

</head>
<body>
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-quiz100 quiz-bg col-md-11 col-sm-11 col-lg-11" style="overflow: overlay;">
        <div class="row col-sm-12 text-center">
          <div class="col-sm-3">
            <h3>View Data</h3>
            <hr/>
            <div class="form-group">
              <label class="container col-sm-6">Participants
                <input type="radio" checked="checked" name="view_select_mode" class="view_select_mode" value="1">
                <span class="checkmark"></span>
              </label>
              <label class="container col-sm-6">Questions
                <input type="radio" name="view_select_mode" class="view_select_mode" value="0">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="form-group">
              <select name="view_department_id" id="view_department_id"class="form-control">
                <option selected disabled value="">Select Department</option>
                <?php
                  foreach ($departments_array as $department) {
                    echo "<option value='".$department['department_id']."'>".$department['department_short_name']."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group form_group_department">
              <select name="view_quiz_id" id="view_quiz_id"class="form-control">
                <option selected disabled value="">Select Quiz</option>
              </select>
            </div>
            <hr>
            <h3>Upload Questions</h3>
            <hr/>
            <!-- <p>
            <a href="./assets/Questions_Format.xlsx" download="Questions_Format.xlsx" class="download_link col-sm-6 text-center"><i class="fa fa-download"></i>Questions Format</a>
          </p>
          <hr> -->
          <form action="" method="post" enctype="multipart/form-data" onsubmit="return false" id="fileupload_form">
            <div class="form-group">
              <label class="container col-sm-6">Create Quiz
                <input type="radio" checked="checked" name="quiz_select_mode" class="quiz_select_mode" value="1">
                <span class="checkmark"></span>
              </label>
              <label class="container col-sm-6">Existing Quiz
                <input type="radio" name="quiz_select_mode" class="quiz_select_mode" value="0">
                <span class="checkmark"></span>
              </label>
            </div>
            <div class="form-group">
              <select name="department_id" id="department_id"class="form-control">
                <option selected disabled value="">Select Department</option>
                <?php
                  foreach ($departments_array as $department) {
                    echo "<option value='".$department['department_id']."'>".$department['department_short_name']."</option>";
                  }
                ?>
              </select>
            </div>
            <div class="form-group">
              <select name="quiz_id" id="quiz_id"class="form-control">
                <option selected disabled value="">Select Quiz</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" id="quiz_title" name="quiz_title" class="form-control" placeholder="Quiz Title">
            </div>

            <div class="form-group">
              <input type="file" name="file" placeholder="Path / Drag file here" id="file" pattern="[a-zA-Z0-9_-\s]{0,}\.txt" title="Text files (.txt) required" class="form-control" >
            </div>
            <div class="form-group">
              <button type="submit" name="filesubmit" id="filesubmit" class="btn btn-primary col-sm-8 filesubmit">Submit</button>
            </div>
          </form>
        </div>

        <div class="col-sm-9 col-auto" >
          <div class="tab-content">
            <div id="menu1" class="tab-pane active">
              <h3 class="view_table_heading">Participants</h3>
              <hr>
              <p>
                <div class="data_table_container">

              </div>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
</body>
<!--===============================================================================================-->
<script src="js/jquery.min.js" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="js/jquery.dataTables.js" crossorigin="anonymous"></script>
<!--===============================================================================================-->

<script src="js/moodleScripts.js"></script>
<!--===============================================================================================-->
</html>
