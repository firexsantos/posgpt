<div class="container mt-5">
    <?php
        $id = trim(@$_GET['id']);

        if(isset($_POST['proses'])){
            $no_transaksi = $_POST['no_transaksi'];
            $simpan = mysqli_query($con, "INSERT INTO transaksi (no_transaksi, useradd) VALUE ('".$no_transaksi."','".$sesuser."')");
            if($simpan){
                header("Location: dash.php?menu=add-transaksi&id=".$no_transaksi);
            }else{
                echo"<div class='alert alert-danger'>Terjadi kesalahan, data gagal diproses.</div>";
            }
        }else if(isset($_POST['simpandetail'])){
            $no_transaksi = $id;
            $kode_barang = $_POST['kode_barang'];
            $harga = $_POST['harga'];
            $qty = $_POST['qty'];
            $total = $_POST['total'];

            $scek = mysqli_query($con, "SELECT * FROM transaksi_detail WHERE kode_barang = '".$kode_barang."' AND no_transaksi = '".$no_transaksi."'");
            $hcek = mysqli_num_rows($scek);
            if($hcek > 0){
                $dcek = mysqli_fetch_array($scek);
                $qty = $dcek['qty'] + $qty;
                $total = $dcek['total'] + $total;
                $simpan = mysqli_query($con, "UPDATE transaksi_detail SET qty = '".$qty."', total = '".$total."' WHERE kode_barang = '".$kode_barang."'");
            }else{
                $simpan = mysqli_query($con, "INSERT INTO transaksi_detail (no_transaksi, kode_barang, harga, qty, total) VALUE ('".$no_transaksi."','".$kode_barang."','".$harga."','".$qty."','".$total."')");
            }
            
            if($simpan){
                header("Location: dash.php?menu=add-transaksi&id=".$no_transaksi);
            }else{
                echo"<div class='alert alert-danger'>Terjadi kesalahan, data gagal diproses.</div>";
            }
        }else if(isset($_POST['hapusdetail'])){
            $id_detail = $_POST['id_detail'];
            $simpan = mysqli_query($con, "DELETE FROM transaksi_detail WHERE id_detail = '".$id_detail."'");
            if($simpan){
                header("Location: dash.php?menu=add-transaksi&id=".$id);
            }else{
                echo"<div class='alert alert-danger'>Terjadi kesalahan, data gagal diproses.</div>";
            }
        }else if(isset($_POST['bayarken'])){
            $grand = $_POST['grand'];
            $bayar = $_POST['bayar'];
            $kembali = $_POST['kembali'];
            $simpan = mysqli_query($con, "UPDATE transaksi SET grand = '".$grand."', bayar = '".$bayar."', kembali = '".$kembali."', `status` = 'selesai' WHERE no_transaksi = '".$id."'");
            if($simpan){
                header("Location: dash.php?menu=transaksi");
            }else{
                echo"<div class='alert alert-danger'>Terjadi kesalahan, data gagal diproses.</div>";
            }
        }

        
        if(empty($id)){
    ?>
    <h1>Tambah Transaksi Penjualan</h1>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <form method="post" class="card">
                <div class="card-header fw-bold">Formulir Tambah Transaksi</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">No. Transaksi :</label>
                        <input type="text" class="form-control fw-bold text-danger" name="no_transaksi" value="<?= autotransaksi() ?>" placeholder="No. Transaksi" readonly>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="dash.php?menu=transaksi" class="btn btn-link">Batal</a>
                    <button type="submit" name="proses" class="btn btn-primary">Proses dan Lanjutkan</button>
                </div>
            </form>
        </div>
        <div class="col-md-8 col-lg-9">

        </div>
    </div>
    <?php
        }else{
    ?>
    <h1>Tambah Barang</h1>
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <form method="post" class="card">
                <div class="card-header fw-bold">#<?= $id ?></div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kode Barang :</label>
                        <select class="form-control" name="kode_barang" id="kode_barang" onchange="cekBarang()" required>
                            <option value="">[ Pilih Barang ]</option>
                            <?php
                                $sbar = mysqli_query($con,"SELECT * FROM barang");
                                while($dbar = mysqli_fetch_array($sbar)){
                                    echo"<option value='".$dbar['kode_barang']."'>".$dbar['kode_barang']." - ".$dbar['nm_barang']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div id="form_lanjut">
                        <div class="mb-3">
                            <label class="form-label">Nama Barang :</label>
                            <input type="text" id="nm_barang" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Barang :</label>
                            <input type="text" id="nm_barangjns" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Satuan :</label>
                            <input type="text" id="nm_barangsat" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">@Harga :</label>
                            <input type="text" id="harga" name="harga" class="form-control" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity :</label>
                            <input type="number" id="qty" name="qty" onkeyup="hitungTotal()" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Total :</label>
                            <input type="text" id="total" name="total" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="dash.php?menu=transaksi" class="btn btn-link">Batal</a>
                    <button type="submit" name="simpandetail" class="btn btn-primary">Tambahkan</button>
                </div>
            </form>
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="card">
                <div class="card-header fw-bold">Keranjang</div>
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th class="text-end">@Harga</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Total</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $nodet = 1;
                            $grand = 0;
                            $sdet = mysqli_query($con, "SELECT a.*, b.nm_barang FROM transaksi_detail a LEFT JOIN barang b ON a.kode_barang = b.kode_barang WHERE no_transaksi = '".$id."'");
                            while($ddet = mysqli_fetch_array($sdet)){
                                echo"
                                    <tr>
                                        <td class='text-center'>".$nodet."</td>
                                        <td>".$ddet['kode_barang']."</td>
                                        <td>".$ddet['nm_barang']."</td>
                                        <td class='text-end'>".rupiah($ddet['harga'])."</td>
                                        <td class='text-center'>".$ddet['qty']."</td>
                                        <td class='text-end'>".rupiah($ddet['total'])."</td>
                                        <td class='text-center'>
                                            <a href='#' class='btn btn-danger btn-sm bthapusdetail' data-bs-toggle='modal' data-bs-target='#modalHapusDetail' data-id='".$ddet['id_detail']."' data-nama='".$ddet['nm_barang']."'>Hapus</a>
                                        </td>
                                    </tr>
                                ";
                                $grand = $grand + $ddet['total'];
                                $nodet++;
                            }
                        ?>
                        <tfooter>
                            <tr>
                                <th colspan="5" class="text-end">Grand Total : Rp</th>
                                <th class="text-end"><?= rupiah($grand) ?></th>
                                <th></th>
                            </tr>
                        </tfooter>
                    </tbody>
                </table>
                <div class="card-footer">
                    <button type="button" class="btn btn-warning" data-bs-toggle='modal' data-bs-target="#modalBayar">Proses Pembayaran</button>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>


<div class="modal fade" id="modalBayar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Proses Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Grand Total :</label>
                        <input type="text" id="grand" name="grand" class="form-control" value="<?= $grand ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bayar :</label>
                        <input type="number" id="bayar" placeholder="Ketik jumlah bayar" onkeyup="hitungKembali()" name="bayar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kembali :</label>
                        <input type="text" id="kembali" name="kembali" class="form-control" readonly>
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" name="bayarken">Proses dan Selesaikan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalHapusDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <input type="hidden" name="id_detail" id="id_detail_hapusdetail">
                    <div class="alert alert-danger">Anda yakin akan menghapus data <b id="nama_hapusdetail"></b>? data yang sudah dihapus tidak bisa dikembalikan lagi.</div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-danger" name="hapusdetail">Ya! Hapus Data</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    $("#form_lanjut").hide();
    function cekBarang(){
        var kode_barang = $("#kode_barang").val();
        $.ajax({
            type: "POST",
            data: {kode_barang:kode_barang},
            url: "ajax.php?jenis=cekbarang",
            success: function(respon){
                // console.log(respon);
                $("#form_lanjut").show();
                $("#nm_barang").val(respon.nm_barang);
                $("#nm_barangjns").val(respon.nm_barangjns);
                $("#nm_barangsat").val(respon.nm_barangsat);
                $("#harga").val(respon.harga_jual);
            }
        });
    }

    function hitungTotal(){
        var harga = $("#harga").val();
        var qty = $("#qty").val();
        total = harga * qty;
        $("#total").val(total);
    }

    function hitungKembali(){
        var grand = $("#grand").val();
        var bayar = $("#bayar").val();
        kembali = bayar - grand;
        $("#kembali").val(kembali);
    }

    $(document).on('click', '.bthapusdetail', function() {
		const id 	= $(this).data('id');
		const nama 	= $(this).data('nama');
		$('#id_detail_hapusdetail').val(id);
		document.getElementById("nama_hapusdetail").innerHTML = nama;
		//console.log("data : " + nama);
	});
</script>