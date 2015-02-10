# coebot-www
A web interface for [Coebot](https://bitbucket.org/tucker_gardner/coebot), a Twitch.tv chat moderation bot.

## Installation
This site is still very early in development so I'm not gonna bother writing detailed install instructions that might change dramatically later, but it's mostly just a standard AMP (Apache/MySQL/PHP) application. Put the files on an Apache server with PHP and enable .htaccess files or copy the contents of the .htaccess file to your Apache config file.

You might notice that one particular file is missing. To keep secret data safe, I put confidential details in a file called safeconfig.php that isn't posted to GitHub. Here's what that file looks like so that you can recreate it:

```php
<?php

// mysql details for new site
define(DB_SERV, "<ip/hostname of mysql server>");
define(DB_USER, "<mysql username>");
define(DB_PASS, "<mysql password>");
define(DB_NAME, "<mysql database name>");
define(DB_PREF, "<prefix to prepend to all table names>");

// mysql details for highlights site
define(DB_HIGHLIGHTS_SERV, "<ip/hostname of mysql server>");
define(DB_HIGHLIGHTS_USER, "<mysql username>");
define(DB_HIGHLIGHTS_PASS, "<mysql password>");
define(DB_HIGHLIGHTS_DATA, "<mysql database name>");

$TEMP_AUTH_KEY = "<a very confidential string of characters>";

?>
```

## Private API
This site uses a private API to communicate with Coebot. This API is still in planning, but the specification so far is available [here](https://docs.google.com/document/d/1tQNETtRvTuSdGKEep57yuO_8J_YfjS5J3--Q6vH0Rcc/edit?usp=sharing).

## License
Copyright 2014-2015 Hayden Schiff, licensed under MIT License

## Issue tracker
Since I'm the only person working on this project for the most part, I have opted to use [this Trello board](https://trello.com/b/7hVc2TY1) to track my issues, as I tend to lose patience for GitHub issues. However, I will also keep an eye on GitHub's issue tracker, so you can submit bugs/suggestions/etc via GitHub.
