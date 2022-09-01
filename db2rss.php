<?php
require_once("config.php"); //$link to database
$path = "http://localhost:8888/db2rss/"; //Update path to XML here
$rss_file_name = "twin_cities.xml"; //Update file name of RSS feed here
// Turn off all error reporting
error_reporting(0);

$qry = "SELECT poi.*,i.image_src,c.city_name FROM `place_of_interest` poi LEFT JOIN `images` i ON poi.place_id = i.place_id LEFT JOIN `city` c on poi.city_id = c.city_id";
$result = mysqli_query($link, $qry);
$items = "";
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$url = $row['URL'];
	if (strpos($url, "https://") === FALSE) {
		$url = "https://" . $url;
	}
	$items .= '<item>
    <title>' . $row['place_name'] . '</title>
	<guid>' . $url . '</guid>
    <link>' . $url . '</link>
    <description>City Name : ' . $row['city_name'] . ',
		Capacity(Thousands) : ' . $row['capacity(thousands)'] . ',
		Days open(Per Year) : ' . $row['days_open(peryear)'] . ',
		Total Visitors(Yearly) : ' . $row['totalvisitors(yearly)'] . ',
		Place Lat : ' . $row['place_lat'] . ',
		Place Long : ' . $row['place_long'] . '
	</description>
	<category>' . $row['category'] . '</category>';
	if ($row['image_src'] != "") {
		if (strpos($row['image_src'], "?") !== FALSE) {
			$image_src_parts = explode("?", $row['image_src']);
			if (isset($image_src_parts[0])) {
				$row['image_src'] = $image_src_parts[0];
			}
		}
		$headers = get_headers($row['image_src'], 1);
		$content_length = isset($headers['Content-Length']) ? $headers['Content-Length'] : 0;
		$content_type = isset($headers['Content-Type']) ? $headers['Content-Type'] : "image/jpeg";
		$items .= '<enclosure url="' . $row['image_src'] . '" length="' . $content_length . '" type="' . $content_type . '" />';
	}
	$items .= '<pubDate>' . gmdate('D, d M Y h:i:s', time()) . ' GMT</pubDate>';
	$items .= '</item>';
}
$rss = '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel> 
  <title>Twin Cities</title>
  <link>' . $path . $rss_file_name . '</link>
  <atom:link href="' . $path . $rss_file_name . '" rel="self" type="application/rss+xml" />
  <description>Place of interest</description>
  <lastBuildDate>' . gmdate('D, d M Y h:i:s', time()) . ' GMT</lastBuildDate>
  ' . $items . '
</channel>
</rss>';
$fp = fopen($rss_file_name, "w");
fputs($fp, $rss);
fclose($fp);
echo '<center><p>Database to RSS converted successfully, <a href="' . $rss_file_name . '" target="_BLANK">OPEN RSS FEED</a></p></center>';
