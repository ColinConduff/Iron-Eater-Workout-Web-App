
$('document').ready(function() {
  $('.thirtySec').on('click', function () {
    $('#timeBtn').addClass('hidden');
    $('#timeBtn').after('<a class="btn btn-success btn-block" id="timeOutput"></a>');
    $('#timerModal').modal('toggle');

    $('#timeOutput').on('click', function () {
      clearInterval(interval);
      $('#timeBtn').removeClass('hidden');
      $('#timeOutput').remove();
    });
    
    var start = new Date().getTime();
    var interval = setInterval( function() {
        var now = 1000*30 - (new Date().getTime() - start);
        if( now > 0 ) 
        {
          document.getElementById('timeOutput').innerHTML = Math.floor(now / 1000);
        }
        else
        {
          clearInterval(interval);
          $('#timeBtn').removeClass('hidden');
          $('#timeOutput').remove();
        }
      }, 100); 
  });

  $('.oneMin').on('click', function () {
    $('#timeBtn').addClass('hidden');
    $('#timeBtn').after('<button class="btn btn-success btn-block" id="timeOutput"></button>');
    $('#timerModal').modal('toggle');

    $('#timeOutput').on('click', function () {
      clearInterval(interval);
      $('#timeBtn').removeClass('hidden');
      $('#timeOutput').remove();
    });
    
    var start = new Date().getTime();
    var interval = setInterval( function() {
        var now = 1000*60 - (new Date().getTime() - start);
        if( now > 0 ) 
        {
          document.getElementById('timeOutput').innerHTML = Math.floor(now / 1000);
        }
        else
        {
          clearInterval(interval);
          $('#timeBtn').removeClass('hidden');
          $('#timeOutput').remove();
        }
      }, 100); 
  });

  $('.twoMin').on('click', function () {
    $('#timeBtn').addClass('hidden');
    $('#timeBtn').after('<button class="btn btn-success btn-block" id="timeOutput"></button>');
    $('#timerModal').modal('toggle');

    $('#timeOutput').on('click', function () {
      clearInterval(interval);
      $('#timeBtn').removeClass('hidden');
      $('#timeOutput').remove();
    });
    
    var start = new Date().getTime();
    var interval = setInterval( function() {
        var now = 1000*60*2 - (new Date().getTime() - start);
        if( now > 0 ) 
        {
          document.getElementById('timeOutput').innerHTML = Math.floor(now / 1000);
        }
        else
        {
          clearInterval(interval);
          $('#timeBtn').removeClass('hidden');
          $('#timeOutput').remove();
        }
      }, 100); 
  });
});