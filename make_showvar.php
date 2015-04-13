<?php

require_once("common.php");

printHead("Variable display maker");
printNav();

?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">

      <h1>Variable display maker</h1>

      <p>This form can be used to create a webpage which you can then embed in your stream using CLR Browser. Only "Channel" and "Variable name" are required fields; the rest are optional.</p>

      <form action="/showvar.php" method="get">


        <h3>Main options</h3>

        <div class="form-group">
          <label for="makeform-channel">Channel name</label>
          <input type="text" class="form-control" id="makeform-channel" name="channel" placeholder="Your Twitch username">
        </div>

        <div class="form-group">
          <label for="makeform-var">Variable name</label>
          <input type="text" class="form-control" id="makeform-var" name="var" placeholder="ID of the variable">
        </div>

        <div class="form-group">
          <label for="makeform-refresh">Refresh interval (milliseconds)</label>
          <input type="number" class="form-control" id="makeform-refresh" name="refresh" min="1000" step="500" value="5000">
        </div>

        <div class="form-group">
          <label for="makeform-themes">Themes (Available themes: basic, blood, arcade, plumbers, guude. Separate multiple themes with spaces.)</label>
          <input type="text" class="form-control" id="makeform-themes" name="themes">
        </div>

        <div class="form-group">
          <label for="makeform-label">Label/caption</label>
          <input type="text" class="form-control" id="makeform-label" name="label" placeholder="e.g. deaths">
        </div>


        <h3>Style options</h3>

        <p>Here are some more stylistic options you can use. All of these settings are optional, and advanced users may prefer to write their own custom CSS instead of using these settings.</p>

        <div class="form-group">
          <label for="makeform-valueFont">Value font</label>
          <input type="text" class="form-control" id="makeform-valueFont" name="valueFont" placeholder="e.g. Comic Sans MS">
        </div>

        <div class="form-group">
          <label for="makeform-valueColor">Value color</label>
          <input type="text" class="form-control" id="makeform-valueColor" name="valueColor" placeholder="e.g. #aa0000">
        </div>

        <div class="form-group">
          <label for="makeform-labelFont">Label font</label>
          <input type="text" class="form-control" id="makeform-labelFont" name="labelFont" placeholder="e.g. Comic Sans MS">
        </div>

        <div class="form-group">
          <label for="makeform-labelColor">Label color</label>
          <input type="text" class="form-control" id="makeform-labelColor" name="labelColor" placeholder="e.g. #aa0000">
        </div>

<!--         <div class="form-group">
          <label for="makeform-channel">Channel</label>
          <input type="text" class="form-control" id="makeform-channel" name="channel">
        </div>

        <div class="form-group">
          <label for="makeform-channel">Channel</label>
          <input type="text" class="form-control" id="makeform-channel" name="channel">
        </div>

        <div class="form-group">
          <label for="makeform-channel">Channel</label>
          <input type="text" class="form-control" id="makeform-channel" name="channel">
        </div>

        <div class="form-group">
          <label for="makeform-channel">Channel</label>
          <input type="text" class="form-control" id="makeform-channel" name="channel">
        </div>

        <div class="form-group">
          <label for="makeform-channel">Channel</label>
          <input type="text" class="form-control" id="makeform-channel" name="channel">
        </div> -->

        <button type="submit" class="btn btn-default">Submit</button>

      </form>

    </div>
  </div>
</div>
<?php
printFooter();
printFoot();
?>