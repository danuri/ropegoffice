<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Kategori Aset</h4>

          <div class="page-title-right">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Kategori
            </button>
          </div>

        </div>
      </div>

      <div class="col-12 align-self-center">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="kategoritable">
              <thead>
                <tr>
                  <th>KODE</th>
                  <th>KATEGORI</th>
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
                  <h5 class="modal-title" id="myModalLabel">Tambah Kategori</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
              </div>
              <div class="modal-body">
                <form action="">
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
                          <label for="nama" class="form-label">Nama Kategori</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="nama" id="nama">
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
  <script type="text/javascript">
  $(document).ready(function() {
    var table = new DataTable('#kategoritable',{
        processing: true,
        serverSide: true,
        ajax: '<?= site_url('aset/getkategori')?>',
        columns: [
            {data: 'kode'},
            {data: 'nama_kategori'},
            {data: 'action'}
        ]
    });

    $('#simpan').on('click',function(event) {
      loaderin();
      axios.post('<?= site_url('aset/kategori/save')?>', {
        kode: $('#kode').val(),
        nama: $('#nama').val()
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
