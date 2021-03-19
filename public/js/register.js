$(document).ready(function(){
  $('.myButton[name="submit"]').click(function() {
    if($('.formInput[name="password"]').val() == $('.formInput[name="verification"]').val() && $('.formInput[name="password"]').val() != ""){
      // new passwords are the sames
      $('label[for="password"]').css('display','none');
      $('label[for="verification"]').css('display','none');
      $(this).attr('type','submit');
      $('.formInput[name="password"]').addClass('great');
      $('.formInput[name="verification"]').addClass('great');
    }else if($('.formInput[name="password"]').val() == $('.formInput[name="verification"]').val()) {
      // passwords are empty
      $('.formInput[name="password"]').addClass('wrong');
      $('.formInput[name="verification"]').addClass('wrong');
      $('label[for="password"]').css('display','');
      $('label[for="verification"]').css('display','none');
    } else {
      // passwords are differents
      $('.formInput[name="password"]').addClass('wrong');
      $('.formInput[name="verification"]').addClass('wrong');
      $('label[for="verification"]').css('display','');
      $('label[for="password"]').css('display','none');
    }
  });
});
