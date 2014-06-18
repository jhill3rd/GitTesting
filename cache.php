<?php
$html = file_get_contents('http://freemarketcafe.com/index.php');
file_put_contents('cache/homepage.html',$html);
