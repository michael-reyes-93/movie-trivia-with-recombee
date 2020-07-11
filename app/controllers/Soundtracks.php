<?php
  class Soundtracks extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->soundtrackModel = $this->model('Soundtrack');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      // Get Soundtracks
      
      $soundtracks = '';

      $data = [
        'soundtracks' => $soundtracks,
      ];

      $this->view('soundtracks/index', $data);

    }

    public function add() {
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'selection_singer_group' => (int)$_POST['selection_singer_group'] > 2 ? 0 : (int)$_POST['selection_singer_group'],
          'name_singer_group' => trim($_POST['name_singer_group']),
          'duration' => $_POST['duration'],
          'name_err' => '',
          'selection_singer_group_err' => '',
          'name_singer_group_err' => '',
          'duration_err' => '',
        ];

        // Validate data
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter name';
        }
        if (empty($data['selection_singer_group'])) {
          $data['selection_singer_group_err'] = 'Please enter a selection';
        }  
        if (empty($data['name_singer_group'])) {
          if (!empty($data['selection_singer_group_err'])) {
            $data['name_singer_group_err'] = 'Please enter a name for the group or singer';
          } elseif ($data['selection_singer_group'] == 1) {
            $data['name_singer_group_err'] = 'Please enter a name for the singer';
          } else {
            $data['name_singer_group_err'] = 'Please enter a name for the group';
          }
        }
        if (empty($data['duration'])) {
          $data['duration_err'] = 'Please enter a duration for the song';
        }  

        // Make sure no errors
        if (empty($data['name_err']) && 
            empty($data['selection_singer_group_err']) &&
            empty($data['name_singer_group_err']) &&
            empty($data['duration_err']))
        {
          // Validated
          if ($data['selection_singer_group'] == 1) {
            if ($this->soundtrackModel->addSinger($data)) {
              flash('post_message', 'Soundtrack Added');
              redirect('soundtracks');
            }
          } else {
            if ($this->soundtrackModel->addGroup($data)) {
              flash('post_message', 'Soundtrack Added');
              redirect('soundtracks');
            }
          }
          
        } else {
          echo '<pre>';
          print_r($data);
          echo '</pre>';

          // Load view with errors
          $this->view('soundtracks/add', $data);
        }

      } else {

        $data = [
          'name' => '',
          'selection_singer_group' => 0,
          'name_singer_group' => '',
          'duration' => '',
        ];

        $this->view('soundtracks/add', $data);
      }
    }

  }