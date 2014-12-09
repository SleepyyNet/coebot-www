downloadCoebotData();
var channelCoebotData = getCoebotDataChannel(channel);

function enableSidebar() {

	$('#navSidebar a').click(function (e) {
		e.preventDefault();
		$(this).tab('show');
        window.location.hash = "#" + $(this).attr("href").substr(5);
        console.log($(this).attr("href").substr(5));
	});

	$('#navSidebar a').on('shown.bs.tab', function (e) {
		var tab = e.target;

		var tabName = $(tab).children('.sidebar-title').html();

		$(".js-channel-title small").html(tabName);
	});
}

function tabContentLoaded() {
    if (window.location.hash != "") {
        var jumpToTab = window.location.hash.substr(1);
        $('#navSidebar a[href="#tab_' + jumpToTab + '"]').click();
    }
}

// channel config data
var channelData = false;
var channelTwitchData = false;
var twitchEmotes = false;
var channelStreamData = false;

function downloadChannelData() {
	$.ajax({
		async: false, // it's my json and i want it NOW!
		dataType: "json",
		url: "/configs/" + channel + ".json",
		success: function(json) {
            console.log("Loaded channel data");
			channelData = json;
		},
		error: function(jqXHR, textStatus, errorThrown) {
			alert("Failed to load channel data!");
			window.location = "/";
		}
	});
}

downloadChannelData();

function displayChannelTitle() {
	var channelTitle = channel;
	var html = ((channelCoebotData.displayName&&channelCoebotData.displayName=="") ? channel : channelCoebotData.displayName) + ' <small>'
	html += $('#navSidebar a:first-child .sidebar-title').html() + '</small>';
	$(".js-channel-title").html(html);
}

function displayChannelOverview() {
	var html = "";
	html += '<p>';
	html += '<a class="btn btn-primary" href="http://www.twitch.tv/' 
	html += channel + '" target="_blank"><i class="fa fa-twitch"></i> Twitch</a>';

    if (channelCoebotData.youtube && channelCoebotData.youtube != "") {
        html += ' <a class="btn btn-default" href="http://www.youtube.com/user/' 
        html += channelCoebotData.youtube + '" target="_blank"><i class="fa fa-youtube-play"></i> YouTube</a>';
    }

    if (channelCoebotData.twitter && channelCoebotData.twitter != "") {
        html += ' <a class="btn btn-default" href="http://twitter.com/' 
        html += channelCoebotData.twitter + '" target="_blank"><i class="fa fa-twitter"></i> Twitter</a>';
    }

	if (channelData.steamID && channelData.steamID != "") {
		html += ' <a class="btn btn-default" href="http://steamcommunity.com/profiles/' 
		html += channelData.steamID + '" target="_blank"><i class="fa fa-steam"></i> Steam</a>';
	}

    if (channelData.lastfm && channelData.lastfm != "") {
        html += ' <a class="btn btn-default" href="http://www.last.fm/user/' 
        html += channelData.lastfm + '" target="_blank"><i class="fa fa-lastfm"></i> last.fm</a>';
    }

	html += '</p>';

	$(".js-channel-overview").html(html);
}

function displayChannelCommands() {
	var tbody = $('.js-commands-tbody');
	var rows = "";
    var shouldSortTable = true;
	for (var i = 0; i < channelData.commands.length; i++) {
		var cmd = channelData.commands[i];
		var row = '<tr>';
		row += '<td><kbd class="command">' + cmd.key + '</kbd></td>';
        row += '<td style="color:' + colorifyAccessLevel(cmd.restriction) + '" data-order="' + cmd.restriction + '">' + prettifyAccessLevel(cmd.restriction) + '</td>';
		row += '<td>' + prettifyStringVariables(cmd.value) + '</td>';
		row += '</tr>';
		rows += row;
	}
    if (rows == "") {
        rows = '<tr><td colspan="2" class="text-center">' + EMPTY_TABLE_PLACEHOLDER + '</td></tr>';
        shouldSortTable = false;
    }
	tbody.html(rows);

    if (shouldSortTable) {
        $('.js-commands-table').dataTable({
            "paging": false,
            "info": false
        });
    }
}

function displayChannelQuotes() {
	var tbody = $('.js-quotes-tbody');
	var rows = "";
    var shouldSortTable = true;
	for (var i = 0; i < channelData.quotes.length; i++) {
		var quote = channelData.quotes[i];
		var row = '<tr>';
		row += '<td>' + (i+1) + '</td>';
		row += '<td>' + quote + '</td>';
		row += '</tr>';
		rows += row;
	}
    if (rows == "") {
        rows = '<tr><td colspan="2" class="text-center">' + EMPTY_TABLE_PLACEHOLDER + '</td></tr>';
        shouldSortTable = false;
    }

	tbody.html(rows);


    if (shouldSortTable) {
        $('.js-quotes-table').dataTable({
            "paging": false,
            "info": false
        });
    }
}

function displayChannelAutoreplies() {
    var tbody = $('.js-autoreplies-tbody');
    var rows = "";
    var shouldSortTable = true;
    for (var i = 0; i < channelData.autoReplies.length; i++) {
        var reply = channelData.autoReplies[i];
        var row = '<tr>';
        row += '<td>' + prettifyRegex(reply.trigger) + '</td>';
        row += '<td>' + prettifyStringVariables(reply.response) + '</td>';
        row += '</tr>';
        rows += row;
    }
    if (rows == "") {
        rows = '<tr><td colspan="2" class="text-center">' + EMPTY_TABLE_PLACEHOLDER + '</td></tr>';
        shouldSortTable = false;
    }

    tbody.html(rows);

    if (shouldSortTable) {
        $('.js-autoreplies-table').dataTable({
            "paging": false,
            "info": false,
            "searching": false
        });
    }
}

function displayChannelScheduled() {
    var tbody = $('.js-scheduled-tbody');
    var rows = "";
    var shouldSortTable = true;
    for (var i = 0; i < channelData.scheduledCommands.length; i++) {
        var cmd = channelData.scheduledCommands[i];
        if (cmd.active) {
            var row = '<tr>';
            row += '<td>' + channelData.commandPrefix + cmd.name + '</td>';
            row += '<td><span title="Cron command: ' + cmd.pattern + '">'
            row += prettyCron.toString(cmd.pattern) + '</td>';
            row += '</tr>';
            rows += row;
        }
    }
    for (var i = 0; i < channelData.repeatedCommands.length; i++) {
        var cmd = channelData.repeatedCommands[i];
        if (cmd.active) {
            var row = '<tr>';
            row += '<td>' + channelData.commandPrefix + cmd.name + '</td>';
            row += '<td><span title="Every ' + cmd.delay + ' seconds">Every '
            row += moment().subtract(cmd.delay, 'seconds').fromNow(true) + '</span></td>';
            row += '</tr>';
            rows += row;
        }
    }
    if (rows == "") {
        rows = '<tr><td colspan="2" class="text-center">' + EMPTY_TABLE_PLACEHOLDER + '</td></tr>';
        shouldSortTable = false;
    }
    
    tbody.html(rows);

    if (shouldSortTable) {
        $('.js-scheduled-table').dataTable({
            "paging": false,
            "info": false,
            "searching": false
        });
    }
}

function displayChannelRegulars() {
    var tbody = $('.js-regulars-tbody');
    var rows = "";
    var shouldSortTable = true;
    for (var i = 0; i < channelData.regulars.length; i++) {
        var reg = channelData.regulars[i];
        var row = '<tr>';
        row += '<td class="text-capitalize">' + reg + '</td>';
        row += '</tr>';
        rows += row;
    }
    if (rows == "") {
        rows = '<tr><td colspan="1" class="text-center">' + EMPTY_TABLE_PLACEHOLDER + '</td></tr>';
        shouldSortTable = false;
    }

    tbody.html(rows);

    if (shouldSortTable) {
        $('.js-regulars-table').dataTable();
    }


    var subsinfoText = 'On this channel, ';
    if (channelData.subcriberRegulars) {
        subsinfoText += 'subscribers are automatically given all the same privileges as regulars.';
    } else if (channelData.subsRegsMinusLinks) {
        subsinfoText += 'subscribers are automatically given the same privileges as regulars, except they cannot post links or use the <kbd class="command">urban</kbd> command.';
    } else {
        subsinfoText += 'subscribers do not automatically receive the same privileges as regulars.';
    }

    $('.js-regulars-subsinfo').html(subsinfoText);
}

function displayChannelChatrules() {
    // var html = ""
    // html += '<h3>Banned phrases</h3>'

    if (channelCoebotData.shouldShowOffensiveWords) {
    
        var tbody = $('.js-chatrules_offensive-tbody');
        var rows = "";
        var shouldSortTable = true;
        for (var i = 0; i < channelData.offensiveWords.length; i++) {
            var word = channelData.offensiveWords[i];
            var row = '<tr>';
            row += '<td>' + prettifyRegex(word) + '</td>';
            row += '</tr>';
            rows += row;
        }
        if (rows == "") {
            rows = '<tr><td colspan="1" class="text-center">' + EMPTY_TABLE_PLACEHOLDER + '</td></tr>';
            shouldSortTable = false;
        }
    
        tbody.html(rows);
    
        if (shouldSortTable) {
            $('.js-chatrules_offensive-table').dataTable({
                "paging": false,
                "info": false,
                "searching": false
            });
        }
    } else {
        $('.js-chatrules_offensive').addClass("hidden");
    }

    // $(".js-chatrules-div").html(html);
}



function prettifyAccessLevel(access) {
    if (access == 0) {
        return "All";
    }
    if (access == 1) {
        if (channelData.subsRegsMinusLinks||channelData.subscriberRegulars) {
            return "Subs";
        } else {
            return "Regs";
        }
    }
    if (access == 2) {
        return "Mods";
    }
    if (access == 3) {
        return "Owners";
    }
}

function colorifyAccessLevel(access) {
    if (access == 0) {
        return "#bdc3c7";
    }
    if (access == 1) {
        return "#8e44ad";
    }
    if (access == 2) {
        return "#27ae60";
    }
    if (access == 3) {
        return "#c0392b";
    }
}

function injectEmoticons(html) {
    html = htmlDecode(html);
    for (var i = 0; i < twitchEmotes.length; i++) {
        var emote = twitchEmotes[i];
        if (emote.state == "active") {
            var pattern = new RegExp(emote.regex);
            html = html.replace(pattern, htmlifyEmote(emote), 'g');
        }
    }
    return html;
}

function htmlDecode(input) {
    return String(input)
        .replace(/&amp;/g, '&')
        .replace(/&quot;/g, '"')
        .replace(/&lt;/g, '<')
        .replace(/&gt;/g, '>');
}

// generates HTML for an emote
function htmlifyEmote(emote) {
    var html = '';
    html += '<img src="' + emote.url;
    html += '" height="' + emote.height;
    html += '" width="' + emote.width;
    html += '" title="' + emote.regex;
    html += '" class="twitch-emote">';
    return html;
}

// displays info about the Twitch channel on the overview page
function injectTwitchData() {
    var oldHtml = $('.js-channel-overview').html();
    var html = '';
    html += '<p>Views: ' + Humanize.intComma(channelTwitchData.views) + '</p>';
    html += '<p>Followers: ' + Humanize.intComma(channelTwitchData.followers) + '</p>';
    html += '<p>Joined Twitch on ' + moment(channelTwitchData.created_at).format('LL') + '</p>';
    html += oldHtml;
    
    $('.js-channel-overview').html(html);
}

$(document).ready(function() {
    $.ajax({
        dataType: "jsonp",
        jsonp: "callback",
        url: "https://api.twitch.tv/kraken/channels/" + channel,
        success: function(json) {
            console.log("Loaded Twitch channel data");
            channelTwitchData = json;
            injectTwitchData();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Failed to load Twitch channel data!");
        }
    });

    $.ajax({
        cache: true,
        dataType: "jsonp",
        jsonp: "callback",
        url: "https://api.twitch.tv/kraken/chat/" + channel + "/emoticons",
        success: function(json) {
            console.log("Loaded Twitch emotes");
            twitchEmotes = json.emoticons;
            var commandsTbody = $('.js-commands-tbody');
            commandsTbody.html(injectEmoticons(commandsTbody.html()));
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Failed to load Twitch emotes!");
        }
    });

    checkIfLive();
    setInterval(checkIfLive, 30000);

    $(".command").prepend('<span class="command-prefix">' + channelData.commandPrefix + '</span>');
})


/**
 * states of liveness
 * 0 = error
 * 1 = offline
 * 2 = live
 * 3 = loading
 */

var isLiveErr = 0;
var isLiveOff = 1;
var isLiveOn = 2;
var isLiveLoad = 3;

var isLiveClasses = [
    "text-warning fa-exclamation-triangle",
    "text-muted fa-toggle-off",
    "text-primary fa-toggle-on",
    "text-muted fa-refresh fa-spin"
];
var isLiveClassesAll = isLiveClasses.join(" ");

var isLiveTitles = [
    "Couldn't access Twitch",
    "Offline",
    "Live",
    "Loading..."
];

// checks if the stream is live
function checkIfLive() {
    var heading = $('.js-channel-islive');
    var icon = heading.children("i");
    icon.removeClass(isLiveClassesAll);
    icon.addClass(isLiveClasses[isLiveLoad]);
    $.ajax({
        dataType: "jsonp",
        jsonp: "callback",
        url: "https://api.twitch.tv/kraken/streams/" + channel,
        success: function(json) {
            console.log("Loaded Twitch stream data");
            channelStreamData = json.stream;
            updateIsLive();
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert("Failed to load Twitch stream data!");
            channelStreamData = false;
            updateIsLive();
        }
    });

}

// determines what the live status is
function getLiveStatus() {
    var liveStatus = isLiveErr;
    if (typeof channelStreamData !== 'boolean') {
        liveStatus = (channelStreamData != null) ? isLiveOn : isLiveOff;
    }
    return liveStatus;
}

// updates the indicator that shows if the channel is currently streaming
function updateIsLive() {}

    var liveStatus = getLiveStatus();

    var heading = $('.js-channel-islive');
    var icon = heading.children("i");

    // style the indicator with the right colors and icon
    icon.removeClass(isLiveClassesAll);
    icon.addClass(isLiveClasses[liveStatus]);

    // get the hover text. if we're live, it's fancier
    var popover = isLiveTitles[liveStatus];
    if (liveStatus == isLiveOn) {
        popover = '';
        popover += '<strong>'+channelStreamData.channel.status+'</strong>';
        popover += ' <em>' + isLiveTitles[liveStatus] + '</em><br>';
        popover += 'Playing ' + channelStreamData.channel.game + '<br>';
        popover += Humanize.intComma(channelStreamData.viewers) + ' watching now';
    }

    heading.attr("data-content", popover);

    heading.popover({
        html: true,
        trigger: 'hover'
    });
}