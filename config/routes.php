<?php

$routes->get('/', function() {
  UserController::create();
});

$routes->post('/event', function(){
  EventController::store();
});

$routes->get('/event/new', function(){
  EventController::create();
});

$routes->get('/event/:id', function($id){
  EventController::show($id);
});


$routes->get('/user/:id', function($id){
  UserController::show($id);
});

$routes->get('/user/:id/:date', function($id, $date){
  UserController::list_events($id, $date);
});

$routes->get('/hiekkalaatikko', function() {
  HelloWorldController::sandbox();
});

$routes->get('/suunnitelmat/calendar', function() {
  HelloWorldController::calendar_show();
});

$routes->get('/suunnitelmat/event/new', function() {
  HelloWorldController::event_new();
});

$routes->get('/suunnitelmat/event/1', function() {
  HelloWorldController::event_show();
});

$routes->get('/suunnitelmat/register', function() {
  HelloWorldController::registered_new();
});
