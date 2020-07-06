<?php require APPROOT . '/views/inc/header.php'; ?>
  <!-- fluid -->
  <div class="container">
    <a href="<?= URLROOT; ?>/movies" class="btn btn-light align-self-start"><i class="fa fa-backward"></i> Back</a>
    <div class="card card-body bg-light row col-xl-10 mt-5">
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
          <input type="file" name="uploaded_poster" id="uploaded_poster" class="form-control-file form-control-lg <?= (!empty($data['photo_err'])) ? 'border border-danger' : ''; ?>">
          <?php if (!empty($data['photo_err'])): ?>
            <span class="text-danger" style="font-size: 80%;"><?= $data['photo_err']; ?></span>
          <?php endif; ?>
        </div>
        <!-- posters preview -->
        <div class="form-row justify-content-center" id="posters-preview" style="<?= (empty($data['poster'])) ? 'display:none;' : ''; ?>">
          <div class="d-flex align-items-end">
            <div class="col mx-5">
              <div>
                <img id="poster-preview" src="<?= URLROOT . '/img/posters/' . $data['poster'] ?>" style="width:343px;height:500px;" alt="your image"/>
              </div>
              <div class="text-center">
                Poster Large Preview
              </div>
            </div>
            <div class="col mx-5">
              <div>
                <img id="poster-preview-2" src="<?= URLROOT . '/img/posters/' . $data['poster'] ?>" style="width:196px;height:289px;" alt="your image"/>
              </div>
              <div class="text-center">
                Poster Small Preview
              </div>
            </div>
          </div>
        </div>
        <!-- end of posters preview -->
        <div class="form-group">
          <label for="uploaded_catalog_photo">catalog photo: <?= (!empty($data['uploaded_catalog_photo_err'])) ? '<sup>*</sup>' : '<b>'.$data['catalog_photo'].'</b>'; ?></label>
          <input type="file" name="uploaded_catalog_photo" id="uploaded_catalog_photo" class="form-control-file form-control-lg">
          <!-- <span class="invalid-feedback"><?= $data['photo_err']; ?></span> -->
        </div>
        <!-- carousel image preview -->
        <div class="form-row justify-content-center" id="catalog-preview" style="<?= (empty($data['catalog_photo']) && empty($data['no_catalog_photo'])) ? 'display:none;' : ''; ?>">
          <div class="col-7 d-flex align-items-end">
            <div class="col">
              <div class="d-flex justify-content-center">
                <img id="catalog-photo-preview" src="<?= !empty($data['no_catalog_photo']) ? $data['no_catalog_photo'] : URLROOT . '/img/catalog/' . $data['catalog_photo'] ?>" style="width:341px;height:192px;" alt="your image"/>
              </div>
              <div class="text-center">
                Catalog Image Preview
              </div>
            </div>
          </div>
        </div>
        <!-- end of carousel image preview -->
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
        <!-- check this later -->
        <!-- <div class="form-row"> -->
          <div class="form-group">
            <label for="director">Director: </label>
            <select class="col-lg-2 selectpicker form-control <?= (!empty($data['director_err'])) ? 'is-invalid' : ''; ?>" name="director" data-live-search="true">
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
        <!-- </div> -->
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
        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="soundtracks">Soundtracks: </label>
            <select class="selectpicker form-control <?= (!empty($data['soundtracks_err'])) ? 'is-invalid' : ''; ?>" name="soundtracks[]" multiple data-actions-box="true" data-live-search="true">
              <?php foreach($data['soundtrack_list'] as $soundtrack): ?>
                <?php if (!empty($data['soundtracks'])): ?>
                  <option <?= in_array($soundtrack->soundtrack_id, $data['soundtracks']) ? 'selected' : ''; ?> value="<?= $soundtrack->soundtrack_id ?>"><?= $soundtrack->name ?></option>
                <?php else: ?>
                  <option value="<?= $soundtrack->soundtrack_id ?>"><?= $soundtrack->name ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <span class="invalid-feedback"><?= $data['soundtracks_err']; ?></span>
          </div>
        </div>
        <!-- rating -->
        <div class="form-group">
          <label for="rating"> Rating: <sup>*</sup></label>
          <input type="text" name="rating" class="form-control form-control-lg <?= (!empty($data['rating_err'])) ? 'is-invalid' : ''; ?>" 
          value="<?= $data['rating']; ?>">
          <span class="invalid-feedback"><?= $data['rating_err']; ?></span>
        </div>
        <!-- end of rating -->
        <!-- movie genre -->
        <div class="form-row">
          <div class="col-4 mb-3">
            <label for="genres">Movie Genre: </label>
            <select id="genre-select" class="selectpicker form-control <?= (!empty($data['genres_err'])) ? 'is-invalid' : ''; ?>" name="genres[]" multiple data-actions-box="true" data-live-search="true">
              <?php foreach($data['genre_list'] as $genre): ?>
                <?php if (!empty($data['genres'])): ?>
                  <option <?= in_array($genre->genre_id, $data['genres']) ? 'selected' : ''; ?> value="<?= $genre->genre_id ?>"><?= $genre->name ?></option>
                <?php else: ?>
                  <option value="<?= $genre->genre_id ?>"><?= $genre->name ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <span class="invalid-feedback"><?= $data['genres_err']; ?></span>
          </div>
          <div class="col-ml-2 mb-4 align-self-end">
            <b class="align-baseline mr-3">If genre is not listed, you can add it</b>
            <a class="align-baseline toggle-genre">
              <i class="fas fa-sign-out-alt text-danger fa-lg"></i>
            </a>
          </div>
        </div>
        <div class="form-group" id="genre" style="display:none;">
          <label for="genre"> genre: <sup>*</sup></label>
          <input type="text" name="genre" class="form-control form-control-lg" id="genre-name">
          <span class="invalid-feedback"></span>
          <div class="mt-3">
            <button type="button" onclick="addGenre('<?= URLROOT; ?>/genres/test')" class="btn btn-success" id="genre_add">Add Genre</button>
          </div>
        </div>
        <!-- end of movie genre -->
        <!-- original languange -->
        <div class="form-row">
          <div class="col-4 mb-3">
            <label for="original_language">Original Language: </label>
            <select id="original-language-select" class="selectpicker form-control <?= (!empty($data['original_language_err'])) ? 'is-invalid' : ''; ?>" name="original_language" data-actions-box="true" data-live-search="true">
              <?php foreach($data['languages_list'] as $language): ?>
                <?php if (!empty($data['original_language'])): ?>
                  <option <?= $language->language_id == $data['original_language'] ? 'selected' : ''; ?> value="<?= $language->language_id ?>"><?= $language->language ?></option>
                <?php else: ?>
                  <option value="<?= $language->language_id ?>"><?= $language->language ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <span class="invalid-feedback"><?= $data['original_language_err']; ?></span>
          </div>
          <div class="col-ml-2 mb-4 align-self-end">
            <b class="align-baseline mr-3">If language is not listed, you can add it</b>
            <a class="align-baseline toggle-language">
              <i class="fas fa-sign-out-alt text-danger fa-lg"></i>
            </a>
          </div>
        </div>
        <div class="form-group" id="language" style="display:none;">
          <label for="language"> language: <sup>*</sup></label>
          <input type="text" name="language" class="form-control form-control-lg" id="language-name">
          <span class="invalid-feedback"></span>
          <div class="mt-3">
            <button type="button" onclick="addLanguage('<?= URLROOT; ?>/languages/add')" class="btn btn-success" id="language_add">Add Language</button>
          </div>
        </div>
        <!-- end of orginal language -->
        <!-- origin country -->
        <div class="form-row">
          <div class="col-4 mb-3">
            <label for="origin_country">Origin Country: </label>
            <select class="selectpicker form-control <?= (!empty($data['origin_country_err'])) ? 'is-invalid' : ''; ?>" name="origin_country" data-actions-box="true" data-live-search="true">
              <?php foreach($data['country_list'] as $country): ?>
                <?php if(!empty($data['origin_country'])): ?>
                  <option <?= $country->id == $data['origin_country'] ? 'selected' : ''; ?> value="<?= $country->id ?>"><?= $country->country ?></option>
                <?php else: ?>
                  <option value="<?= $country->id ?>"><?= $country->country ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <span class="invalid-feedback"><?= $data['origin_country_err']; ?></span>
          </div>
          <div class="col-ml-2 mb-4 align-self-end">
            <b class="align-baseline mr-3">If country is not listed, you can add it</b>
            <a class="align-baseline toggle-country">
              <i class="fas fa-sign-out-alt text-danger fa-lg"></i>
            </a>
          </div>
        </div>
        <div class="form-group" id="country" style="display:none;">
          <label for="country"> Country: <sup>*</sup></label>
          <input type="text" name="country" class="form-control form-control-lg" id="country-name">
          <span class="invalid-feedback"></span>
          <div class="mt-3">
            <button type="button" onclick="addCountry('<?= URLROOT; ?>/countries/test')" class="btn btn-success" id="country_add">Add Country</button>
          </div>
        </div>
        <!-- end of origin country -->
        <div class="form-group">
          <label for="streaming_on"> Streaming On: <sup>*</sup></label>
          <input type="text" name="streaming_on" class="form-control form-control-lg <?= (!empty($data['streaming_on_err'])) ? 'is-invalid' : ''; ?>" 
          value="<?= $data['streaming_on']; ?>">
          <span class="invalid-feedback"><?= $data['streaming_on_err']; ?></span>
        </div>
        <div class="form-row">
          <div class="col-2 mb-3">
            <label for="awards" class="mr-4" style="color: red; font-weight: bold;"> Awards: <sup>*</sup></label>
            <button type="button" onclick="assignMovieToAward('<?= URLROOT; ?>')" class="btn btn-primary mb-3">Add Award Input</button>
          </div>
        </div>
        <b id="awards-note">If the award is not in the list, please add it inside the corresponding event. You can edit an existing event or add a new event</b>
        <br>
        <br>
        <!-- awards - status -->
        <?php if(!empty($data['awards_status'])): ?>
          <?php foreach($data['awards_status'] as $award_status): ?>
            <div class="form-row align-items-center">
              <div class="form-group col-lg-8">
                <label for="movie_awards"> Award 1: <sup>*</sup></label>
                <select class="selectpicker form-control <?= (!empty($data['countries_err'])) ? 'is-invalid' : ''; ?>" name="movie_awards[]" data-actions-box="true" data-live-search="true">
                <?php foreach($data['movie_awards_list'] as $movie_award): ?>
                  <?php if (!empty($data['awards_status'])): ?>
                    <option <?= $award_status['award_id'] == $movie_award->award_id ? 'selected' : ''; ?> value="<?= $movie_award->award_id ?>"><?= $movie_award->name ?></option>
                  <?php else: ?>
                    <option value="<?= $movie_award->award_id ?>"><?= $movie_award->name ?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select>
              </div>
              <div class="form-group col-lg-2">
                <label for="status">status in participation: </label>
                <select class="col-5 selectpicker form-control" data-actions-box="true" name="status[]">
                  <option value="nominated" <?= $award_status['status'] == 'nominated' ? 'selected' : '' ?>>nominated</option>
                  <option value="winner" <?= $award_status['status'] == 'winner' ? 'selected' : '' ?>>winner</option>
                </select>
              </div>
              <button type="button" class="btn btn-danger award-status-remove"><i class="fas fa-minus-circle"></i></button>
            </div>
          <?php endforeach ?>
        <?php endif ?>

        <!-- end of awards - status -->
        <div class="form-row">
          <div class="col-4 mb-3">     
            <label for="dubbed_languages" style="color: red; font-weight: bold;">Dubbed Languages: </label>
            <select id="dubbed-language-select" class="selectpicker form-control <?= (!empty($data['dubbed_languages_err'])) ? 'is-invalid' : ''; ?>" name="dubbed_languages[]" multiple data-actions-box="true" data-live-search="true">
              <?php foreach($data['languages_list'] as $language): ?>
                <?php if (!empty($data['dubbed_languages'])): ?>
                  <option <?= in_array($language->language_id, $data['dubbed_languages']) ? 'selected' : ''; ?> value="<?= $language->language_id ?>"><?= $language->language ?></option>
                <?php else: ?>
                  <option value="<?= $language->language_id ?>"><?= $language->language ?></option>
                <?php endif ?>            
              <?php endforeach ?>
            </select>
            <span class="invalid-feedback"><?= $data['dubbed_languages_err']; ?></span>
          </div>
        </div>
        <div class="form-row">
          <div class="col-4 mb-3">     
            <label for="subtitle_languages" style="color: red; font-weight: bold;">Subtitles Languages: </label>
            <select id="subtitles-select" class="selectpicker form-control <?= (!empty($data['subtitle_languages_err'])) ? 'is-invalid' : ''; ?>" name="subtitle_languages[]" multiple data-actions-box="true" data-live-search="true">
              <?php foreach($data['languages_list'] as $language): ?>
                <?php if (!empty($data['subtitle_languages'])): ?>
                  <option <?= in_array($language->language_id, $data['subtitle_languages']) ? 'selected' : ''; ?> value="<?= $language->language_id ?>"><?= $language->language ?></option>
                <?php else: ?>
                  <option value="<?= $language->language_id ?>"><?= $language->language ?></option>
                <?php endif ?>            
              <?php endforeach ?>
            </select>
            <span class="invalid-feedback"><?= $data['subtitle_languages_err']; ?></span>
          </div>
        </div>
        
        <input type="hidden" name="poster" value="<?= $data['poster']; ?>">
        <input type="hidden" name="catalog_photo" value="<?= $data['catalog_photo']; ?>">

        <input type="submit" value="Submit" class="btn btn-success">
      </form>
    </div>
  </div>


<?php require APPROOT . '/views/modals/modal.php'; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>