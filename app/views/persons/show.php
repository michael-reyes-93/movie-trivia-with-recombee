<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container-fluid">
  <!-- title -->
  <div class="row">
    <div class="col text-center mb-3">
      <h1 class="text-warning display-2"><?= $data['person']->name ?></h1>
    </div>
  </div>
  <!-- end of title -->
  <div class="row justify-content-center">
    <div class="col-lg-3 col-sm-6">
      <!-- rounded rounded-circle img-thumbnail img-fluid -->
      <img src="<?= URLROOT; ?>/img/cars.jpg" class="img-thumbnail" alt="">
      <h2 class="my-3 text-warning">Born In: <?= $data['person']->born ?></h2>
      <p class="text-muted">
        <?= $data['person']->biography ?>
      </p>
    </div>
    

  </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>