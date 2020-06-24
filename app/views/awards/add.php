<?php require APPROOT . '/views/inc/header.php'; ?>

  <a href="<?= URLROOT; ?>/persons" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Award</h2>
    <p>Create an person with this form</p>
    <form action="<?= URLROOT; ?>/awards/add" method="post" enctype="multipart/form-data">
      <!-- <div class="form-group">
        <select id="cars">
          <?php foreach($data['movie_titles'] as $movie_title): ?> 
            <option value="<?= $movie_title->movie_id ?>"><?= $movie_title->title ?></option>
          <?php endforeach; ?>
        </select>
      </div> -->


      <div class="form-group">
        <label for="event"> Name Of The Award Event: <sup>*</sup></label>
        <select class="col-lg-2 selectpicker form-control <?= (!empty($data['event_err'])) ? 'is-invalid' : ''; ?>" name="event" data-live-search="true" onChange="changeTesting(this.value, );">
          <option value="" disabled selected>Select</option>
          <?php foreach($data['event_list'] as $event): ?>
            <?php if (!empty($data['event'])): ?>
              <option <?= $data['event'] == $event->event_id ? 'selected' : ''; ?> value="<?= $event->event_id ?>"><?= $event->name ?></option>
            <?php else: ?>
              <option value="<?= $event->event_id ?>"><?= $event->name ?></option>
            <?php endif; ?>
          <?php endforeach ?>
        </select>
        <span class="invalid-feedback"><?= $data['event_err']; ?></span>
      </div>

      <div class="form-group">
        <label for="year"> Year Of The Award: <sup>*</sup></label>
        <!-- <input type="text" name="born" class="form-control form-control-lg <?= (!empty($data['born_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['born']; ?>" placeholder="testing">
        <span class="invalid-feedback"><?= $data['born_err']; ?></span> -->
      </div>
      <div class="form-group">
        <label for="award"> Name Of The Award: <sup>*</sup></label>
        <select id="awards" class="col-lg-2 selectpicker form-control <?= (!empty($data['award_err'])) ? 'is-invalid' : ''; ?>" name="award[]" multiple data-live-search="true">
          <option value="" disabled selected>Select</option>
        </select>
        <span class="invalid-feedback"><?= $data['award_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="reason">Reason For Being Participating: <sup>*</sup></label>
        <!-- <input type="file" name="uploaded_photo" id="uploaded_photo" class="form-control-file form-control-lg <?= (!empty($data['photo_err'])) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"><?= $data['photo_err']; ?></span> -->
      </div>
      <div class="form-row">
        <div class="form-group col-lg-2">
          <label for="status">status in participation: </label>
          <select class="selectpicker form-control" name="status[]" data-actions-box="true">
            <option>nominated</option>
            <option>won</option>
          </select>
          <!-- <select class="selectpicker form-control <?= (!empty($data['role_err'])) ? 'is-invalid' : ''; ?>" name="role[]" multiple data-actions-box="true">
            <option <?= in_array(1, $data['role']) ? 'selected' : ''; ?> value="1">actor</option>
            <option <?= in_array(2, $data['role']) ? 'selected' : ''; ?> value="2">producer</option>
            <option <?= in_array(3, $data['role']) ? 'selected' : ''; ?> value="3">director</option>
          </select>
          <span class="invalid-feedback"><?= $data['role_err']; ?></span> -->
        </div>
      </div>

      <input type="hidden" name="photo" value="<?= $data['photo']; ?>">

      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>