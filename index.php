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
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" />
        <?php get_template_part('content','background'); ?>
    </head>

    <body>
      <div class="fixed">
        <?php get_template_part('content','nav'); ?>
      </div>

      </div>
        <div id="background">
          <?php echo get_template_part('content','main'); ?>
          <?php echo get_template_part('content','gallery'); ?>
          <?php echo get_template_part('content','products'); ?>
          <?php echo get_template_part('content','webisodes'); ?>
        </div><!-- #background -->

        <!-- Modals -->
        <div id="video-modal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
          <h3 class="video-title">Class Historian</h3>
          <div id="youtube-player"></div>
          <!-- <iframe id="youtube-video" width="100%" height="500px" src="https://www.youtube.com/embed/to-nZLV794g" frameborder="0" allowfullscreen></iframe> -->
          <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>

        <div id="image-modal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
          <div class="image-photos"></div>
          <div class="image-nav">
            <a id="previous-photo" href="#previous-photo" class="button small"><img class="nav-arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/arrow-left.png"></i></a>
            <a id="next-photo" href="#next-photo" class="button small"><img class="nav-arrow" src="<?php echo get_stylesheet_directory_uri(); ?>/images/assets/arrow-right.png"></i></a>
          </div>
          <a class="close-reveal-modal" aria-label="Close">&#215;</a>
        </div>
        <!-- End Modals -->
        <footer>
          <?php wp_footer(); ?>
          <!-- JavaScript -->
          <script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vflpCdzwa/www-widgetapi.js" async=""></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/youtube-frame-api.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-v1.11.3.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/foundation-5.5.3/js/foundation.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/jquery-migrate.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/slick/slick.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/ScrollMagic/minified/plugins/TweenMax.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/ScrollMagic/minified/ScrollMagic.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/ScrollMagic/minified/plugins/debug.addIndicators.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/ScrollMagic/minified/plugins/animation.gsap.min.js"></script>
          <script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/libs/ScrollMagic/minified/plugins/animation.velocity.min.js"></script>
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
                responsive: [
                  {
                    breakpoint: 1024,
                    settings: {
                      slidesToShow: 3,
                      slidesToScroll: 3,
                      infinite: true,
                      dots: true
                    }
                  },
                  {
                    breakpoint: 800,
                    settings: {
                      slidesToShow: 2,
                      slidesToScroll: 2
                    }
                  },
                  {
                    breakpoint: 500,
                    settings: {
                      slidesToShow: 1,
                      slidesToScroll: 1
                    }
                  }
                ]
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
              $(document).on("click",".photo",function() {
                var imagesArray = [],
                  currentImageId,
                  currentImagePhoto,
                  images = $(".photo img");

                images.each(function() {
                  imagesArray.push($(this).attr("src"));
                });

                // Set currentImageId
                currentImageId = $(this).find("img").attr("id").slice(-1);
                console.log(currentImageId);

                // Display current photo
                currentImagePhoto = $(this).find("img").attr("src");
                console.log(currentImagePhoto);
                $(".image-photos").html('<img src="'+currentImagePhoto+'" />');

                // Previous photo in modal
                $(document).on("click","#previous-photo",function(e) {
                  e.preventDefault();
                  currentImageId -= 1;
                  currentImageId %= imagesArray.length;
                  var photoId = currentImageId<=0 ? currentImageId*-1 : currentImageId;
                  // console.log("photo-"+photoId);
                  $(".image-photos").html('<img src="'+imagesArray[photoId]+'" style="width:100%" />');
                });

                // Next Photo in modal
                $(document).on("click","#next-photo",function(e) {
                  e.preventDefault();
                  currentImageId += 1;
                  currentImageId %= imagesArray.length;
                  var photoId = currentImageId<=0 ? currentImageId*-1 : currentImageId;
                  // console.log("photo-"+photoId);
                  $(".image-photos").html('<img src="'+imagesArray[photoId]+'" style="width:100%" />');
                });

                $("#image-modal").foundation("reveal","open");
                // Display the images in the popup. Add navigation.
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
                    for (var i=0;i<12;i++) {
                      try {
                        if (webisodes[i].guid!=null && webisodes[i].thumbnail_image!=null && webisodes[i].post_title!=null) {
                          console.log(webisodes[i].guid, webisodes[i].thumbnail_image,webisodes[i].post_title);
                          html+='<div class="small-6 medium-4 large-3 column">'
                          html+='<a href="'+ webisodes[i].guid +'" class="webisode">';
                          html+='<figure>';
                          html+='<img src="'+ webisodes[i].thumbnail_image +'">';
                          html+='</figure>';
                          html+='<h3 class="webisode-title">'+ webisodes[i].post_title +'</h3>';
                          html+='</a>';
                          html+='</div>'
                        }
                      } catch(error) {
                        if (error) $(".load-webisode-error").html("No more webisodes to load.");
                      }
                    }
                    // console.log(html);
                    $(".row.webisodes-container").append(html);
                  }
                });
              });

              displayNavigation();
            });


            // Display navigation
            function displayNavigation() {
              // $.ajax({
              //   "url": "http://webseries.guitarcenter.dev/webisode/",
              //   data: {"start":0,"pager":1},
              //   dataType: "text/json",
              //   complete: function(xhr) {
              //     var data = JSON.parse(xhr.responseText);
              //     var pager = data.pager;
              //     var html='';
              //     // console.log("ID: " + 9);
              //     // console.log("Episode: " + "0");
              //     // console.log("Artist: " + data.webisodes[0].post_title);
              //     // console.log("Previous: " + pager.previous);
              //     // console.log("Episode: " + data.webisodes[0].episode);
              //     // console.log("Next: " + pager.next);
              //     // console.log(data.webisodes[0]);
              //     html+='<li><a href="http://webseries.guitarcenter.dev/webisode/?start='+ (pager.previous-1) +'&pager=1&redirect=1" class="nav"><img class="nav-arrow" src="http://webseries.guitarcenter.dev/wp-content/themes/webseries/images/assets/arrow-left.png"></a></li>';
              //     html+='<li><a id="episode-title">Episode '+ (data.webisodes[0].episode) +' of '+ pager.last_page +' </a></li>';
              //     html+='<li><a href="http://webseries.guitarcenter.dev/webisode/?start='+ (pager.next-1) +'&pager=1&redirect=1" class="nav"><img class="nav-arrow" src="http://webseries.guitarcenter.dev/wp-content/themes/webseries/images/assets/arrow-right.png"></a></li>';
              //     $(".right").html(html);
              //   }
              // });
            }


            // ScrollMagic Start
            var controller = new ScrollMagic.Controller({triggerHook: "onEnter",});

            // Fade Up Scene for .featured-artist
            var sceneMicLockerBackground = new ScrollMagic.Scene({triggerElement: '#featured-artist'})
              .setTween("#featured-artist", 1, {y:"0",ease:Linear.easeNone},{y:"100%",ease:Linear.easeNone});
            var sceneArtistFade = new ScrollMagic.Scene({
                // triggerElement: '#featured-artist',
                duration: 800,
              })
              // .addIndicators({name: "artistFade duration(200)"})
              .setTween(".featured", 1, {opacity:0,ease:Linear.easeOut})
              .addTo(controller);
            var sceneArtistUp = new ScrollMagic.Scene({
                triggerElement: "#background",
                triggerHook: "onLeave",
                duration: 800,
              })
              .setTween(".featured", 1, {y:"-150%"},{y:"0%",ease:Linear.easeNone});

            // #mic-locker .title-container show
            var tweenMicLockerTitleShow = TweenMax.from(".title-container",1,{top:100,opacity:0});
            var sceneMicLockerTitleShow = new ScrollMagic.Scene({
                triggerElement: "#mic-locker",
                offset: -300
              })
              // .addIndicators({name: "#mic-locker duration(null)"})
              .setTween(tweenMicLockerTitleShow);

            // #mic-locker .products show
            var tweenMicLockerProductsShow = TweenMax.from("#mic-locker .products",1,{opacity:0});
            var sceneMicLockerProductsShow = new ScrollMagic.Scene({
                triggerElement: '#mic-locker .title-container',
                offset: -150
              })
              // .addIndicators({name: "micLockerProductsShow duration(none)"})
              .setTween(tweenMicLockerProductsShow);

            // #mic-locker hide
            var tweenMicLockerHide = TweenMax.to("#mic-locker .products-container",1,{top:-200,opacity:0});
            var sceneMicLockerHide = new ScrollMagic.Scene({
                triggerElement:'#mic-locker',
                triggerHook: "onLeave",
                offset: -100
              })
              // .addIndicators({name: "sceneMicLockerHide duration(none)"})
              .setTween(tweenMicLockerHide);
            var tweenWebisodeShow = TweenMax.to("#previous-webisodes",2,{top:-400})
            var sceneWebisodeShow = new ScrollMagic.Scene({
                triggerElement:"#mic-locker",
                triggerHook: "onLeave",
                offset: -100
              })
              // .addIndicators({name: "sceneWebisodeShow duration(none)"})
              .setTween(tweenWebisodeShow);

            controller.addScene([
              sceneMicLockerBackground,
              sceneArtistFade,
              sceneArtistUp,
              sceneMicLockerBackground,
              sceneMicLockerTitleShow,
              sceneMicLockerProductsShow,
              sceneMicLockerHide,
              sceneWebisodeShow
            ]);

            // Foundation
            $(document).foundation();
          </script>
        </footer>
    </body>
</html>

