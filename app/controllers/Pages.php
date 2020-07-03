<?php
  class Pages extends Controller{
    public function __construct() {
      $this->movieModel = $this->model('Movie');
    }

    public function index() {
      $movies = $this->movieModel->getMovies();
      $top5Movies = $this->movieModel->getTop5();

      $data = [
        'title' => 'TraversyMVC',
        'movies' => $movies,
        'top_5' => $top5Movies
      ];

      $this->view('pages/index', $data);
    }

    public function about() {
      $data = [
        'title' => 'About Us'
      ];
      
      $this->view('pages/about', $data);
    }
  }
