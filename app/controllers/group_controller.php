<?php

  class GroupController extends BaseController{
    public static function index(){
      $groups = Group::all();

      View::make('group/index.html', array('groups' => $groups));
    }

    public static function create(){
      View::make('group/new.html');
    }

    public static function store(){
      $params = $_POST;
      $user = get_user_logged_in();

      $attributes = array(
        'name' => $params['name'],
        'description' => $params['description'],
      );

      $group = new Group($attributes);
      $errors = $group->errors();

      if(count($errors) == 0){
        $group->save();
        $group->add_user($user);

        Redirect::to('/group/' . $group->id, array('message' => 'Ryhmä luotu'));
      }else{
        View::make('group/new.html', array('errors' => $errors, 'attributes' => $attributes));
      }
    }

    public static function show($id){
      $group = Group::find($id);

      View::make('group/show.html', array('group' => $group));
    }

    public static function destroy($id){
      $group = new Group(array('id' => $id));
      $group->destroy();

      Redirect::to('/', array('message' => 'Ryhmä tuhottu onnistuneesti!'));
    }
  }
