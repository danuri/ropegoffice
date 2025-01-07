<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Surat Masuk</h4>

          <div class="page-title-right">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Surat Masuk
            </button>
          </div>

        </div>

        <div class="card border card-border-warning">
          <div class="card-body">
            <form action="javascript:void(0);" class="row g-3">
                <div class="col-md-4">
                    <label for="tahun" class="form-label">Tahun</label>
                    <select id="tahun" class="form-select">
                        <option value="2025" selected>2025</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-12 align-self-center">
        <div class="card">
          <div class="card-body">
            <table class="table" id="asettable">
              <thead>
                <tr>
                  <th>Agenda</th>
                  <th>Tanggal Surat</th>
                  <th>Nama</th>
                  <th>Perihal</th>
                  <th>Asal Surat</th>
                  <th>Arah</th>
                  <th>Cetak</th>
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
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Tambah Surat Masuk</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_via" class="form-label">Masuk Surat Via</label>
                      </div>
                      <div class="col-lg-4">
                        <input type="text" class="form-control" name="srt_via" id="srt_via">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_via_agenda" class="form-label">Nomor Agenda</label>
                      </div>
                      <div class="col-lg-4">
                        <input type="text" class="form-control" name="srt_via_agenda" id="srt_via_agenda">
                      </div>
                      <div class="col-lg-2">
                          <label for="srt_via_tanggal" class="form-label">Tanggal Agenda</label>
                      </div>
                      <div class="col-lg-3">
                        <input type="date" class="form-control" name="srt_via_tanggal" id="srt_via_tanggal" value="<?= date('Y-m-d')?>">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_asal" class="form-label">Asal Surat</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="srt_asal" id="srt_asal">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_asal_nomor" class="form-label">Nomor Surat</label>
                      </div>
                      <div class="col-lg-4">
                          <input type="text" class="form-control" name="srt_asal_nomor" id="srt_asal_nomor">
                      </div>
                      <div class="col-lg-2">
                          <label for="srt_asal_tanggal" class="form-label">Tanggal Surat</label>
                      </div>
                      <div class="col-lg-3">
                          <input type="date" class="form-control" name="srt_asal_tanggal" id="srt_asal_tanggal" value="<?= date('Y-m-d')?>">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_asal_perihal" class="form-label">Perihal</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="srt_asal_perihal" id="srt_asal_perihal">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_asal_nama" class="form-label">Atas Nama</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="srt_asal_nama" id="srt_asal_nama">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_asal_nama" class="form-label">Agenda TU</label>
                      </div>
                      <div class="col-lg-4">
                          <input type="text" class="form-control" name="srt_kode" id="srt_kode">
                      </div>
                      <div class="col-lg-2">
                          <label for="srt_asal_nama" class="form-label">Tanggal Diterima</label>
                      </div>
                      <div class="col-lg-3">
                          <input type="date" class="form-control" name="srt_tanggal_terima" id="srt_tanggal_terima" value="<?= date('Y-m-d')?>">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_arah" class="form-label">Arah Surat</label>
                      </div>
                      <div class="col-lg-4">
                          <select class="form-select" name="srt_arah" id="srt_arah">
                            <option value="Kabag I">Kabag I</option>
                            <option value="Kabag II">Kabag II</option>
                            <option value="Kasubbag TU">Kasubbag TU</option>
                            <option value="Karopeg">Karopeg</option>
                          </select>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="srt_arah" class="form-label">Sifat Surat</label>
                      </div>
                      <div class="col-lg-4">
                          <input type="text" class="form-control" name="srt_sifat" id="srt_sifat">
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

  <div id="detailModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="myModalLabel">Detail Surat Masuk</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
              </div>
              <div class="modal-body" id="detailsurat">
                Loading
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">Tutup</button>
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
        ajax: {
          url: '<?= site_url('surat/surat_masuk/getdata')?>',
            data: function (d) {
                d.tahun = $('#tahun').val()
            }
        },
        columns: [
            {data: 'srt_kode'},
            {data: 'srt_asal_tanggal'},
            {data: 'srt_asal_nama'},
            {data: 'srt_asal_perihal'},
            {data: 'srt_asal'},
            {data: 'srt_arah'},
            {data: 'action'},
        ]
    });

    $('#tahun').change(function(event) {
        table.ajax.reload();
    });

    $('#simpan').on('click',function(event) {
      loaderin();

      axios.post('<?= site_url('surat/surat_masuk/save')?>', {
        srt_via: $('#srt_via').val(),
        srt_via_agenda: $('#srt_via_agenda').val(),
        srt_via_tanggal: $('#srt_via_tanggal').val(),
        srt_asal: $('#srt_asal').val(),
        srt_asal_nomor: $('#srt_asal_nomor').val(),
        srt_asal_tanggal: $('#srt_asal_tanggal').val(),
        srt_asal_perihal: $('#srt_asal_perihal').val(),
        srt_asal_nama: $('#srt_asal_nama').val(),
        srt_kode: $('#srt_kode').val(),
        srt_tanggal_terima: $('#srt_tanggal_terima').val(),
        srt_arah: $('#srt_arah').val(),
        srt_sifat: $('#srt_sifat').val(),
      })
      .then(function (response) {
        loaderout();
        alert('Surat telah disimpan');
        table.ajax.reload(null, false);
        $('#addModal').modal('hide');
      })
      .catch(function (error) {
        loaderout();
        console.log(error);
      });
    });

  });

  function detail(id) {
    $('#detailsurat').load('<?= site_url('surat/surat_masuk/detail')?>/'+id);
    $('#detailModal').modal('show');
  }
  </script>
  <?= $this->endSection() ?>
