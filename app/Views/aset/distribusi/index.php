<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Distribusi Aset</h4>

          <div class="page-title-right">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                Tambah Penggunaan
            </button>
          </div>

        </div>
      </div>

      <div class="col-12 align-self-center">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="disttable">
              <thead>
                <tr>
                  <th>PEGAWAI</th>
                  <th>ASET</th>
                  <th>PENERIMAAN</th>
                  <th>PENGEMBALIAN</th>
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
                  <h5 class="modal-title" id="myModalLabel">Distribusi Aset</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
              </div>
              <div class="modal-body">
                <form action="">
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="kode" class="form-label">NIP</label>
                      </div>
                      <div class="col-lg-9">
                        <div class="input-group">
                            <input type="text" class="form-control" aria-label="NIP Pegawai" aria-describedby="button-addon2" name="nip" id="nip">
                            <button class="btn btn-outline-success" type="button" id="button-addon2" onclick="searchpegawai()">Cari</button>
                        </div>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="merek" class="form-label">Nama</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="nama" id="nama" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="tipe" class="form-label">Jabatan</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="jabatan" id="jabatan" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="tipe" class="form-label">Satuan Kerja</label>
                      </div>
                      <div class="col-lg-9">
                          <input type="text" class="form-control" name="satker" id="satker" readonly>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="tanggal" class="form-label">Aset</label>
                      </div>
                      <div class="col-lg-9">
                        <select class="form-select" name="aset" id="aset">
                          <?php foreach ($assets as $row) {
                            echo '<option value="'.$row->id.'">'.$row->merek.' - '.$row->tipe.' - '.$row->kode_aset.'</option>';
                          } ?>
                        </select>
                      </div>
                  </div>
                  <div class="row mb-3">
                      <div class="col-lg-3">
                          <label for="tanggal" class="form-label">Tanggal Serah Terima</label>
                      </div>
                      <div class="col-lg-9">
                        <input type="date" name="tanggal_terima" id="tanggal_terima" class="form-control" value="">
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
    var table = new DataTable('#disttable',{
        processing: true,
        serverSide: true,
        ajax: '<?= site_url('aset/distribusi/getaset')?>',
        columns: [
            {data: 'nip'},
            {data: 'id_aset'},
            {data: 'tanggal_terima'},
            {data: 'tanggal_kembali'},
            {data: 'action'},
        ]
    });

    $('#simpan').on('click',function(event) {
      loaderin();
      axios.post('<?= site_url('aset/distribusi/save')?>', {
        nip: $('#nip').val(),
        nama: $('#nama').val(),
        satker: $('#satker').val(),
        jabatan: $('#jabatan').val(),
        id_aset: $('#aset').val(),
        tanggal_terima: $('#tanggal_terima').val()
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

    $.fn.modal.Constructor.prototype.enforceFocus = function() {};
    $('#aset').select2({
        dropdownParent: $('#addModal')
    });

  });

  function searchpegawai() {
    axios.get('<?= site_url() ?>ajax/searchpegawai/'+$('#nip').val())
    .then(function (response) {
      // handle success
      console.log(response.data);
      $('#nama').val(response.data.data.NAMA_LENGKAP);
      $('#satker').val(response.data.data.KETERANGAN_SATUAN_KERJA);
      $('#jabatan').val(response.data.data.TAMPIL_JABATAN);
    })
    .catch(function (error) {
      alert('Data tidak ditemukan');
    })
    .finally(function () {
      // always executed
    });
  }

  function uploadBA(id) {
    alert('adasd');
  }
  </script>
  <?= $this->endSection() ?>
