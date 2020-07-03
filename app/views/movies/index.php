<?php require APPROOT . '/views/inc/header.php'; ?>
  <?= flash('post_message') ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Movies</h1>
    </div>
    <div class="col-md-6">
      <a href="<?= URLROOT; ?>/movies/add" class="btn btn-primary pull-right">
        <i class="fas fa-pencil-alt"></i> Add Movie
      </a>
    </div>
  </div>
  <div class="row justify-content-center col-lg-12 col-sm-6">
    <div class="col-6">
        <div class="card mb-5">
          <div class="card-header">
            <div class="row">
              <h4 class="col-10 text-center">Top 5 popular movies</h4>
              <button class="btn btn-primary float-right col-2" data-toggle="modal" data-target="#popular-movie-modal">
                <i class="fa fa-plus"></i> movies
              </button>
            </div>
          </div>
            <div class="card-body">
              <div class="row justify-content-between">
                <!-- <div class="card col-3 ">
                  <img src="<?= URLROOT; ?>/img/cars.jpg" alt="" class="card-img-overlay img-fluid">
                  <div class="card-body">
                    <p class="class-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur fugit esse magnam!</p>
                    <a href="#" class="btn btn-primary btn-block">More Books</a>
                  </div>
                </div> -->

                <!-- <div class="row row-cols-1 row-cols-md-3"> -->
                <?php foreach ($data['top_5'] as $movieInTop): ?>
                  <?php if($movieInTop): ?>
                  <div class="col-4 mb-4">
                    <div class="card h-100">
                      
                      <img src="<?= URLROOT; ?>/img/<?= $movieInTop->poster?>" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title"><?= $movieInTop->title ?></h5>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <button class="button btn-danger delete-card" data-toggle="modal" data-target="#participant-delete-modal-<?= $participant->participant_id ?>">
                          <i class="far fa-trash-alt" aria-hidden="true"></i>
                        </button>
                        <button class="button btn-primary edit-card" data-toggle="modal" data-target="#participant-edit-modal-<?= $participant->participant_id ?>">
                          <i class="fa fa-edit" aria-hidden="true"></i>
                        </button>
                      
                      </div>
                    </div>
                  </div>
                  <!-- modal to delete -->
                  <!-- <div class="modal fade" id="participant-delete-modal-<?= $participant->participant_id ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title">Delete <?= $participant->name ? $participant->name : $participant->title?> in <?= $award->name ?> </h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <b>Are you sure you want to delete this <?= $data['category_name'] ?>?</b>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="deleteParticipant('<?= URLROOT; ?>/participants/deleteParticipant/<?= $data['event_id'] ?>', <?= $participant->participant_id ?>, '<?= $award->category ?>','<?= $participant->award_id ?>')">Delete</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="logout">Close</button>
                        </div>
                      </div>
                    </div>
                  </div> -->
                  <!-- end of modal -->

                  <?php endif; ?>
                <?php endforeach; ?>
                <!-- </div> -->

              </div>
            </div>
            <div class="card-footer">
              <!-- data-toggle="modal" data-target="#sign-out" -->
              <!-- href="<?= URLROOT; ?>/participants/add/<?= $award->award_id ?>" -->
              <!-- <a href="<?= URLROOT; ?>/participants/modal" class="btn btn-primary float-right" > -->
              
              <!-- </a> -->
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
<?php require APPROOT . '/views/inc/footer.php'; ?>