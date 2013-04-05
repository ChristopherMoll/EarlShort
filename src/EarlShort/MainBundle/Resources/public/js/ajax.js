$(document).ready(function() {
  $('form').submit(function(event) {
      event.preventDefault();

      var data = $('form').serialize(),
           url = $('form').attr( 'action' );

      /* Send the data using post */
      var posting = $.post( url, data);

      posting.done(function(response) {
         $('#shortened-response').html(response);
      });
  })
});