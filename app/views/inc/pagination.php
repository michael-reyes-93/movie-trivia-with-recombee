<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center" url="<?= $data['url'] ?>">
    <li class="page-item" page="previous" style="display: none"> <!-- disabled -->
      <a class="page-link">Previous</a>
    </li>
    <?php for ($i=1; $i <= getLastPage(); $i++): ?>
      <li class="page-item <?= $i == 1 ? 'active' : '' ?>" page="<?= $i ?>">
        <a class="page-link"><?= $i ?></a>
      </li>
    <?php endfor; ?>
    <li class="page-item" page="next" limit="<?= getLastPage() ?>">
      <a class="page-link">Next</a>
    </li>
  </ul>
</nav>