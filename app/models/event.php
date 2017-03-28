<?php

  class Event extends BaseModel{

    public $id, $eventday, $eventtime, $description, $registered_id, $eventgroup_id;

    public function __construct($attributes){
      parent::__construct($attributes);
    }

    public static function all(){
      $query = DB::connection()->prepare('SELECT * FROM Event');
      $query->execute();
      $rows = $query->fetchAll();
      $events = array();

      foreach($rows as $row){
        $events[] = new Event(array(
	  'id' => $row['id'],
	  'eventday' => $row['eventday'],
	  'eventtime' => $row['eventtime'],
	  'description' => $row['description'],
	  'registered_id' => $row['registered_id'],
	  'eventgroup_id' => $row['eventgroup_id']
	));
      }

      return $events;
    }

    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Event WHERE id = :id LIMIT 1');
      $query->execute(array(':id' => $id));
      $row = $query->fetch();

      if($row){
	$event = new Event(array(
	  'id' => $row['id'],
	  'name' => $row['name']
	));

	return $event;
      }

      return null;
  }
