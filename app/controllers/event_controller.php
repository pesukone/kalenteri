<?php

  class EventController extends BaseController{
    /*public static function index(){
      parent::check_logged_in();

      $events = Event::all();
      
      View::make('event/index.html', array('events' => $events));
    }*/

    /*public static function show($id){
      parent::check_event_owner($id);
      setlocale(LC_TIME, 'fi_FI');

      $event = Event::find($id);

      View::make('event/show.html', array('event' => $event));
    }*/

    public static function create(){
      parent::check_logged_in();

      $user = parent::get_user_logged_in();
      View::make('event/new.html', array('groups' => $user->groups));
    }

    public static function store(){
      parent::check_logged_in();

      $event = self::parse_post_attributes($_POST);
      $errors = $event->errors();

      if(count($errors) == 0){
        $event->save();

        Redirect::to('/user/' . parent::get_user_logged_in()->id . '/' . $event->eventday, array('message' => 'Merkintä luotu'));
      }else{
        View::make('event/new.html', array('errors' => $errors, 'attributes' => $_POST, 'groups' => parent::get_user_logged_in()->groups));
      }
    }

    public static function edit($id){
      self::check_event_owner($id);

      $event = Event::find($id);
      $user = self::get_user_logged_in();
      View::make('event/edit.html', array('attributes' => $event, 'groups' => $user->find_groups()));
    }

    public static function update($id){
      self::check_event_owner($id);

      $event = self::parse_post_attributes($_POST);
      $event->id = $id;
      $errors = $event->errors();

      if(count($errors) > 0){
        View::make('event/edit.html', array('errors' => $errors, 'attributes' => $event));
      }else{
        $event->update();

        Redirect::to('/user/' . parent::get_user_logged_in()->id . '/' . $event->eventday, array('message' => 'Merkintää muokattu onnistuneesti!'));
      }
    }

    public static function destroy($id){
      self::check_event_owner($id);

      $event = new Event(array('id' => $id));
      $event->destroy();

      Redirect::to('/', array('message' => 'Merkintä tuhottu onnistuneesti!'));
    }

    private static function parse_post_attributes($params){
      $attributes = array(
        //'id' => $id,
        'eventday' => $params['day'],
        'eventtime' => $params['time'],
        'description' => $params['description'],
        'user' => self::get_user_logged_in(),
        'group' => is_numeric($params['group']) ? Group::find($params['group']) : null
      );

      return new Event($attributes);
    }
  }
