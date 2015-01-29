<?php

require_once("common.php");

printHead("Home", array("/css/index.css"), array("/js/index.js"));
printNav();

?>
<div class="container">

  <div class="row">
    <div class="col-sm-12">
      <div class="alert alert-info" role="alert" id="home_placeholder">
        <strong>Welcome!</strong> We're working hard to build the new site. While we're still early in development, some things may not work quite right, so please pardon our dust!
      </div>
      <!-- <div class="jumbotron" id="home_placeholder">
        <h1>Welcome to the beta!</h1>
        <p>We are working hard on making Coebot's new website. However, the new home page is still being designed! In the mean time, these other pages probably have whatever you might be looking for:</p>
        <p>
          <a class="btn btn-primary btn-lg" href="/channels" role="button">Channels</a>
          <a class="btn btn-primary btn-lg" href="/commands" role="button">Commands</a>
        </p>
      </div> -->
    </div>
  </div>


  <div class="row">

    <div class="col-md-8 col-lg-9 js-whoslive-containers">
      <div id="carousel-whoslive" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <!-- <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
          <li data-target="#carousel-example-generic" data-slide-to="1"></li>
          <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol> -->

        <!-- Wrapper for slides -->
        <div class="carousel-inner js-whoslive-carousel" role="listbox">
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-whoslive" role="button" data-slide="prev">
          <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-whoslive" role="button" data-slide="next">
          <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

    <div class="col-md-4 col-lg-3 whoslive-sidebar js-whoslive-containers">
      <h4>Who's live?</h4>
      <div class="list-group js-whoslive-list">
      </div>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">

    <div class="col-md-8 col-sm-12 infobox">
      <h3>Welcome to <?php echo $SITE_TITLE; ?></h3>
      <p class="lead"><?php echo $SITE_TITLE; ?> is a chat bot for Twitch.tv. <?php echo $SITE_TITLE; ?> can moderate chat, manage custom commands, track highlights, and much more!</p>
    </div>

    <div class="col-md-4 col-sm-6 infobox">
      <h3>Need help?</h3>
      <p>The commands list has all the information you need to learn to use <?php echo $SITE_TITLE; ?> like a pro.</p>
      <p><a class="btn btn-default" href="/commands" role="button">View commands &raquo;</a></p>
    </div>

    <div class="col-md-4 col-sm-6 infobox">
      <h3>Looking for someone?</h3>
      <p>If you're looking for information about a channel that isn't currently live, you can find them on the channels list.</p>
      <p><a class="btn btn-default" href="/channels" role="button">View channels &raquo;</a></p>
    </div>

    <div class="col-md-4 col-sm-6 infobox">
      <h3>Do you stream?</h3>
      <p>If you're a streamer and you want to use <?php echo $SITE_TITLE; ?> on your channel, drop us a line! We are always happy to welcome new streamers to the <?php echo $SITE_TITLE; ?> family.</p>
      <p><a class="btn btn-default" href="https://twitter.com/endsgamer" role="button">Tweet @endsgamer &raquo;</a></p>
    </div>

    <div class="col-md-4 col-sm-6 infobox">
      <h3>We're open source!</h3>
      <p>Interested in how <?php echo $SITE_TITLE; ?> works? All our code is freely licensed, so go ahead and explore!</p>
      <p><a class="btn btn-default" href="https://bitbucket.org/tucker_gardner/coebot" role="button">Bot source &raquo;</a> <a class="btn btn-default" href="https://github.com/oxguy3/coebot-www" role="button">Website source &raquo;</a></p>
    </div>

  </div>


</div>
<?php
printFooter();
printFoot();
?>