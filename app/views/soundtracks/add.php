<?php require APPROOT . '/views/inc/header.php'; ?>

  <a href="<?= URLROOT; ?>/soundtracks" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Soundtrack</h2>
    <p>Create an soundtrack with this form</p>
    <form action="<?= URLROOT; ?>/soundtracks/add" method="post" enctype="multipart/form-data">

      <div class="form-group">
        <label for="name"> Name: <sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['name']; ?>">
        <span class="invalid-feedback"><?= $data['name_err']; ?></span>
      </div>
      <div class="form-group">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <select class="selectpicker <?= (!empty($data['selection_singer_group_err'])) ? 'is-invalid' : ''; ?>" name="selection_singer_group">
              <option selected>Choose...</option>
              <option <?php if ($data['selection_singer_group'] == 1 ) echo 'selected'; ?> value="1">Singer</option>
              <option <?php if ($data['selection_singer_group'] == 2 ) echo 'selected'; ?> value="2">Group</option>
            </select>
          </div>
          <input type="text" class="form-control ml-2 <?= (!empty($data['selection_singer_group_err']) || !empty($data['name_singer_group_err']))  ? 'is-invalid' : ''; ?>"  value="<?= $data['name_singer_group']; ?>" placeholder="Name of the group or singer" name="name_singer_group">
          <span class="invalid-feedback"><?= $data['selection_singer_group_err']; ?></span>
          <span class="invalid-feedback"><?= $data['name_singer_group_err']; ?></span>
        </div>
      </div>
      <div class="form-group">
        <label for="duration"> Duration: <sup>*</sup></label>
        <input type="text" name="duration" class="form-control form-control-lg <?= (!empty($data['duration_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['duration']; ?>">
        <span class="invalid-feedback"><?= $data['duration_err']; ?></span>
      </div>

      <!-- <input type="hidden" name="photo" value="<?= $data['photo']; ?>"> -->

      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>