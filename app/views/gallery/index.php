<?php require APPROOT . '/views/inc/header.php'; ?>
 <!-- gallery --> 
 <section class="py-5">
      <div class="container-fluid">
        <!-- title -->
        <div class="row text-muted text-center">
          <div class="col m-4">
            <h1 class="display-4 mb-4">Gallery</h1>
            <div class="underline-dark mb-4"></div>
            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae nostrum laudantium laborum accusantium, dignissimos repellat explicabo saepe consectetur quidem tempore.</p>
          </div>
        </div>
        <!-- end of title -->
        <ul class="list-inline text-center text-uppercase font-weight-bold my-4">
          <li class="list-inline-item gallery-list-item active-item" data-filter="all">
            All<span class="mx-md-5 mx-3 text-muted">/</span>
          </li>
          <li class="list-inline-item gallery-list-item" data-filter="new">
            New<span class="mx-md-5 mx-3 text-muted">/</span>
          </li>
          <li class="list-inline-item gallery-list-item" data-filter="free">
            Free<span class="mx-md-5 mx-3 text-muted">/</span>
          </li>
          <li class="list-inline-item gallery-list-item" data-filter="pro">
            Pro
          </li>
        </ul>
        <div class="container-fluid">
          <div class="d-flex flex-wrap justify-content-center">
            <div class="filter new m-3">
              <img src="img/images/img1.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img2.jpeg" alt="" width="300">
            </div>
            <div class="filter free m-3">
              <img src="img/images/img3.jpeg" alt="" width="300">
            </div>
            <div class="filter new m-3">
              <img src="img/images/img4.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img5.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img6.jpeg" alt="" width="300">
            </div>
            <div class="filter new m-3">
              <img src="img/images/img7.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img8.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img9.jpeg" alt="" width="300">
            </div>
            <div class="filter free m-3">
              <img src="img/images/img10.jpeg" alt="" width="300">
            </div>
            <div class="filter new m-3">
              <img src="img/images/img11.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img12.jpeg" alt="" width="300">
            </div>
            <div class="filter free m-3">
              <img src="img/images/img13.jpeg" alt="" width="300">
            </div>
            <div class="filter free m-3">
              <img src="img/images/img14.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img15.jpeg" alt="" width="300">
            </div>
            <div class="filter pro m-3">
              <img src="img/images/img16.jpeg" alt="" width="300">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end of gallery -->
    <ul class="list-inline text-center text-uppercase font-weight-bold my-4">
      <li class="list-inline-item gallery-list-item active-item" data-filter="all">
        All<span class="mx-md-5 mx-3 text-muted">/</span>
      </li>
      <li class="list-inline-item gallery-list-item" data-filter="new">
        New<span class="mx-md-5 mx-3 text-muted">/</span>
      </li>
      <li class="list-inline-item gallery-list-item" data-filter="free">
        Free<span class="mx-md-5 mx-3 text-muted">/</span>
      </li>
      <li class="list-inline-item gallery-list-item" data-filter="pro">
        Pro
      </li>
    </ul>
    <div class="d-flex flex-wrap justify-content-center">
      <?php foreach ($data['top_5'] as $movieInTop): ?>
        <?php if($movieInTop): ?>
          <div class="card col-2 h-100 m-3">      
            <img src="<?= file_exists('img/posters/' . $movieInTop->name) ? 'img/posters/' . $movieInTop->name : 'http://placehold.it/343x500?text=sample%20image' ?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?= $movieInTop->name ?></h5>
              <button class="button btn-danger delete-card" data-toggle="modal" data-target="#participant-delete-modal-<?= $participant->participant_id ?>">
                <i class="far fa-trash-alt" aria-hidden="true"></i>
              </button>
              <button class="button btn-primary edit-card" data-toggle="modal" data-target="#participant-edit-modal-<?= $participant->participant_id ?>">
                <i class="fa fa-edit" aria-hidden="true"></i>
              </button>      
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>