<?php
date_default_timezone_set('America/El_Salvador');
setlocale(LC_TIME, 'spanish');
echo '<br/>'.utf8_encode(strftime("%A %#d de %B del %Y"));