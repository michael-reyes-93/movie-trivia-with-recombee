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
        <label for="uploaded_poster">Poster Image: <?= (!empty($data['photo_err'])) ? '<sup>*</sup>' : '<b>'.$data['poster'].'</b>'; ?></label>
        <input type="file" name="uploaded_poster" id="uploaded_poster" class="form-control-file form-control-lg <?= (!empty($data['photo_err'])) ? 'is-invalid' : ''; ?>">
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
      <div class="form-row">
        <div class="form-group col-lg-2">
          <label for="director">Director: </label>
          <select class="selectpicker form-control <?= (!empty($data['director_err'])) ? 'is-invalid' : ''; ?>" name="director" data-live-search="true">
            <?php foreach($data['director_list'] as $director): ?>
              <?php if (!empty($data['director'])): ?>
                <option <?= $data['director'] == $director->person_id ? 'selected' : ''; ?> value="<?= $director->person_id ?>"><?= $director->name ?></option>
              <?php else: ?>
                <option value="<?= $director->person_id ?>"><?= $director->name ?></option>
              <?php endif; ?>
            <?php endforeach ?>
          </select>
          <span class="invalid-feedback"><?= $data['director_err']; ?></span>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-2">
          <label for="cast">Cast: </label>
          <select class="selectpicker form-control <?= (!empty($data['cast_err'])) ? 'is-invalid' : ''; ?>" name="cast[]" multiple data-actions-box="true" data-live-search="true">
            <?php foreach($data['actor_list'] as $actor): ?>
              <?php if (!empty($data['cast'])): ?>
                <option <?= in_array($actor->person_id, $data['cast']) ? 'selected' : ''; ?> value="<?= $actor->person_id ?>"><?= $actor->name ?></option>
              <?php else: ?>
                <option value="<?= $actor->person_id ?>"><?= $actor->name ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </select>
          <span class="invalid-feedback"><?= $data['cast_err']; ?></span>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-lg-2">
          <label for="producers">Producers: </label>
          <select class="selectpicker form-control <?= (!empty($data['producers_err'])) ? 'is-invalid' : ''; ?>" name="producers[]" multiple data-actions-box="true" data-live-search="true">
            <?php foreach($data['producer_list'] as $producer): ?>
              <?php if (!empty($data['producers'])): ?>
                <option <?= in_array($producer->person_id, $data['producers']) ? 'selected' : ''; ?> value="<?= $producer->person_id ?>"><?= $producer->name ?></option>
              <?php else: ?>
                <option value="<?= $producer->person_id ?>"><?= $producer->name ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </select>
          <span class="invalid-feedback"><?= $data['producers_err']; ?></span>
        </div>
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

      <input type="hidden" name="poster" value="<?= $data['poster']; ?>">

      <input type="submit" value="Submit" class="btn btn-success">
    </form>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>