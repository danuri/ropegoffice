<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Data Aset</h4>

          <div class="page-title-right">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Aset
            </button>
          </div>

        </div>
      </div>

      <div class="col-12 align-self-center">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="asettable">
              <thead>
                <tr>
                  <th>KODE</th>
                  <th>KATEGORI</th>
                  <th>MEREK/TIPE</th>
                  <th>TANGGAL MASUK</th>
                  <th>FOTO</th>
                  <th>STATUS</th>
                  <th>OPSI</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div id="addModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Tambah Aset</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="kode" class="form-label">Kategori</label>
                      </div>
                      <div class="col-lg-9">
                        <select class="form-select" name="kategori" id="kategori">
                          <?php foreach ($kategori as $row) {?>
                            <option value="<?= $row->id ?>"><?= $row->nama_kategori ?></option>
                          <?php } ?>
                        </select>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="kode" class="form-label">Kode</label>
                      </div>
                      <div class="col-lg-9">
                        <input type="text" class="form-control" name="kode" id="kode">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="merek" class="form-label">Merek</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="merek" id="merek">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="tipe" class="form-label">Tipe</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="tipe" id="tipe">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="tanggal" class="form-label">Tanggal Masuk</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="date" class="form-control" name="tanggal" id="tanggal">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="foto" class="form-label">Foto</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="file" class="form-control" name="foto" id="foto">
                      </div>
                  </div>
              </form>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
                  <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
              </div>

          </div>
      </div>
  </div>
  <?= $this->endSection() ?>

  <?= $this->section('script') ?>
  <script src="https://cdn.jsdelivr.net/npm/axios@1.6.7/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    var table = new DataTable('#asettable',{
        processing: true,
        serverSide: true,
        ajax: '<?= site_url('aset/getaset')?>',
        columns: [
            {data: 'kode_aset'},
            {data: 'kategori_id'},
            {data: 'nama'},
            {data: 'tanggal'},
            {data: 'imgfoto'},
            {data: 'status'},
            {data: 'action'},
        ]
    });

    $('#simpan').on('click',function(event) {
      loaderin();

      const form = new FormData();
      form.append('kode', $('#kode').val());
      form.append('kategori', $('#kategori').val());
      form.append('merek', $('#merek').val());
      form.append('tipe', $('#tipe').val());
      form.append('tanggal', $('#tanggal').val());
      form.append('foto', $('#foto').prop('files')[0]);

      axios.post('<?= site_url('aset/save')?>', form, {
        headers: {
          'Content-Type': 'multipart/form-data'
        }
      })
      .then(function (response) {
        loaderout();
        alert('Data telah disimpan');
        table.ajax.reload(null, false);
        $('#addModal').modal('hide');
      })
      .catch(function (error) {
        loaderout();
        console.log(error);
      });
    });

  });
  </script>
  <?= $this->endSection() ?>
