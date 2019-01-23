<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

print "Starting";
$output = array();
$lines = array();
$file = fopen('./data.csv', 'r');
while (($line = fgetcsv($file, 1000, "\t")) !== FALSE) {
  //$line is an array of the csv elements
  //print_r($line);
  $lines[] = $line;
}

foreach ($lines as $line) {
  
  //file_put_contents("/var/www/drupalvm/drupal/debug/auto.txt", print_r($line, TRUE), FILE_APPEND);
  file_put_contents("/var/www/work/auto.txt", print_r($line, TRUE), FILE_APPEND);
  
  $search = explode('.search.ting.', $line[0]);
  $search_string = $search[1];
  $hits = $line[2];
  $object = null;
  if (strpos($line[1], '.ting.object.') !== false) {
     $object = explode('.ting.object.', $line[1]);
  } else if (strpos($line[1], '.ting.collection.') !== false) {
     $object = explode('.ting.collection.', $line[1]);
  }
  $faust = $object[1]; 
  //print_r($object);
  if (isset($object)) {
    if (!array_key_exists($search_string, $output)) {
      $output[$search_string] = array();
    }

    if (!array_key_exists($faust, $output[$search_string])) {
      $output[$search_string][$faust] = $hits;
    } else {
      $output[$search_string][$faust] += $hits;
    }
    
  }
 
  //print_r($search);
}
 //print_r ($output);
  //file_put_contents("/var/www/drupalvm/drupal/debug/auto1.txt", print_r($output, TRUE), FILE_APPEND);
//file_put_contents("/var/www/work/auto1.txt", print_r($output, TRUE), FILE_APPEND);
file_put_contents('auto3.txt',  json_encode($output));
fclose($file);

