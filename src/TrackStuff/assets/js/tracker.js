$(function () {
  var app = window.app = {};

  $('.tracker-input').keydown(function(e) {
    if (e.keyCode === 13) {
      var text = $(this).val();
      if (text.trim() === '') {
        return;
      }
      $.ajax({
        url: $(this).data('action'),
        type: 'post',
        data: {
          text: text
        },
        success: function (data) {
          for (var i=0; i < data.logs.length; i++) {
            $('.tracker-entries').append('<p>'+data.logs[i]+'</p>');
          }
          $(this).val('');
          $('.tracker-messages').html(data.message);
        },
        error: function (data) {
          $(this).addClass('error');
          $('.tracker-messages').html(data.responseJSON.message);
        }
      });

    }
  });

});
