<?php
session_start();
$_SESSION = array();
include("../captcha/simple-php-captcha.php");
$_SESSION['safe'] = simple_php_captcha();
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Dev Abhi" />

    <!-- Stylesheets
    ============================================= -->
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css" />
    <link rel="stylesheet" href="../style.css" type="text/css" />
    <link rel="stylesheet" href="../css/dark.css" type="text/css" />
    <link rel="stylesheet" href="../css/font-icons.css" type="text/css" />
    <link rel="stylesheet" href="../css/animate.css" type="text/css" />
    <link rel="stylesheet" href="../css/magnific-popup.css" type="text/css" />

    <link rel="stylesheet" href="../css/responsive.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <!--[if lt IE 9]>
    	<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

    <!-- External JavaScripts
    ============================================= -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<script type="text/javascript" src="../js/plugins.js"></script>

    <!-- Document Title
    ============================================= -->
	<title>Escrow Script | PHP Escrow System</title>

</head>

<body class="stretched">

    <!-- Document Wrapper
    ============================================= -->
    <div id="wrapper" class="clearfix">

        <!-- Content
        ============================================= -->
        <section id="content">

            <div class="content-wrap">

                <div class="container clearfix">

                    <div id="section-home" class="heading-block title-center nobottomborder page-section">
                        <h1>Introduction of Escrow Script (PHP)</h1>
                        <span>Adding escrow system to your website was never so <span class="color">Easy</span></span>
                    </div>

                    <div class="center bottommargin">
                        <a target="_blank" href="http://customphpscript.com/php-escrow-payment-system/" class="button button-3d button-teal button-xlarge nobottommargin"><i class="icon-star3"></i>Check the demo</a> - OR - <a href="http://customphpscript.com/"  class="button button-3d button-red button-xlarge nobottommargin"><i class="icon-shopping-cart"></i>Escrow Shop</a>
                    </div>

                    <div class="clear"></div>

                    <div class="col_two_third topmargin nobottommargin">
                        <img src="../images/escrow-script.png">
                       <!--  <img data-animate="fadeInLeft" src="images/landing/device1.png" alt="Mac" style="position: absolute; opacity: 0; width: 100%; top: 0; left: 0;">
                        <img data-animate="fadeInRight" data-delay="300" src="images/landing/device2.png" alt="iPad" style="position: absolute; opacity: 0; width: 100%; top: 0; left: 0;">
                        <img data-animate="fadeInUp" data-delay="600" src="images/landing/device3.png" alt="iPhone" style="position: absolute; opacity: 0; width: 100%; top: 0; left: 0;"> -->

                    </div>

                    <div class="col_one_third topmargin nobottommargin col_last">

                        <h3>Short Overview.</h3>

                        <p>Today we see a rise in development of B2B websites and most of the B2B websites need escrow system. But a good and reliable escrow script is missing in the market. We have developed this escrow script so that any one can easily integrate a escrow system in your website. You can even use this script as a boilerplate to build a complete escrow website like <a target="_blank" href="http://escrow.com/">www.escrow.com</a>  .</p>

                        <div class="divider divider-short"><i class="icon-circle"></i></div>

                        <ul class="iconlist iconlist-large iconlist-color">
                            <li><i class="icon-ok-sign"></i> It Uses Express Checkout And PARALLEL PAYMENTS API</li>
                            <li><i class="icon-ok-sign"></i> Senders and receivers can have any PayPal account type</li>
                            <li><i class="icon-ok-sign"></i> Uses simple PHP &amp; 100% Customizable</li>
                            <li><i class="icon-ok-sign"></i> You can set the currency for transactions (EUR, USD,CAD)</li>
                            <li><i class="icon-ok-sign"></i> Responsive &amp; Retina Devices Support</li>
                            <li><i class="icon-ok-sign"></i> Easy Embeddable in any Website</li>
                            <li><i class="icon-ok-sign"></i> <strong>FREE</strong> Support</li>
                        </ul>

                    </div>


                    <div class="clear"></div>

                     <div class="divider divider-short divider-center"><i class="icon-circle"></i></div>

                    <div id="section-faqs" class="heading-block title-center page-section">
                        <h2>Frequently Asked Questions</h2>
                        <span>We have answered some common Questions for your Convenience</span>
                    </div>

                    <div class="col_half nobottommargin">

                        <h4 id="faq-1"><strong>Q.</strong>Why should I buy this script?</h4>
                        <p>There are some other selleres selling escrow script in the market, but it's not as robust as our escrow script. Users complain they have lots of bugs and support provided by developer is very poor. We provide you with robust escrow script which is supported by our team very actively.</p>

                        <div class="line"></div>

                        <h4 id="faq-2"><strong>Q.</strong> Why you want to increase price of this script in future?</h4>
                        <p>We plan to keep adding features to our escrow script. So, to cover the cost of our labour, we need to increase the price. But the best part is that buyers will get all updates free of cost. So you dont have to pay anything extra to get fetaures we will add in future</p>

                    </div>

                    <div class="col_half nobottommargin col_last">

                        <h4 id="faq-7"><strong>Q.</strong>What are your future plans with Escrow script?</h4>
                        <p>We have plans to add many features to current script and we will keep adding features. With addition of features price will also increase, but, buyers will get all updates free of cost in future. So, sooner you buy lesser you have to pay.</p>

                        <div class="line"></div>

                        <h4 id="faq-8"><strong>Q.</strong> I have bought your escrow script and facing some issues, what shall i do?</h4>
                        <p>Functionality of script depends on many factors. It might be that some server related factors are not allowing to work properly or due to not installing script correctly its not working properly. In such situation all you have to do is report issue to our forum and one of our support ninjas will soon get back to you. We have decide to provide very active support to our escrow script.</p>



                    </div>

                    <div class="clear"></div>

                    <div class="divider divider-short divider-center"><i class="icon-circle"></i></div>



                    <div id="section-contact" class="heading-block title-center page-section">
                        <h2>Get in Touch with me</h2>
                        <span>Still have Questions? Contact Me</span>
                    </div>

                    <!-- Contact Form
                    ============================================= -->
                    <div class="col_half">

                        <div class="fancy-title title-dotted-border">
                            <h3>Send me an Email</h3>
                        </div>

                        <div id="contact-form-result" data-notify-type="success" data-notify-msg="<i class=icon-ok-sign></i> Message Sent Successfully!"></div>

                        <form class="nobottommargin" id="template-contactform" name="template-contactform" action="../include/sendemail.php" method="post">

                            <div class="form-process"></div>

                            <div class="col_one_third">
                                <label for="template-contactform-name">Name <small>*</small></label>
                                <input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control required" />
                            </div>

                            <div class="col_one_third">
                                <label for="template-contactform-email">Email <small>*</small></label>
                                <input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control" />
                            </div>

                            <div class="col_one_third col_last">
                                <label for="template-contactform-phone">Phone</label>
                                <input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="sm-form-control" />
                            </div>

                            <div class="clear"></div>

                            <div class="col_full">
                                <label for="template-contactform-message">Message <small>*</small></label>
                                <textarea class="required sm-form-control" id="template-contactform-message" name="template-contactform-message" rows="6" cols="30"></textarea>
                            </div>

                           <div class="col_half">
                                <label for="template-contactform-name">Captcha <small>*</small></label>
                                <input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value=""
                                class="sm-form-control required" />
                            </div>

                            <div class="col_half col_last">
                           <?php

                                if(isset($_SESSION['sessionarray'])){
                                    $sessionarray = $_SESSION['sessionarray'];
                                    array_push($sessionarray, $_SESSION['safe']['code']);
                                    $_SESSION['sessionarray'] = $sessionarray;

                                }else{

                                     $_SESSION['sessionarray'] = array($_SESSION['safe']['code']);
                                }

                                echo '<img alt="if you dont see image refresh the page" src="' . $_SESSION['safe']['image_src'] . '" alt="CAPTCHA code">';
                            ?>
                            </div>


                            <div class="col_full hidden">
                                <input type="hidden" name="template-contactform-url" value="<?php echo  $_SERVER['REQUEST_URI']; ?>">
                            </div>

                            <div class="col_full">
                                <button class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Send Message</button>
                            </div>

                        </form>

                        <script type="text/javascript">

                            $("#template-contactform").validate({
                                submitHandler: function(form) {
                                    $('.form-process').fadeIn();
                                    $(form).ajaxSubmit({
                                        target: '#contact-form-result',
                                        success: function() {
                                            $('.form-process').fadeOut();
                                            $('#template-contactform').find('.sm-form-control').val('');
                                            $('#contact-form-result').attr('data-notify-msg', $('#contact-form-result').html()).html('');
                                            SEMICOLON.widget.notifications($('#contact-form-result'));
                                        }
                                    });
                                }
                            });

                        </script>

                    </div><!-- Contact Form End -->

                    <!-- Google Map
                    ============================================= -->
                    <div class="col_half col_last"><!--  -->
                    <div style = "text-align:center">
                     <!--   <div id="pph-hireme"></div>
                        <script type="text/javascript">
                        (function(d, s) {
                            var useSSL = 'https:' == document.location.protocol;
                            var js, where = d.getElementsByTagName(s)[0],
                            js = d.createElement(s);
                            js.src = (useSSL ? 'https:' : 'http:') +  '//www.peopleperhour.com/hire/108792231/337263.js?width=300&height=315&orientation=vertical&theme=dark&hourlies=20426%2C70934&rnd='+parseInt(Math.random()*10000, 10);
                            try { where.parentNode.insertBefore(js, where); } catch (e) { if (typeof console !== 'undefined' && console.log && e.stack) { console.log(e.stack); } }
                        }(document, 'script'));
                        </script>-->
                    </div>

                    </div><!-- Google Map End -->






                </div>



            </div>

        </section><!-- #content end -->

        <!-- Footer
        ============================================= -->
        <footer id="footer" class="dark">

            <div class="container">

                <!-- Footer Widgets
                ============================================= -->
                <div class="footer-widgets-wrap clearfix">





                </div><!-- .footer-widgets-wrap end -->

            </div>



        </footer><!-- #footer end -->

    </div><!-- #wrapper end -->

    <!-- Go To Top
    ============================================= -->
    <div id="gotoTop" class="icon-angle-up"></div>

    <!-- Footer Scripts
    ============================================= -->
    <script type="text/javascript" src="../js/functions.js"></script>

    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56315991-1', 'auto');
  ga('send', 'pageview');

</script>

</body>
</html>
