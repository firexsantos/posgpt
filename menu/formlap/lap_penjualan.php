<div class="container mt-5">
    <h1>Laporan Penjualan</h1>
    <div class="row">
        <div class="col-md-4">
            <form target="_blank" action="pdf.php" class="card">
                <input type="hidden" name="menu" value="lap-penjualan">
                <input type="hidden" name="jenis" value="tanggal">
                <div class="card-header fw-bold">Lap. Per-Tanggal</div>
                <div class="card-body" style="min-height:180px;">
                    <div class="mb-2">
                        <label>Pilih Tanggal :</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form target="_blank" action="pdf.php" class="card">
                <input type="hidden" name="menu" value="lap-penjualan">
                <input type="hidden" name="jenis" value="bulan">
                <div class="card-header fw-bold">Lap. Per-Bulan</div>
                <div class="card-body" style="min-height:180px;">
                    <div class="mb-2">
                        <label>Pilih Bulan :</label>
                        <select class="form-control" name="bulan" required>
                            <option value="">[ Pilih Bulan ]</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Ketik Tahun :</label>
                        <input type="number" min="2022" max="2050" class="form-control" placeholder="Ketik Tahun" name="tahun" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <form target="_blank" action="pdf.php" class="card">
                <input type="hidden" name="menu" value="lap-penjualan">
                <input type="hidden" name="jenis" value="tahun">
                <div class="card-header fw-bold">Lap. Per-Tahun</div>
                <div class="card-body" style="min-height:180px;">
                    <div class="mb-2">
                        <label>Ketik Tahun :</label>
                        <input type="number" min="2022" max="2050" class="form-control" placeholder="Ketik Tahun" name="tahun" required>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="reset" class="btn btn-default">Reset</button>
                    <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>