<?php

/**
 * Interprets an nginx configuration file and sends it to an array
 *
 * PHP version 5
 *
 * You will need to ensure the nginx config file is properly formatted.
 * Some requirements include:
 *  - Double-spaced or quadruple-spaced indentations only
 *  - Key/var is single spaced
 *  - No comments, unless in-line
 *  - Only "server" and "location" block headers will be detected
 *
 * The following will get the best output:
 *
 * server {
 *   root /var/www
 *   index index.php
 *
 *   location / {
 *     somekey somevar
 *     anotherkey anothervar
 *   }
 *
 *   location @rewrite something blah {
 *     morekey morevar
 *   }
 *
 *
 * @author     Matt Withoos <mattwithoos@gmail.com>
 * @license    http://opensource.org/licenses/gpl-license.php GNU GPL v3
 * @version    1.0.0
 * @link       https://github.com/mattwithoos/nginxConfigInterpreter
 */

function nginxConfigInterpreter($config_location) {

  // Sanity check - does the file exist?
  if (!file_exists($config_location)) {
    return ('<b>FATAL ERROR:</b> The file does not exist at location: '.$config_location);
  }

  // Get the raw data
  $lines = explode("\n", file_get_contents($config_location));


  // Prepare the input for validation
  foreach ($lines as $line_num=>$line) {
    $newlines[$line_num] = str_replace('  ', '', $line);
  }

  // Set a flag to indent the array deeper based on the config block name
  foreach ($newlines as $line_num=>$line) {
    if (stripos($line,'server {') !== FALSE) {
      $indent_flag = 1;
      $indent_num++;
      $server_flag = TRUE;
    }
    if (stripos($line,'location') !== FALSE) {
      $indent_flag = 2;
      $location_header = $line;
      $location_flag = TRUE;
    }

    // Begin a multi-dimensional array
    if($indent_flag == 1) {
      if (stripos($line,'server') !== FALSE) {
      } else {
        if (stripos($line,' ')) {
            $space_split = explode(' ', $line);
            $newcut['server'.$indent_num][$space_split[0]] = $space_split[1];
        }
      }
    }

    // Create an array under the Server block
    if($indent_flag == 2) {
      if (stripos($line,'location') !== FALSE) {
      } else {
        if (stripos($line,' ')) {
            $space_split = explode(' ', $line);
            $newcut['server'.$indent_num][$location_header][$space_split[0]] = $space_split[1];
        }
      }
    }
  }
  // Errors and warnings check
  if (!$server_flag) {
    return ('<b>FATAL ERROR</b>: Could not find server block. Ensure the config file contains exactly "server {" with one space.');
  }
  if (!$location_flag) {
    print '<b>WARNING</b>: Could not find location block. Check the formatting.<br><br>';
  }
  if (!isset($newcut)) {
    return ('<b>FATAL ERROR</b>: Could not convert config file to array. Check the formatting.');
  }
  return $newcut;
}
