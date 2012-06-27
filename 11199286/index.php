<?php

//Automatically replace content of wordpress posts/page
if (function_exists('add_filter')) {
	add_filter('the_content', 'frame_external_links');
}

//test datas
$content = '
	
	<a href="#">fedmich</a>
	<a href="https://google.com">federico</a>
	<a href="http://google.com">google</a>
	<a href="subfolder">subfolder</a>
	<a href="/absolute">absolute</a>
	<a href="../">relative</a>
	';

$contentx = frame_external_links($content);

//Sample output
echo 'before';
var_dump(trim($content));
echo '<hr />';
echo 'after';
var_dump(trim($contentx));

echo '<hr />';
echo '<b>actual</b>';
echo '<br />';

echo $contentx;

function frame_external_links($content) {
	$top_frame = 'http://anonymouse.org/cgi-bin/anon-www.cgi/';

	$pat = '@<a .*href="(.*)"@isU';
	preg_match_all($pat, $content, $m_links);
	if (!$m_links) {
		//no links found, just return original content
		return $content;
	}

	$contentx = $content;
	foreach ($m_links[1] as $mctr => $link) {
		$process_this = 0;
		switch ($link) {
			case '#':
			case '':
				$process_this = 0;
				break;
			default:
				//check if the link starts with the following patterns
				if (substr($link, 0, 1) == '/') {
					$process_this = 0;
				} else if (stristr($link, 'https://')) {
					$process_this = 1;
				} else if (stristr($link, 'http://')) {
					$process_this = 1;
				}
		}

		if (!$process_this) {
			//Check next link
			continue;
		}

		$prev_link = $m_links[0][$mctr];
		$new_link = $top_frame . $link;
		$new_link .= '" target="_blank';

		$replaced = str_replace($link, $new_link, $prev_link);

		$contentx = str_replace($prev_link, $replaced, $contentx);
	}

	return $contentx;
}

