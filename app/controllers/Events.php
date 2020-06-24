<?php
  class Events extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->eventModel = $this->model('Event');
      $this->awardModel = $this->model('Award');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      // Get Events
      $events = $this->eventModel->getEvents();

      $data = [
        'events' => $events
        //'movie_titles' => $movie_titles
      ];
  
      $this->view('events/index', $data);
    }

    public function show($id, $page = 0) {
      $event = $this->eventModel->getEventById($id); 
      $awards = $this->awardModel->getAwards($id);

      $data = [
        'event_id' => $id,
        'event' => $event,
        'awards' => $awards
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
          'awards2' => $_POST['awards2'],
          'awards' => $this->awards_category($_POST['award_name_list'], $_POST['category_list'])
        ];

        // Validate data
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter name';
        }

        if (empty($data['year'])) {
          $data['year_err'] = 'Please enter year of the event';
        }

        if (empty($data['awards2'])) {
          $data['awards_err'] = 'Please enter awards';
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
      $awards = $this->awardModel->getAwards($id);

      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     // Sanitize POST array
    //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'year' => trim($_POST['year']),
          'awards' => $this->awards_category($_POST['award_name_list'], $_POST['category_list'], $awards)
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
          $results = [];
          if ($this->eventModel->updateEvent($data)) {

            array_push($results, $this->awardModel->updateAwards($id, $data['awards']));
            if (in_array(true, $results)) {
              flash('event_message', 'Event Updated');
              redirect('events');
            }
          }

        } else {
                    
          echo '<pre>';
          print_r($awards);
          print_r($data);
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

        // if (!@GetImageSize($file)) {
        //   $data['photo_err'] = 'Please upload a photo';
        // } else {
        //   $data['photo'] = $person->photo;
        // }

        $this->view('events/edit', $data);
      }

    }

    private function awards_category($arr1, $arr2, $arr3 = []) {
      $new_arr = [];
      foreach( $arr1 as $key => $a ) {
        if(!empty($arr3)) {
          //$new_arr['id'] = ;
          array_push($new_arr, 
            array(
              'name' => $arr1[$key], 
              'category' => $arr2[$key],
              'id' => $key < count($arr1) - count($arr3) ? 'x' : $arr3[$key - (count($arr1) - count($arr3))]->award_id
            )
          );
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

        if(empty($award['award_name_err'])) {
          array_push($results, true);
        } 
        if(empty($award['category_err'])) {
          array_push($results, true);
        } else {
          array_push($results, false);
        }
      }        

      return in_array(false, $results) ? false : true;
    }
  }

