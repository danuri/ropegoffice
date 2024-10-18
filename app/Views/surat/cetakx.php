<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <style>
    body {
      font-family: 'American Typewriter', serif;
      font-size: 15px;
      padding-left: 50px;
    }

    @media print {
    body{
        width: 21cm;
        height: 29.7cm;
        margin: 30mm 45mm 30mm 45mm;
        /* change the margins as you want them to be. */
       }
    }
    </style>
  </head>
  <body>
    <div style="padding-left:300px;margin-top:100px;margin-bottom:20px;">
      <?= $surat->srt_kode?>
    </div>
    <table border="0" width="500px">
      <tr>
        <td height="20px"><?= $surat->srt_asal_nomor?></td>
      </tr>
      <tr>
        <td height="20px"><?= $surat->srt_asal?></td>
      </tr>
      <tr>
        <td height="20px"><?= $surat->srt_asal_perihal?> - <?= $surat->srt_asal_nama?></td>
      </tr>
      <tr>
        <td height="20px"><?= $surat->srt_asal_tanggal?></td>
      </tr>
    </table>
    <div style="padding-left:250px;margin-top:50px;">
      <?= $surat->srt_arah?>
    </div>

    <script type="text/javascript">
    window.addEventListener("afterprint", function(event) {
        window.close()
    })
    window.print()
    </script>
  </body>
</html>