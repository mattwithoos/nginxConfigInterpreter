<?php

require('nginxConfigInterpreter.php');

echo "<h1>Example 1</h1> Perfect nginx config file, returns valid multi-dimensional array. <hr>";
echo "<pre>";
print_r(nginxConfigInterpreter('example1.conf'));
echo "</pre>";

echo "<h1>Example 2</h1> Valid nginx config file, but no location blocks. Returns warning + array. <hr>";
echo "<pre>";
print_r(nginxConfigInterpreter('example2.conf'));
echo "</pre>";

echo "<h1>Example 3</h1> Config file doesn't exist or can't be found. Returns error and terminates. <hr>";
echo "<pre>";
print_r(nginxConfigInterpreter('examplex.conf'));
echo "</pre>";

echo "<h1>Example 4</h1> Invalid nginx config file, no server block. Returns error and terminates. <hr>";
echo "<pre>";
print_r(nginxConfigInterpreter('example3.conf'));
echo "</pre>";
