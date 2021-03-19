// AJAX add questions
$(document).on('click', '#submit-field', function(){
  if($("#title-add").val() != ""){
    $(".mySpinner").css("display","block");
    $.post("../private/addField.php",
    {
      title: $("#title-add").val(),
      image: $("#image-add").val(),
      content: $("#content-add").val(),
    },
    function(data, status){
      $( ".current-card .card" ).remove();
      $(".current-card").append(data);
      $(".mySpinner").css("display","none");
      // clear input
      $('#title-add').val('');
      $('#content-add').val('');
    });
  } else {
    alert('Please type in a title for this question');
  }
});


// AJAX add member
$(document).on('click', '#button-new-user', function(){
  if($("#content-new-user").val() != ""){
    // invite user
    $(".mySpinner").css("display","block");
    $.post("../private/inviteUser.php",
    {
      emails : $("#content-new-user").val(),
      rights : $("#customSwitch2").prop("checked"),
    },
    function(data, status){
      $(".friend-list").empty();
      $(".friend-list").append(data);
      $(".mySpinner").css("display","none");
      // clear input
      $('#content-new-user').val('');
    });
  } else {
    alert('Please enter a valid email address');
  }
});

// AJAX delete a field
$(document).on('click', 'a.btn', function(){
  let a = this;
  $.post("../private/deleteField.php",
  {
    id : $(this).parent().find('.card-id').text(),
  },
  function(data, status){
    $("body").append(data);
    if(data == ""){
      $(a).parent().remove();
    }
  });
});

// AJAX delete survey
$(document).on('click', '#button-delete-project', function(){
  //$(".mySpinner").css("display","block");
  $.post("../private/deleteSurvey.php",
  {
    delete : true,
  },
  function(data, status){
    $("body").append(data);
    //$(".mySpinner").css("display","none");
  });
});
