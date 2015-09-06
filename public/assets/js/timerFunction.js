

$('document').ready(function() {

  var timerFunction = function (timeMultiplier) {
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
      var now = 1000*60*timeMultiplier - (new Date().getTime() - start);
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
  };

  $('.thirtySec').on('click', function () {timerFunction(.5)});
  $('.oneMin').on('click', function () {timerFunction(1)});
  $('.twoMin').on('click', function () {timerFunction(2)});
  $('.threeMin').on('click', function () {timerFunction(3)});
  $('.fourMin').on('click', function () {timerFunction(4)});
  $('.fiveMin').on('click', function () {timerFunction(5)});

});