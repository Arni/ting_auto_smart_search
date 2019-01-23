<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


// In ting_search_search_execute ting_search.module line 349
 variable_set('ting_auto_keys', $keys);


//In opensearch_do_search opensearch.client.inc line 218
    $startTime = explode(' ', microtime());
    
    $data = variable_get('ting_auto_data', false);
    //file_put_contents("/var/www/drupalvm/drupal/debug/searchauto8.txt", print_r($data, TRUE), FILE_APPEND);
    if (!$data) {
      //file_put_contents("/var/www/drupalvm/drupal/debug/searchauto7.txt", print_r("ramt", TRUE), FILE_APPEND);
       $data = json_decode(file_get_contents('/var/www/work/autodata.txt'), true);
       variable_set('ting_auto_data', $data);
    }
    
  $keys = variable_get('ting_auto_keys', false);
  //file_put_contents("/var/www/drupalvm/drupal/debug/searchauto2.txt", print_r($keys, TRUE), FILE_APPEND);
  //file_put_contents("/var/www/drupalvm/drupal/debug/searchauto3.txt", print_r("ramt", TRUE), FILE_APPEND);
  $aboosts = array();
  if (array_key_exists($keys, $data)) {
    //file_put_contents("/var/www/drupalvm/drupal/debug/searchauto3.txt", print_r("ramt", TRUE), FILE_APPEND);
    $i = 0;
    $weight = 10000;
    //file_put_contents("/var/www/drupalvm/drupal/debug/searchauto6.txt", print_r($data[$keys], TRUE), FILE_APPEND);
     foreach($data[$keys] as $faust => $objects) {
        $uboosts[] =
            array (
                'fieldName' => 'term.default',
                'fieldValue' => urldecode($faust),
                'weight' => $weight,
             );
        $weight = $weight - 1000;
        $i += 1;
        if ($i > 4) {
          break;
        }
      }
      //file_put_contents("/var/www/drupalvm/drupal/debug/searchauto5.txt", print_r($aboosts, TRUE), FILE_APPEND);
  }   
    $stopTime = explode(' ', microtime());
        $time = floatval(($stopTime[1]+$stopTime[0]) - ($startTime[1]+$startTime[0]));
        var_dump($time);
    $request->userDefinedBoost = $uboosts;
    file_put_contents("/var/www/drupalvm/drupal/debug/searchauto3.txt", print_r($request, TRUE), FILE_APPEND);
  }

