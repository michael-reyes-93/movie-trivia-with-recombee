<?php
  class Events extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->eventModel = $this->model('Event');
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

      $data = [
        'event_id' => $id,
        'event' => $event,
        'awards' => array_map("clean_data", preg_split("/(\w*and\w*|[,]+)/",  $event->awards ) )
      ];

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
            $this->checkErrors($data['awards'])){
          if ($this->eventModel->addEvent($data)) {
            flash('event_message', 'Event Added');
            redirect('events');
          }

          $this->view('events/add', $data);
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

    //   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     // Sanitize POST array
    //     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //     $data = [
    //       'id' => $id,
    //       'name' => trim($_POST['name']),
    //       'born' => trim($_POST['born']),
    //       'biography' => trim($_POST['biography']),
    //       'photo' => $_POST['photo'],
    //       'is_actor' => in_array(1, $_POST['role']) ? 1 : 0,
    //       'is_producer' => in_array(2, $_POST['role']) ? 1 : 0,
    //       'is_director' => in_array(3, $_POST['role']) ? 1 : 0,
    //       'role' => empty($_POST['role']) ? [] : $_POST['role'],
    //       'name_err' => '',
    //       'born_err' => '',
    //       'biography_err' => '',
    //       'photo_err' => '',
    //       'role_err' => ''
    //     ];

    //     // Validate data
    //     if (empty($data['name'])) {
    //       $data['name_err'] = 'Please enter name';
    //     }
    //     if (empty($data['born'])) {
    //       $data['born_err'] = 'Please enter brith information';
    //     }  
    //     if (empty($data['biography'])) {
    //       $data['biography_err'] = 'Please enter a biography';
    //     }
    //     if (!empty($_FILES['uploaded_photo']['name'])) {
    //       $data['photo'] = $_FILES['uploaded_photo']['name'];
    //     }
    //     if (empty($data['photo'])) {
    //       $data['photo_err'] = 'Please upload a photo';
    //     }
    //     if (empty($data['role'])) {
    //       $data['role_err'] = 'Please select one or various roles';
    //     }

    //     // Make sure no errors
    //     if (empty($data['name_err']) && 
    //         empty($data['born_err']) &&
    //         empty($data['biography_err']) &&
    //         empty($data['photo_err']) &&
    //         empty($data['role_err'])
    //     ) {
    //       $folder = 'img/';
    //       $uploaded_file = $folder . $_FILES['uploaded_photo']['name'];
    //       move_uploaded_file($_FILES['uploaded_photo']['tmp_name'], $uploaded_file);

    //       print_r($data);

    //       // Validated
    //       if ($this->personModel->updatePerson($data)) {
    //         flash('person_message', 'Person Updated');
    //         redirect('persons');
    //       }
    //     } else {
    //       // Load view with errors
    //       $this->view('persons/edit', $data);
    //     }

    //   } else {
    //     $roles = [];

    //     // Get existing post from model
    //     $person = $this->personModel->getPersonById($id); 

    //     // Check for owner
    //     // if ($post->user_id != $_SESSION['user_id']) {
    //     //   redirect('posts');
    //     // }
    //     $file = URLROOT . '/img/' . $person->photo;
    //     echo $file;

    //     $data = [
    //       'id' => $id,
    //       'name' => $person->name,
    //       'born' => $person->born,
    //       'biography' => $person->biography,
    //       'photo' => '',
    //       'is_actor' => $person->is_actor,
    //       'is_producer' => $person->is_producer,
    //       'is_director' => $person->is_director,
    //       'role' => $roles
    //     ];

    //     if (!@GetImageSize($file)) {
    //       $data['photo_err'] = 'Please upload a photo';
    //     } else {
    //       $data['photo'] = $person->photo;
    //     }

    //     print_r($person);
    //     $this->view('persons/edit', $data);
    //   }

      $this->view('persons/edit');
    }

    private function awards_category($arr1, $arr2) {
      $new_arr = [];
      foreach( $arr1 as $key => $a ) {
        array_push($new_arr, array(
          'name' => $arr1[$key], 
          'category' => $arr2[$key])
        );
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

