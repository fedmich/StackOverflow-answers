<?php

$source = '<div id="fb-root"></div>
codes

<div id="fb-root"></div>

aas
<div id="fb-root"></div>
ss
<div id="fb-root"></div>
';

$repl = '<div id="fb-root"></div>';
$re_pattern = preg_quote($repl);

function replace_2nd($a) {
	static $count = 0;
	if (++$count > 1) {
		return null;
	}
	$args = func_get_arg(0);
	return $args[0];
}

$result = preg_replace_callback("@$re_pattern@i", 'replace_2nd', $source);

echo nl2br(htmlspecialchars($source));
echo '<hr />';
echo nl2br(htmlspecialchars($result));
