<div class="x_panel">
  <div class="x_title">
    <h2><i class="glyphicon glyphicon-shopping-cart"></i>  Cart</h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <form id="beli">
      <table id='carttable' class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Sub-Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody class='hasil'>
          <tr>
            <td colspan="2"><strong>Total Belanja</strong></td>
            <td><b class="total"><?php echo $this->cart->total_items(); ?></b> Item(s)</td>
            <td></td>
            <td style="text-align:right"><b>Rp. <?php echo number_format($this->cart->total(),2,",","."); ?></b></td>
            <td></td>
          </tr>
          <tr>
            <td colspan="2"><strong>Jumlah Bayar</strong></td>
            <td colspan="3"></td>
            <td></td>
          </tr>
        </tbody>
      </table>
      <a class="btn btn-default submit btn-sm resetitem"><i class="fa fa-trash-o"></i> Clear</a>
      <button type="submit" class="btn btn-default submit btn-sm btn-primary"><i class="fa fa-check" required></i> Check Out</button>
    </form>
  </div>
</div>
