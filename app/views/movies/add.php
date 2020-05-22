<?php require APPROOT . '/views/inc/header.php'; ?>

  <a href="<?= URLROOT; ?>/movies" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>
  <div class="card card-body bg-light mt-5">
    <h2>Add Post</h2>
    <p>Create a post with this form</p>
    <form action="<?= URLROOT; ?>/movies/add" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="title"> Title: <sup>*</sup></label>
        <input type="text" name="title" class="form-control form-control-lg <?= (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['title']; ?>">
        <span class="invalid-feedback"><?= $data['title_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="story"> Description: <sup>*</sup></label>
        <textarea name="story" rows=4 class="form-control form-control-lg <?= (!empty($data['story_err'])) ? 'is-invalid' : ''; ?>"><?= $data['story']; ?></textarea>
        <span class="invalid-feedback"><?= $data['story_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="photo"> Poster Image: <?= (!empty($data['photo_err'])) ? '<sup>*</sup>' : '<b>'.$data['poster'].'</b>'; ?></label>
        <input type="file" name="photo" id="photo" class="form-control form-control-lg <?= (!empty($data['photo_err'])) ? 'is-invalid' : ''; ?>">
        <span class="invalid-feedback"><?= $data['photo_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="release_date"> Release Date: <sup>*</sup></label>
        <input type="date" name="release_date" class="form-control form-control-lg <?= (!empty($data['release_date_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['release_date']; ?>">
        <span class="invalid-feedback"><?= $data['release_date_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="budget"> Budget: <sup>*</sup></label>
        <input type="text" name="budget" class="form-control form-control-lg <?= (!empty($data['budget_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['budget']; ?>">
        <span class="invalid-feedback"><?= $data['budget_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="return_of_investment"> Return Of Investment: <sup>*</sup></label>
        <input type="text" name="return_of_investment" class="form-control form-control-lg <?= (!empty($data['return_of_investment_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['return_of_investment']; ?>">
        <span class="invalid-feedback"><?= $data['return_of_investment_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="director"> Director id: <sup>*</sup></label>
        <input type="text" name="director" class="form-control form-control-lg <?= (!empty($data['director_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['director']; ?>">
        <span class="invalid-feedback"><?= $data['director_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="music_director"> Music Director Name: <sup>*</sup></label>
        <input type="text" name="music_director" class="form-control form-control-lg <?= (!empty($data['music_director_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['music_director']; ?>">
        <span class="invalid-feedback"><?= $data['music_director_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="rating"> Rating: <sup>*</sup></label>
        <input type="text" name="rating" class="form-control form-control-lg <?= (!empty($data['rating_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['rating']; ?>">
        <span class="invalid-feedback"><?= $data['rating_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="original_language"> original language: <sup>*</sup></label>
        <input type="text" name="original_language" class="form-control form-control-lg <?= (!empty($data['original_language_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['original_language']; ?>">
        <span class="invalid-feedback"><?= $data['original_language_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="country"> Country: <sup>*</sup></label>
        <input type="text" name="country" class="form-control form-control-lg <?= (!empty($data['country_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['country']; ?>">
        <span class="invalid-feedback"><?= $data['country_err']; ?></span>
      </div>
      <div class="form-group">
        <label for="streaming_on"> Streaming On: <sup>*</sup></label>
        <input type="text" name="streaming_on" class="form-control form-control-lg <?= (!empty($data['streaming_on_err'])) ? 'is-invalid' : ''; ?>" 
        value="<?= $data['streaming_on']; ?>">
        <span class="invalid-feedback"><?= $data['streaming_on_err']; ?></span>
      </div>

      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>