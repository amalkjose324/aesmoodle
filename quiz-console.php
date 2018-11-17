<?php
include_once "db_connection.php";
// if (!isset($_SESSION['userid'])) {
//   echo "<script>window.location.href = './';</script>";
// }else if(!$_SESSION['u_type']==2){
//   echo "<script>window.location.href = 'console.php';</script>";
// }
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

            <div class="card">
              <div class="card-header">
                <b><?php echo $moodle_user_name; ?></b>
                <br>
                <table class="text-center col-sm-12">
                  <tr>
                    <td width="60%">Department</td>
                    <td width="40%"><?php echo $moodle_user_department_name; ?></td>
                  </tr>
                  <tr>
                    <td>Admission No</td>
                    <td><?php echo $moodle_user_register_no; ?></td>
                  </tr>
                </table>
              </div>
              <?php
              $quiz_count=0;
              $question_count=0;
              $user_visits_sel=mysqli_query($moodle_con,"SELECT COUNT(DISTINCT `question_quiz_id`) AS `quiz_count`,COUNT('participation_question_id') AS `question_count` FROM `moodle_participation`,`moodle_questions` WHERE `question_id`=`participation_question_id` AND `participation_user_id`=$moodle_user_id");
              while($user_visits_rows=mysqli_fetch_array($user_visits_sel)){
                $quiz_count=$user_visits_rows['quiz_count'];
                $question_count=$user_visits_rows['question_count'];
              }

              ?>
              <div class="card-body">
                <table class="text-center col-sm-12">
                  <tr>
                    <td width="75%">Visited Quizzes</td>
                    <td width="25%"><?php echo $quiz_count;?></td>
                  </tr>
                  <tr>
                    <td>Questions Attended</td>
                    <td><?php echo $question_count;?></td>
                  </tr>
                </table>
              </div>
              <div class="card-footer">
                <table class="text-center col-sm-12">
                  <tr>
                    <th width="60%">Total Score</th>
                    <th width="40%"><?php echo $moodle_user_score; ?></th>
                  </tr>
                </table>
              </div>
            </div>
            <hr/>
            <div class="form-group form_group_department">
              <select name="user_attend_quiz_id" id="user_attend_quiz_id"class="form-control">
                <option selected disabled value="">Select Quiz</option>
                <?php
                  $dept_quizzes_select=mysqli_query($moodle_con,"SELECT * FROM `moodle_quizzes` WHERE `quiz_department_id`=$moodle_user_department_id");
                  while($dept_quizzes_list=mysqli_fetch_array($dept_quizzes_select)){
                    $quiz_id=$dept_quizzes_list['quiz_id'];
                    $quiz_title=$dept_quizzes_list['quiz_title'];
                    echo "<option value='$quiz_id'>$quiz_title</option>";
                  }
                 ?>
              </select>
            </div>
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
