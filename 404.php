<!DOCTYPE HTML>
<html>
    <head>
        <title>Podcast</title>
        <?php wp_head(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/libs/foundation-5.5.3/css/foundation.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/libs/foundation-5.5.3/foundation-icons/foundation-icons.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/libs/slick/slick.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/libs/slick/slick-theme.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/libs/slick/slick-theme.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" />
        <?php get_template_part('content','background'); ?>
    </head>
    <body>
        <div class="fixed">
            <?php get_template_part('content','nav'); ?>
        </div>

        <div class="container" style="background-image:url(/wp-content/themes/webseries/images/assets/mic-locker-bg.jpg);">
            <div id="container-404" class="row">
                <div class="small-12 large-2 column">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/logo.jpg" />
                </div>
                <div class="small-12 large-10 column">
                    <h1 class="h1-404">404 Error</h1>
                    <p>Can't find the page. You can either go back to the <a href="/">main page.</a> or choose from one of the Previous Webisodes below.</p>
                </div>
            </div>
        </div>

        <?php echo get_template_part('content','webisodes'); ?>

        <footer>
          <?php wp_footer(); ?>
          <script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflpCdzwa/www-widgetapi.js" async=""></script>
          <script src="https://www.youtube.com/iframe_api"></script>
          <!-- Skrollr -->
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-v1.11.3.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/foundation-5.5.3/js/foundation.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-migrate.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/slick/slick.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/imagesloaded.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/enquire.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/skrollr/skrollr.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/_main.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/youtube-frame-api.js"></script>
          <script type="text/javascript">
            // Inserts an async script, then http://www.youtube.com/iframe_api
            // var tag = document.createElement('script');
            // tag.src = "https://www.youtube.com/iframe_api";
            // var firstScriptTag = document.getElementsByTagName('script')[0];
            // firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

            $(document).ready(function() {
              // Product Slider
              $(".products").slick({
                infinite: true,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay:false,
                dots: false,
              });

              // Youtube Videos
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

              // Video
              $(document).on("click",".video-main,.video-sub",function() {
                $("#video-modal").foundation("reveal","open");
                onYouTubeIframeAPIReady(videoContainer,videoId);
              });

              $(document).on("click","#video-modal .close-reveal-modal",function() {
                $("#video-modal").foundation("reveal","close");
                stopVideo();
              });

              // Photo
              $(document).on("click",".photo-link",function() {
                var imageTitle = $(this).data("photo-title");
                var image = $(this).data("photo");
                var photo = "<img class='photo' src='"+image+"' />";
                $(".image-title").html(imageTitle);
                $(".image-photo").html(photo);
              });

              // More Webisodes
              var url = "http://" + window.location.host + "/webisode/";
              $(document).on("click",".more-webisodes",function() {
                var webisodesCount = $(".webisode").length;

                $.ajax({
                  "url": url,
                  data: {"start":webisodesCount},
                  dataType: "text/json",
                  complete: function(xhr) {
                    var data = JSON.parse(xhr.responseText);
                    // console.log(data.webisodes);
                    var webisodes = data.webisodes;
                    var html="";
                    // html = "something";
                    // console.log(webisodes.length);
                    for (var i=0;i<webisodes.length;i++) {
                      if (webisodes[i].guid!=null && webisodes[i].thumbnail_image!=null && webisodes[i].post_title!=null) {
                        // console.log(webisodes[i].guid, webisodes[i].thumbnail_image,webisodes[i].post_title);
                        html+='<li class="webisode">';
                        html+='<a href="'+ webisodes[i].guid +'">';
                        html+='<div class="webisode-image" style="background-image:url('+ webisodes[i].thumbnail_image +');" data-image-src="'+ webisodes[i].thumbnail_image +'"></div>';
                        html+='<h3>'+ webisodes[i].post_title +'</h3>';
                        html+='</a>';
                        html+='</li>';
                      }
                    }
                    // console.log(html);
                    $("#previous-webisodes .inline-list").append(html);
                  }
                });
              });

            });


            // Foundation
            $(document).foundation();

            // Skrollr
            var s = skrollr.init({
              forceHeight:true,
            });

          </script>
        </footer>
    </body>
</html>
