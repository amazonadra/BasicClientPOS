<div class="x_panel">
  <div class="x_title">
    <h2><i class="glyphicon glyphicon-gift"></i>  Products</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
    </ul>
    <div class="clearfix"></div>
  </div>

  <div class="x_content">
    <table id="produk" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nama Produk</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($barang as $b) {?>
          <tr class="pos">
            <td class="kiri"><?php echo $b->id_barang; ?></td>
            <td class="kiri"><?php echo $b->nama; ?></td>
            <td class="kiri"><?php echo $b->stock; ?></td>
            <td class="kanan">Rp. <?php echo number_format($b->harga,2,",","."); ?></td>
            <td class="kanan"><a type="button" class="btn btn-default btn-sm btn-success tambahitem" id="<?php echo $b->id_barang; ?>"> <i class="fa fa-shopping-cart"></i></a></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
