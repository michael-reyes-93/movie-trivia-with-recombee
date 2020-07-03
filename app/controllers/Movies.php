<?php
  class Movies extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->movieModel = $this->model('Movie');
      $this->soundtrackModel = $this->model('Soundtrack');
      $this->countryModel = $this->model('Country');
      $this->categoryModel = $this->model('Category');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      // Get Movies
      //$posts = $this->postModel->getPosts();
      $movies = $this->movieModel->getMovies();
      $top5Movies = $this->movieModel->getTop5();

      $data = [
        'movies' => $movies,
        'top_5' => $top5Movies
      ];

      $this->view('movies/index', $data);

    }

    public function add() {

      $directorList = $this->movieModel->getDirectors(); 
      $actorList = $this->movieModel->getActors();
      $producerList = $this->movieModel->getProducers();
      $soundtrackList = $this->soundtrackModel->getSoundtracks();
      $countryList = $this->countryModel->getCountries();
      $categoryList = $this->categoryModel->getCategories();
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'title' => trim($_POST['title']),
          'story' => trim($_POST['story']),
          'poster' => $_POST['poster'],
          'release_date' => $_POST['release_date'],
          'budget' => (float)$_POST['budget'],
          'return_of_investment' => (float)$_POST['return_of_investment'],
          'director' => !empty($_POST['director']) ? (int)$_POST['director'] : '',
          'cast' => !empty($_POST['cast']) ? $_POST['cast'] : [],
          'producers' => !empty($_POST['producers']) ? $_POST['producers'] : [],
          'soundtracks' => !empty($_POST['soundtracks']) ? $_POST['soundtracks'] : [],
          'countries' => !empty($_POST['countries']) ? $_POST['countries'] : [],
          'music_director' => $_POST['music_director'],
          'rating' => (float)$_POST['rating'],
          'original_language' => (int)$_POST['original_language'],
          'country' => (int)$_POST['country'],
          'streaming_on' => $_POST['streaming_on'],
          'director_list' => $directorList,
          'actor_list' => $actorList,
          'producer_list' => $producerList,
          'soundtrack_list' => $soundtrackList,
          'country_list' => $countryList,
          'category_list' => $categoryList,
          // 'user_id' => $_SESSION['user_id'],
          'title_err' => '',
          'story_err' => '',
          'poster_err' => '',
          'release_date_err' => '',
          'budget_err' => '',
          'return_of_investment_err' => '',
          'director_err' => '',
          'cast_err' => '',
          'soundtracks_err' => '',
          'music_director_err' => '',
          'rating_err' => '',
          'original_language_err' => '',
          'country_err' => '',
          'streaming_on_err' => ''
        ];

        // Validate data
        if (empty($data['title'])) {
          $data['title_err'] = 'Please enter title';
        }
        if (empty($data['story'])) {
          $data['story_err'] = 'Please enter description text';
        }
        $check = @getimagesize($_FILES['photo']['tmp_name']);
        if ($check === false) {
          $data['poster_err'] = 'Please upload a photo for the poster';
        }
        if (empty($data['release_date'])) {
          $data['release_date_err'] = 'Please choose a date';
        }
        if (empty($data['budget'])) {
          $data['budget_err'] = 'Please enter a budget';
        }
        if (empty($data['return_of_investment'])) {
          $data['return_of_investment_err'] = 'Please enter a return of investment';
        }
        if (empty($data['director'])) {
          $data['director_err'] = 'Please enter a director id';
        }
        if (empty($data['music_director'])) {
          $data['music_director_err'] = 'Please enter a music director name';
        }
        if (empty($data['rating'])) {
          $data['rating_err'] = 'Please enter a rating number';
        }
        if (empty($data['original_language'])) {
          $data['original_language_err'] = 'Please enter a languaje id';
        }
        if (empty($data['country'])) {
          $data['country_err'] = 'Please enter a country id';
        }
        if (empty($data['streaming_on'])) {
          $data['streaming_on_err'] = 'Please enter a streaming on  option';
        }
        
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
        if (empty($data['title_err']) && 
            empty($data['story_err']) &&
            empty($data['photo_err']) &&
            empty($data['release_date_err']) &&
            empty($data['budget_err']) &&
            empty($data['return_of_investment_err']) &&
            empty($data['director_err']) &&
            empty($data['music_director_err']) && 
            empty($data['rating_err']) &&
            empty($data['original_language_err']) &&
            empty($data['country_err']) &&
            empty($data['streaming_on_err']))
        {
          $folder = 'img/posters/';
          $uploaded_file = $folder . $_FILES['photo']['name'];
          move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file);
          // Validated
          if ($this->movieModel->addMovie($data)) {
            flash('post_message', 'Movie Added');
            redirect('movies');
          }
        } else {
          echo '<pre>';
          print_r($data);
          echo '</pre>';
          // Load view with errors
          $this->view('movies/add', $data);
        }

      } else {

        $data = [
          'title' => '',
          'story' => '',
          'poster' => '',
          'release_date' => '',
          'budget' => '',
          'return_of_investment' => '',
          'director_list' => $directorList,
          'actor_list' => $actorList,
          'producer_list' => $producerList,
          'soundtrack_list' => $soundtrackList,
          'country_list' => $countryList,
          'category_list' => $categoryList,
          'music_director' => '',
          'rating' => '',
          'original_language' => '',
          'country' => '',
          'streaming_on' => '',
        ];

        echo '<pre>';
        print_r($data);
        echo '</pre>';

        $this->view('movies/add', $data);
      }
    }

    public function top5Movies() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        print_r($_POST);
        echo $this->movieModel->addToTop5($_POST['movie']) . '</br>';
        //flash('participant_message', 'the participant name is incorrect', 'alert alert-danger');
        header('Content-Type: application/json');
        $output = json_encode(array('redirect' => URLROOT . '/movies/movies'));
        echo $output;
      } else {
        // $data['test'] ='testing modal';
      }
    }
    private function modal($test) {
      
      return "<script>alert(" . $test . "); </script>";
    }
    



  }