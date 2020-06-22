<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-fluid">
  <!-- title -->
  <div class="row">
    <div class="col text-center mb-3">
      <h1 class="text-warning display-2"><?= $data['event']->name ?></h1>
    </div>
  </div>
  <!-- end of title -->
  <div class="row justify-content-center">
    <div class="col-lg-3 col-sm-6">
      <!-- rounded rounded-circle img-thumbnail img-fluid -->
      <img src="<?= URLROOT; ?>/img/cars.jpg" class="img-thumbnail" alt="">
      <h2 class="my-3 text-warning">Year Of The Event: <?= $data['event']->year ?></h2>
      <div class="col-md-12 d-flex justify-content-center mb-5">
        <a href="<?= URLROOT; ?>/participants/add/<?= $data['event_id'] ?>" class="btn btn-primary justify-content-center">
          <i class="fas fa-pencil-alt"></i> Add participants
        </a>
      </div>
      <?php foreach($data['awards'] as $award): ?>
        <div class="card mb-5">
          <div class="card-header">
            <b><?= $award ?></b>
          </div>
          <div class="card-body">
            <blockquote class="blockquote mb-0">
              <p>coming soon</p>
              <footer class="blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
            </blockquote>
          </div>
        </div>
        
      <?php endforeach ?>
    </div>
    

  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>