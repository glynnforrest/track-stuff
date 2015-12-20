$(function () {
  $('.tracker-date').fdatepicker({
    format: 'yyyy/m/d'
  });

  function previousDay() {
    var datepicker = $('.tracker-date');
    var date = new Date(datepicker.val());
    date.setDate(date.getDate() - 1);
    datepicker.fdatepicker('update', date);
  }

  function nextDay() {
    var datepicker = $('.tracker-date');
    var date = new Date(datepicker.val());
    date.setDate(date.getDate() + 1);
    datepicker.fdatepicker('update', date);
  }

  $('.tracker-input').keydown(function(e) {
    //keyup
    if (e.keyCode === 38) {
      previousDay();
    }

    //keydown
    if (e.keyCode === 40) {
      nextDay();
    }

    if (e.keyCode === 13) {
      var text = $(this).val();
      if (text.trim() === '') {
        return;
      }
      var that = $(this);
      $.ajax({
        url: $(this).data('action'),
        type: 'post',
        data: {
          text: text,
          date: $('.tracker-date').val()
        },
        success: function (data) {
          for (var i=0; i < data.logs.length; i++) {
            $('.tracker-entries').append('<p>'+data.logs[i]+'</p>');
          }
          that.val('');
          $('.tracker-messages').html(data.message);
        },
        error: function (data) {
          that.addClass('error');
          $('.tracker-messages').html(data.responseJSON.message);
        }
      });

    }
  });

});
