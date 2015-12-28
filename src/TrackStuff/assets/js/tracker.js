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
    var iconBox = $('.postfix');
    iconBox.parent().hide();
    $('.tracker-error').hide();

    //keyup
    if (e.keyCode === 38) {
      previousDay();
    }

    //keydown
    if (e.keyCode === 40) {
      nextDay();
    }

    if (e.keyCode === 13) {
      $('.tracker-input').attr('disabled', true);
      iconBox.children('.fa').hide();

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
          iconBox
            .addClass('success')
            .removeClass('error')
            .children('.fa')
            .removeClass('fa-times')
            .addClass('fa-check')
            .show();
          that.val('');
        },
        error: function (data) {
          iconBox
            .addClass('error')
            .removeClass('success')
            .children('.fa')
            .removeClass('fa-check')
            .addClass('fa-times')
            .show();
          $('.tracker-error').html(data.responseJSON.message).show();
        },
        complete: function() {
          $('.tracker-input').attr('disabled', false);
          iconBox.parent().show();
          that.focus();
        }
      });

    }
  });

});
