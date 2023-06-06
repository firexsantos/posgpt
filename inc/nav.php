<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="dash.php"><?= identitas() ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link <?php if(empty($menu)){ echo "active";} ?>" href="dash.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($menu == "pengguna"){ echo "active";} ?>" href="dash.php?menu=pengguna">Pengguna</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php if($menu == "barangsat" || $menu == "barangjns"){ echo "active";} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Master
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?php if($menu == "barangjns"){ echo "active";} ?>" href="dash.php?menu=barangjns">Jenis Barang</a></li>
              <li><a class="dropdown-item <?php if($menu == "barangsat"){ echo "active";} ?>" href="dash.php?menu=barangsat">Satuan Barang</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($menu == "barang"){ echo "active";} ?>" href="dash.php?menu=barang">Data Barang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if($menu == "transaksi"){ echo "active";} ?>" href="dash.php?menu=transaksi">Transaksi</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle <?php if($menu == "lap-penjualan"){ echo "active";} ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              Laporan
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item <?php if($menu == "lap-penjualan"){ echo "active";} ?>" href="dash.php?menu=lap-penjualan">Lap. Penjualan</a></li>
              <li><a class="dropdown-item" href="pdf.php?menu=lap-stok" target="_blank">Lap. Stok Barang</a></li>
            </ul>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>