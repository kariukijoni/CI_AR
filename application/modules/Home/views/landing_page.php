<!DOCTYPE html>
<html lang="en" class="wide wow-animation">
    <head>
        <title><?php echo $page_title; ?></title>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="description" content="ABS">
        <meta name="author" content=ABS"">
        <link rel="icon" href="<?php echo base_url() . 'public/home/images/favicon.ico'; ?>" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'public/home/css/css.css'; ?>?family=Montserrat:400,700%7CLato:300,300italic,400,400italic,700,900%7CPlayfair+Display:700italic,900">
        <link rel="stylesheet" href="<?php echo base_url() . 'public/home/css/style.css'; ?>">

        <link rel="stylesheet" href="<?php echo base_url() . 'public/home/bootstrap/dist/css/bootstrap.css'; ?>">
        <link rel="stylesheet" href="<?php echo base_url() . 'public/home/css/custom.css'; ?>">

    </head>
    <body style="">
        <div class="page">
            <header class="page-head">
                <div class="rd-navbar-wrap">
                    <nav data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-stick-up-clone="false" data-md-stick-up-offset="53px" data-lg-stick-up-offset="53px" data-md-stick="true" data-lg-stick-up="true" class="rd-navbar rd-navbar-corporate-light">
                        <div class="rd-navbar">
                            <div class="rd-navbar-aside-wrap" id="top_nav">
                                <div class="rd-navbar-aside">
                                    <div data-rd-navbar-toggle=".rd-navbar-aside" class="rd-navbar-aside-toggle"><span></span></div>
                                    <div class="rd-navbar-aside-content">

                                        <div class="rd-navbar-aside-group">
                                            <ul class="list-inline list-inline-reset">
                                                <li><a href="#" class="icon icon-circle icon-silver-chalice-filled icon-xxs-smallest fa fa-twitter"></a></li>
                                                <li><a href="#" class="icon icon-circle icon-silver-chalice-filled icon-xxs-smallest fa fa-skype"></a></li>
                                                <li><a href="#" class="icon icon-circle icon-silver-chalice-filled icon-xxs-smallest fa fa-linkedin"></a></li>
                                                <li><a href="#" class="icon icon-circle icon-silver-chalice-filled icon-xxs-smallest fa fa-youtube"></a></li>
                                                <li><a href="#" class="icon icon-circle icon-silver-chalice-filled icon-xxs-smallest fa fa-facebook"></a></li>
                                                <li><a href="#" class="icon icon-circle icon-silver-chalice-filled icon-xxs-smallest fa fa-map-marker"></a><span>ABS Permit Application System</span></li>
                                            </ul>
                                        </div>
                                        <ul class="rd-navbar-aside-group list-units">
                                            <li>
                                                <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                                    <div class="unit-left"><span class="icon icon-xxs icon-primary material-icons-phone"></span></div>
                                                    <div class="unit-body"><a href="callto:#" class="link-secondary">+1242*******</a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                                    <div class="unit-left"><span class="icon icon-xxs icon-primary fa-envelope-o"></span></div>
                                                    <div class="unit-body"><a href="/cdn-cgi/l/email-protection#ab88" class="link-secondary"><span class="__cf_email__" data-cfemail="81e8efe7eec1e5e4eceeede8efeaafeef3e6">info@abs.co.ke</span></a></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                                    <div class="unit-body">
                                                        <a href="<?php echo base_url() . 'manager/login'; ?>" class="btn btn-sm btn-primary btn-circle fa fa-user"> login </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <p>Or</p>
                                            </li>
                                            <li>
                                                <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                                    <div class="unit-body">
                                                        <a href="<?php echo base_url() . 'manager/register_account'; ?>" class="btn btn-sm btn-primary btn-circle fa fa-user-md"> Sign up </a></div> 
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="rd-navbar-inner rd-navbar-group">
                                <div class="rd-navbar-panel">
                                    <button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
                                    <a href="#" class="rd-navbar-brand brand"><img src="<?php echo base_url() . 'public/home/images/flag_logo.jpg'; ?>" width="200" height="22" alt="logo"/></a> 
                                </div>
                                <div class="rd-navbar-nav-wrap">
                                    <div class="rd-navbar-nav-inner">
                                        <ul class="rd-navbar-nav">
                                            <li><a href="#">Home</a> </li>
                                            <li><a href="#">ABS Information</a>
                                                <ul class="rd-navbar-dropdown">
                                                    <li><a href="#">Biological Resources</a> </li>
                                                    <li><a href="#">Application process</a> </li>
                                                    <li><a href="#">Required Documents</a> </li>
                                                    <li><a href="#">Lead Agencies and Mandate</a> </li>
                                                    <li><a href="#">Documents to be Uploaded</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">Contact us</a>
                                                <ul class="rd-navbar-dropdown">
                                                    <li><a href="#">Bahamas Environmental Science an Technology (Best) Commission</a> </li>
                                                    <li><a href="#">Dept. of Marine Resources (DMR)</a> </li>
                                                    <li><a href="#">Bahamas National Trust (DNT)</a> </li>
                                                    <li><a href="#">Department of Agriculture (DOA)</a> </li>
                                                </ul>
                                            </li>
                                            <li><a href="#"></a>
                                                <div class="rd-navbar-search">
                                                    <form action="search-results.html" method="GET" data-search-live="rd-search-results-live" data-search-live-count="6" class="rd-search">
                                                        <div class="rd-search-inner">
                                                            <div class="form-group">
                                                                <label for="rd-search-form-input" class="form-label">Search...</label>
                                                                <input id="rd-search-form-input" type="text" name="s" autocomplete="off" class="form-control">
                                                            </div>
                                                            <button type="submit" class="rd-search-submit"></button>
                                                        </div>
                                                        <div id="rd-search-results-live" class="rd-search-results-live"></div>
                                                    </form>
                                                    <button data-rd-navbar-toggle=".rd-navbar-search, .rd-navbar-search-wrap" class="rd-navbar-search-toggle"></button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </nav>
                </div>
            </header>
            <main class="page-content">
                <section>
                    <div data-loop="false" data-autoplay="" data-simulate-touch="true" class="swiper-container swiper-slider swiper-variant-1">
                        <div class="swiper-wrapper text-center">
                            <div data-slide-bg="<?php echo base_url() . 'public/home/images/banner1.jpg'; ?>" class="swiper-slide">
                                <div class="swiper-slide-caption">
                                    <div class="shell">
                                        <div class="range range-sm-center">
                                            <div class="cell-sm-11 cell-md-10 cell-lg-9">
                                                <div class="panel panel-default panel-transparent">
                                                    <h2 data-caption-animate="fadeInUp" data-caption-delay="0s" class="slider-header">ABS</h2>
                                                    <p data-caption-animate="fadeInUp" data-caption-delay="100" class="text-bigger slider-text">Permit Application System</p>
                                                    <div class="row">
                                                        <div class="col-sm-offset-8 col-sm-4">
                                                            <div class="group-xl-responsive offset-top-30 offset-sm-top-45"><a data-caption-animate="fadeInUp" data-caption-delay="250" href="#" class="btn btn-xl btn-primary-contrast">Read more...</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-slide-bg="<?php echo base_url() . 'public/home/images/banner2.jpg'; ?>" class="swiper-slide">
                                <div class="swiper-slide-caption">
                                    <div class="shell">
                                        <div class="range range-sm-center">
                                            <div class="cell-sm-11 cell-md-10 cell-lg-9">
                                                <div class="panel panel-default panel-transparent">
                                                    <h2 data-caption-animate="fadeInUp" data-caption-delay="0s" class="slider-header">Apply Online</h2>
                                                    <hr/>
                                                    <p data-caption-animate="fadeInUp" data-caption-delay="100" class="text-bigger slider-text">
                                                        ABS IT Permit Applivation System
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-offset-8 col-sm-4">
                                                            <div class="group-xl-responsive offset-top-30 offset-sm-top-45"><a data-caption-animate="fadeInUp" data-caption-delay="250" href="#" class="btn btn-xl btn-primary-contrast">Read more...</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-slide-bg="<?php echo base_url() . 'public/home/images/banner3.jpg'; ?>" class="swiper-slide">
                                <div class="swiper-slide-caption">
                                    <div class="shell">
                                        <div class="range range-sm-center">
                                            <div class="cell-sm-11 cell-md-10 cell-lg-9">
                                                <div class="panel panel-default panel-transparent">
                                                    <h2 data-caption-animate="fadeInUp" data-caption-delay="0s" class="slider-header">Responsive</h2>
                                                    <p data-caption-animate="fadeInUp" data-caption-delay="100" class="text-bigger slider-text">
                                                    ABS IT Application System
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-offset-8 col-sm-4">
                                                            <div class="group-xl-responsive offset-top-30 offset-sm-top-45"><a data-caption-animate="fadeInUp" data-caption-delay="250" href="#" class="btn btn-xl btn-primary-contrast">Read more...</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div data-slide-bg="<?php echo base_url() . 'public/home/images/banner4.jpg'; ?>" class="swiper-slide">
                                <div class="swiper-slide-caption">
                                    <div class="shell">
                                        <div class="range range-sm-center">
                                            <div class="cell-sm-11 cell-md-10 cell-lg-9">
                                                <div class="panel panel-default panel-transparent">
                                                    <h2 data-caption-animate="fadeInUp" data-caption-delay="0s" class="slider-header">ABS</h2>
                                                    <p data-caption-animate="fadeInUp" data-caption-delay="100" class="text-bigger slider-text">
                                                        ABS Research Permit Application System
                                                    </p>
                                                    <div class="row">
                                                        <div class="col-sm-offset-8 col-sm-4">
                                                            <div class="group-xl-responsive offset-top-30 offset-sm-top-45"><a data-caption-animate="fadeInUp" data-caption-delay="250" href="#" class="btn btn-xl btn-primary-contrast">Read more...</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-scrollbar"></div>
                        <div class="swiper-nav-wrap">
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </section>
                <div class="divider-spectrum"></div>

            </main>
            <footer class="page-foot section-15" id="footer">
                <div class="shell text-center">
                    <div class="range">
                        <div class="cell-sm-12">
                            <p class="rights text-white"><span>Copyright &#169; 2017-<?php echo date('Y'); ?> ABS All Rights Reserved</span></p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <div id="form-output-global" class="snackbars"></div>
        <div tabindex="-1" role="dialog" aria-hidden="true" class="pswp">
            <div class="pswp__bg"></div>
            <div class="pswp__scroll-wrap">
                <div class="pswp__container">
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                    <div class="pswp__item"></div>
                </div>
                <div class="pswp__ui pswp__ui--hidden">
                    <div class="pswp__top-bar">
                        <div class="pswp__counter"></div>
                        <button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
                        <button title="Share" class="pswp__button pswp__button--share"></button>
                        <button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
                        <button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
                        <div class="pswp__preloader">
                            <div class="pswp__preloader__icn">
                                <div class="pswp__preloader__cut">
                                    <div class="pswp__preloader__donut"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                        <div class="pswp__share-tooltip"></div>
                    </div>
                    <button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
                    <button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__cent"></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="<?php echo base_url() . 'public/home/js/core.min.js'; ?>"></script> 
        <script src="<?php echo base_url() . 'public/home/js/script.js'; ?>"></script>
    </body>
</html>