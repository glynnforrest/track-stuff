$(function () {
  var app = window.app = {};

  $('.tracker-input').keydown(function(e) {
    if (e.keyCode === 13) {
      var text = $(this).val();
      if (text.trim() === '') {
        return;
      }
      $(this).val('');
      $('.tracker-entries').append('<p>'+text+'</p>');
    }
  });

});
