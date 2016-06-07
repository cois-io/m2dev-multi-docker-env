<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/info-styles.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/t.ico" />
    <title>COIS :: &#60;PHPInfo&#62</title>
</head>
<body>
<?php
// @TODO clean this mess up
ob_start();
phpinfo();
$content = ob_get_contents();
ob_end_clean();
$pinfo = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $content);
echo $pinfo;
?>
</body>
</html>