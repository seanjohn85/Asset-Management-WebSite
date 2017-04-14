<?php
    //files used by this page
    require_once 'utils/functions.php';
    require_once 'classes/User.php';
    require_once 'classes/DB.php';
    require 'classes/StockTableGateway.php';
    
    //web session started
    start_session();
    
    //connects to db
    $connection = Connection::getInstance();
    //gets all stocks
    $gateway = new StockTableGateway($connection);
    
    
    //gets all stocks from the stocl table using the getStock() method
    $stock = $gateway->getStock();
?>

<!DOCTYPE HTML>
<html>
    <head>
        <!--Meta Tags-->
        <?php require 'utils/meta.php'; ?>
        <title>Mason Assets Homepage</title>
        <!--imports css files-->
        <?php require 'utils/styles.php'; ?>

    </head>
    <!--imports the drawMap() function and sets the scroll bar and offset of scroll-->
    <body onload="drawMap()" data-spy="scroll" data-target=".navbar" data-offset="50"  >
        <div class="row">
            <!--this imports the nav bar-->
            <?php require 'utils/homeTool.php'; ?>
        </div>
        <!--Homepage billboard image row-->
        <div class="row r1">
            <!-- css used to set the  background image-->
            <div class="billboard heroImage">
                <!--used to keep text in the image to be max 1170px-->
                <div class="container bg ">
                    <!--this is some branding text a slogon that sits at the bottom over the main billbroad image--> 
                    <div class="hero-text col-lg-3 col-md-3 col-sm-4 col-xs-7">
                        <h1 class="wow animated fadeInUp"><span>Mason</span> <span>Assets</span></h1>
                        <p class="wow animated fadeInUp">Protect your assets, protect your future</p>
                    </div>
                    <!--this text animates in on fade and contains a link to open a new customer account-->
                    <div class="hero-text link pull-right">
                        <a href="signUpCreateCustomerForm.php" class=" btn border_btn btn-default hov wow animated fadeInUp">Sign Up</a>
                    </div>
                </div>
            </div><!--close billboard heroImage-->
        </div><!-- close Homepage billboard row -->
        
        <!--main body of content-->
        <div class="container">
            <!--2nd row content animates in-->
            <div class="row r2 wow animated zoomInUp">
                <!-- heading section navbar id link lists services offered-->
                <section class="col-lg-12 center-all-content what-we-offer" id="services">
                    <h1>What We Offer</h1>
                    <!--left service block -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!--font logo for this block-->
                        <i class="fa fa-university fa-5x"></i>
                        <!--text under logo-->
                        <h2>Nationwide Branches</h2>
                        <p>
                            We have local branches nationwide with
                            fully trained friendlily staff to cater for every
                            type of client to help maximize potential profit
                            while minimizing the risk.
                        </p>
                    </div><!--close left service block-->
                    
                    <!--center service block -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!--font logo for this block-->
                        <i class="fa fa-line-chart fa-5x"></i>
                        <!--text under logo-->
                        <h2>Online Reports</h2>
                        <p>
                            Your online account contains features such as reports and graphs on both
                            your stocks performance and projected performance equipping
                            you with detailed information to make informed investments.
                        </p>
                    </div><!--close center service block -->
                    
                    <!--right service block -->
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!--font logo for this block-->
                        <i class="fa fa-globe fa-5x"></i>
                        <!--text under logo-->
                        <h2>Global Marketplace</h2>
                        <p>
                            We manage and offer to our clients a portfolio from the leadings
                            global stock markets including but not limited to the London SE
                            and the NYSE, offering some of the most sought after stock globally.
                        </p>
                    </div><!--close right service block -->
                    
                </section><!--close service section -->
                
            </div><!--close r2-->
            
            <!--3rd row-->
            <div class='row r3'>
                <!-- this section has no menu link ourst section-->
                <section class="col-lg-12 center-all-content ourst">
                    <h1>Our Stocks</h1>
                    <!--owl-carousel used to display all our stock the user can swipe 
                    of grab through the different stock types-->
                    <div id="our-stocks" class=" owl-carousel">
                    <!--php to get all stock from the db and put them in an item div
                    this div is targeted by the owl-carousel library-->
                        <?php
                            //feches first row of stock
                            $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                            
                            //loops through all the rows of this table on the database
                            while ($stockRow) 
                            {
                                //sets the colour to green 
                                $colour = "green";
                                //changes to red if the price has dropped
                                if(($stockRow['openPrice']-$stockRow['currentPrice'])>0)
                                {
                                    $colour ="red";
                                }
                                //opens the div
                                echo'<div class="item">';
                                //displays the logo of this stock
                                echo'<img src="image/logos/'.$stockRow['image'].'" class="backup_picture img-responsive">';
                                //displays the name of this stock
                                echo '<h3><b>Stock Name: </b><span>'.$stockRow['stockName'].'</span></h3>';
                                //diplays stock code
                                echo '<p><b>Stock Code: </b>'.$stockRow['stockCode'].'</p>';
                                //displays open price
                                echo '<p><b>Open price: </b> &dollar;'.$stockRow['openPrice'].'</p>';
                                //displays current price
                                echo '<p><b>Current Price: </b> <span class="'.$colour.'">&dollar;'.$stockRow['currentPrice'].'</span></p>';
                                //closes the div
                                echo '</div>';
                            
                                //ends the statement to stop an infinate loop on this row
                                $stockRow = $stock->fetch(PDO::FETCH_ASSOC);
                            }//close while
                        ?>
                    
                    </div><!--close owl-carousel-->
                    <!--instructions for owl-carousel-->
                    <!--image on the right of text-->
                    <div class="col-md-3 col-sm-3 col-xs-3 right-img">
                        <img class="img-responsive img-circle" src="image/grab.png" alt="grap">
                    </div>
                    <!--centered text-->
                    <div class="col-md-6 col-sm-6 col-xs-6 center-all-content">
                        <h2>Grab or Scroll through our Stocks</h2>
                    </div>
                    <!--image on the left of text-->
                    <div class="col-md-3   col-sm-3 col-xs-3 left-img">
                        <img class="img-responsive img-circle" src="image/touch.png" alt="touch">
                    </div>
                    
                </section><!--close ourst section-->
            </div><!--close r3-->
        </div><!--close container-->
        
        <!--container-fluid logOn used to create fullscreen dark bg-->
        <div class="container-fluid logOn">
            <!--max width for content 1197px-->
            <div class =" container ">
                <!--fourth row of content-->
                <div class="row r4">
                    <!--image of the map of the world-->
                    <section class="col-lg-12 col-sm-12 col-md-12 col-xs-12 world">
                        <img class="img-responsive" src="image/map.png" alt="Founder">
                        <!--text positioned over the map-->
                        <h1 class="wow animated fadeInUp">Enter the Global Stock Market</h1>
                    </section><!--close world section -->
                </div><!--close r4-->
            </div><!--close container-->
        </div> <!--close container-fluid-->
        
        <!--container-fluid gray used to create fullscreen gray bg-->
        <div class="container-fluid gray">
            <!-- new row content animated in (one time only)-->
            <div class="row r5 wow animated zoomInUp ">
                <!--max width for content 1197px-->
                <div class="container">
                    <!--this is the device section id targeted by navbar-->
                    <section class="col-lg-12 center-all-content device" id="device">
                        <h1>Multi Platform</h1>
                    </section>
                    <!--centered sample image of the site on different devices-->
                    <section class="col-lg-12 center-all-content " >
                        <img class="center-block img-responsive" src="image/preview.png" alt="Sample devices">
                    </section>
                    <!--text below image-->
                    <section class="col-lg-12 center-all-content device">
                        <h2>Asset the stock market and your portfolio anyplace, anywhere, any device</h2>
                    </section>
                </div><!--close container-->
            </div><!--close r5-->
        </div><!--close container-fluid gray-->
        
       <!--max width for content 1197px-->
        <div class="container">
            <!-- new row content animated in (one time only)-->
            <div class="row r6 wow animate zoomInUp">
                <!--this is the client tesimonials section-->
                <div class="col-lg-12  tesimonials">
                    <!--heading-->
                    <h1 class="center-all-content">What Our Clients Say</h1>
                    <!--left quote-->
                    <section class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!--quote contained in speech bubble-->
                        <blockquote class="quote">
                            Over the last five years my investment has gone from 
                            strength to strength and I am enjoying the benefits thanks
                            to the knowledge and experience of Mason Assets.
                        </blockquote>
                        <!--quote attr under the speech bubble-->
                        <blockquote> Vince McMahon </blockquote>
                        <img class="img-rounded img-responsive clients" src="image/clients/vince.png" alt="Vince McMahon">
                    </section><!--close left quote-->
                    <!--middle quote-->
                    <section class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!--quote contained in speech bubble-->
                        <blockquote class="quote">
                            The excellent customer service is second to none. The 
                            personal trustworthily staff at my branch always make  
                            me feel assured my investment is in safe hands.
                        </blockquote>
                        <!--quote attr under the speech bubble-->
                        <blockquote> Phil Mitchell  </blockquote>
                        <img class="img-rounded img-responsive clients" src="image/clients/phil.png" alt="Phil Mitchell">
                    </section><!--close middle quote-->
                    <!--right quote-->
                    <section class = "col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <!--quote contained in speech bubble-->
                        <blockquote class="quote">
                            I was really unsure of gambling on the stock market
                            before I joined Mason Assets. The
                            advise they provided allowed me to make educated informed investments.
                        </blockquote>
                        <!--quote attr under the speech bubble-->
                        <blockquote> Rihanna  </blockquote>
                        <img class="img-rounded img-responsive clients" src="image/clients/rih.png" alt="Rihanna">
                    </section><!--close right quote-->
                    <!--bottome tag line-->
                    <h2 class="center-all-content">Real People, Real Opinions</h2>
                </div><!--close testimonials-->
            </div><!--close r6-->
        </div><!--close container-->
       
       <!--container-fluid logOn used to create fullscreen dark bg-->
        <div class="container-fluid logOn">
            <!--max width for content 1197px-->
            <div class =" container ">
                <!--new row of content-->
                <div class="row r7">
                    <!--fade in section header id used by navbar to link-->
                    <section class="col-lg-12 center-all-content branch wow animated fadeInUp" id="branches">
                        <h1>Your nearest Branch</h1>
                    </section>
                    <!--styled google map api used here-->
                    <section id="my-map" class="col-lg-12 center-all-content map" >
                    </section>
                    <!--branch name-->
                    <section class="col-lg-12 center-all-content branch wow animated fadeInUp">
                        <h2>Dun Laoghaire</h2>
                    </section>
                </div><!--close r7-->
            </div><!--close container-->
        </div><!--close container-fluid logOn-->
        
        <!--max width for content 1197px navbar link id used here-->
        <div id="about" class="container">
            <!--new row of content-->
            <div class="row r8 story">
                <!--about us section-->
                <section  class="col-lg-12 about-us">
                    <!--section headding-->
                    <h1 class="story wow animated fadeInUp">Our Story</h1>
                    <!--this list contains a timeline styled story of the company
                    with images and text to left or right of the image-->
                    <ul class="about">
                        <!--start of timeline-->
                        <li>
                            <div class="about-image">
                                <img class="img-circle img-responsive" src="image/ourstory/founder.png" alt="Founder">
                            </div>
                            <!--Text to left-->
                            <div class="about-panel">
                                <h4>January 1994</h4>
                                <h4 class="subheading">Our Founder</h4>
                                <p class="text-muted">
                                    Our company started with a simple idea from our 
                                    founder Dr. Mason, to deliver the global stock 
                                    market to the Ireland. Our first 5 branches 
                                    where opened later this year allowing our clients 
                                    to trade on the Irish on London stock exchange markets.
                                </p>
                            </div>
                        </li>
                        <!--second timeline event-->
                        <li class="about-inverted">
                            <!--timeline image-->
                            <div class="about-image">
                                <img class="img-circle img-responsive" src="image/ourstory/office.png" alt="head office">
                            </div>
                            <!--Text to right-->
                            <div class="about-panel">
                                <h4>March 1995</h4>
                                <h4 class="subheading">Head Office Opens</h4>
                                <p class="text-muted">
                                    Due to the growing number of branches 
                                    (with an expansion to role our nationwide) 
                                    our head office opened its doors to provide 
                                    support for our ever expanding cliental.
                                </p>
                            </div>
                        </li>
                        <!--third timeline event-->
                        <li>
                            <!--timeline image-->
                            <div class="about-image">
                                <img class="img-circle img-responsive" src="image/ourstory/nyse.png" alt="nyse">
                            </div>
                            <!--Text to left-->
                            <div class="about-panel">
                                <h4>December 1997</h4>
                                <h4 class="subheading">Transition to Global Market</h4>
                                <p class="text-muted">Now approaching 4 years in business with at least a branch 
                                    in every county of Ireland we decided to introduce new markets such as the  
                                    New York stock exchange. 
                                </p>
                            </div>
                        </li>
                        <!--fourth timeline event-->
                        <li class="about-inverted">
                            <!--timeline image-->
                            <div class="about-image">
                                <img class="img-circle img-responsive" src="image/ourstory/tumb.png" alt="customer service tumbs up">
                            </div>
                            <!--Text to right-->
                            <div class="about-panel">
                                <h4>2000 - 2008</h4>
                                <h4 class="subheading">A New Millennium</h4>
                                <p class="text-muted">
                                    Starting the new millennium during the 
                                    Celtic Tiger years we focused on delivering 
                                    our award winning customer service to our many 
                                    satisfied clients across the country, helping 
                                    them achieve large financial gains.  
                                </p>
                            </div>
                        </li>
                        <!--fifth timeline event-->
                        <li>
                            <!--timeline image-->
                            <div class="about-image">
                                <img class="img-circle img-responsive" src="image/ourstory/awards.png" alt="award">
                            </div>
                            <!--Text to left-->
                            <div class="about-panel">
                                <h4>2008 - 2016</h4>
                                <h4 class="subheading">Financial Awards</h4>
                                <p class="text-muted">
                                    2008 marked for the first time since we went into 
                                    business a Global recession. During this difficult 
                                    period we helped support of clients and provided them 
                                    with sound financial advise. Ensuring you make good business 
                                    decisions is our business. Over the last 8 years we have won 
                                    numerous financial awards.  
                                </p>
                            </div>
                        </li>
                        <!--final list item on time line text in the image div instead of an image-->
                        <li class="about-inverted">
                            <div class="about-image">
                                <h4><span>Contact</span> <span> us</span> <span>today</span> 
                                    <span>to</span> <span> start </span> <span> a new</span>
                                    <span> journey</span> <span> together!</span>
                                </h4>
                            </div><!--close about-image-->
                        </li>
                    </ul><!--close list about-->
                </section><!--close column-->
            </div> <!--close row r8 story-->
        </div> <!--close container-->
        
        <!--container-fluid gray used to create fullscreen gray bg-->
        <div class="container-fluid gray">
            <!--max width for content 1197px-->
            <div class =" container ">
                <!--new row of content-->
                <div class="row r9">
                    <!-- nav bar link id, all conetent centered-->
                    <section id="directors" class="col-lg-12 col-sm-12 col-md-12 col-xs-12 center-all-content directors">
                        <!--section heading-->
                        <h1 class="wow animated fadeInUp directors">Meet Our Directors</h1>
                    </section>
                    <!--left section-->
                    <section class="col-lg-4 col-sm-4 col-md-4 col-xs-12 center-all-content directors">
                        <img class="img-circle img-responsive" src="image/directors/nic.png" alt="Nicolas Cage">
                        <h2>CEO</h2>
                        <h3>Nicolas Cage</h3>
                        <p>Nicolas has been our CEO the last 5 years and has was a former director to Bank Of America. His international
                            financial experience has helped expand of presence on the Global market and plans to expand or operations internationally are the heart of Nicolas plans. Nicolas
                            has an exciting 5 year plan for our business.
                        </p>
                    </section><!--close left section-->
                    
                    <!--center section-->
                    <section class="col-lg-4 col-sm-4 col-md-4 col-xs-12 center-all-content directors">
                        <img class="img-circle img-responsive" src="image/directors/denny.png" alt="denny">
                        <h2>CFO</h2>
                        <h3>Denzel Washington</h3>
                        <p>Denzel has been a director with the company since establishment and he is entirely focused on educating our customers to make smart financial decisions.
                            Customer focus is one of Denzel's prime passions so it is imperative to Denzil that our staff forge a relationship with our clients built on trust that your investment is in our safe hands.
                        </p>
                    </section><!--close center section-->
                    
                    <!--right section-->
                    <section class="col-lg-4 col-sm-4 col-md-4 col-xs-12 center-all-content directors">
                        <img class="img-circle img-responsive" src="image/directors/thewolf.png" alt="denny">
                        <h2>Managing Director</h2>
                        <h3>Jordan Belfort</h3>
                        <p>Jordan is our newest, youngest director. He is highly sought after in this industry and we feel all our clients and staff can gain from his experience. Since Jordan's arrival and his new policies 
                            we are delighted that 95% of our clients investments over the last 6 months have turned a profit leaving no doubt that he is the true Wolf of Wall Street.
                        </p>
                    </section><!--close right section-->
                    
                    <!--final tageline full width on all screens-->
                    <section class="col-lg-12 col-sm-12 col-md-12 col-xs-12 center-all-content directors">
                        <h4 class="wow animated fadeInUp directors">
                        Protect your assets, Protect your future</h1>
                    </section>
                </div><!--close r9-->
            </div><!--clsoe container-->
        </div><!--close container-fluid gray-->
        
        <!--adds footer-->
        <?php require 'utils/footer.php'; ?>  
        <!--adds js files-->
        <?php require 'utils/scripts.php'; ?>
        <!--js required to generate the map-->
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcmkMGym9MDnbRKDvE8SBD7ZtyOJWcSPo&sensor=false"></script>
        <script type="text/javascript" src="scripts/map.js"></script>
    </body>
</html>