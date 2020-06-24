<?php require APPROOT . '/views/inc/header.php'; ?>

  <a href="<?= URLROOT; ?>/events" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2 id="test-div2">Add Event</h2>
    <p>Create an person with this form</p>
    <form action="<?= URLROOT; ?>/events/edit/<?= $data['id']; ?>" method="post" enctype="multipart/form-data">
      <!-- <div class="form-group">
        <select>
          <?php foreach($data['movie_titles'] as $movie_title): ?> 
            <option value="<?= $movie_title->movie_id ?>"><?= $movie_title->title ?></option>
          <?php endforeach; ?>
        </select>
      </div> -->
      
      <!-- <button type="button" onclick="myNewFunction()" class="btn btn-success" id="country_add">Add Country</button> -->

      <div class="form-group">
        <label for="award_event"> Name Of The Event: <sup>*</sup></label>
        <input type="text" name="name" class="form-control form-control-lg <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['name']; ?>">
        <span class="invalid-feedback"><?= $data['name_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="year"> Year Of The Event: <sup>*</sup></label>
        <input type="text" name="year" class="form-control form-control-lg <?= (!empty($data['year_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['year']; ?>" placeholder="testing">
        <span class="invalid-feedback"><?= $data['year_err']; ?></span>
      </div>
      
      <button type="button" id="add-awards" class="btn btn-success mb-3">Add Award Input</button>

      <?php if(!empty($data['awards'][0]->name)): ?>
        <?php for ($i=0; $i < count($data['awards']); $i++): ?>
          <div class="form-row align-items-center">
            <div class="form-group col-lg-10">
              <label for="award_name_list"> Award <?= $i + 1 ?>: <sup>*</sup></label>
              <input type="text" name="award_name_list[]" class="form-control form-control-lg <?= (!empty($award['award_name_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['awards'][$i]->name ?>" placeholder="testing">
              <span class="invalid-feedback"><?= $award['award_name_err']; ?></span>
            </div>
            <div class="form-group col-lg-2">
              <label for="category_list"> category of award: <sup>*</sup></label>
              <select class="selectpicker form-control <?= (!empty($award['category_err'])) ? 'is-invalid' : ''; ?>" name="category_list[]">
                <option <?= $data['awards'][$i]->category == 'x' ? 'selected' : '' ?> value="x">Select</option>
                <option <?= $data['awards'][$i]->category == 'm' ? 'selected' : '' ?> value="m">Movies</option>
                <option <?= $data['awards'][$i]->category == 'a' ? 'selected' : '' ?> value="a">Actor</option>
                <option <?= $data['awards'][$i]->category == 'd' ? 'selected' : '' ?> value="d">Director</option>
                <option <?= $data['awards'][$i]->category == 'p' ? 'selected' : '' ?> value="p">Producer</option>
              </select>
              <span class="invalid-feedback"><?= $award['category_err']; ?></span>
            </div>
          </div>
        <?php endfor ?>
      <?php else: ?>
        <?php foreach($data['awards'] as $award): ?>
          <div class="form-row align-items-center">
            <div class="form-group col-lg-10">
              <label for="award_name_list"> Award 1: <sup>*</sup></label>
              <input type="text" name="award_name_list[]" class="form-control form-control-lg <?= (!empty($award['award_name_err'])) ? 'is-invalid' : ''; ?>" value="<?= $award['name'] ?>" placeholder="testing">
              <span class="invalid-feedback"><?= $award['award_name_err']; ?></span>
            </div>
            <div class="form-group col-lg-2">
              <label for="category_list"> category of award: <sup>*</sup></label>
              <select class="selectpicker form-control <?= (!empty($award['category_err'])) ? 'is-invalid' : ''; ?>" name="category_list[]">
                <option <?= $award['category'] == 'x' ? 'selected' : '' ?> value="x">Select</option>
                <option <?= $award['category'] == 'm' ? 'selected' : '' ?> value="m">Movies</option>
                <option <?= $award['category'] == 'a' ? 'selected' : '' ?> value="a">Actor</option>
                <option <?= $award['category'] == 'd' ? 'selected' : '' ?> value="d">Director</option>
                <option <?= $award['category'] == 'p' ? 'selected' : '' ?> value="p">Producer</option>
              </select>
              <span class="invalid-feedback"><?= $award['category_err']; ?></span>
            </div>
          </div>
        <?php endforeach ?>
      <?php endif ?>

      
      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>