<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link <?= uri_string() == '' ? '' : 'collapsed' ?>" href="<?= base_url() ?>">
        <i class="bi bi-grid"></i>
        <span>Home</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= uri_string() == 'keranjang' ? '' : 'collapsed' ?>" href="<?= base_url('keranjang') ?>">
        <i class="bi bi-cart-check"></i>
        <span>Keranjang</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link <?= uri_string() == 'kategori' ? '' : 'collapsed' ?>" href="<?= base_url('kategori') ?>">
        <i class="bi bi-tags"></i>
        <span>Kategori</span>
      </a>
    </li>

    <?php if (session('role') === 'admin'): ?>
      <li class="nav-item">
        <a class="nav-link <?= uri_string() == 'produk' ? '' : 'collapsed' ?>" href="<?= base_url('produk') ?>">
          <i class="bi bi-receipt"></i>
          <span>Produk</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?= uri_string() == 'diskon' ? '' : 'collapsed' ?>" href="<?= base_url('diskon') ?>">
          <i class="bi bi-cash-coin"></i>
          <span>Diskon</span>
        </a>
      </li>
    <?php endif; ?>

    <li class="nav-item">
      <a class="nav-link <?= uri_string() == 'profile' ? '' : 'collapsed' ?>" href="<?= base_url('profile') ?>">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li>

  </ul>
</aside>
