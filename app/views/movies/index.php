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

<?php require APPROOT . '/views/inc/footer.php'; ?>