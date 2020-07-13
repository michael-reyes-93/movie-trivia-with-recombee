<?php
  class Events extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->eventModel = $this->model('Event');
      $this->awardModel = $this->model('Award');
      $this->movieModel = $this->model('Movie');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      $num_rows = $this->eventModel->getNumOfMovies()->num_rows;
      paginationOptions(array('num_rows' => $num_rows, 'rows_per_page' => 5));
      // Get Events
      $events = $this->eventModel->getEventsPerPage(getLimitPerPage(1));

      $data = [
        'events' => $events,
        'url' => URLROOT . '/events/eventsPerPageToArray'
        //'movie_titles' => $movie_titles
      ];
  
      $this->view('events/index', $data);
    }

    public function show($id, $page = 0) {
      $event = $this->eventModel->getEventById($id); 
      $awards = $this->awardModel->getAwardsByEventId($id);
      $movies = $this->movieModel->getMovies();
      $actors = $this->movieModel->getActors();
      $directors = $this->movieModel->getDirectors();
      $producers = $this->movieModel->getProducers();
      $participants = $this->awardModel->getParticipantsInAwardsByEventId($id);

      $data = [
        'event_id' => $id,
        'event' => $event,
        'awards' => $awards,
        'movies' => $movies,
        'actors' => $actors,
        'directors' => $directors,
        'producers' => $producers,
        'participants' => $participants
      ];

      echo '<pre>';
      print_r($awards);
      echo '</pre>';

      // array_map("clean_data", preg_split("/(\w*and\w*|[,]+)/",  $event->awards ) )

      $this->view('events/show', $data);
    }

    public function add() {
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'year' => $_POST['year'],
          'awards' => $this->awards_category($_POST['award_name_list'], $_POST['category_list'])
        ];

        // Validate data
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter name';
        }

        if (empty($data['year'])) {
          $data['year_err'] = 'Please enter year of the event';
        }

        print_r($data['awards']);
        foreach ($data['awards'] as $key => $value) {
          // $arr[3] will be updated with each value from $arr...

          if(empty($data['awards'][$key]['name'])) {
            $data['awards'][$key]['award_name_err'] = 'invalid award name';
          }
          
          if($data['awards'][$key]['category'] == 'x') {
            $data['awards'][$key]['category_err'] = 'invalid award category';
          }
        }

        // Make sure no errors
        if (empty($data['name_err']) &&
            empty($data['year_err']) &&
            $this->checkErrors($data['awards']))
        {
          $event_response = $this->eventModel->addEvent($data);
          $results = [];
          if ($event_response[0]) {

            $event_id = $event_response[1];
            array_push($results, $this->awardModel->addAwards($event_id, $data['awards']));
            if (in_array(true, $results)) {
              flash('event_message', 'Event Added');
              redirect('events');
            }
          }

        } else {
          // $data['awards_array'] = array_map("clean_data", preg_split("/(\w*and\w*|[,]+)/",  $data['awards'] ) );

          //$data['new_array'] = $this->awards_category($data['award_list'], $data['category_list']);

          echo '<pre>';
          print_r($data);
          echo '</pre>';

          // Load view with errors
          $this->view('events/add', $data);
        }

      } else {

        $data = [
          'name' => '',
          'year' => '',
          'awards' => '',
          'awards2' => '',
          'award_list' => []
        ];

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        $this->view('events/add', $data);
      }
    }

    public function edit($id) {
      $awards = $this->awardModel->getAwardsByEventId($id);

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $awards_actions_to_do = [];
        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'year' => trim($_POST['year']),
          'awards' => [],
        ];
        
        // check the list of awards have the name and the category, then assign the new list to get checked and be used
        if (!empty($_POST['award_name_list']) || !empty($_POST['category_list'])) {
          // new_data contains the data submitted
          $new_data_and_actions = $this->awards_category($_POST['award_name_list'], $_POST['category_list'], $_POST['ids'], $_POST['status']);
          $data['awards'] = $new_data_and_actions['new_data'];
          $awards_actions_to_do = $new_data_and_actions['actions'];
          //$data['awards_removed'] = $this->awards_category($_POST['award_name_list'], $_POST['category_list'])['deleted_ids'];
        }

        // Validate data
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter name';
        }

        if (empty($data['year'])) {
          $data['year_err'] = 'Please enter year of the event';
        }

        foreach ($data['awards'] as $key => $value) {
          // $arr[3] will be updated with each value from $arr...

          if ($data['awards'][$key]['status'] != 'deleted') {
            if(empty($data['awards'][$key]['name'])) {
              $data['awards'][$key]['award_name_err'] = 'invalid award name';
            }
            
            if($data['awards'][$key]['category'] == 'x') {
              $data['awards'][$key]['category_err'] = 'invalid award category';
            }
          }
        }

        $test = 0;
        // Make sure no errors
        if (empty($data['name_err']) &&
            empty($data['year_err']) &&
            $this->checkErrors($data['awards']))
        {

          if (!empty($awards_actions_to_do['update'])) {
            foreach($awards_actions_to_do['update'] as $award_update) {
              $this->awardModel->updateAwardsByEventId($award_update['new_name'], $award_update['new_category'], $award_update['id']);
            }
          }
          if (!empty($awards_actions_to_do['delete'])) {
            foreach($awards_actions_to_do['delete'] as $award_delete) {
              $this->awardModel->deleteAwardFromEvent($award_delete['id'], $award_delete['category']);
            }
          }
          if (!empty($awards_actions_to_do['insert'])) {
            foreach($awards_actions_to_do['insert'] as $award_add) {
              $this->awardModel->addAwardToEvent($award_add['name'], $award_add['category'], $id);
            }
          }

          $results = [];
          // if ($this->eventModel->updateEvent($data)) {

          //   array_push($results, $this->awardModel->updateAwards($id, $data['awards']));
          //   if (in_array(true, $results)) {
          //     flash('event_message', 'Event Updated');
          //     redirect('events');
          //   }
          // }
          
          flash('event_message', 'Event Updated');
          redirect('events');
        } else {
                    
          // $subtitle_languages_actions_to_do = $this->updateArraysInDB($this->languagesToArray($subtitle_languages), $data['subtitle_languages']);
          echo '<pre>';
          echo "errors: " . '<br>';
          print_r($this->checkErrors($data['awards']));
          print_r($awards_actions_to_do);
          echo '</pre>';

          // Load view with errors
          $this->view('events/edit', $data);
        }

      } else {

        // Get existing post from model
        $event = $this->eventModel->getEventById($id); 

        // Check for owner
        // if ($post->user_id != $_SESSION['user_id']) {
        //   redirect('posts');
        // }
        // $file = URLROOT . '/img/' . $person->photo;
        // echo $file;

        $data = [
          'id' => $id,
          'awards' => $awards,
          'name' => $event->name,
          'year' => $event->year
        ];

        echo '<pre>';
        print_r($awards);
        print_r($data);
        echo '</pre>';

        $this->view('events/edit', $data);
      }

    }

    public function eventsPerPageToArray() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_arr = ['titles' => [], 'table_data' => []];

        $new_arr['titles'] = array('Name', 'Year', 'Edit', 'View', 'Delete');

        $eventsPerPage = $this->eventModel->getEventsPerPage(getLimitPerPage((int)$_POST['page']));
        foreach($eventsPerPage as $event) {
          $table_row = '<tr><th>' . $event->name . '</th><td>' . $event->year . '</td><td><a href="' . URLROOT . '/events/edit/' . $event->event_id . '" class="btn btn-primary"><i class="far fa-edit"></i></a></td><td><a href="' . URLROOT . '/events/show/' . $event->event_id . '" class="btn btn-primary"><i class="far fa-eye"></i></a></td><td><a href="' . URLROOT . '/events/delete/' . $event->event_id . '" class="btn btn-danger"><i class="far fa-trash-alt"></i></a></td></tr>';
          array_push($new_arr['table_data'], $table_row);
        }

        header('Content-Type: application/json');
        $output = json_encode($new_arr);
        echo $output;
      } else {
        // no post executed
      }
    }

    private function awards_category($arr1, $arr2, $id = [], $status = []) {
      $new_arr = !empty($id) ? array('new_data' => [], 'actions' => array('update' => [], 'insert' => [], 'delete' => [])) : [];
      // $new_arr = [];

      // echo '<pre>';
      // print_r($arr1);
      // print_r($arr2);
      // print_r($id);
      // print_r($status);
      // echo '</pre>';

      foreach( $arr1 as $key => $a ) {
        // here we take the third array that is the awards for the event in the edit method, so we can get what are ids are missing,
        // in the private method updateAwardsInDB we use the ids to know what ids going to be eliminated.
        if(!empty($id) && !empty($status)) {

          // here the array 1 is compared to array 3, the names or category will always have the same count so in case there is a new 
          // name or category, that id won't be there because the information get using the event_id throw there is new names and categories
          // in this way we can't extract all the ids before they changed, so the ids can help to know what id is missing in the new data 
          // and delete the registries missing in DB, in case there is not any id missing won't affect
          if ($status[$key] == 'updated') {
            array_push($new_arr['new_data'], array('name' => $arr1[$key], 'category' => $arr2[$key], 'id' => $id[$key], 'status' => 'updated'));
            array_push($new_arr['actions']['update'], array('new_name' => $arr1[$key], 'new_category' => $arr2[$key], 'id' => $id[$key]));
          }          

          if ($status[$key] == 'new') {
            array_push($new_arr['new_data'], array('name' => $arr1[$key], 'category' => $arr2[$key], 'id' => 'x', 'status' => 'new'));
            array_push($new_arr['actions']['insert'], array('name' => $arr1[$key], 'category' => $arr2[$key], 'id' => $id[$key]));
          }
          
          if ($status[$key] == 'deleted') {
            array_push($new_arr['new_data'], array('name' => '', 'category' => $arr2[$key], 'id' => $id[$key], 'status' => 'deleted'));
            array_push($new_arr['actions']['delete'], array('id' => $id[$key], 'category' => $arr2[$key]));
          }


        } else {
          array_push($new_arr, array(
            'name' => $arr1[$key], 
            'category' => $arr2[$key])
          );
        }
      }
  
      return $new_arr;
    }

    private function checkErrors($arr) {
      $results = [];

      foreach ($arr as $award) {

        if(empty($award['award_name_err']) && empty($award['category_err'])) {
          array_push($results, 'true');
        } else {
          array_push($results, 'false');
        }
      }        

      return in_array('false', $results) ? false : true;
    }

    private function test($number = 0) {
      return array(1, 2, 3, 4, 5);
    }

    private function awardsToArray($awards) {
      // table_ids are from the many to many table so is easier to update, insert and delete in it
      $new_arr = [];
      foreach($awards as $award) {
        array_push($new_arr, array('award_id' => $award->award_id));
      }
      return $new_arr;
    }

    private function updateAwardsInDB($old_data, $new_data, $ids) {
      $new_arr = array('update' => [], 'insert' => [], 'delete' => []);
      $limit = count($ids);
      $second_limit = (int)abs(count($old_data) - count($ids));
      $action_to_do = (count($old_data) > count($ids)) ? 'd' : 'i';
      $aux = -1;
      // echo '<h1>Limit: ' . $limit . '</h1>';

      // updates
      for ($i = 0; $i < $limit; $i++) {
        array_push($new_arr['update'], array('award_id' => $ids[$i], 'new_name' => $new_data[$i]['name'], 'new_category' => $new_data[$i]['category']));
      } 

      // echo '<h1>' . array_diff( )
      for ($j = 0; $j < $second_limit; $j++) {
        if ($action_to_do == 'i') {
          array_push($new_arr['insert'], $new_data[$j]);
        } 
        if ($action_to_do == 'd') {
          array_push($new_arr['delete'], array('award_id' => $ids[$j], 'category' => 'm'));
        }
      }

      return $new_arr;
    }
  }

