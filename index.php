<!DOCTYPE html>
<html type="text/html">
  	<head>
    	<title>Slideshow</title>
    	<style type="text/css">
      		* {margin:0;padding:0;position:relative;}
      		html, body {width:100%;height:100%;overflow:hidden;background-color:#000;}
			.container {width:100%;height:100%;}
      		.image {width:100%;height:100%;background-size:contain;background-position:center center;background-repeat:no-repeat;position:absolute;}
     		#a {opacity:1;}
      		#b {opacity:0;}
    	</style>
  	</head>
  	<body>

		<div class="container">
			<div class="image" id="a"></div>
			<div class="image" id="b"></div>
		</div>
    
    	<script src="../slideshow/js/jquery.min.js"></script>
    	<script src="../slideshow/js/jquery.waitforimages.min.js"></script>

        <script type="text/javascript">

            let preload = "b";

			var preloadPictures = function(pictureUrls, callback) {
    var i,
        j,
        loaded = 0;

    for (i = 0, j = pictureUrls.length; i < j; i++) {
        (function (img, src) {
            img.onload = function () {                               
                if (++loaded == pictureUrls.length && callback) {
                    callback();
                }
            };

            // Use the following callback methods to debug
            // in case of an unexpected behavior.
            img.onerror = function () {};
            img.onabort = function () {};

            img.src = src;
        } (new Image(), pictureUrls[i]));
    }
};

			function checkImage(imageSrc, good, bad) {

    			var img = new Image();
    			img.onload = good; 
    			img.onerror = bad;
    			img.src = imageSrc;

			}

			function displayImage(container, path) {

				if (container == "b") {

					$("#b").css("background-image", "url('"+path+"')").waitForImages(function() {
					  	preload = "a";
						preloadPictures([path], function() {
							$("#b").animate({opacity: 1}, 500);
							setTimeout(function() {
                            	$("#a").animate({opacity: 0}, 500);
                        	}, 500);
						});
					});

				}
				
				else {
				
					$("#a").css("background-image", "url('"+path+"')").waitForImages(function() {
					  	preload = "b";
						preloadPictures([path], function() {
							$("#a").animate({opacity: 1}, 500);
                        	setTimeout(function() {
                            	$("#b").animate({opacity: 0}, 500);
                        	}, 500);
						});
						
					});
				
				}
			}

            function setImage() {

        		let path = "https://www.videoevent.be/slides/slide.png?v=" + Date.now();

				checkImage(path, function() {
    				displayImage(preload, path);
  				}, function() {
    				console.log("Image not found, skipping update.");
				});

      		}

            setInterval(setImage, 5000);
            setImage();

        </script>
    </body>
</html>