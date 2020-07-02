<?php require APPROOT . '/views/inc/header.php'; ?>

<a href="<?= URLROOT; ?>/events" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
<?= flash('participant_message') ?>
<div class="container-fluid">
  <!-- title -->
  <div class="row">
    <div class="col text-center mb-3">
      <h1 class="text-warning display-2"><?= $data['event']->name ?></h1>
    </div>
  </div>
  <!-- end of title -->
  <div class="row justify-content-center col-12">
    <div class="col-lg-4 col-sm-6">
      <!-- rounded rounded-circle img-thumbnail img-fluid -->
      <img src="<?= URLROOT; ?>/img/cars.jpg" class="img-thumbnail" alt="">
      <h2 class="my-3 text-warning">Year Of The Event: <?= $data['event']->year ?></h2>
      <!-- <div class="col-md-12 d-flex justify-content-center mb-5">
        <a href="<?= URLROOT; ?>/participants/add/<?= $data['event_id'] ?>" class="btn btn-primary justify-content-center">
          <i class="fas fa-pencil-alt"></i> Add participants
        </a>
      </div> -->
    </div>
    <div class="row justify-content-center col-lg-12 col-sm-6">
      <div class="col-6">
        <?php foreach($data['awards'] as $award): ?>
          <div class="card mb-5">
            <div class="card-header">
              <b><?= $award->name ?></b>
              <button class="btn btn-primary float-right" data-toggle="modal" data-target="#award-modal-<?= $award->award_id ?>">
                <i class="fa fa-plus"></i> participants
              </button>
            </div>
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>coming soon</p>
                <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
              </blockquote>
              <div class="row justify-content-between">
                <!-- <div class="card col-3 ">
                  <img src="<?= URLROOT; ?>/img/cars.jpg" alt="" class="card-img-overlay img-fluid">
                  <div class="card-body">
                    <p class="class-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur fugit esse magnam!</p>
                    <a href="#" class="btn btn-primary btn-block">More Books</a>
                  </div>
                </div> -->

                <!-- <div class="row row-cols-1 row-cols-md-3"> -->
                <?php foreach ($data['participants'] as $participant): ?>
                  <?php if($participant->award_id == $award->award_id): ?>
                  <div class="col-4 mb-4">
                    <div class="card h-100">
                      
                      <img src="<?= URLROOT; ?>/img/<?= $participant->photo ? $participant->photo : $participant->poster?>" class="card-img-top" alt="...">
                      <div class="card-body">
                        <h5 class="card-title">Card title</h5>
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

                  <!-- modal -->
                  <div class="modal fade" id="participant-edit-modal-<?= $participant->participant_id ?>">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title"><?= $award->name ?></h4>
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            
                            <label for="director">Select : </label>
                            <select class="col-4 selectpicker form-control" data-live-search="true" id="participant-picked-<?= $participant->participant_id ?>">
                              <?php switch($award->category): 
                                case 'm': ?>
                                  <?php $data['category_name'] = 'movie' ?>
                                  <?php foreach($data['movies'] as $movie): ?>
                                    <option value="<?= $movie->movie_id ?>" <?= $participant->title == $movie->title ? 'selected' : '' ?>><?= $movie->title ?></option>
                                  <?php endforeach; ?>
                                <?php break; ?>
                                <?php case 'a': ?>
                                  <?php $data['category_name'] = 'actor' ?>
                                  <?php foreach($data['actors'] as $actor): ?>
                                    <option value="<?= $actor->person_id ?>" <?= $participant->name == $actor->name ? 'selected' : '' ?>><?= $actor->name ?></option>
                                  <?php endforeach; ?>
                                <?php break; ?>
                                <?php case 'd': ?>
                                  <?php $data['category_name'] = 'director' ?>
                                  <?php foreach($data['directors'] as $director): ?>
                                    <option value="<?= $director->person_id ?>" <?= $participant->name == $director->name ? 'selected' : '' ?>><?= $director->name ?></option>
                                  <?php endforeach; ?>
                                <?php break; ?>
                                <?php case 'p': ?>
                                  <?php $data['category_name'] = 'producer' ?>
                                  <?php foreach($data['producers'] as $producer): ?>
                                    <option value="<?= $producer->person_id ?>" <?= $participant->name == $producer->name ? 'selected' : '' ?>><?= $producer->name ?></option>
                                  <?php endforeach; ?>
                                <?php break; ?>
                              <?php endswitch; ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="status">status in participation: </label>
                            <select class="col-5 selectpicker form-control" data-actions-box="true" id="status-<?= $participant->participant_id ?>">
                              <option <?= $participant->status == 'nominated' ? 'selected' : '' ?>>nominated</option>
                              <option <?= $participant->status == 'winner' ? 'selected' : '' ?>>winner</option>
                            </select>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="editParticipant('<?= URLROOT; ?>/participants/editParticipant/<?= $data['event_id'] ?>', <?= $participant->participant_id ?>, '<?= $award->category ?>')">Stay Here</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="logout">Logout</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- end of modal -->
                  <!-- modal to delete -->
                  <div class="modal fade" id="participant-delete-modal-<?= $participant->participant_id ?>">
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
                  </div>
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
          <div class="modal fade" id="award-modal-<?= $award->award_id ?>">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title"><?= $award->name ?></h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label for="director">Select : </label>
                    <select class="col-4 selectpicker form-control" data-live-search="true" id="participant-picked-<?= $award->award_id ?>">
                      <?php switch($award->category): 
                        case 'm': ?>
                          <?php foreach($data['movies'] as $movie): ?>
                            <option value="<?= $movie->movie_id ?>"><?= $movie->title ?></option>
                          <?php endforeach; ?>
                        <?php break; ?>
                        <?php case 'a': ?>
                          <?php foreach($data['actors'] as $actor): ?>
                            <option value="<?= $actor->person_id ?>"><?= $actor->name ?></option>
                          <?php endforeach; ?>
                        <?php break; ?>
                        <?php case 'd': ?>
                          <?php foreach($data['directors'] as $director): ?>
                            <option value="<?= $director->person_id ?>"><?= $director->name ?></option>
                          <?php endforeach; ?>
                        <?php break; ?>
                        <?php case 'p': ?>
                          <?php foreach($data['producers'] as $producer): ?>
                            <option value="<?= $producer->person_id ?>"><?= $producer->name ?></option>
                          <?php endforeach; ?>
                        <?php break; ?>
                      <?php endswitch; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="status">status in participation: </label>
                    <select class="col-5 selectpicker form-control" data-actions-box="true" id="status-<?= $award->award_id ?>">
                      <option>nominated</option>
                      <option>won</option>
                    </select>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addParticipant('<?= URLROOT; ?>/participants/addParticipant/<?= $data['event_id'] ?>', <?= $award->award_id ?>, '<?= $award->category ?>')">Stay Here</button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal" id="logout">Logout</button>
                </div>
              </div>
            </div>
          </div>
          <!-- end of modal -->
        <?php endforeach; ?>  
      </div>
    </div>
    

  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>