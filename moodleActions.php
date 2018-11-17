<?php
$moodle_con = mysqli_connect("localhost", "root", "", "aes_moodle_db") or die("Connection failure");
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

/* ===========================================-- ADMIN SECTION FUNCTIONS --========================================== */
if(isset($_POST['fun'])&&$_POST['fun']=="admin_getQuestions"){
  $moodle_dept_id=$_POST['dept_id'];
  $moodle_quiz_id=$_POST['quiz_id'];
  ?>
  <table class="table table-striped dataTable col-sm-12">

    <thead>
      <tr>
        <th>Question</th>
        <th>Option-1</th>
        <th>Option-2</th>
        <th>Option-3</th>
        <th>Option-4</th>
        <!-- <th style="width: 70px;">Actions</th> -->
      </tr>
    </thead>
    <tbody>
      <?php
      $moodle_qus_sel=mysqli_query($moodle_con,"SELECT * FROM `moodle_questions`,`moodle_quizzes` WHERE `quiz_id`=`question_quiz_id` AND `quiz_status`=1 AND `question_status`=1 AND 	`quiz_department_id`=$moodle_dept_id AND `quiz_id`=$moodle_quiz_id");
      while($moodle_qus_rows=mysqli_fetch_array($moodle_qus_sel)){
        $correct_ans=$moodle_qus_rows['question_option_correct'];
        ?>
        <tr>
          <td><?php echo $moodle_qus_rows['question_title']?></td>
          <td><?php echo $moodle_qus_rows['question_option_1'] == $correct_ans ? "<b style='color:red;'>".$moodle_qus_rows['question_option_1']."</b>" : $moodle_qus_rows['question_option_1']; ?></td>
          <td><?php echo $moodle_qus_rows['question_option_2'] == $correct_ans ? "<b style='color:red;'>".$moodle_qus_rows['question_option_2']."</b>" : $moodle_qus_rows['question_option_1']; ?></td>
          <td><?php echo $moodle_qus_rows['question_option_3'] == $correct_ans ? "<b style='color:red;'>".$moodle_qus_rows['question_option_3']."</b>" : $moodle_qus_rows['question_option_1']; ?></td>
          <td><?php echo $moodle_qus_rows['question_option_4'] == $correct_ans ? "<b style='color:red;'>".$moodle_qus_rows['question_option_4']."</b>" : $moodle_qus_rows['question_option_1']; ?></td>
          <!-- <td>
            <input type="hidden" name="mqid" id="mqid" class="mqid" value="<?php /*echo $moodle_qus_rows['question_id'] */?>">
            <button id="btn_mq_edit" class="btn_mq_edit btn btn-warning mq_action_buttons col-sm-5"  style="min-width:40px;"><i class="fa fa-pencil"></i></button>
            <button id="btn_mq_delete" class="btn_mq_delete btn btn-danger mq_action_buttons col-sm-5"  style="min-width:40px;"><i class="fa fa-remove"></i></button>
          </td> -->
        </tr>
        <?php
      }
      ?>
    </tbody>

  </table>
  <?php
}
if(isset($_POST['fun'])&&$_POST['fun']=="admin_getQuizzes"){
  $moodle_dept_id=$_POST['dept_id'];
  echo "<option selected disabled value=''>Select Quiz</option>";
  $select_quizzes=mysqli_query($moodle_con,"SELECT * FROM `moodle_quizzes` WHERE `quiz_department_id`=$moodle_dept_id");
  while($select_quizzes_row=mysqli_fetch_array($select_quizzes)){
    echo "<option value=".$select_quizzes_row['quiz_id'].">".$select_quizzes_row['quiz_title']."</option>";
  }
}
if(isset($_POST['fun'])&&$_POST['fun']=="admin_quizAdd"){
  $moodle_dept_id=$_POST['dept_id'];
  $moodle_quiz_title=trim($_POST['quiz_title']);
  if(checkQuizTitle($moodle_quiz_title,$moodle_con)){
    mysqli_query($moodle_con,"INSERT INTO `moodle_quizzes` (`quiz_title`,`quiz_department_id`) VALUES('$moodle_quiz_title',$moodle_dept_id)");
    if(mysqli_affected_rows($moodle_con)>0){
      $select_new_quiz_id=mysqli_query($moodle_con,"SELECT * FROM `moodle_quizzes` WHERE `quiz_title`='$moodle_quiz_title'");
      while($id_row=mysqli_fetch_array($select_new_quiz_id)){
        echo $id_row['quiz_id'];
      }
    }else{
      echo "0";
    }
  }else{
    echo "0";
  }

}

function checkQuizTitle($title,$moodle_con){
  $check_title_sel=mysqli_query($moodle_con,"SELECT * FROM `moodle_quizzes` WHERE `quiz_title`='$title'");
  if(mysqli_num_rows($check_title_sel)>0){
    return false;
  }else{
    return true;
  }
}


if(isset($_POST['fun'])&&$_POST['fun']=="admin_getParticipants"){
  $moodle_dept_id=$_POST['dept_id'];
  ?>
  <table class="table table-striped dataTable">

    <thead>
      <tr>
        <th>Register No</th>
        <th>Name</th>
        <th>Department</th>
        <th>Score</th>
        <th>Quizzes-Visited</th>
        <th>Questions-Attended</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $moodle_parti_sel=mysqli_query($moodle_con,"SELECT * FROM `moodle_users`,`moodle_departments` WHERE `user_department_id`=`department_id` AND `department_id`=$moodle_dept_id");
      while($moodle_parti_rows=mysqli_fetch_array($moodle_parti_sel)){
        ?>
        <tr>
          <td><?php echo $moodle_parti_rows['user_registration_no']?></td>
          <td><?php echo "---- Name ---"?></td>
          <td><?php echo $moodle_parti_rows['department_short_name']?></td>
          <td><?php echo $moodle_parti_rows['user_score']?></td>
          <?php
            $quiz_count=0;
            $question_count=0;
            $user_id_for_sel=$moodle_parti_rows['user_registration_no'];
            $user_visits_sel=mysqli_query($moodle_con,"SELECT COUNT(DISTINCT `question_quiz_id`) AS `quiz_count`,COUNT('participation_question_id') AS `question_count` FROM `moodle_participation`,`moodle_questions` WHERE `question_id`=`participation_question_id` AND `participation_user_id`=$user_id_for_sel");
            while($user_visits_rows=mysqli_fetch_array($user_visits_sel)){
              $quiz_count=$user_visits_rows['quiz_count'];
              $question_count=$user_visits_rows['question_count'];
            }
           ?>
          <td><?php echo $quiz_count?></td>
          <td><?php echo $question_count?></td>
        </tr>
        <?php
      }
      ?>
    </tbody>

  </table>
  <?php
}



function pre_postRemover($value)
{
  $value = preg_replace('/^\"/', '', $value);
  $value = preg_replace('/\"$/', '', $value);
  return trim($value);
}


if(isset($_POST['fun'])&&$_POST['fun']=="admin_questionAdd"){
  $quiz_id=$_POST['quiz_id'];
  $department_id=$_POST['dept_id'];
  $file=$_FILES['file']['tmp_name'];

  $upload_count=0;

  $read_data = fopen($file, 'r');
  $fread = trim(fread($read_data,filesize($file)));
  fclose($read_data);
  preg_match_all("/\[html\][^}]*}/",$fread,$split);
  foreach ($split[0] as $string)
  {
    // print_r($split[0]);
    // print_r($string);
    preg_match('/\[html](.*?){\n/', $string, $question_string);
    $question=pre_postRemover($question_string[1]);
    preg_match_all("/\=(.*?)\n/",$string,$correct_options);
    preg_match_all("/\~(.*?)\n/",$string,$wrong_options);
    if(sizeof($correct_options[1])!=1 || sizeof($wrong_options[1])<3){
      continue;
    }else{
      $options_list=array($wrong_options[1][0],$wrong_options[1][1],$wrong_options[1][2],$correct_options[1][0]);
      shuffle($options_list);
      $option1=pre_postRemover($options_list[0]);
      $option2=pre_postRemover($options_list[1]);
      $option3=pre_postRemover($options_list[2]);
      $option4=pre_postRemover($options_list[3]);
      $correct=pre_postRemover($correct_options[1][0]);

      mysqli_query($moodle_con,"INSERT INTO `moodle_questions` (`question_quiz_id`,`question_title`,`question_option_1`,`question_option_2`,`question_option_3`,`question_option_4`,`question_option_correct`) VALUES ($quiz_id,'$question','$option1','$option2','$option3','$option4','$correct')");
      if(mysqli_affected_rows($moodle_con)>0){
        $upload_count++;
      }
    }
  }
  echo $upload_count;
}
/* ===========================================-- USER SECTION FUNCTIONS --=========================================== */
?>
