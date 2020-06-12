<div role="main" class="main shop py-4">
    <section class="page-header page-header-classic">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="breadcrumb">
                        <li><a class="breadcrumb-list" href="#">lelang</a></li>
                        <li class="active">detail lelang</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col p-static">
                    <h1 data-title-border><?php echo $lelang->nama_barang ?></h1><br >
                    <span class="badge badge-primary badge-xs" style="font-size:14px; font-weight:400; margin-top:10px; "><?php echo $lelang->jenis_barang ?></span>

                </div>
            </div>
        </div>
    </section>
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <img alt="" class="img-fluid" src="<?php echo $lelang->gambar_sementara ?>">
      </div>
      <div class="col-lg-6">
        <div class="summary entry-summary">
          <h1 class="mb-0 font-weight-bold text-7"> </h1>
          
          <p class="price">
            <span class="amount">Rp <?php echo number_format($lelang->harga_max) ?></span>
          </p> 
          <table class="table">
            <tbody>
              <tr>
                <td>Kondisi</td>
                <td>: Bekas</td>
              </tr>
              <tr>
                <td>Terakhir Di Perbarui</td>
                <td>: 22 September 2019</td>
              </tr>
              <tr>
                <td>Batas Penawaran</td>
                <td>: 22 September 2019</td>
              </tr>
              <tr>
                <td>Auctioneer</td>
                <td>: Rakyat</td>
              </tr>
            </tbody>
          </table>
          <!-- <h1 class="text-color-dark font-weight-normal text-5 mb-2">Lelang  <strong class="font-weight-extra-bold">Detail</strong></h1>
          <ul class="list list-icons list-primary list-borders text-3">
            <li><i class="fas fa-caret-right left-10"></i> <strong class="text-color-primary">Limit Lelang:</strong> <?php echo number_format($lelang->harga_max) ?></li>
            <li><i class="fas fa-caret-right left-10"></i> <strong class="text-color-primary">Tanggal Dimulai:</strong> 22 September 2019</li>
            <li><i class="fas fa-caret-right left-10"></i> <strong class="text-color-primary">Batas Lelang:</strong> 22 September 2019</li>
            <li><i class="fas fa-caret-right left-10"></i> <strong class="text-color-primary">Kondisi Barang:</strong> Bekas</li>
          </ul> -->
          <a href="<?php echo base_url("lelang/tawar_lelang"); ?>" class="btn btn-primary btn-block btn-modern text-uppercase">IKUT LELANG</a>
          <!-- <h4 class="mb-3 text-4 text-uppercase">Cara Berpatisipasi :</h4> -->
          <!-- <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> -->
          <!-- <form enctype="multipart/form-data" method="post" class="cart">
            <div class="quantity quantity-lg">
              <input type="button" class="minus" value="-">
              <input type="text" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
              <input type="button" class="plus" value="+">
            </div>
            <button href="#" class="btn btn-primary btn-block btn-modern text-uppercase">Ikut Lelang</button>
          </form> -->
          <div class="product-meta">
            <!-- <span class="posted-in">Categories: <a rel="tag" href="#"><?php echo $lelang->jenis_barang ?></a></span> -->
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="tabs tabs-product mb-2">
          <ul class="nav nav-tabs">
            <li class="nav-item active"><a class="nav-link py-3 px-4" href="#productDescription" data-toggle="tab">Deskripsi</a></li>
            <li class="nav-item"><a class="nav-link py-3 px-4" href="#productInfo" data-toggle="tab">Informasi Tambahan</a></li>
            <li class="nav-item"><a class="nav-link py-3 px-4" href="#riwayatpenawaran" data-toggle="tab">Riwayat Penawaran</a></li>
          </ul>
          <div class="tab-content p-0">
            <div class="tab-pane p-4 active" id="productDescription">
              <?php echo $lelang->deskripsi_barang ?>
            </div>
            <div class="tab-pane p-4" id="productInfo">
              <table class="table m-0">
                <tbody>
                  <tr>
                    <th class="border-top-0">
                      Size:
                    </th>
                    <td class="border-top-0">
                      Unique
                    </td>
                  </tr>
                  <tr>
                    <th>
                      Colors
                    </th>
                    <td>
                      Red, Blue
                    </td>
                  </tr>
                  <tr>
                    <th>
                      Material
                    </th>
                    <td>
                      100% Leather
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

