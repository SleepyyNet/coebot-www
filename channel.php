<?php

require_once("common.php");

if (!isset($_GET['channel'])) {
  header("Location: /");
  die();
}
$channel = $_GET['channel'];
if (!validateChannel($channel)) {
  header("Location: /");
  die();
}

if (isset($_GET['tab']) && htmlspecialchars($_GET['tab']) == $_GET['tab']) {
  $jumpToTab = $_GET['tab'];
}

$extraHeadCode = "<script>";
$extraHeadCode .= "var channel = \"$channel\";";
if (isset($jumpToTab)) {
  $extraHeadCode .= "var jumpToTab = \"$jumpToTab\";";
}
$extraHeadCode .= "</script>";

printHead(
  $channel, 
  array("/css/dashboard.css"), 
  array("//cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js",
    "//cdn.datatables.net/plug-ins/9dcbecd42ad/integration/bootstrap/3/dataTables.bootstrap.js",
    "/js/later.min.js", 
    "/js/prettycron.js", 
    "/js/dashboard.js"
  ), 
  $extraHeadCode
);
printNav();

?>
<div class="container-fluid">
  <div class="row" role="tabpanel">
    <div class="col-sm-3 col-lg-2 sidebar">
      <ul class="nav nav-sidebar sidebar-collapse collapse" id="navSidebar" role="tablist">
        <li class="active"><a href="#tab_overview"><i class="fa fa-star fa-fw"></i>&nbsp; <span class="sidebar-title">Overview</span></a></li>
        <li><a href="#tab_commands"><i class="fa fa-terminal fa-fw"></i>&nbsp; <span class="sidebar-title">Commands</span></a></li>
        <li><a href="#tab_quotes"><i class="fa fa-quote-left fa-fw"></i>&nbsp; <span class="sidebar-title">Quotes</span></a></li>
        <li><a href="#tab_autoreplies"><i class="fa fa-comments-o fa-fw"></i>&nbsp; <span class="sidebar-title">Auto-replies</span></a></li>
        <li><a href="#tab_scheduled"><i class="fa fa-calendar fa-fw"></i>&nbsp; <span class="sidebar-title">Scheduled commands</span></a></li>
        <li><a href="#tab_regulars"><i class="fa fa-users fa-fw"></i>&nbsp; <span class="sidebar-title">Regulars</span></a></li>
        <li><a href="#tab_chatrules"><i class="fa fa-gavel fa-fw"></i>&nbsp; <span class="sidebar-title">Chat rules</span></a></li>
      </ul>
    </div>
    <script>enableSidebar()</script>
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

      <h2 class="page-header js-channel-title"></h2>
      <script>displayChannelTitle()</script>


      <div class="tab-content">

        <div role="tabpanel" class="tab-pane fade in active" id="tab_overview">
          <div class="js-channel-overview"></div>
        </div><!--/.tab-pane -->
        <script>displayChannelOverview()</script>


        <div role="tabpanel" class="tab-pane fade" id="tab_commands">
          <p>
            Here are the special commands defined for this channel. You can also use any of the universal/shared commands, listed <a href="http://coebot.tv/">here</a>.
          </p>
          <div class="">
            <table class="table table-striped js-commands-table">
              <thead>
                <tr>
                  <th>Command</th>
                  <th>Access</th>
                  <th>Response</th>
                </tr>
              </thead>
              <tbody class="js-commands-tbody"></tbody>
            </table>
            <script>displayChannelCommands()</script>
          </div>

        </div><!--/.tab-pane -->


        <div role="tabpanel" class="tab-pane fade" id="tab_quotes">
          <p>
            To retrieve a particular quote, use <kbd class="command">quote get [number]</kbd>. You can also retrieve a random quote with <kbd class="command">quote random</kbd>.
          </p>
          <div class="">
            <table class="table table-striped js-quotes-table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Quote</th>
                </tr>
              </thead>
              <tbody class="js-quotes-tbody"></tbody>
            </table>
            <script>displayChannelQuotes()</script>
          </div>
        </div><!--/.tab-pane -->


        <div role="tabpanel" class="tab-pane fade" id="tab_autoreplies">
          <p>
            Here are the auto-replies defined for this channel. Whenever Coebot sees anyone say any of these phrases, it will automatically give the appropriate reply. Asterisks (*) represent wildcards.
          </p>
          <div class="">
            <table class="table table-striped js-autoreplies-table">
              <thead>
                <tr>
                  <th>Trigger</th>
                  <th>Response</th>
                </tr>
              </thead>
              <tbody class="js-autoreplies-tbody"></tbody>
            </table>
            <script>displayChannelAutoreplies()</script>
          </div>
        </div><!--/.tab-pane -->


        <div role="tabpanel" class="tab-pane fade" id="tab_scheduled">
          <p>
            Here are the scheduled and repeating commands defined for this channel. Coebot will automatically execute these commands according to the given time interval.
          </p>
          <div class="">
            <table class="table table-striped js-scheduled-table">
              <thead>
                <tr>
                  <th>Command</th>
                  <th>Frequency</th>
                </tr>
              </thead>
              <tbody class="js-scheduled-tbody"></tbody>
            </table>
            <script>displayChannelScheduled()</script>
          </div>
        </div><!--/.tab-pane -->


        <div role="tabpanel" class="tab-pane fade" id="tab_regulars">
          <p>
            Here are all the users with the "regular" rank for this channel. Regulars can post links in chat and use some commands not available to the general public. Channel owners can give out this rank as they please, so the process and rules to get promoted to regular will differ betweeen channels.
          </p>
          <p class="js-regulars-subsinfo"></p>
          <div class="">
            <table class="table js-regulars-table">
              <thead>
                <tr>
                  <th>Twitch name</th>
                </tr>
              </thead>
              <tbody class="js-regulars-tbody"></tbody>
            </table>
            <script>displayChannelRegulars()</script>
          </div>
        </div><!--/.tab-pane -->


        <div role="tabpanel" class="tab-pane fade" id="tab_chatrules">
          <h3>Banned phrases</h3>
          <div class="">
            <table class="table js-chatrules_offensive-table">
              <thead>
                <tr>
                  <th>Phrase</th>
                </tr>
              </thead>
              <tbody class="js-chatrules_offensive-tbody"></tbody>
            </table>
          </div>
          <script>displayChannelChatrules()</script>
        </div><!--/.tab-pane -->

      </div>
      <script>tabContentLoaded();</script>
    </div>
  </div>
</div>
<?php
printFoot();
?>