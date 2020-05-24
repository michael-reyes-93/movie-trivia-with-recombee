<?php require APPROOT . '/views/inc/header.php'; ?>
  <?= flash('person_message') ?>
  <div class="row mb-3">
    <div class="col-md-6">
      <h1>Persons</h1>
    </div>
    <div class="col-md-6">
      <a href="<?= URLROOT; ?>/persons/add" class="btn btn-primary pull-right">
        <i class="fas fa-pencil-alt"></i> Add Person
      </a>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row mb-5">
      <div class="col-xl-8 col-lg-6 col-md-8">
        <div class="row align-items-center justify-content-center">
          <div class="col-xl-10 col-12 mb-4 mb-xl-0">
            <h3 class="text-muted text-center mb-3">Actors, Producers and Directors</h3>
            <table class="table table-striped bg-light text-center">
              <thead>
                <tr class="text-muted">
                  <th>Name</th>
                  <th>Born</th>
                  <th>Biography</th>
                  <th>Roles</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($data['persons'] as $person): ?>
                  <tr>
                    <th><?= $person->name ?></th>
                    <td><?= $person->born ?></td>
                    <td><?= $person->biography ?></td>
                    <td>
                      <?php 
                        $roles = [];
                        if ($person->is_actor != 0) {
                          array_push($roles, "actor");
                        }
                        if ($person->is_producer != 0) {
                          array_push($roles, "producer");
                        }
                        if ($person->is_director) {
                          array_push($roles, "director");
                        }
                        echo join(" / ", $roles);
                      ?>
                    </td>
                    <td>
                      <a href="<?= URLROOT; ?>/persons/edit/<?= $person->person_id ?>" class="btn btn-primary"><i class="far fa-edit"></i></a>
                      <a href="<?= URLROOT; ?>/persons/show/<?= $person->person_id ?>" class="btn btn-primary"><i class="far fa-eye"></i></a>
                      <!-- <a href="#" class="btn"><i class="far fa-eye"></a> -->
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