<?php
require_once('../lib/database.php');
require_once('../lib/initializePublic.php');
$thisPage = 'One bridge';

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
} else { // form loaded
    if (!isset($_GET['id'])) {
        redirect_to('homepage.php');
    }
    $id = $_GET['id'];
    $bridge = find_bridge_by_id($id);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title><?php echo $bridge['bridgeName'] ?></title>
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="mainStyle.css">
    <script type="text/javascript">
        function hide_float_right() {
            var content = document.getElementById('float_content_right');
            var hide = document.getElementById('hide_float_right');
            if (content.style.display == "none")
            {content.style.display = "block"; hide.innerHTML = '<a href="javascript:hide_float_right()">Tắt Quảng Cáo [X]</a>'; }
                else { content.style.display = "none"; hide.innerHTML = '<a href="javascript:hide_float_right()">Xem Quảng Cáo</a>';
            }
            }
        
        function hide_float_left() {
            var content1 = document.getElementById('float_content_left');
            var hide1 = document.getElementById('hide_float_left');
            if (content1.style.display == "none")
            {content1.style.display = "block"; hide1.innerHTML = '<a href="javascript:hide_float_left()">Tắt Quảng Cáo [X]</a>'; }
                else { content1.style.display = "none"; hide1.innerHTML = '<a href="javascript:hide_float_left()">Xem Quảng Cáo</a>';
            }
            }           
    </script>
        <style>
        .float-ck { position: fixed; bottom: 0px; z-index: 9000}
        * html .float-ck {position:absolute;bottom:auto;top:expression(eval (document.documentElement.scrollTop+document.docum entElement.clientHeight-this.offsetHeight-(parseInt(this.currentStyle.marginTop,10)||0)-(parseInt(this.currentStyle.marginBottom,10)||0))) ;}
        #float_content_right {border: 1px solid #01AEF0;}
        #hide_float_right {text-align:right; font-size: 11px;}
        #hide_float_right a {background: #01AEF0; padding: 2px 4px; color: #FFF;}

        #float_content_left {border: 1px solid #01AEF0;}
        #hide_float_left {text-align:left; font-size: 11px;}
        #hide_float_left a {background: #01AEF0; padding: 2px 4px; color: #FFF;}
        </style>

    <!-- <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script> -->
</head>

<body>
    <?php include('nav.php'); ?>
    <div class="container content">
        <div class="row">
            <div class="col-md-6">
                <div id="bridgeImages" class="carousel slide" data-ride="carousel" data-interval="false">
                    <ol class="carousel-indicators">
                        <?php echo make_slide_indicators($bridge['bridgeID']);
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $image_set = get_images_by_bridgeID($bridge['bridgeID']);
                        $count = 0;
                        while ($image = mysqli_fetch_assoc($image_set)) :
                        ?>
                            <div class="carousel-item<?php echo $count == 0 ? ' active' : '' ?>">
                                <div class="embed-responsive embed-responsive-1by1">
                                    <div class="imageWrapper embed-responsive-item">
                                        <img src="<?php echo $image['link'] ?>" alt="">
                                    </div>
                                </div>
                            </div>
                        <?php
                            $count++;
                        endwhile;
                        ?>
                    </div>
                    <a class="carousel-control-prev" href="#bridgeImages" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#bridgeImages" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-md-5 offset-md-1">
                <div class="bridge-title mb-5 d-flex justify-content-between">
                    <h1><?php echo $bridge['bridgeName'] ?></h1>
                    <a class="btn align-self-center" href="download.php?id=<?php echo $bridge['bridgeID'] ?>">Download as PDF</a>
                </div>
                <div class="bridge-information">
                    <div class="accordion" id="accordionBridge">
                        <hr>
                        <div class="bridge-details header" id="headingOne">
                            <div>
                                <h4 class="btn mb-0 font-weight-bold d-flex justify-content-between" data-toggle="collapse" data-target="#collapseOne">General information <i class="fa fa-long-arrow-right"></i></h4>
                            </div>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionBridge">
                            <ul>
                                <li><?php echo $bridge['country'] ?></li>
                                <li><?php echo $bridge['year'] ?></li>
                                <li>Length: <?php echo $bridge['length'] ?> metres</li>
                                <?php echo !empty($bridge['height']) ? '<li>Height: ' . $bridge['height'] . ' metres</li>' : ''  ?>
                                <?php echo !empty($bridge['altitude']) ? '<li>Altitude: ' . $bridge['altitude'] . ' metres</li>' : ''  ?>
                                <?php echo !empty($bridge['width']) ? '<li>Width: ' . $bridge['width'] . ' metres</li>' : ''  ?>
                                <?php
                                ?>
                            </ul>
                        </div>
                        <hr>
                        <div class="bridge-description header" id="headingTwo">
                            <h4 class="btn mb-0 font-weight-bold d-flex justify-content-between" data-toggle="collapse" data-target="#collapseTwo">Description <i class="fa fa-long-arrow-right"></i></h4>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionBridge">
                            <p><?php echo $bridge['description'] ?></p>
                        </div>
                        <hr>
                        <div class="bridge-location header" id="headingThree">
                            <h4 class="btn mb-0 font-weight-bold d-flex justify-content-between" data-toggle="collapse" data-target="#collapseThree">See on map <i class="fa fa-long-arrow-right"></i></h4>
                        </div>
                        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionBridge">
                            <iframe src="<?php echo $bridge['location'] ?>" width="400px" height="300px" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        <hr>
                        <!-- <div class="bridge-ad header" id="headingFour">
                            <h4 class="btn mb-0 font-weight-bold d-flex justify-content-between" data-toggle="collapse" data-target="#collapseFour">Plan a visit <i class="fa fa-long-arrow-right"></i></h4>
                        </div> -->
                        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionBridge">
                        </div>
                    </div>

                </div>

                <!-- <div style="height: 480px" id="mapContainer">
                    <script>
                        // Initialize the platform object:
                        var platform = new H.service.Platform({
                            'apikey': 'BRP_MaqMG-jCMJjRxkuAfLuN1XQkcqLGyb7grLrDm8A'
                        });

                        // Obtain the default map types from the platform object
                        var maptypes = platform.createDefaultLayers();

                        // Instantiate (and display) a map object:
                        var map = new H.Map(
                            document.getElementById('mapContainer'),
                            maptypes.vector.normal.map, {
                                zoom: 10,
                                center: {
                                    lng: 8.3575,
                                    lat: 46.694199999999995
                                }
                            });

                        // Define a variable holding SVG mark-up that defines an icon image:
                        var svgMarkup = '<svg width="24" height="24" ' +
                            'xmlns="http://www.w3.org/2000/svg">' +
                            '<rect stroke="white" fill="#1b468d" x="1" y="1" width="22" ' +
                            'height="22" /><text x="12" y="18" font-size="12pt" ' +
                            'font-family="Arial" font-weight="bold" text-anchor="middle" ' +
                            'fill="white">H</text></svg>';

                        // Create an icon, an object holding the latitude and longitude, and a marker:
                        var icon = new H.map.Icon(svgMarkup),
                            coords = {
                                lat: 46.694199999999995,
                                lng: 8.3575
                            },
                            marker = new H.map.Marker(coords, {
                                icon: icon
                            });

                        // Add the marker to the map and center the map at the location of the marker:
                        map.addObject(marker);
                        map.setCenter(coords);
                    </script>
                </div> -->

            </div>

        </div>



        <div >   
            <img class="img-fluid" src="https://pbs.twimg.com/media/C1m1uwXWQAANjvt.jpg"></img>
        </div>
         
                            
        <div class="relatedBridges mt-5 text-center">
            <h3>Keep exploring</h3>
            <div class="row">
                <div class="col">
                    <div id="relatedBridgeCarousel" class="carousel fdi-Carousel slide" data-ride="carousel" data-interval="50000">
                        <div class="carousel-inner row no-gutters">
                            <?php
                            $bridge_set = get_related_bridges($bridge['bridgeID']);
                            $count = 0;
                            while ($bridge = mysqli_fetch_assoc($bridge_set)) :
                                $profilePic = get_profile_picture_of_bridge($bridge['bridgeID'])
                            ?>

                                <div class="carousel-item<?php echo $count == 0 ? ' active' : '' ?>" style="height: auto;">
                                    <div class="d-block col-3 text-center">
                                        <a class="text-decoration-none" href="eachBridge.php?id=<?php echo $bridge['bridgeID'] ?>">
                                            <div class="embed-responsive embed-responsive-1by1">
                                                <div class="imageWrapper embed-responsive-item">
                                                    <img src="<?php echo $profilePic['link'] ?>" class="img-responsive lazy">
                                                </div>
                                            </div>
                                            <h5 class="mt-3"><?php echo $bridge['bridgeName'] ?></h5>
                                        </a>
                                    </div>
                                </div>
                            <?php $count++;
                            endwhile ?>
                        </div>
                        <a class="carousel-control-prev" href="#relatedBridgeCarousel" role="button" data-slide="prev">
                            <span class="fa fa-angle-double-left" style="font-size:48px;" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#relatedBridgeCarousel" role="button" data-slide="next">
                            <span class="fa fa-angle-double-right" style="font-size:48px;" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="float-ck" style="left: 0px" >
            <div id="hide_float_left">
            <a href="javascript:hide_float_left()">Tắt Quảng Cáo [X]</a></div>
        <div id="float_content_left"> 
            <a href="https://www.makemytrip.com/bus-tickets/" target="_blank"><img src="https://www.advertgallery.com/wp-content/uploads/2019/03/make-my-trip-upto-rs-21000-off-per-person-on-international-flights-ad-times-of-india-mumbai-26-02-2019-250x400.png" title="Bus" /></a> 
        </div>
            </div>
    </div>

    <div class="container">
        <div class="float-ck" style="right: 0px" >
        <div id="hide_float_right">
        <a href="javascript:hide_float_right()">Tắt Quảng Cáo [X]</a></div>
        <div id="float_content_right">
        <a href="https://www.makemytrip.com/flights/" target="_blank"><img src="https://www.advertgallery.com/wp-content/uploads/2019/02/make-my-trip-this-summer-head-to-europe-upto-rs-60000-off-ad-bombay-times-12-02-2019-250x391.png" title="Filght" /></a>
         
        </div>
        </div>
    </div>


    <?php include('footer.php') ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="script.js"></script>

    <script>
        $(document).ready(function() {
            $(".collapse.show").each(function() {
                $(this).prev(".header").find(".fa").addClass("fa-arrow-down").removeClass("fa-long-arrow-right");
            });

            $(".collapse").on('show.bs.collapse', function() {
                $(this).prev(".header").find(".fa").removeClass("fa-long-arrow-right").addClass("fa-arrow-down");
            }).on('hide.bs.collapse', function() {
                $(this).prev(".header").find(".fa").removeClass("fa-arrow-down").addClass("fa-long-arrow-right");
            });
        });

        $(document).ready(function() {
            $('.fdi-Carousel .carousel-item').each(function() {
                var next = $(this).next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));

                for (var i = 0; i < 2; i++) {
                    next = next.next();
                    if (!next.length) {
                        next = $(this).siblings(':first');
                    }

                    next.children(':first-child').clone().appendTo($(this));
                }
            });
        });
    </script>
</body>

</html>


<?php
db_disconnect($db);
?>