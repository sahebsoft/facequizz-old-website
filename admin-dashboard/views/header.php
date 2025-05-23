<html lang="en" ng-app="myApp" class="rtl">
    <head>
        <title>Quiz App</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 

        <link rel="stylesheet" href="/app/assets/css/bootstrap.css"/>
        <link rel="stylesheet" href="/app/assets/css/font-awesome.css"/>
        <link rel="stylesheet" href="/app/assets/css/app.css"/>
        <link rel="stylesheet" href="/app/assets/css/app-rtl.css"/>
        
        <script src="/app/assets/js/jquery.js"></script>
        <script src="/app/assets/js/angular.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-route.js"></script>
        
        <style>


        </style>
    </head>
    <body>
        <header>
        <nav class="navbar bg-inverse nav-bar-full navbar-fixed-top box-shadow">
            <div id="mobile_nav" class="hidden-md-up">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2" aria-controls="exCollapsingNavbar2" aria-expanded="false" aria-label="Toggle navigation">
                    &#9776;
                </button>
            </div>
            <div class="collapse navbar-toggleable-sm" id="exCollapsingNavbar2">


                <ul class="nav navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?=URL;?>">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <? if(Session::get('user_type') =='a') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL.'user';?>">User</a>
                    </li>
                    <? } ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL.'user/logout';?>">Logout</a>
                    </li>
                    <ul class="nav navbar-nav pull-xs-right">
                    <li class="nav-item ">
                        <span class="nav-link"><?=Session::get('title');?></span>
                    </li>
                    </ul>
                </ul>
            </div>
        </nav>
        </header>
        <div class="container-fluid">


