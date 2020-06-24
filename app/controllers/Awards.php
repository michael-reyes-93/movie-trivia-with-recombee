<?php
  class Awards extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->eventModel = $this->model('Event');
      // $this->personModel = $this->model('Person');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      // Get Persons
      // $persons = $this->personModel->getPersons();

      // $data = [
      //   'persons' => $persons,
      //   //'movie_titles' => $movie_titles
      // ];

      // $this->view('persons/index', $data);
      $this->view('awards/index');

    }

    public function show($id, $page = 0) {
      // $person = $this->personModel->getPersonById($id); 

      // $data = [
      //   'person' => $person
      // ];

      $this->view('persons/show', $data);
    }

    public function add() {

      $test = 1;
      $eventsList = $this->eventModel->getEvents();

      // $data['awards_array'] = array_map("clean_data", preg_split("/(\w*and\w*|[,]+)/",  $data['awards'] ) );
      
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'awards' => !empty($_POST['award']) ? $_POST['award'] : [],
          'event' => !empty($_POST['event']) ? (int)$_POST['event'] : '',
          'event_list' => $eventsList
          // 'born' => trim($_POST['born']),
          // 'biography' => trim($_POST['biography']),
          // 'photo' => $_POST['photo'],
          // 'role' => empty($_POST['role']) ? [] : $_POST['role'],
          // 'name_err' => '',
          // 'born_err' => '',
          // 'biography_err' => '',
          // 'photo_err' => '',
          // 'role_err' => ''
        ];

        // Validate data
        if (empty($data['awards'])) {
          $data['award_err'] = 'Please select award';
        }
        if (empty($data['event'])) {
          $data['event_err'] = 'Please select event';
        }  
        // if (empty($data['biography'])) {
        //   $data['biography_err'] = 'Please enter a biography';
        // }
        // if (!empty($_FILES['uploaded_photo']['name'])) {
        //   $data['photo'] = $_FILES['uploaded_photo']['name'];
        // }
        // if (empty($data['photo'])) {
        //   $data['photo_err'] = 'Please upload a photo';
        // }
        // if (empty($data['role'])) {
        //   $data['role_err'] = 'Please select one or various roles';
        // }

        // Make sure no errors
        if (empty($data['award_err']) &&
            empty($data['event_err']) &&
            $test != 0
            // empty($data['born_err']) &&
            // empty($data['biography_err']) &&
            // empty($data['photo_err']) &&
            // empty($data['role_err'])
        ){
          // Validated
          // if ($this->personModel->addPerson($data)) {
          //   flash('person_message', 'Person Added');
          //   redirect('persons');
          // }
          echo '<pre>';
          print_r($data);
          echo '</pre>';
          echo "something:  " .  in_array($test,  $data['awards']);
          $this->view('awards/add', $data);
        } else {
          // Load view with errors
          $this->view('awards/add', $data);
        }

      } else {

        $data = [
          'awards' => [],
          'event' => '',
          'event_list' => $eventsList
          // 'born' => '',
          // 'biography' => '',
          // 'photo' => '',
          // 'role' => []
        ];


        $this->view('awards/add', $data);
      }

      echo '<pre>';
      print_r($data);
      echo '</pre>';
      for($i = 0; $i < count($eventsList); ++$i) {
        echo $eventsList[$i]->awards . "<br>";
      }
      //echo $eventsList[0]->awards;
      $this->view('awards/add');
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
  }