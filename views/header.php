<!DOCTYPE html> 
<html  dir="rtl" lang="ar">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta charset='utf-8'/>
        <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
        
        <title><?= (isset($this->title)) ? $this->title : 'Facebook Quizzes اختبارات الفيسبوك'; ?></title>
        <? if (isset($this->description)) { ?><meta name="description" content="<?= $this->description; ?>" /><? } ?>
        
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css" /> 
        <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />                         
        
        <link rel="shortcut icon" href="http://www.facequizz.com/favicon.ico" />
        <link rel="canonical" href="<?= $this->url; ?>" /> 
        <link rel="image_src" href="<?= $this->image; ?>" />
        <meta property="og:url" content="<?= $this->url; ?>" />
        <meta property="og:title" content="<?= $this->og_title; ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:image" content="<?= $this->image; ?>" />

        <meta property="og:description" content="<?= $this->og_description; ?>" />
        <meta property="fb:app_id" content="843135262439999"/>
        <meta property="fb:admins" content="100000625470045" />

        <meta name="twitter:domain" content="www.facequizz.com"/>
        <meta name="twitter:card" content="summary_large_image"/>
        <meta name="twitter:site" content="@facequizz"/>
        <meta name="twitter:creator" content="@facequizz"/>
        <meta name="twitter:title" content="<?= $this->og_title; ?>"/>
        <meta name="twitter:description" content="<?= $this->og_description; ?>"/>
        <meta name="twitter:image:src" content="<?= $this->image; ?>"/>
        <meta name="twitter:url" content="<?= $this->url; ?>"/>    

        <script type='text/javascript' src='http://ajax.aspnetcdn.com/ajax/jquery/jquery-1.8.3.min.js'></script>
        <script src="http://www.facequizz.com/public/js/angular.min.js" type="text/javascript"></script>
        <script src="http://www.facequizz.com/public/js/custom.js" type="text/javascript"></script>
        <script src="http://www.facequizz.com/public/js/bootstrap.min.js" type="text/javascript"></script>
        <? if (isset($this->robots)) { ?><meta name="robots" content="<?= $this->robots; ?>" /><? } ?>
        <? if (isset($this->canonical)) { ?><link rel="canonical" href="<?= $this->canonical; ?>"/><? } ?>  

        <meta name="google-site-verification" content="3taVyzT6B8pBfySbsSQ7b8X4A6-KDUBk9WiS202mFFI" />
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-59246258-5', 'auto');
            ga('send', 'pageview');

        </script>
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1&appId=1579115725667717"></script>
        <style type="text/css">
            @import url(http://fonts.googleapis.com/earlyaccess/droidarabickufi.css);
            body {
                background: #FFF url(/public/images/bg.png);
                background-color: #999;
                padding-top: 12px;
                padding-bottom: 40px;
                font-family: 'Droid Arabic Kufi', sans-serif;
            }
            a:hover {
                text-decoration: none;
            }
            img{
                max-width: 100%;
            }
            * {
                font-family: 'Droid Arabic Kufi', sans-serif !important;line-height: 30px; 
            }
            nav,.navbar{min-height: 70px;padding: 0.5rem;opacity: 0.9;box-shadow: 0px 10px 5px 1px rgba(0,0,0,.3);}
            .navbar-toggler{padding: 1rem;color:#fff;}
            .navbar-brand{float:none;}
            .modal {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                z-index: 1040;
                display: none;
                overflow: hidden;
                -webkit-overflow-scrolling: touch;
                outline: 0;
                background-color:rgba(0,0,0,0.95);
            }
            .modal-dialog{
                vertical-align: middle;
                display: table-cell;
            }
            .modal-content{
                width: 350px;
                max-width: 100%;
                background-color: white;
                text-align: left;
                padding: 20px 10px;
                border-radius:5px;-webkit-border-radius: 5px;-moz-border-radius: 5px;
                margin: 0 auto;

            }
            .modal-table{
                display: table;
                height: 100%;
                width: 100%;
            }
            .modal-body,.modal-header{
                text-align: center;
            }
            .modal-body{
                height: 230px;
            }
            .modal-footer{
                text-align: center;
                color: crimson;
                text-decoration: underline;
            }
            #content {
                background-color: #fafbfc;
                margin-top: 5rem;
            }
            .table td,.table th{vertical-align: middle;text-align: right;padding: 0.25rem .75rem;}
            nav a{
                color: #fafafa!important;
            }

            .navbar-nav .nav-item+.nav-item{
                padding: 0.5rem;
                margin-right: 1rem;
            }
            .navbar-nav .nav-item {
                float: right;
            }
            
            .more-quiz{
                border-bottom: solid 1px #d5d5d5;margin-bottom: 0.5rem;padding-bottom: 0.5rem;
            }
            #answers {max-width:730px;text-align:right;margin-top: 0.5rem;}
            #answers table {border : 4px dashed;}
            #answers .radio {margin: 4px 5px 2px 5px;height: 20px;width: 22px;}
            #answers table label {display:block;font-size:16px;cursor: pointer;padding: 0.25rem;}
            #answers table td {
                    border-bottom:1px solid #9E9E9E;
            }
            .card {
                box-shadow: 1px 0 10px 1px rgba(0,0,0,.3);
                border-radius: 0px;
            }
            .btn {
                box-shadow: 0 2px 5px 0 rgba(0,0,0,.26);
                border-radius: 3px;
            }            
        </style>

        <script>
            window.fbAsyncInit = function () {
                FB.init({
                    appId: '843135262439999',
                    xfbml: true,
                    version: 'v2.5'
                });
            };

            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {
                    return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({
                google_ad_client: "ca-pub-6154079892224305",
                enable_page_level_ads: true
            });
        </script>
        <script>var app = angular.module('quizApp',[]);</script>
    </head>
    <body dir="rtl" onLoad="">  
        
                <nav class="navbar bg-primary nav-bar-full navbar-fixed-top box-shadow">
            <div id="mobile_nav" class="hidden-md-up">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation">
                    &#9776;
                </button>
            </div>
            <div class="collapse navbar-toggleable-sm" id="exCollapsingNavbar2">


                <ul class="nav navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link navbar-brand" id="banner_link" href="<?= DOMAIN; ?><?= $this->ref; ?>" title="Top Quizzes Online">Face Quizz اختبارات الفيسبوك</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link" href="/">اختبارات شخصية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= 'http://www.facequizz.com/?id=284' . $this->ref; ?>">اختبار قوة الملاحظة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://www.facequizz.com/?id=372<?= $this->ref; ?>">اختبار قواعد اللغة العربية</a>
                    </li>

                </ul>
            </div>
        </nav>       
        <div id="content">