<?php require APPROOT . '/views/inc/header.php'; ?>
  <!-- <h1><?= $data['title'] ?></h1> -->
  <!-- <pre>
    <?php print_r($data) ?>
  </pre> -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <?php for($i = 0; $i < count($data['top_5']); $i++): ?>
        <?php if($i == 0): ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="active"></li>
        <?php else: ?>
          <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>"></li>
        <?php endif ?>
      <?php endfor; ?>
    </ol>
    <div class="carousel-inner">
      <?php foreach($data['top_5'] as $key => $movieInTop): ?>
        <?= '<script>console.log(' . $key . ')</script>' ?>
        <div class="carousel-item <?= $key == 0 ? 'active' : '' ?>">
          <!-- <img class="d-block w-100 " src="<?= URLROOT; ?>/img/<?= $movieInTop->poster ?>" alt="First slide"> -->
          <img class="d-block w-100" style="height: 800px" src="<?= $movieInTop->cover ?>" alt="First slide">
        </div>
      <?php endforeach; ?>
        <!-- <div class="carousel-item active">
          <img class="d-block w-100" src="<?= URLROOT; ?>/img/la.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="<?= URLROOT; ?>/img/chicago.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="<?= URLROOT; ?>/img/ny.jpg" alt="Third slide">
        </div> -->
        
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <br>
  <br>
  <br>
  <div class="container-fluid">
    <input type="hidden" name="movies_count" value="<?= count($data['movies']); ?>">
    <?php for($i = 0; $i < count($data['movies']); $i++): ?>
    <div id="carouselExample<?= $i ?>" class="catalog carousel-group carousel slide" data-ride="carousel" data-interval="900000">
      <div class="catalog carousel-inner carousel-inner<?= $i ?> carousel-inner-genre row w-100 mx-auto" role="listbox">
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2 active">
          <img class="img-fluid mx-auto d-block" src="https://occ-0-465-472.1.nflxso.net/dnm/api/v6/X194eJsgWBDE2aQbaNdmCXGUP-Y/AAAABXzOmhCXfs1qAxNXmROvf1XvsQNM5hb8dHaWtnHuhouXpl6gqF9BL_axnRTD5tG0uNsceosdGFY-D3v3u_fLixP1shs.webp?r=dc3" alt="slide 1">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/HobbsShaw_341x192.jpg" alt="slide 2">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/13-Best-Shawshank_341x192.jpg" alt="slide 3">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/highlander-serie-television-duncan-macleod-1_341x192.jpg" alt="slide 4">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/Under-the-Red-Hood-Review_341x192.jpg" alt="slide 5">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/beetlejuice-movie_341x192.jpg" alt="slide 6">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/AAAABf60_mPqM-YklJ43hswydSOarCZ4kZWsGfDQsYxdtBfvEMplomSlYqL8C59m3T04IsvTDBO_E3CK77HjnhJXjiPwN5U_341x192.jpg" alt="slide 7">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/book-03-harry-potter-and-the-prisoner-of-azkaban-audiobook_341x192.jpg" alt="slide 8">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/landscape-desktop.764.430_341x192.jpg" alt="slide 9">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/450_1000_341x192.jpg" alt="slide 10">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/revenge_of_the_sith_by_1darthvader-d6ftwy7_341x192.jpg" alt="slide 11">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/The-Return-of-the-King-2003-movie_341x192.jpg" alt="slide 12">
        </div>
        <div class="catalog carousel-item carousel-item<?= $i ?> carousel-item-genre col-12 col-sm-6 col-md-4 col-lg-2">
          <img class="img-fluid mx-auto d-block" src="http://www.simpleimageresizer.com/_uploads/photos/8c12f95c/blade-runner-1-ksrC-U40966851055g8H-624x385Las_Provincias_341x192.jpg" alt="slide 13">
        </div>
      </div>
      <a class="catalog carousel-control-prev" href="#carouselExample<?= $i ?>" role="button" data-slide="prev">
        <i class="fas fa-arrow-circle-left fa-2x text-muted"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a class="catalog carousel-control-next text-faded" href="#carouselExample<?= $i ?>" role="button" data-slide="next">
        <i class="fas fa-arrow-circle-right fa-2x text-muted"></i>
        <span class="sr-only">Next</span>
      </a>
    </div>
    <br>
    <br>
    <?php endfor; ?>
  </div>

  <br>
  <br>
  <p class="d-block p-5">
    <br>
    split up and commented css for understanding. <br>
    fixed animation for previous slide. <br>
    added breakpoints and slide item counts
    <br><br>
    based on:
    <a href="https://www.codeply.com/go/s3I9ivCBYH">https://www.codeply.com/go/s3I9ivCBYH</a>

  </p>
<?php require APPROOT . '/views/inc/footer.php'; ?>