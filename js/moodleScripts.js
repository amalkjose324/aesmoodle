$(document).ready(function () {
  $('#view_quiz_id').hide();
  $('#quiz_id').hide();
  $('.quiz_select_mode').change(function () {
    $selected_val=$('input[name=quiz_select_mode]:checked').val();
    if ($selected_val == 0) {
      $('#quiz_id').show();
      $('#quiz_title').hide();
      var quiz_id=$('#quiz_id').val("");
      var dept_id=$('#department_id').val("");
      var file_name=$('#file').val("");
    }else{
      $('#quiz_id').hide();
      $('#quiz_title').show();
      var quiz_id=$('#quiz_title').val("");
      var dept_id=$('#department_id').val("");
      var file_name=$('#file').val("");
    }
  })

  $('.view_select_mode').change(function () {
    $selected_val=$('input[name=view_select_mode]:checked').val();
    if ($selected_val == 0) {
      $('#view_quiz_id').show();
      $('.view_table_heading').html("Questions");
      $('.data_table_container').html("");
      $('#view_quiz_id').val("");
      $('#view_department_id').val("");
    }else{
      $('#view_quiz_id').hide();
      $('.view_table_heading').html("Participants");
      $('.data_table_container').html("");
      $('#view_quiz_id').val("");
      $('#view_department_id').val("");
    }
  })

  $('#view_department_id').change(function () {
    $view_sel_val=$('input[name=view_select_mode]:checked').val();
    if ($view_sel_val == 0) {
      $fun = "admin_getQuizzes";
      $dept_id= $(this).val();
      $.ajax({
        type:'post',
        url:'./moodleActions.php',
        async:false,
        data:{fun:$fun,dept_id:$dept_id},
        success:function(response)
        {
          $('#view_quiz_id').html(response);
        }
      });
    }else{
      $fun = "admin_getParticipants";
      $dept_id= $(this).val();
      $.ajax({
        type:'post',
        url:'./moodleActions.php',
        async:false,
        data:{fun:$fun,dept_id:$dept_id},
        success:function(response)
        {
          $('.data_table_container').html(response);
          $('.dataTable').each(function () {
            $(this).DataTable();
          });
        }
      });
    }
  })

  $('#department_id').change(function () {
    $sel_val=$('input[name=quiz_select_mode]:checked').val();
    if ($sel_val == 0) {
      $fun = "admin_getQuizzes";
      $dept_id= $(this).val();
      $.ajax({
        type:'post',
        url:'./moodleActions.php',
        async:false,
        data:{fun:$fun,dept_id:$dept_id},
        success:function(response)
        {
          $('#quiz_id').html(response);
        }
      });
    }
  })

  $('#view_quiz_id').change(function () {
    $view_sel_val=$('input[name=view_select_mode]:checked').val();
    if ($view_sel_val == 0) {
      $fun = "admin_getQuestions";
      $quiz_id= $(this).val();
      $dept_id= $('#view_department_id').val();
      var dept_idRegExp=/^[0-9]{1,}$/;
      if(dept_idRegExp.test($dept_id)){
        $.ajax({
          type:'post',
          url:'./moodleActions.php',
          async:false,
          data:{fun:$fun,dept_id:$dept_id,quiz_id:$quiz_id},
          success:function(response)
          {
            $('.data_table_container').html(response);
            $('.dataTable').each(function () {
              $(this).DataTable();
            });
          }
        });
      }
    }
  })

  $('.btn-sel').each(function () {
    $(this).click(function () {
      $('.btn-sel').removeClass('sel-active');
      $(this).addClass('sel-active');
    });
  });


  $('.download_link').each(function () {
    $(this).click(function () {
      alert("Open downloaded file in Excel and save as .txt file to upload");
    })
  })

  $('.btn_mq_delete').each(function () {
    $(this).click(function () {
      alert("delete");
    })
  })

  $('.btn_mq_edit').each(function () {
    $(this).click(function () {
      alert("edit");
    })
  })

  $('#fileupload_form').on("submit",function () {
    $selected_val=$('input[name=quiz_select_mode]:checked').val();
    if ($selected_val == 0) {
      var quiz_id=$('#quiz_id').val();
      var dept_id=$('#department_id').val();
      var file_name=$('#file').val();
      var file_nameRegExp= /\.txt$/;
      var dept_idRegExp=/^[0-9]{1,}$/;
      var quiz_idRegExp=/^[0-9]{1,}$/;
      if(!dept_idRegExp.test(dept_id)){
        alert("Select Department!");
        $('#department_id').focus();
        return false;
      }else if(!quiz_idRegExp.test(quiz_id)){
        alert("Select an Existing Quiz");
        $('#quiz_id').focus();
        return false;
      }else if(!file_nameRegExp.test(file_name)){
        alert("Select Valid Text (.txt) file!");
        $('#file').val('');
        $('#file').focus();
        return false;
      }else{
        $fun="admin_questionAdd";
        var file_data = $('#file').prop('files')[0];
        var form_data = new FormData(this);
        form_data.append('file', file_data);
        form_data.append('fun', $fun);
        form_data.append('dept_id', dept_id);
        form_data.append('quiz_id', quiz_id);
        $.ajax({
          type:'post',
          url:'./moodleActions.php',
          cache : false,
          async:false,
          processData: false,
          contentType: false,
          data:form_data,
          success:function(response)
          {
            console.log(response);
            if(response>0){
              alert(response+" Questions Added!");
            }else{
              alert("Invalid Question File!");
            }
          }
        });
      }
    }else{
      var quiz_title=$('#quiz_title').val();
      var dept_id=$('#department_id').val();
      var file_name=$('#file').val();
      var file_nameRegExp= /\.txt$/;
      var dept_idRegExp=/^[0-9]{1,}$/;
      var quiz_titleRegExp=/^[^&]{3,}$/;
      if(!dept_idRegExp.test(dept_id)){
        alert("Select Department!");
        $('#department_id').focus();
        return false;
      }else if(!quiz_titleRegExp.test(quiz_title)){
        alert("Enter a Quiz Title to Create");
        $('#quiz_title').focus();
        return false;
      }else if(!file_nameRegExp.test(file_name)){
        alert("Select Valid Text (.txt) file!");
        $('#file').val('');
        $('#file').focus();
        return false;
      }else{
        $fun="admin_quizAdd";
        $.ajax({
          type:'post',
          url:'./moodleActions.php',
          async:false,
          data:{fun:$fun,dept_id:dept_id,quiz_title:quiz_title},
          success:function(response)
          {
            if(response<1){
              alert("Quiz Title is already existing!");
            }else{
              $fun="admin_questionAdd";
              var file_data = $('#file').prop('files')[0];
              var form_data = new FormData(this);
              form_data.append('file', file_data);
              form_data.append('fun', $fun);
              form_data.append('dept_id', dept_id);
              form_data.append('quiz_id', response);
              $.ajax({
                type:'post',
                url:'./moodleActions.php',
                cache : false,
                async:false,
                processData: false,
                contentType: false,
                data:form_data,
                success:function(response)
                {
                  console.log(response);
                  if(response>0){
                    alert(response+" Questions Added!");
                  }else{
                    alert("Invalid Question File!");
                  }
                }
              });
            }
          }
        });
      }
    }
  })

})
