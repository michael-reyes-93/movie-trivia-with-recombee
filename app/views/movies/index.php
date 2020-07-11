<?php require APPROOT . '/views/inc/header.php'; ?>
  <?= flash('post_message') ?>
  <div class="row justify-content-center mb-3 mx-auto">
    <div class="col-xl-10 col-lg-10 col-md-9 col-sm-4">
      <h1 class="text-center">Movies</h1>
    </div>
    <div class="col-xl col-lg-1 col-md-1 col-sm-4 align-self-center">
      <a href="<?= URLROOT; ?>/movies/add" class="btn btn-primary pull-right">
        <i class="fas fa-pencil-alt"></i> Add Movie
      </a>
    </div>
  </div>
  <!-- <div class="row justify-content-center col-lg-12"> -->
    <div class="mx-auto col-xl-12 col-lg-11 col-md-10 col-sm-8">
        <div class="card mb-5">
          <div class="card-header">
            <div class="row">
              <h4 class="col-lg-9 col-md-9 text-center">Top 5 popular movies</h4>
              <button class="btn btn-primary float-right col-lg-2 col-md-3" data-toggle="modal" data-target="#popular-movie-modal">
                <i class="fa fa-plus"></i> movies
              </button>
            </div>
          </div>
            <div class="card-body">
              <div class="row justify-content-between justify-content-md-center">
                <?php foreach ($data['top_5'] as $movieInTop): ?>
                  <?php if($movieInTop): ?>
                  <div class="col-xl col-lg-4 col-md-6 col-sm-8 mb-4">
                    <div class="card h-100">
                      
                      <img src="<?= URLROOT; ?>/img/posters/<?= $movieInTop->poster?>" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title"><?= $movieInTop->title ?></h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        
                        <span class="badge badge-secondary">Genre</span>
                      </div>
                    </div>
                    <button class="button btn-danger delete-card" data-toggle="modal" data-target="#participant-delete-modal-">
                      <i class="far fa-trash-alt" aria-hidden="true"></i>
                    </button>
                    <button class="button btn-primary edit-card" data-toggle="modal" data-target="#participant-edit-modal-">
                      <i class="fa fa-edit" aria-hidden="true"></i>
                    </button>
                  </div>

                  <?php endif; ?>
                <?php endforeach; ?>
                <!-- </div> -->

              </div>
            </div>
          </div>

          <!-- modal -->
          <div class="modal fade" id="popular-movie-modal">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title text-center">Select a movie to add to popular movies</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="director">Movies avaible: </label>
                    <select class="col-4 selectpicker form-control" data-live-search="true" id="top5-movie-picked">
                      <?php foreach($data['movies'] as $movie): ?>
                        <option value="<?= $movie->movie_id ?>"><?= $movie->title ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addMovieToTop5('<?= URLROOT; ?>/movies/top5Movies')">Stay Here</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="logout">Logout</button>
                </div>
              </div>
            </div>
          </div>
          <!-- end of modal -->
        </div>
    </div>
  <!-- </div> -->

  <div class="container-fluid">
    <!-- <div class="row justify-content-center"> -->
      <!-- <div class="col-xl-8 col-lg-6 col-md-12"> -->
        <div class="row align-items-center justify-content-center">
          <div class="col-xl-10 col-12 mb-4 mb-xl-0">
            <h3 class="text-muted text-center mb-3">Movies</h3>
            <div class="table-responsive-sm">
              <table  id="movies_index_table" class="table table-striped bg-light text-center">
                <thead>
                  <tr class="text-muted">
                    <th class="">Title</th>
                    <th class="">Language</th>
                    <th class="">Country</th>
                    <th class="">Poster</th>
                    <th class="">Edit</th>
                    <th class="">View</th>
                    <th class="">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($data['movies'] as $movie): ?>
                    <tr>
                      <th><?= $movie->title ?></th>
                      <td><?= $movie->language ?></td>
                      <td><?= $movie->country ?></td>
                      <td><?= $movie->poster ?></td>
                      <td>
                        <a href="<?= URLROOT; ?>/movies/edit/<?= $movie->movie_id ?>" class="btn btn-primary"><i class="far fa-edit"></i></a>                   
                        <!-- <a href="#" class="btn"><i class="far fa-eye"></a> -->
                      </td>
                      <td>
                        <a href="<?= URLROOT; ?>/movies/show/<?= $movie->movie_id ?>" class="btn btn-primary"><i class="far fa-eye"></i></a>
                      </td>
                      <td>
                        <a href="<?= URLROOT; ?>/movies/delete/<?= $movie->movie_id ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      <!-- </div> -->
    <!-- </div> -->
  </div>
<?php require APPROOT . '/views/inc/pagination.php'; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>