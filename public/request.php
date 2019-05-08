<?php

header("Content-type: text/plain");

echo "Request details\n\n";

echo "\$_SERVER\n";
print_r($_SERVER);

echo "\n\$_GET\n";
print_r($_GET);

echo "\n\$_POST\n";
print_r($_POST);