$(document).ready(function() {

  $('#get-data').on('click', function() {

    $('.loader-container').show();

    $.ajax({
      url: 'https://dsb99.app/rumble/api/v1/channel/tateconfidential/videos',
      method: 'GET',
      success: function(response) {

        $('.loader-container').hide();

        const main = $('main');
        const section = $('<section>');
        const ul = $('<ul>'); 
        
        const videos = response.data.videos;
        console.log(videos);

        videos.forEach(video => {

          const html = video.html;

          ul.append(html);

        });

        section.append(ul);
        main.append(section);

      },
      error: function(xhr, status, error) {
        // Handle the error
        $('.loader-container').hide();
        console.log('Error:', error);
      }
    });

  });
});