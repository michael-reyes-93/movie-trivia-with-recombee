<?php require APPROOT . '/views/inc/header.php'; ?>

  <a href="<?= URLROOT; ?>/events" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2 id="test-div2">Add Event</h2>
    <p>Create an person with this form</p>
    <form action="<?= URLROOT; ?>/events/add" method="post" enctype="multipart/form-data">
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
      <div class="form-group">
        <label for="awards2"> Awards Given: <sup>*</sup></label>
        <textarea name="awards2" rows=4 class="form-control form-control-lg <?= (!empty($data['awards_err'])) ? 'is-invalid' : ''; ?>" placeholder="award 1, award 2 and award 3"><?= $data['awards2']; ?></textarea>
        <span class="invalid-feedback"><?= $data['awards_err']; ?></span>
      </div>
      
      <!-- <div class="form-row align-items-center">
        <div class="form-group col-lg-10">
          <label for="award_name_list"> Award 1: <sup>*</sup></label>
          <input type="text" name="award_name_list[]" class="form-control form-control-lg <?= (!empty($data['award_name_err'])) ? 'is-invalid' : ''; ?>" value="<?= $award['name'] ?>" placeholder="testing">
              <span class="invalid-feedback"><?= $data['award_name_err']; ?></span>
            </div>
            <div class="form-group col-lg-2">
              <label for="category_list"> category of award: <sup>*</sup></label>
              <select class="selectpicker form-control <?= (!empty($data['participated_as_err'])) ? 'is-invalid' : ''; ?>" name="category_list[]">
                <option <?= $award['participated_as'] == 'x' ? 'selected' : '' ?> value="x">Select</option>
                <option <?= $award['participated_as'] == 'm' ? 'selected' : '' ?> value="m">Movies</option>
                <option <?= $award['participated_as'] == 'a' ? 'selected' : '' ?> value="a">Actor</option>
                <option <?= $award['participated_as'] == 'd' ? 'selected' : '' ?> value="d">Director</option>
                <option <?= $award['participated_as'] == 'p' ? 'selected' : '' ?> value="p">Producer</option>
              </select>
              <span class="invalid-feedback"><?= $data['participated_as_err']; ?></span>
            </div>
          </div> -->
      <button type="button" id="add-awards" class="btn btn-success mb-3">Add Award Input</button>
      
      <?php if(!empty($data['awards'])): ?>
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
                <option <?= $award['catergoy'] == 'd' ? 'selected' : '' ?> value="d">Director</option>
                <option <?= $award['category'] == 'p' ? 'selected' : '' ?> value="p">Producer</option>
              </select>
              <span class="invalid-feedback"><?= $award['category_err']; ?></span>
            </div>
          </div>
          <!-- style="display:none;" -->
          <!-- <div class="form-group" id="category" >
            <label for="category"> category: <sup>*</sup></label>
            <input type="text" name="category" class="form-control form-control-lg" id="category-name">
            <span class="invalid-feedback"></span>
            
          </div> -->
        <?php endforeach ?>
      <?php endif ?>

      <?php if(empty($data['awards'])): ?>
        <div class="form-row align-items-center">
          <div class="form-group col-lg-10">
            <label for="award_name_list"> Award 1: <sup>*</sup></label>
            <input type="text" name="award_name_list[]" class="form-control form-control-lg" placeholder="testing">
          </div>
          <div class="form-group col-lg-2">
            <label for="category_list"> category of award: <sup>*</sup></label>
            <select class="selectpicker form-control" name="category_list[]">
              <option value="x" selected>Select</option>
              <option value="m">Movies</option>
              <option value="a">Actor</option>
              <option value="d">Director</option>
              <option value="p">Producer</option>
            </select>
          </div>
        </div>
      <?php endif ?>

      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>