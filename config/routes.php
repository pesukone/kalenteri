<?php

  function check_logged_in(){
    BaseController::check_logged_in();
  }

  $routes->get('/', function() {
    UserController::login();
  });

  $routes->post('/event', 'check_logged_in', function(){
    EventController::store();
  });

  $routes->get('/event/new', 'check_logged_in', function(){
    EventController::create();
  });

  $routes->get('/event/:id', 'check_logged_in', function($id){
    EventController::show($id);
  });

  $routes->get('/event/:id/edit', 'check_logged_in', function($id){
    EventController::edit($id);
  });

  $routes->post('/event/:id/edit', 'check_logged_in', function($id){
    EventController::update($id);
  });

  $routes->post('/event/:id/destroy', 'check_logged_in', function($id){
    EventController::destroy($id);
  });

  $routes->get('/user/new', function(){
    UserController::create();
  });

  $routes->post('/user/:id', 'check_logged_in', function($id){
    UserController::parse_time($id);
  });

  $routes->post('/user', function(){
    UserController::store();
  });

  $routes->get('/login', function(){
    UserController::login();
  });

  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

  $routes->get('/user/:id', 'check_logged_in', function($id){
    UserController::show($id);
  });

  $routes->get('/user/:id/:year-:month-:day', function($id, $year, $month, $day){
    UserController::events_for_day($id, $year . "-" . $month . "-" . $day);
  });

  $routes->get('/user/:id/:time', 'check_logged_in', function($id, $time){
    UserController::show_month($id, $time);
  });

  $routes->get('/group', 'check_logged_in', function(){
    GroupController::index();
  });

  $routes->post('/group', 'check_logged_in', function(){
    GroupController::store();
  });

  $routes->get('/group/new', 'check_logged_in', function(){
    GroupController::create();
  });

  $routes->get('/group/:id', 'check_logged_in', function($id){
    GroupController::show($id);
  });

  $routes->post('/group/:id/destroy', 'check_logged_in', function($id){
    GroupController::destroy($id);
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
