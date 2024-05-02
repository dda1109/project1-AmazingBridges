<footer class="page-footer font-small text-light pt-4 mt-5">
    <div class="container-fluid text-center text-md-left">
        <div class="text-center center-block">
            <a href="https://www.facebook.com/groups/BetheBridge/"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
            <a href="https://twitter.com/hashtag/bridges"><i id="social-tw" class="fa fa-twitter-square fa-3x social"></i></a>
            <a href="https://plus.google.com/Bridges"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
            <a href="mailto:theamazingbridge@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
        </div>
        <br><br>
        <div class="row ml-5 pl-5">
            <div class="col-md-4 mt-md-0 mt-3">
                <h5 class="text-uppercase">Amazing Bridges</h5>
                <ul class="list-unstyled">
                    <li>31 Le Thanh Nghi, Hai Ba Trung, Hanoi</li>
                    <li>Monday - Friday: 11AM - 5PM</li>
                    <li>+44 (0) 20 7494 2035</li>
                    <li>theamazingbridge@gmail.com</li>
                </ul>
            </div>
            <hr class="clearfix w-100 d-md-none pb-3">
            <div class="col-md-4 mb-md-0 mb-3">
                <h5>ABOUT US</h5>
                <ul class="list-unstyled">
                    <li><a href="about.php">Amazing Bridges</a></li>
                </ul>
            </div>
            <div class="col-md-4 mb-md-0 mb-3">
                <h5>TOP CATEGORIES</h5>
                <ul class="list-unstyled">
                    <?php
                    $category_set = find_all_categories();
                    while ($category = mysqli_fetch_assoc($category_set)) :
                    ?>
                        <li class="list-unstyled"><a href="category.php?id=<?php echo $category['categoryID'] ?>"><?php echo $category['categoryName'] ?></a></li>
                    <?php
                    endwhile;
                    mysqli_free_result($category_set); ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright text-center py-3">© 2020
        <a href="Homedemo.php">AMAZING BRIDGES</a>
    </div>
</footer>