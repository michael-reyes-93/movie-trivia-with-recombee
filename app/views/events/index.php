<?php require APPROOT . '/views/inc/header.php'; ?>
  <?= flash('event_message') ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Persons</h1>
    </div>
    <div class="col-md-6">
      <a href="<?= URLROOT; ?>/events/add" class="btn btn-primary pull-right">
        <i class="fas fa-pencil-alt"></i> Add Event
      </a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row mb-5">
      <div class="col-xl-8 col-lg-6 col-md-8">
        <div class="row align-items-center justify-content-center">
          <div class="col-xl-10 col-12 mb-4 mb-xl-0">
            <h3 class="text-muted text-center mb-3">Events</h3>
            <table class="table table-striped bg-light text-center">
              <thead>
                <tr class="text-muted">
                  <th>Name</th>
                  <th>Year</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['events'] as $event): ?>
                  <tr>
                    <th><?= $event->name ?></th>
                    <td><?= $event->year ?></td>
                    <td>
                      <a href="<?= URLROOT; ?>/events/edit/<?= $event->event_id ?>" class="btn btn-primary"><i class="far fa-edit"></i></a>
                    </td>
                    <td>
                      <a href="<?= URLROOT; ?>/events/show/<?= $event->event_id ?>" class="btn btn-primary"><i class="far fa-eye"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>