<?php
  class Pages extends Controller{
    public function __construct() {
      $this->movieModel = $this->model('Movie');
    }

    public function index() {
      $movies = $this->movieModel->getMovies();
      $data = [
        'title' => 'TraversyMVC',
        'movies' => $movies
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
