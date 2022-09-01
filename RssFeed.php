<html lang="en">

<head>
	<title>Twin Cities</title>
	<style type="text/css">
		th,
		td {
			padding: 6px;
			background-color: gainsboro;
		}

		h3 {
			color: orangered;
			font-size: 22px;
			font-family: sans-serif;
		}

		.title {
			background-color: darkgray;
			color: black;
			font-size: 15px;
			font-weight: 600;
			padding: 6px;
			font-family: sans-serif;
			text-underline-offset: 1px;
		}

		.desc {
			padding: 6px;
		}
	</style>
</head>

<body>
	<?php

	$rss = "http://localhost/testsite/cw/twin_cities.xml";

	echo '<h3><u>Twin Cities</u></h3>';

	$rss_feed = simplexml_load_file($rss);

	echo '<table class="rss-table>"';
	echo '<tbody>';

	if (!empty($rss_feed)) {
		$i = 0;
		foreach ($rss_feed->channel->item as $feed_item) {
			echo '<tr>';
			echo '<td valign="top">';
			echo '<div class="title"><a href="' . $feed_item->link . '">' . $feed_item->title . '"</a></div>';
			echo $today = date("D M j  Y");
			echo '<div class="desc">' . implode('', array_slice(explode(',', $feed_item->description), 0, 2)) . '</div>';
			echo '<div class="desc">' . implode('', array_slice(explode(',', $feed_item->description), 2, 2)) . '</div>';
			echo '<div class="desc">' . implode('', array_slice(explode(',', $feed_item->description), 3, 3)) . '</div>';
			echo '<div class="desc">' . "Category:" . $feed_item->category . '</div>';
			echo '</td>';
			echo '</tr>';
		}
		echo '</tbody>';
		echo '</table>';
	}

	?>
</body>

</html>