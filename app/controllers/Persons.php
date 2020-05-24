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

    public function show($id, $page = 0) {
      $person = $this->personModel->getPersonById($id); 

      $data = [
        'person' => $person
      ];

      $this->view('persons/show', $data);
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
            flash('person_message', 'Person Added');
            redirect('persons');
          }
        } else {
          // Load view with errors
          $this->view('persons/add', $data);
        }

      } else {

        $data = [
          'name' => '',
          'born' => '',
          'biography' => '',
          'photo' => '',
          'role' => []
        ];

        $this->view('persons/add', $data);
      }
    }

    public function edit($id) {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'name' => trim($_POST['name']),
          'born' => trim($_POST['born']),
          'biography' => trim($_POST['biography']),
          'photo' => $_POST['photo'],
          'is_actor' => in_array(1, $_POST['role']) ? 1 : 0,
          'is_producer' => in_array(2, $_POST['role']) ? 1 : 0,
          'is_director' => in_array(3, $_POST['role']) ? 1 : 0,
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

        // Make sure no errors
        if (empty($data['name_err']) && 
            empty($data['born_err']) &&
            empty($data['biography_err']) &&
            empty($data['photo_err']) &&
            empty($data['role_err'])
        ) {
          $folder = 'img/';
          $uploaded_file = $folder . $_FILES['uploaded_photo']['name'];
          move_uploaded_file($_FILES['uploaded_photo']['tmp_name'], $uploaded_file);

          print_r($data);

          // Validated
          if ($this->personModel->updatePerson($data)) {
            flash('person_message', 'Person Updated');
            redirect('persons');
          }
        } else {
          // Load view with errors
          $this->view('persons/edit', $data);
        }

      } else {
        $roles = [];

        // Get existing post from model
        $person = $this->personModel->getPersonById($id); 

        // Check for owner
        // if ($post->user_id != $_SESSION['user_id']) {
        //   redirect('posts');
        // }
        $file = URLROOT . '/img/' . $person->photo;
        echo $file;

        $data = [
          'id' => $id,
          'name' => $person->name,
          'born' => $person->born,
          'biography' => $person->biography,
          'photo' => '',
          'is_actor' => $person->is_actor,
          'is_producer' => $person->is_producer,
          'is_director' => $person->is_director,
          'role' => $roles
        ];

        if (!@GetImageSize($file)) {
          $data['photo_err'] = 'Please upload a photo';
        } else {
          $data['photo'] = $person->photo;
        }

        print_r($person);
        $this->view('persons/edit', $data);
      }
    }

  }