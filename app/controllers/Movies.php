<?php
  class Movies extends Controller {

    public function __construct() {
      // if(!isLoggedIn()) {
      //   redirect('users/login');
      // }

      $this->movieModel = $this->model('Movie');
      $this->soundtrackModel = $this->model('Soundtrack');
      $this->countryModel = $this->model('Country');
      $this->genreModel = $this->model('Genre');
      $this->awardModel = $this->model('Award');
      $this->languageModel = $this->model('Language');
      $this->participantModel = $this->model('Participant');
      $this->imageModel = $this->model('Image');
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
      $genreList = $this->genreModel->getGenres();
      $moviesAwardsAvaible = $this->awardModel->getAwardsByCategory('m');
      $languagesList = $this->languageModel->getLanguages();
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'title' => trim($_POST['title']),
          'story' => trim($_POST['story']),
          'poster' => $_POST['poster'],
          'catalog_photo' => $_POST['catalog_photo'],
          'release_date' => $_POST['release_date'],
          'budget' => (float)$_POST['budget'],
          'return_of_investment' => (float)$_POST['return_of_investment'],
          'director' => !empty($_POST['director']) ? (int)$_POST['director'] : '',
          'cast' => !empty($_POST['cast']) ? $_POST['cast'] : [],
          'producers' => !empty($_POST['producers']) ? $_POST['producers'] : [],
          'soundtracks' => !empty($_POST['soundtracks']) ? $_POST['soundtracks'] : [],
          'countries' => !empty($_POST['countries']) ? $_POST['countries'] : [],
          'awards_status' =>  !empty($_POST['movie_awards']) && !empty($_POST['status']) ? $this->movie_awards($_POST['movie_awards'], $_POST['status']) : [],
          'music_director' => $_POST['music_director'],
          'rating' => (float)$_POST['rating'],
          'genres' => !empty($_POST['genres']) ? $_POST['genres'] : [],
          'original_language' => (int)$_POST['original_language'],
          'origin_country' => (int)$_POST['origin_country'],
          'streaming_on' => $_POST['streaming_on'],
          'dubbed_languages' => !empty($_POST['dubbed_languages']) ? $_POST['dubbed_languages'] : [],
          'subtitle_languages' => !empty($_POST['subtitle_languages']) ? $_POST['subtitle_languages'] : [],
          'director_list' => $directorList,
          'actor_list' => $actorList,
          'producer_list' => $producerList,
          'soundtrack_list' => $soundtrackList,
          'country_list' => $countryList,
          'genre_list' => $genreList,
          'languages_list' => $languagesList,
          'movie_awards_list' => $moviesAwardsAvaible,
          // 'user_id' => $_SESSION['user_id'],
          // 'title_err' => '',
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
        // La funcion getimagesize nos retorna un arreglo de propiedades de la imagen y si no es una imagen retorna false y un error notice.
        // Podemos utilizar el @ antes de la funcion para omitir el notice si no es una imagen.
        $check = @getimagesize($_FILES['photo']['tmp_name']);
        if ($check === false) {
          $data['poster_err'] = 'Please upload a photo for the poster';
        }
        if (!empty($_FILES['uploaded_poster']['name'])) {
          // Save images in the server
          $folder = 'img/posters/';
          $uploaded_file = $folder . $_FILES['uploaded_poster']['name'];
          move_uploaded_file($_FILES['uploaded_poster']['tmp_name'], $uploaded_file);
          // save image name in server
          $this->imageModel->addImage($_FILES['uploaded_poster']['name']);
          $data['poster'] = $_FILES['uploaded_poster']['name'];

          // $this->deleteImage('delete_image_4.jpg');
        }
        if (empty($data['poster'])) {
          $data['photo_err'] = 'Please upload a photo';
        }
        if (!empty($_FILES['uploaded_catalog_photo']['name'])) {
          // Save images in the server
          $folder = 'img/catalog/';
          $uploaded_file = $folder . $_FILES['uploaded_catalog_photo']['name'];
          move_uploaded_file($_FILES['uploaded_catalog_photo']['tmp_name'], $uploaded_file);
          // save image name in server
          $this->imageModel->addImage($_FILES['uploaded_catalog_photo']['name']);
          $data['catalog_photo'] = $_FILES['uploaded_catalog_photo']['name'];

          // $this->deleteImage('delete_image_4.jpg');
        }
        if (empty($data['catalog_photo'])) {
          $data['no_catalog_photo'] = 'http://placehold.it/341x192?text=' . (empty($data['title']) ? 'catalog photo' : $data['title']);
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
        if (empty($data['cast'])) {
          $data['cast_err'] = 'Please select cast members';
        }
        if (empty($data['producers'])) {
          $data['producers_err'] ='Please select producers involved in the movie';
        }
        if (empty($data['music_director'])) {
          $data['music_director_err'] = 'Please enter a music director name';
        }
        if (empty($data['soundtracks'])) {
          $data['soundtracks_err'] = 'Please select one or multiple soundtracks';
        }
        if (empty($data['rating'])) {
          $data['rating_err'] = 'Please enter a rating number';
        }
        if (empty($data['genres'])) {
          $data['genres_err'] = 'Please select one o more genres';
        }
        // original language err
        // origin country
        if (empty($data['original_language'])) {
          $data['original_language_err'] = 'Please enter a languaje id';
        }
        if (empty($data['origin_country'])) {
          $data['origin_country_err'] = 'Please enter a country id';
        }
        if (empty($data['streaming_on'])) {
          $data['streaming_on_err'] = 'Please enter a streaming on  option';
        }
        
        // foreach ($data['awards_status'] as $key => $award_status) {

        //   if(empty($award_status['award_id'])) {
        //     $data['awards'][$key]['award_name_err'] = 'invalid award name';
        //   }
          
        //   if($data['awards'][$key]['category'] == 'x') {
        //     $data['awards'][$key]['category_err'] = 'invalid award category';
        //   }  
        // } 

        if (empty($data['dubbed_languages'])) {
          $data['dubbed_languages_err'] = 'Please select one or more languages';
        }
        if (empty($data['subtitle_languages'])) {
          $data['subtitle_languages_err'] = 'Please select one or more languages for subtitles';
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
        if (
          empty($data['title_err']) && 
            empty($data['story_err']) &&
            empty($data['photo_err']) &&
            empty($data['release_date_err']) &&
            empty($data['budget_err']) &&
            empty($data['return_of_investment_err']) &&
            empty($data['director_err']) &&
            empty($data['cast_err']) &&
            empty($data['producers_err']) &&
            empty($data['music_director_err']) && 
            empty($data['soundtracks_err']) &&
            empty($data['rating_err']) &&
            empty($data['genres_err']) &&
            empty($data['original_language_err']) &&
            empty($data['origin_country_err']) &&
            empty($data['streaming_on_err']) &&
            empty($data['dubbed_languages_err']) &&
            empty($data['subtitle_languages_err'])
        )
        {
          // Validated
          $movie_response = $this->movieModel->addMovie($data);
          echo "<script>console.log(" . $movie_response[0] . ")</script>";
          if ($movie_response[0]) {
            if (!empty($data['awards_status'])) {
              foreach($data['awards_status'] as $award_status) {
                $this->participantModel->addParticipantToAward($award_status['status'], $movie_response[1], $award_status['award_id'], 'm');
              }
            }

            

            flash('post_message', 'Movie Added');
            redirect('movies');
          }

          $this->view('movies/add', $data);

        } else {
          // echo '<pre>';
          // print_r($data['no_catalog_photo']);
          // echo '</pre>';
          // Load view with errors
          $this->view('movies/add', $data);
        }

      } else {

        $data = [
          'title' => '',
          'story' => '',
          'poster' => '',
          'catalog_photo' => '',
          'release_date' => '',
          'budget' => '',
          'return_of_investment' => '',
          'director_list' => $directorList,
          'actor_list' => $actorList,
          'producer_list' => $producerList,
          'soundtrack_list' => $soundtrackList,
          'country_list' => $countryList,
          'genre_list' => $genreList,
          'languages_list' => $languagesList,
          'movie_awards_list' => $moviesAwardsAvaible,
          'music_director' => '',
          'rating' => '',
          'original_language' => '',
          'country' => '',
          'streaming_on' => '',
        ];

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

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

    public function movieAwardsList() {
      $new_arr = [];
      foreach($this->awardModel->getAwardsByCategory('m') as $movie_award) {
        array_push($new_arr, 
          array(
            'award_id' => $movie_award->award_id,
            'name' => $movie_award->name
          )
        );
      }

      header('Content-Type: application/json');
      $output = json_encode($new_arr);
      echo $output;
    }

    private function modal($test) {
      
      return "<script>alert(" . $test . "); </script>";
    }
    
    private function movie_awards($arr1, $arr2, $arr3 = []) {
      $new_arr = [];
      foreach( $arr1 as $key => $a ) {
        if(!empty($arr1) && !empty($arr2) && !empty($arr3)) {
          //$new_arr['id'] = ;
          array_push($new_arr, 
            array(
              'award_id' => $arr1[$key], 
              'status' => $arr2[$key],
              'id' => $key < count($arr1) - count($arr3) ? 'x' : $arr3[$key - (count($arr1) - count($arr3))]->award_id
            )
          );
        } else if (!empty($arr1) && !empty($arr2)) {
          array_push($new_arr, array(
            'award_id' => $arr1[$key], 
            'status' => $arr2[$key])
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

    private function deleteImage($image_name) {
      unlink('img/' . $image_name);
    }


  }