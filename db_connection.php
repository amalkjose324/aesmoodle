<?php
/* ==============================================-- DATABASE CONNECTION --==============================================*/
$moodle_con = mysqli_connect("localhost", "root", "", "aes_moodle_db") or die("Connection failure");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
/* ==========================================-- USER REGISTER NUMBER CONFIG --==========================================*/
$moodle_user_register_no=0;
/* ==============================================-- PUBLIC USER DETAILS --==============================================*/
$moodle_user_id=0;
$moodle_user_department_id=0;
$moodle_user_score=0;
$moodle_user_type=1;
gotoMoodlePage("admin-console.php");
/* ==========================================-- USER SELECTION OR CREATION --===========================================*/
// $moodle_users_select=mysqli_query($moodle_con,"SELECT * FROM `moodle_users` WHERE `user_registration_no` = $moodle_user_register_no");
// if(mysqli_num_rows($moodle_users_select)>0){
//   while($moodle_users_row=mysqli_fetch_array($moodle_users_select)){
//     $moodle_user_id=$moodle_users_row['user_id'];
//     $moodle_user_department_id=$moodle_users_row['user_department_id'];
//     $moodle_user_score=$moodle_users_row['user_score'];
//     $moodle_user_type=$moodle_users_row['user_type'];
//   }
//   if($moodle_user_type==1){
//     gotoMoodlePage("admin-console.php");
//   }else if($moodle_user_type==0){
//     gotoMoodlePage("quiz-console.php");
//   }
// }else{
//   $moodle_user_department_id=getMoodleUserDeptId($moodle_user_register_no);
//   if($moodle_user_department_id>0){
//     mysqli_query($moodle_con,"INSERT INTO `moodle_users` (`user_registration_no`,`user_department_id`) VALUES($moodle_user_register_no,$moodle_user_department_id)");
//     if(mysqli_raws_affected($moodle_con)>0){
//       gotoMoodlePage("quiz-console.php");
//     }
//   }else{
//     die("Error in User Insertion : Department details not found.!");
//   }
// }

/* ==============================================-- DEFINED FUNCTIONS --==============================================*/
function gotoMoodlePage($page){
  if(!$page==basename($_SERVER['PHP_SELF'])){
    echo "<script>window.location.href='$page';</script>";
  }
}

function getMoodleUserDeptId($regno){
  return 0;
}
