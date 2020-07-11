<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center" url="<?= URLROOT ?>">
    <li class="page-item" page="previous"> <!-- disabled -->
      <a class="page-link">Previous</a>
    </li>
    <?php for ($i=1; $i <= $data['last_page']; $i++): ?>
      <li class="page-item <?= $i == 1 ? 'active' : '' ?>" page="<?= $i ?>">
        <a class="page-link"><?= $i ?></a>
      </li>
    <?php endfor; ?>
    <li class="page-item" page="next">
      <a class="page-link">Next</a>
    </li>
  </ul>
</nav>