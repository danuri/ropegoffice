<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
          <h4 class="mb-sm-0">Nomor Agenda Keluar</h4>

          <div class="page-title-right">
            <select class="form-select" name="tahun" id="tahun">
              <?php for ($i=date('Y'); $i > 2018 ; $i--) {
                echo '<option value="'.$i.'">'.$i.'</option>';
              } ?>
            </select>
          </div>

        </div>
      </div>

      <div class="col-12 align-self-center">
        <div class="card">
          <div class="card-body">
            <form action="<?= site_url('surat/agenda_keluar/add')?>" method="POST" id="addagenda">
              <div class="row">
                <div class="col-lg-4">
                  <label for="employeeName" class="form-label">Pemohon</label>
                  <select class="select2" name="pemohon">
                    <?php foreach ($pegawai as $row) {
                      echo '<option value="'.$row->NIP_BARU.'#'.$row->NAMA_LENGKAP.'#'.$row->KODE_SATKER_3.'#'.$row->SATKER_3.'">'.$row->NAMA_LENGKAP.'</option>';
                    } ?>
                  </select>
                </div>
                <div class="col-lg-4">
                  <label for="StartleaveDate" class="form-label">Perihal</label>
                  <input type="text" class="form-control" name="perihal" id="perihal">
                </div>
                <div class="col-lg-2">
                  <label for="EndleaveDate" class="form-label">Jumlah</label>
                  <input type="number" class="form-control" name="jumlah" id="jumlah">
                </div>
                <div class="col-lg-2">
                  <button type="submit" class="btn btn-primary mt-4">Book</button>
                </div>
              </div>
          </form>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped" id="agenda">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Pemohon</th>
                  <th>Perihal</th>
                  <th>Jumlah</th>
                  <th>Nomor</th>
                  <th>Sampai</th>
                  <th></th>
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
  <?= $this->endSection() ?>

  <?= $this->section('script') ?>
  <script src="<?= base_url()?>assets2/js/jquery.form.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      var table = new DataTable('#agenda',{
          processing: true,
          serverSide: true,
          ajax: '<?= site_url('surat/agenda_keluar/getdata')?>',
          columns: [
              {data: 'created_at'},
              {data: 'pemohon'},
              {data: 'perihal'},
              {data: 'jumlah_nomor'},
              {data: 'nomor_mulai'},
              {data: 'nomor_sampai'},
              {data: 'action'},
          ],
          ordering: false
      });

      $('#addagenda').submit(function() {
        $(this).ajaxSubmit({
          success: function(responseText, statusText, xhr, $form){
            alert(responseText.message);
            table.ajax.reload(null, false);
          }
        });
        return false;
      });
    });
  </script>
  <?= $this->endSection() ?>
