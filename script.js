(function($) {

  'use strict';

  var dcPrefix = 'https://www.documentcloud.org/documents/',
      stPrefix = 'http://projects.statesman.com/documents/?doc=';

  var validUrl = function(url) {
    return url.indexOf(dcPrefix) === 0;
  };

  var dcUrlError = function() {
    $('#dc-error').show();
    $('dc-url').parent().addClass('has-error');
    $('#st-url').val(null);
  };

  $(function() {

    // Respond to chnages in URL input
    $('#dc-url').on('input', function(e) {

      var $el = $(this),
          dcUrl = $el.val();

      $('#info').hide();
      $('#dc-error').hide();

      // Set an error class if the URL is invalid
      if(validUrl(dcUrl) || dcUrl.length === 0) {
        $el.parent().removeClass('has-error');
        if(dcUrl.length === 0) {
          $('#st-url').val(null);
          return;
        }
      }
      else {
        $('#st-url').val(null);
        return $el.parent().addClass('has-error');
      }

      // Parse using js-url
      var id = url('filename', dcUrl),
          hash = url('#', dcUrl);

      // Build the new URL
      var stUrl = stPrefix + id;
      if(hash.length !== 0) {
        stUrl += ('#' + hash);
      }

      // Render the new URL
      $('#st-url').val(stUrl);

      // Get document info
      $.ajax({
        url: 'https://www.documentcloud.org/documents/' + id + '.json',
        crossDomain: true,
        dataType: 'json',
        success: function(data) {
          if(id !== data.id) {
            return dcUrlError();
          }
          var imgUrl = data.resources.page.image
            .replace('{page}', '1')
            .replace('{size}', 'small');
          $('#info .media-object').attr('src', imgUrl);
          $('#title').text(data.title);
          $('#annotations').text(data.annotations.length);
          $('#pages').text(data.pages);
          $('#info').show();
        },
        error: dcUrlError
      });

    });

  });

}(jQuery));
