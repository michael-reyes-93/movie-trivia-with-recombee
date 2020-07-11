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
      $this->dubbedLanguageModel = $this->model('DubbedLanguage');
      $this->subtitleLanguageModel = $this->model('SubtitleLanguage');
      // $this->userModel = $this->model('User');
    }

    public function index() {
      $num_rows = $this->movieModel->getNumOfMovies()->num_rows;
      paginationOptions(array('num_rows' => $num_rows, 'rows_per_page' => 5));

      // Get Movies
      //$posts = $this->postModel->getPosts();
      $movies = $this->movieModel->getMoviesPerPage(getLimitPerPage(1));
      $top5Movies = $this->movieModel->getTop5();
     

      $data = [
        'movies' => $movies,
        'top_5' => $top5Movies,
        'last_page' => getLastPage(),
      ];

      // echo '<pre>';
      // print_r($movies);
      // echo '</pre>';

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
          $poster_name = !empty($data['title']) ? $data['title'] . '.jpg' : 'no-poster-name.jpg';
          $uploaded_file = $folder . $poster_name;
          move_uploaded_file($_FILES['uploaded_poster']['tmp_name'], $uploaded_file);
          // save image name in server
          // $this->imageModel->addImage($_FILES['uploaded_poster']['name']);
          $data['poster'] = $poster_name;

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
          $movie_id = $movie_response[1];
          if ($movie_response[0]) {
            if (!empty($data['awards_status'])) {
              foreach($data['awards_status'] as $award_status) {
                $this->participantModel->addParticipantToAward($award_status['status'], $movie_id, $award_status['award_id'], 'm');
              }
            }

            foreach($data['dubbed_languages'] as $dubbed_language) {
              $this->dubbedLanguageModel->addDubbedLanguageForMovie($dubbed_language, $movie_id);
            }

            foreach($data['subtitle_languages'] as $subtitle_language) {
              $this->subtitleLanguageModel->addSubtitleLanguageForMovie($subtitle_language, $movie_id);
            }

            foreach($data['genres'] as $genre) {
              $this->genreModel->addGenreForMovie($genre, $movie_id);
            }

            flash('post_message', 'Movie Added');
            redirect('movies');
          }

          $this->view('movies/add', $data);

        } else {
          echo '<pre>';
          print_r($data['awards_status']);
          echo '</pre>';
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

    public function edit($movie_id) {

      $directorList = $this->movieModel->getDirectors(); 
      $actorList = $this->movieModel->getActors();
      $producerList = $this->movieModel->getProducers();
      $soundtrackList = $this->soundtrackModel->getSoundtracks();
      $countryList = $this->countryModel->getCountries();
      $genreList = $this->genreModel->getGenres();
      $moviesAwardsAvaible = $this->awardModel->getAwardsByCategory('m');
      $languagesList = $this->languageModel->getLanguages();

      // Get data for the diferent categories by movie_id
      $movie = $this->movieModel->getMovieById($movie_id);
      $cast = $this->movieModel->getCastByMovieId($movie_id);
      $producers = $this->movieModel->getProducersByMovieId($movie_id);
      $soundtracks = $this->movieModel->getSoundtracksByMovieId($movie_id);
      $dubbed_languages = $this->movieModel->getDubbedLanguagesByMovieId($movie_id);
      $subtitle_languages = $this->movieModel->getSubtitlesLanguagesByMovieId($movie_id);
      $genres = $this->movieModel->getGenresByMovieId($movie_id);
      $awards_status = $this->movieModel->getAwardsByMovieId($movie_id);
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'movie_id' => $movie_id,
          'title' => trim($_POST['title']),
          'story' => trim($_POST['story']),
          'poster' => $_POST['poster'],
          'catalog_photo' => $_POST['catalog_photo'],
          'catalog_photo_src' => !empty($_POST['catalog_photo']) ? URLROOT . '/img/catalog/' . $_POST['catalog_photo'] : '',
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
          $poster_name = !empty($data['title']) ? $data['title'] . '.jpg' : 'no-poster-name.jpg';
          $uploaded_file = $folder . $poster_name;
          move_uploaded_file($_FILES['uploaded_poster']['tmp_name'], $uploaded_file);
          // save image name in DB
          $data['poster'] = $poster_name;
          // $this->imageModel->addImage($data['poster']);
          // if (file_exists('img/posters/' . $movie->poster)) {
          //   $this->deleteImage($movie->poster);
          // }
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
          $data['catalog_photo_src'] = 'http://placehold.it/341x192?text=' . (empty($data['title']) ? 'catalog photo' : $data['title']);
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
          $movie_response = $this->movieModel->updateMovie($data);

          if ($movie_response[0]) {
            // if (!empty($data['awards_status'])) {
            //   foreach($data['awards_status'] as $award_status) {
            //     $this->participantModel->addParticipantToAward($award_status['status'], $movie_id, $award_status['award_id'], 'm');
            //   }
            // }
            
            $genres_actions_to_do = $this->updateArraysInDB($movie_id, $this->genresToArray($genres), $data['genres']);
            if (!empty($genres_actions_to_do['update'])) {
              foreach($genres_actions_to_do['update'] as $genre_update) {
                $this->genreModel->updateGenreForMovie($genre_update['table_id'], $genre_update['old_id'], $genre_update['new_id'], $movie_id);
              }
            }
            if (!empty($genres_actions_to_do['delete'])) {
              foreach($genres_actions_to_do['delete'] as $genre_delete) {
                $this->genreModel->deleteGenreForMovie($genre_delete, $movie_id);
              }
            }
            if (!empty($genres_actions_to_do['insert'])) {
              foreach($genres_actions_to_do['insert'] as $genre_add) {
                $this->genreModel->addGenreForMovie($genre_add, $movie_id);
              }
            }

            $dubbed_languages_actions_to_do = $this->updateArraysInDB($movie_id, $this->languagesToArray($dubbed_languages), $data['dubbed_languages']);
            if (!empty($dubbed_languages_actions_to_do['update'])) {
              foreach($dubbed_languages_actions_to_do['update'] as $dubbed_language_update) {
                $this->dubbedLanguageModel->updateDubbedLanguageForMovie($dubbed_language_update['table_id'], $dubbed_language_update['old_id'], $dubbed_language_update['new_id'], $movie_id);
              }
            }
            if (!empty($dubbed_languages_actions_to_do['delete'])) {
              foreach($dubbed_languages_actions_to_do['delete'] as $dubbed_language_delete) {
                $this->dubbedLanguageModel->deleteDubbedLanguageForMovie($dubbed_language_delete, $movie_id);
              }
            }
            if (!empty($dubbed_languages_actions_to_do['insert'])) {
              foreach($dubbed_languages_actions_to_do['insert'] as $dubbed_language_add) {
                $this->dubbedLanguageModel->addDubbedLanguageForMovie($dubbed_language_add, $movie_id);
              }
            }

            $subtitle_languages_actions_to_do = $this->updateArraysInDB($movie_id, $this->languagesToArray($subtitle_languages), $data['subtitle_languages']);
            if (!empty($subtitle_languages_actions_to_do['update'])) {
              foreach($subtitle_languages_actions_to_do['update'] as $subtitle_language_update) {
                $this->subtitleLanguageModel->updateSubtitleLanguageForMovie($subtitle_language_update['table_id'], $subtitle_language_update['old_id'], $subtitle_language_update['new_id'], $movie_id);
              }
            }
            if (!empty($subtitle_languages_actions_to_do['delete'])) {
              foreach($subtitle_languages_actions_to_do['delete'] as $subtitle_language_delete) {
                $this->subtitleLanguageModel->deleteSubtitleLanguageForMovie($subtitle_language_delete, $movie_id);
              }
            }
            if (!empty($subtitle_languages_actions_to_do['insert'])) {
              foreach($subtitle_languages_actions_to_do['insert'] as $subtitle_language_add) {
                $this->subtitleLanguageModel->addSubtitleLanguageForMovie($subtitle_language_add, $movie_id);
              }
            }

            $awards_status_actions_to_do = $this->updateStatusInDB($movie_id, $this->awardsStatusToArray($awards_status), $data['awards_status']);
            $participant_id_inserted = 0;
            if (!empty($awards_status_actions_to_do['update'])) {
              foreach($awards_status_actions_to_do['update'] as $award_status_update) {
                $this->participantModel->updateMovieParticipantStatus($award_status_update['participant_id'], $award_status_update['new_status']);
              }
            }
            if (!empty($awards_status_actions_to_do['delete'])) {
              foreach($awards_status_actions_to_do['delete'] as $award_status_delete) {
                $this->participantModel->deleteMovieParticipant($award_status_delete);
              }
            }

            $awards_actions_to_do = $this->updateAwardsInDB($movie_id, $this->awardsStatusToArray($awards_status), $data['awards_status']);
            if (!empty($awards_actions_to_do['update'])) {
              foreach($awards_actions_to_do['update'] as $award_update) {
                $this->awardModel->updateAwardForMovie($award_update['table_id'], $award_update['new_id']);
              }
            }
            if (!empty($awards_actions_to_do['delete'])) {
              foreach($awards_actions_to_do['delete'] as $award_delete) {
                $this->awardModel->deleteAwardForMovie($award_delete);
              }
            }

            // awards status is an array the contains the award id and the status of the movie who participated as nominated o winner
            // for insert is required in this order status from the participant in that award in this case a movie who was nominated or winner, 
            // participant_picked that can be (movie, actor, person, or actor), award_id and the category in this case movies
            if (!empty($awards_status_actions_to_do['insert'])) {
              foreach($awards_status_actions_to_do['insert'] as $key => $awards_status_insert) {
                $this->participantModel->addParticipantToAward($awards_status_insert, $movie_id, $awards_actions_to_do['insert'][$key], 'm');
              }
            }

            flash('post_message', 'Movie Updated');
            redirect('movies');
          }

          $this->view('movies/edit', $data);

        } else {
          echo '<pre>';
          echo $data['poster'] . '<br>';
          echo "Old Poster: " . $movie->poster . '<br>';
          echo '</pre>';

          // Load view with errors
          $this->view('movies/edit', $data);
        }

      } else {
        
        $data = [
          'movie_id' => $movie_id,
          'title' => $movie->title,
          'story' => $movie->story,
          'poster' => $movie->poster,
          'catalog_photo' => $movie->catalog_photo,
          'catalog_photo_src' => empty($movie->catalog_photo) ? 'http://placehold.it/341x192?text=' . $movie->title : URLROOT . '/img/catalog/' . $movie->catalog_photo, 
          'release_date' => $movie->release_date,
          'budget' => $movie->budget,
          'return_of_investment' => $movie->return_of_investment,
          'director' => $movie->director_id,
          'cast' => $this->castToArray($cast),
          'producers' => $this->producersToArray($producers),
          'music_director' => $movie->music_director,
          'soundtracks' => $this->soundtracksToArray($soundtracks),
          'rating' => $movie->raiting,
          'genres' => $this->genresToArray($genres)['ids'],
          'original_language' => $movie->original_language_id,
          'origin_country' => $movie->origin_country_id,
          'streaming_on' => $movie->streaming_on,
          'awards_status' => $awards_status,
          'dubbed_languages' => $this->languagesToArray($dubbed_languages)['ids'],
          'subtitle_languages' => $this->languagesToArray($subtitle_languages)['ids'],
          'director_list' => $directorList,
          'actor_list' => $actorList,
          'producer_list' => $producerList,
          'soundtrack_list' => $soundtrackList,
          'country_list' => $countryList,
          'genre_list' => $genreList,
          'languages_list' => $languagesList,
          'movie_awards_list' => $moviesAwardsAvaible
        ];

        echo '<pre>';
        print_r($awards_status);
        print_r($this->awardsStatusToArray($awards_status));
        print_r($data['awards_status']);
        echo '</pre>';

        $this->view('movies/edit', $data);
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

    public function moviesPerPageToArray() {
      if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $new_arr = [];
        $moviesPerPage = $this->movieModel->getMoviesPerPage(getLimitPerPage((int)$_POST['page']));
        foreach($moviesPerPage as $movie) {
          array_push($new_arr, 
            array(
              'movie_id' => $movie->movie_id,
              'title' => $movie->title,
              'poster' => $movie->poster,
              'language' => $movie->language,
              'country' => $movie->country
            )
          );
        }

        header('Content-Type: application/json');
        $output = json_encode($new_arr);
        echo $output;
      } else {
        // no post executed
      }
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
        } elseif (!empty($arr1) && !empty($arr2)) {
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

    private function deleteOldPoster($image_name) {
      unlink('img/posters/' . $image_name);
    }
    
    private function castToArray($cast) {
      $new_arr = [];
      foreach($cast as $cast_member) {
        array_push($new_arr, $cast_member->actor_id);
      }
      return $new_arr;
    }

    private function producersToArray($producers) {
      $new_arr = [];
      foreach($producers as $producer) {
        array_push($new_arr, $producer->producer_id);
      }
      return $new_arr;
    }

    private function soundtracksToArray($soundtracks) {
      $new_arr = [];
      foreach($soundtracks as $soundtrack) {
        array_push($new_arr, $soundtrack->soundtrack_id);
      }
      return $new_arr;
    }

    private function languagesToArray($languages) {
      $new_arr = array('table_ids' => [], 'ids' => []);
      foreach($languages as $language) {
        array_push($new_arr['ids'], $language->language_id);
        array_push($new_arr['table_ids'], $language->id);
      }
      return $new_arr;
    }

    private function genresToArray($genres) {
      // table_ids are from the many to many table so is easier to update, insert and delete in it
      $new_arr = array('table_ids' => [], 'ids' => []);
      foreach($genres as $genre) {
        array_push($new_arr['ids'], $genre->genre_id);
        array_push($new_arr['table_ids'], $genre->id);
      }
      return $new_arr;
    }

    private function awardsStatusToArray($awards_status) {
      $new_arr = array('table_ids' => [], 'ids' => [], 'participant_ids' => []);
      foreach($awards_status as $award_status) {
        array_push($new_arr['ids'], $award_status->award_id);
        array_push($new_arr['table_ids'], $award_status->id);
        array_push($new_arr['participant_ids'], $award_status->participant_id);
      }
      return $new_arr;
    }

    private function updateArraysInDB($movie_id, $old_data, $new_data) {
      $new_arr = array('update' => [], 'insert' => [], 'delete' => []);
      $limit = count($new_data) < count($old_data['ids']) ? count($new_data) : count($old_data['ids']);
      $second_limit = $limit + (int)abs(count($new_data) - count($old_data['ids']));
      $action_to_do = (count($new_data) < count($old_data['ids'])) ? 'd' : 'i';
      $aux = -1;
      // echo '<h1>Limit: ' . $limit . '</h1>';

      // updates
      for ($i = 0; $i < $limit; $i++) {
        array_push($new_arr['update'], array('table_id' => $old_data['table_ids'][$i], 'old_id' => $old_data['ids'][$i], 'new_id' => $new_data[$i]));
      } 

      for ($j = $limit; $j < $second_limit; $j++) {
        if ($action_to_do == 'i') {
          array_push($new_arr['insert'], $new_data[$j]);
        } 
        if ($action_to_do == 'd') {
          array_push($new_arr['delete'], $old_data['table_ids'][$j]);
        }
      }

      return $new_arr;
    }

    private function updateAwardsInDB($movie_id, $old_data, $new_data) {
      $new_arr = array('update' => [], 'insert' => [], 'delete' => []);
      $limit = count($new_data) < count($old_data['ids']) ? count($new_data) : count($old_data['ids']);
      $second_limit = $limit + (int)abs(count($new_data) - count($old_data['ids']));
      $action_to_do = (count($new_data) < count($old_data['ids'])) ? 'd' : 'i';
      $aux = -1;
      // echo '<h1>Limit: ' . $limit . '</h1>';

      // updates
      for ($i = 0; $i < $limit; $i++) {
        array_push($new_arr['update'], array('table_id' => $old_data['table_ids'][$i], 'old_id' => $old_data['ids'][$i], 'new_id' => $new_data[$i]['award_id']));
      } 

      for ($j = $limit; $j < $second_limit; $j++) {
        if ($action_to_do == 'i') {
          array_push($new_arr['insert'], $new_data[$j]['award_id']);
        } 
        if ($action_to_do == 'd') {
          array_push($new_arr['delete'], $old_data['table_ids'][$j]);
        }
      }

      return $new_arr;
    }

    private function updateStatusInDB($movie_id, $old_data, $new_data) {
      $new_arr = array('update' => [], 'insert' => [], 'delete' => []);
      $limit = count($new_data) < count($old_data['ids']) ? count($new_data) : count($old_data['ids']);
      $second_limit = $limit + (int)abs(count($new_data) - count($old_data['ids']));
      $action_to_do = (count($new_data) < count($old_data['ids'])) ? 'd' : 'i';
      $aux = -1;
      // echo '<h1>Limit: ' . $limit . '</h1>';

      // updates
      for ($i = 0; $i < $limit; $i++) {
        array_push($new_arr['update'], array('participant_id' => $old_data['participant_ids'][$i], 'new_status' => $new_data[$i]['status']));
      } 

      for ($j = $limit; $j < $second_limit; $j++) {
        if ($action_to_do == 'i') {
          array_push($new_arr['insert'], $new_data[$j]['status']);
        } 
        if ($action_to_do == 'd') {
          array_push($new_arr['delete'], $old_data['participant_ids'][$j]);
        }
      }

      return $new_arr;
    }
  }