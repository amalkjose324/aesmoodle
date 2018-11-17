$(document).on("click",".grid-button",function () {
  $qid=(this.innerHTML).trim();
  $selected_val=$('input[name=quiz_options]:checked').val();
  if (typeof $selected_val === "undefined") {
    $selected_val=0;
  }
  $fun="question_change";
  $.ajax({
    type:'post',
    url:'./quizactions.php',
    async:false,
    data:{question_id:$qid,fun:$fun,selected_option:$selected_val},
    success:function(response)
    {
      var obj = JSON.parse(response)[0]['val'];
      if(obj){
        $('.question_space').load(' .question_space');
      }
    }
  });
})
$(document).on("click",".btn_next_question",function () {
  $fun="question_change_next_question";
  $selected_val=$('input[name=quiz_options]:checked').val();
  if (typeof $selected_val === "undefined") {
    $selected_val=0;
  }
  $.ajax({
    type:'post',
    url:'./quizactions.php',
    async:false,
    data:{fun:$fun,selected_option:$selected_val},
    success:function(response)
    {
      var obj = JSON.parse(response)[0]['val'];
      if(obj){
        $('.question_space').load(' .question_space');
      }
    }
  });
})
$(document).on("click",".btn_reset_options",function () {
  $fun="question_option_reset";
  $.ajax({
    type:'post',
    url:'./quizactions.php',
    async:false,
    data:{fun:$fun},
    success:function(response)
    {
      var obj = JSON.parse(response)[0]['val'];
      if(obj){
        $('.question_space').load(' .question_space');
      }
    }
  });
})
$(document).on("click",".btn_mark_review",function () {
  $fun="question_review_set_reset";
  $selected_val=$('input[name=quiz_options]:checked').val();
  if (typeof $selected_val === "undefined") {
    $selected_val=0;
  }
  $.ajax({
    type:'post',
    url:'./quizactions.php',
    async:false,
    data:{fun:$fun,selected_option:$selected_val},
    success:function(response)
    {
      var obj = JSON.parse(response)[0]['val'];
      if(obj){
        $('.question_space').load(' .question_space');
      }
    }
  });
})
$(document).on("change","input[name=quiz_options]",function () {
  $('.btn_reset_options').removeClass('btn-hidden');
})
$(document).on("click",".backtoquiz",function () {
  $('.console-loader').hide();
})

$(document).on("click",".btn-final-submit",function () {
  $('.console-loader').show();
  $('#modal_confirm_final_submit').modal('show');
})
$(document).on("click",".confirm_submission",function () {
  $('#modal_confirm_final_submit').modal('hide');
  $('#modal_result_generation_loader').modal('show');
  $fun="final_submission";
  var obj =false;
  time=setInterval(function(){
  $.ajax({
    type:'post',
    url:'./quizactions.php',
    async:false,
    data:{fun:$fun},
    success:function(response){
      console.log(response);
      obj = JSON.parse(response)[0]['val'];
      if(obj){
        clearInterval(time);
        pass_status = JSON.parse(response)[0]['pass_status'];
        pass_mark = JSON.parse(response)[0]['pass_mark'];
        user_round = JSON.parse(response)[0]['userround'];
        if(user_round==2){
          $.ajax({
            type:'post',
            url:'./quizactions.php',
            async:false,
            data:{fun:"round_2_winner"},
            success:function(response2){
              console.log(response2);
              obj2 = JSON.parse(response2)[0]['val'];
              if(obj){
                alert("Result will be published later");
                window.location.href="./";
              }
            }
          });
        }else{
        $('.passmark_display').text(pass_mark);
        if(pass_status){
          $('.greeting_msg').html("<h5 style='color:green'> Congratulations..! You are eligible for the next Round.</h5>");
          $('.exit_next_round').html("<button type='button' class='btn btn-success continue_to_next_round' data-dismiss='modal'>Continue to Next Round</button>");

        }else{
          $('.greeting_msg').html("<h5 style='color:red'>Sorry, You aren't eligible for next round. Thanks for participation</h5>");
          $('.exit_next_round').html("<button type='button' class='btn btn-danger exit_from_quiz' data-dismiss='modal'>Exit from Quiz</button>");
        }
        $('#modal_result_view').modal('show');
      }
        $('#modal_result_generation_loader').modal('hide');
      }
    }
  });
},5000);
})
$(document).on("click",".exit_from_quiz",function () {
  $fun="exit_from_quiz";
  $.ajax({
    type:'post',
    url:'./quizactions.php',
    async:false,
    data:{fun:$fun},
    success:function(response){
      console.log(response);
      obj = JSON.parse(response)[0]['val'];
      if(obj){
        window.location.href="./";
      }
    }
  });
})
$(document).on("click",".continue_to_next_round",function () {
  $fun="continue_to_next_round";
  $.ajax({
    type:'post',
    url:'./quizactions.php',
    async:false,
    data:{fun:$fun},
    success:function(response){
      console.log(response);
      obj = JSON.parse(response)[0]['val'];
      if(obj){
        window.location.href="";
      }
    }
  });
})
$(document).ready(function () {
  $('.console-loader').hide();
  setTimeout(function() {
    $("#proceed").show();
  }, 15000);

  $("body").on("contextmenu",function(e){
       return false;
   });

   $('body').bind('cut copy paste', function (e) {
        e.preventDefault();
    });

})
