<?php

require_once 'Route.php';

Route::set('index.php', function() {
  print "index !!!!!!";
  //Controller::renderView('index');
});

Route::set('inscription', function() {
  Controller::renderView('inscription');
});
