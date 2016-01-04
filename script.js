            // Inserts an async script, then http://www.youtube.com/iframe_api
            // var tag = document.createElement('script');
            // tag.src = "https://www.youtube.com/iframe_api";
            // var firstScriptTag = document.getElementsByTagName('script')[0];
            // firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            $(document).ready(function() {
              $(".products").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay:false,
                dots: false,
              });


              var videoContainer = 'youtube-player';
              var videoId = "";
              var player;
              function onYouTubeIframeAPIReady(videoContainer,videoId) {
                player = new YT.Player(videoContainer, {
                  height: '500',
                  width: '100%',
                  videoId: videoId,
                  events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                  }
                });
              }

              function onPlayerReady() {
                player.playVideo();
              }

              var done = false;
              function onPlayerStateChange() {
                if (event.data == YT.PlayerState.PLAYING && !done) {
                  setTimeout(stopVideo, 6000);
                  done = true;
                }
              }
              
              function stopVideo() {
                player.stopVideo();
                player.destroy();
              }

              // Set videoId
              $(".video-main,.video-sub").click(function() {
                videoId = $(this).data("video");
              });

              $(".photo-link").on("click",function() {
                var imageTitle = $(this).data("photo-title");
                var image = $(this).data("photo");
                var photo = "<img class='photo' src='"+image+"' />";
                $(".image-title").html(imageTitle);
                $(".image-photo").html(photo);
              });

              $(document).foundation();

              $(document).on('open.fndtn.reveal','[data-reveal]',function(e) {
                var videoModal = $("#video-modal")[0];
                if(e.target==videoModal) {
                  onYouTubeIframeAPIReady(videoContainer,videoId);
                }
              });

              $(document).on('close.fndtn.reveal','[data-reveal]',function(e) {
                // console.log($(this));
                // For video modal only.
                var videoModal = $("#video-modal")[0];
                if (e.target==videoModal) {
                  stopVideo();
                }
              });
            });