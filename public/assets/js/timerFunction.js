
$('document').ready(function() {
  $('.thirtySec').on('click', function () {
    $(this).addClass('hidden');
    $(this).after('<button class="btn" id="thirtySecOutput"></button>');
    
    $('#thirtySecOutput').on('click', function () {
      clearInterval(interval);
      $('.thirtySec').removeClass('hidden');
      $('#thirtySecOutput').remove();
    });
    
    var start = new Date().getTime();
    var interval = setInterval( function() {
        var now = 1000*30 - (new Date().getTime() - start);
        if( now > 0 ) 
        {
          document.getElementById('thirtySecOutput').innerHTML = Math.floor(now / 1000);
        }
        else
        {
          clearInterval(interval);
          $('.thirtySec').removeClass('hidden');
          $('#thirtySecOutput').remove();
        }
      }, 100); 
  });

  $('.oneMin').on('click', function () {
    $(this).addClass('hidden');
    $(this).after('<button class="btn" id="oneMinOutput"></button>');
    
    $('#oneMinOutput').on('click', function () {
      clearInterval(interval);
      $('.oneMin').removeClass('hidden');
      $('#oneMinOutput').remove();
    });
    
    var start = new Date().getTime();
    var interval = setInterval( function() {
        var now = 1000*60 - (new Date().getTime() - start);
        if( now > 0 ) 
        {
          document.getElementById('oneMinOutput').innerHTML = Math.floor(now / 1000);
        }
        else
        {
          clearInterval(interval);
          $('.oneMin').removeClass('hidden');
          $('#oneMinOutput').remove();
        }
      }, 100); 
  });

  $('.twoMin').on('click', function () {
    $(this).addClass('hidden');
    $(this).after('<button class="btn" id="twoMinOutput"></button>');
    
    $('#twoMinOutput').on('click', function () {
      clearInterval(interval);
      $('.twoMin').removeClass('hidden');
      $('#twoMinOutput').remove();
    });
    
    var start = new Date().getTime();
    var interval = setInterval( function() {
        var now = 1000*60*2 - (new Date().getTime() - start);
        if( now > 0 ) 
        {
          document.getElementById('twoMinOutput').innerHTML = Math.floor(now / 1000);
        }
        else
        {
          clearInterval(interval);
          $('.twoMin').removeClass('hidden');
          $('#twoMinOutput').remove();
        }
      }, 100); 
  });
});