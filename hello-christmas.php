<?php
/*
Plugin Name: Hello Christmas
Description: It's Christmas time. We can look at famous jazz lyrics for the rest of the year. This plugin is a festive alternative to Hello, Dolly. Random Christmas song lyrics will be shown at the top of your admin screen.
Author: Kyle Maurer
Version: 1.2
Author URI: http://realbigmarketing.com/
*/

function christmas_get_lyric() {
	$lyrics = "You're a mean one <span>Mr. Grinch</span>
We wish you a <span>merry Christmas</span>
Have a holly, <span>jolly Christmas</span>
Let it snow, <span>let it snow,</span> let it snow!
When we <span>finally kiss</span> goodnight
Chestnuts <span>roasting on an</span> open fire
Jack frost <span>nipping at your</span> nose
Yuletide carols <span>being sung by</span> a choir
With a corn cob pipe <span>and a button nose</span>
Rudolph the <span>red nosed</span> reindeer
...had a very <span>shiny nose</span>
God rest ye <span>merry gentlemen</span>
Joy <span>to the</span> world!
Oh, <span>Holy</span> night
Silent night, <span>Holy night</span>
<span>Santa Claus</span> is coming to town
He sees <span>you when you're</span> sleeping
We <span>three kings</span> of orient are
<span>bearing gifts</span> we traverse afar
Westward <span>leading still</span> proceeding
He knows <span>when you're</span> awake
He knows <span>if you've been</span> bad or good
You <span>better be</span> good for <span>goodness sake</span>
You better watch out, <span>you better not cry</span>
Jingle bells, <span>jingle bells</span>
Dashing through the snow
In a one <span>horse open</span> sleigh
O'er the fields we go
What fun it is <span>to ride and sing</span>
O come <span>all ye</span> faithful
Oh Chrismas tree, <span>oh Christmas tree</span>
O little town of <span>Bethlehem</span>
Soon it will be <span>Christmas</span> day
It's <span>Christmas Eve</span> and these shoes are <span>just her size</span>
Go tell <span>it on the</span> mountain
Candles burnin' low. <span>Lots of mistletoe.</span>
Let them know it's <span>Christmas time</span>
Oh the <span>weather outside</span> is frightful
Santa <span>baby...</span>
I played my drum for Him <span>barump barump bump</span>
Now hurry <span>down the chimney</span> tonight
It's the most <span>wonderful time</span> of the year
And so this is <span>Christmas</span>
Simply having a <span>wonderful Christmas time</span>
The star is brightly <span>shining</span>
But baby it's <span>cold outside</span>
Put some records on <span>while I pour</span>
The <span>lights</span> are turned way <span>down low</span>
I'm <span>dreaming</span> of a white Christmas
Where the treetops <span>glisten</span>
To hear <span>sleigh bells in the snow</span>
Up on the house top <span>click,</span> click, <span>click</span>";

	// Here we split it into lines
	$lyrics = explode( "\n", $lyrics );

	// And then randomly choose a line
	return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

function days_until_christmas() {
	//How long until Christmas?
	$year       = date( "Y" );
	$target     = mktime( 0, 0, 0, 12, 25, $year );
	$today      = time();
	$difference = ( $target - $today );
	$days       = (int) ( $difference / 86400 );

	return $days;
}

// This just echoes the chosen line, we'll position it later
function hello_christmas() {

	//Only go if no Hello Dolly and less than 40 days until Christmas
	if ( ! function_exists( 'hello_dolly' ) && days_until_christmas() < 40 ) {
		$chosen = christmas_get_lyric();
		echo "<div id='christmas'><span class='hello-snow'><i></i><i></i><i></i><i></i></span>$chosen</div>";
	}
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'hello_christmas' );

// We need some CSS to position the paragraph
// Falling snow help from http://standardista.com/snow/
function hello_christmas_css() {
	if ( ! function_exists( 'hello_dolly' ) && days_until_christmas() < 40 ) {
		// This makes sure that the positioning is also good for right-to-left languages
		$x = is_rtl() ? 'left' : 'right';

		echo "
	<style type='text/css'>
	#christmas {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
		color: #006D00;
		font-style: italic;
    	position: relative;
	}
	#christmas span {
		color: #D60000;
	}
	#christmas .hello-snow i {
		position: absolute;
		height: 2px;
		width: 2px;
		display: inline-block;
		background-color: #fff;
		-webkit-animation: falling 1s ease-in-out 1s infinite;
		-moz-animation: falling 1s ease-in-out 1s infinite;
		-ms-animation: falling 1s ease-in-out 1s infinite;
		animation-name: falling;
		animation-duration: 1s;
		animation-timing-function: ease-in-out;
		animation-iteration-count:infinite;
		animation-delay: 2s;
		-webkit-animation-direction: normal;
		-moz-animation-direction: normal;
		-ms-animation-direction: normal;
	}
	#christmas i:nth-last-of-type(2) {
		left: 20%;
		animation-duration: 1.5s;
		-webkit-animation: falling 1.5s ease-in-out 1.5s infinite;
		-moz-animation: falling 1.5s ease-in-out 1.5s infinite;
		-ms-animation: falling 1.5s ease-in-out 1.5s infinite;
	}
	#christmas i:nth-last-of-type(3) {
		left: 50%;
		animation-duration: 2s;
		-webkit-animation: falling 2s ease-in-out 2s infinite;
		-moz-animation: falling 2s ease-in-out 2s infinite;
		-ms-animation: falling 2s ease-in-out 2s infinite;
	}
	#christmas i:nth-last-of-type(4) {
		left: 75%;
		animation-delay: 1s;
		animation-duration: 1.1s;
		-webkit-animation: falling 1.1s ease-in-out 1.1s infinite;
		-moz-animation: falling 1.1s ease-in-out 1.1s infinite;
		-ms-animation: falling 1.1s ease-in-out 1.1s infinite;
	}
	@keyframes falling {
	    0% {
	      top: -40px;
	    }
	    100% {
	      top: 18px;
	    }
	}
	@-webkit-keyframes falling {
	    0%{
	      -webkit-transform: translateY(0);
	    }
	    100% {
	      -webkit-transform: translateY(18px);
	    }
	}
	@-moz-keyframes falling {
	    0%{
	      -moz-transform: translateY(0);
	    }
	    100% {
	      -moz-transform: translateY(18px);
	    }
	}
	@-ms-keyframes falling {
	    0%{
	      -ms-transform: translateY(0);
	    }
	    100% {
	      -ms-transform: translateY(18px);
	    }
    }
	</style>";
	}
}

add_action( 'admin_head', 'hello_christmas_css' );