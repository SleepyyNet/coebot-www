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

$extraHeadCode = "<script>";
$extraHeadCode .= "var channel = \"$channel\";";
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

      <div class="panel panel-default channel-sidebar-panel">
        <div class="panel-heading visible-xs-block" role="tab" id="channelSidebarHeading">
          <h4 class="panel-title">
            <div class="channel-sidebar-heading-title">
              <span class="js-channel-title"></span>
            </div>
            <div class="channel-sidebar-heading-toggle">
              <a data-toggle="collapse" href="#channelSidebarCollapse" aria-expanded="true" aria-controls="channelSidebarCollapse" class="btn btn-default btn-sm js-channel-tab-icon"></a>
            </div>
            <div class="clearfix"></div>
          </h4>
        </div>
        <div id="channelSidebarCollapse" class="panel-collapse collapse" role="tabpanel" aria-labelledby="channelSidebarHeading" data-toggle="false">
          <div class="panel-body">
            <ul class="nav nav-sidebar" id="navSidebar" role="tablist">
              <li class="active"><a href="#tab_overview">
                <span class="sidebar-icon"><i class="fa fa-star fa-fw"></i></span>
                <span class="sidebar-title">Overview</span>
              </a></li>
              <li><a href="#tab_commands">
                <span class="sidebar-icon"><i class="fa fa-terminal fa-fw"></i></span>
                <span class="sidebar-title">Commands</span>
              </a></li>
              <li><a href="#tab_quotes">
                <span class="sidebar-icon"><i class="fa fa-quote-left fa-fw"></i></span>
                <span class="sidebar-title">Quotes</span>
              </a></li>
              <li><a href="#tab_autoreplies">
                <span class="sidebar-icon"><i class="fa fa-comments-o fa-fw"></i></span>
                <span class="sidebar-title">Auto-replies</span>
              </a></li>
              <li><a href="#tab_scheduled">
                <span class="sidebar-icon"><i class="fa fa-calendar fa-fw"></i></span>
                <span class="sidebar-title">Scheduled commands</span>
              </a></li>
              <li><a href="#tab_regulars">
                <span class="sidebar-icon"><i class="fa fa-users fa-fw"></i></span>
                <span class="sidebar-title">Regulars</span>
              </a></li>
              <li><a href="#tab_chatrules">
                <span class="sidebar-icon"><i class="fa fa-gavel fa-fw"></i></span>
                <span class="sidebar-title">Chat rules</span>
              </a></li>
            </ul>
            <?php printFooter(); ?>
          </div>
        </div>
      </div>
    </div>

    <!-- </div> -->
    <script>enableSidebar()</script>


    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">

      <h2 class="page-header">
        <span class="js-islive islive-indicator small" data-placement="bottom"><i class="js-islive-icon fa fa-fw"></i></span>
        <span class="js-channel-title channel-title hidden-xs"></span>
        <span class="js-channel-tab-title channel-tab-title"><span>
      </h2>
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
                  <th class="row-command-col-access">Access</th>
                  <th>Response</th>
                  <th>Count</th>
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
          <div class="js-chatrules_offensive">
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