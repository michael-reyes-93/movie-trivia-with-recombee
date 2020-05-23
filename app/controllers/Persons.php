<?php
  class Persons extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->personModel = $this->model('Person');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      // Get Persons
      $persons = $this->personModel->getPersons();

      $data = [
        'persons' => $persons,
        //'movie_titles' => $movie_titles
      ];

      $this->view('persons/index', $data);

    }

    public function add() {
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'born' => trim($_POST['born']),
          'biography' => trim($_POST['biography']),
          'photo' => $_POST['photo'],
          'role' => empty($_POST['role']) ? [] : $_POST['role'],
          'name_err' => '',
          'born_err' => '',
          'biography_err' => '',
          'photo_err' => '',
          'role_err' => ''
        ];

        // Validate data
        if (empty($data['name'])) {
          $data['name_err'] = 'Please enter name';
        }
        if (empty($data['born'])) {
          $data['born_err'] = 'Please enter brith information';
        }  
        if (empty($data['biography'])) {
          $data['biography_err'] = 'Please enter a biography';
        }
        if (!empty($_FILES['uploaded_photo']['name'])) {
          $data['photo'] = $_FILES['uploaded_photo']['name'];
        }
        if (empty($data['photo'])) {
          $data['photo_err'] = 'Please upload a photo';
        }
        if (empty($data['role'])) {
          $data['role_err'] = 'Please select one or various roles';
        }

        // $check = @getimagesize($_FILES['photo']['tmp_name']);
        // if ($check === false) {
        //   $data['poster_err'] = 'Please upload a photo for the actor';
        // }
        
        // if ($check !== false){
        //     $carpeta_destino = 'fotos/';
        //     $archivo_subido = $carpeta_destino . $_FILES['foto']['name'];
        //     move_uploaded_file($_FILES['foto']['tmp_name'], $archivo_subido);

        //     $statement = $conexion->prepare('INSERT INTO fotos (titulo, imagen, texto) VALUES (:titulo, :imagen, :texto)');
        //     $statement->execute(array(':titulo' => $_POST['titulo'], ':imagen' => $_FILES['foto']['name'], ':texto' => $_POST['texto']));
        
        //     header('Location: index.php');
        // } else {
        //   $error = "El archivo no es una imagen o el archivo es muy pesado";
        // }
        // if (empty($data['story'])) {
        //   $data['story_err'] = 'Please enter description text';
        // }

        // Make sure no errors
        if (empty($data['name_err']) && 
            empty($data['born_err']) &&
            empty($data['biography_err']) &&
            empty($data['photo_err']) &&
            empty($data['role_err']))
        {
          // $folder = 'img/';
          // $uploaded_file = $folder . $_FILES['photo']['name'];
          // move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file);
          // Validated
          if ($this->personModel->addPerson($data)) {
            flash('post_message', 'Person Added');
            redirect('persons');
          }
        } else {
          // Load view with errors
          $this->view('persons/add', $data);
        }

      } else {

        //$movie_titles = $this->movieModel->getMoviesTitleWithId();

        $data = [
          'name' => '',
          'born' => '',
          'biography' => '',
          'photo' => '',
          'role' => []
          //'movie_titles' => $movie_titles
        ];

        $this->view('persons/add', $data);
      }
    }

  }