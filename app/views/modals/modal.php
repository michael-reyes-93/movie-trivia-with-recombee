  <!-- modal -->
  <div class="modal fade" id="sign-out">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><?= $data['event']->name ?></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          Press logout to leave
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="addParticipant('<?= URLROOT; ?>/participants/modal')">Stay Here</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal" id="logout">Logout</button>
        </div>
      </div>
    </div>
  </div>
  <!-- end of modal -->