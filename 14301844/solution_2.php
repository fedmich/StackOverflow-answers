<?php

$repl = '<div id="fb-root"></div>';
$re_pattern = preg_quote($repl);
$source = '<div id="fb-root"></div>
codes

<div id="fb-root"></div>

aas
<div id="fb-root"></div>
ss
<div id="fb-root"></div>
';

preg_match("@$re_pattern@i", $source, $matches, PREG_OFFSET_CAPTURE);
$result = preg_replace("@$re_pattern@i", "", $source);
$result = substr_replace($result, $matches[0][0], $matches[0][1], 0);

//check result
echo nl2br(htmlspecialchars($source));
echo '<hr />';
echo nl2br(htmlspecialchars($result));