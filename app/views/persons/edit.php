<?php require APPROOT . '/views/inc/header.php'; ?>

  <a href="<?= URLROOT; ?>/persons" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Person</h2>
    <p>Create an person with this form</p>
    <form action="<?= URLROOT; ?>/persons/edit/<?= $data['id']; ?>" method="post" enctype="multipart/form-data">
      <!-- <div class="form-group">
        <select id="cars">
          <?php foreach($data['movie_titles'] as $movie_title): ?> 
            <option value="<?= $movie_title->movie_id ?>"><?= $movie_title->title ?></option>
          <?php endforeach; ?>
        </select>
      </div> -->

      <div class="form-group">
        <label for="name"> Name: <sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['name']; ?>">
        <span class="invalid-feedback"><?= $data['name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="born"> Born In: <sup>*</sup></label>
        <input type="text" name="born" class="form-control form-control-lg <?= (!empty($data['born_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['born']; ?>" placeholder="testing">
        <span class="invalid-feedback"><?= $data['born_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="biography"> Biography: <sup>*</sup></label>
        <textarea name="biography" rows=4 class="form-control form-control-lg <?= (!empty($data['biography_err'])) ? 'is-invalid' : ''; ?>"><?= $data['biography']; ?></textarea>
        <span class="invalid-feedback"><?= $data['biography_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="uploaded_photo">Profile Image: <?= (!empty($data['photo_err'])) ? '<sup>*</sup>' : '<b>'.$data['photo'].'</b>'; ?></label>
        <input type="file" name="uploaded_photo" id="uploaded_photo" class="form-control-file form-control-lg <?= (!empty($data['photo_err'])) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"><?= $data['photo_err']; ?></span>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-2">
          <label for="role">Role: </label>
          <select class="selectpicker form-control <?= (!empty($data['role_err'])) ? 'is-invalid' : ''; ?>" name="role[]" multiple data-actions-box="true">
            <option <?= $data['is_actor'] != 0 ? 'selected' : ''; ?> value="1">actor</option>
            <option <?= $data['is_producer'] != 0 ? 'selected' : ''; ?> value="2">producer</option>
            <option <?= $data['is_director'] != 0 ? 'selected' : ''; ?> value="3">director</option>
          </select>
          <span class="invalid-feedback"><?= $data['role_err']; ?></span>
        </div>
      </div>

      <input type="hidden" name="photo" value="<?= $data['photo']; ?>">

      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>