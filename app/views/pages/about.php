<?php require APPROOT . '/views/inc/header.php'; ?>
  <h1><?= $data['title'] ?></h1>

  <h1>Pure CSS Star Rating Widget</h1>
<fieldset class="rating">
    <input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
    <!-- <input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label> -->
    <input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
    <!-- <input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label> -->
    <input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
    <!-- <input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label> -->
    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
    <!-- <input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label> -->
    <input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
    <!-- <input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label> -->
</fieldset>
<br>
<br>
<br>
<br>
<br>
  <div class="row justify-content-center col-lg-12 col-sm-6">
    <div class="col-6">

              <div class="row justify-content-between">
                <?php foreach ($data['top_5'] as $movieInTop): ?>
                  <?php if($movieInTop): ?>
                  <div class="col-4 mb-4">
                    <div class="card h-100">
                      
                      <img src="<?= URLROOT; ?>/img/posters/<?= $movieInTop->name?>" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title"><?= $movieInTop->name ?></h5>
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