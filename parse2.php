<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$data = json_decode(file_get_contents('/var/www/drupalvm/drupal/debug/auto3.txt'), true);
//file_put_contents("/var/www/drupalvm/drupal/debug/auto4.txt", print_r($my_arr, TRUE), FILE_APPEND);

$output = array();
foreach ($data as $search => $objects) {
  arsort($objects);
  $output[$search] = array_slice($objects, 0, 1000);
}

file_put_contents("/var/www/drupalvm/drupal/debug/auto5.txt", print_r($data, TRUE), FILE_APPEND);
file_put_contents("/var/www/drupalvm/drupal/debug/auto6.txt", print_r($output, TRUE), FILE_APPEND);
file_put_contents('/var/www/drupalvm/drupal/debug/autodata.txt',  json_encode($output));

