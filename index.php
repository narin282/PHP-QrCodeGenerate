
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>CPO : QR Code Generator</title>
    <link rel="icon" type="image/png" href="media/img/icon.png" />
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
    
    <!-- Custom styles for this template -->
    <link href="css/floating-labels.css" rel="stylesheet">
  </head>
  <body>
    <?PHP
        include('phpqrcode/qrlib.php');
        
        if (isset($_POST['codeText'])) {
            $PNG_WEB_DIR = 'temp/'; //กำหนด Path รูป Qr Code
            $filename = $_POST['filename'];
            $path = $PNG_WEB_DIR.$filename.'.png'; //ไฟล์
            $codeText = $_POST['codeText'];
            $errorCorrectionLevel = 'L'; 
            $size = 14; //ขนาด QR Code
            $frame = 1;
            QRcode::png($codeText, $path, $errorCorrectionLevel, $size, $frame);
        }
    ?>
    <form class="form-signin" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="text-center mb-4">
            <?php
                if (!isset($_POST['codeText'])) {
                    echo '<img class="mb-4" src="media/img/qr-loading.png" alt="" width="150" height="150"/>';
                }else {
                    echo '<img src='."$path".' width="150" height="150"/>';
                }
            ?>
        </div>
        <div class="text-center mb-4">
            <h1 class="h3 mb-3 font-weight-normal">QR Code Generator by Narin</h1>
            <p>Place website [URL] or text for generate QR Code.</p>
        </div>

        <div class="form-label-group">
            <input type="text" name="codeText" class="form-control" placeholder="www.example.com" required autofocus>
        </div>
        <input type="text" name="filename" value="<?=date("YmdHis")?>" hidden>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Generate QR Code </button>
        <?php
            if (isset($_POST['codeText'])) {
                echo '<a class="btn btn-lg btn-danger btn-block" href="'.$path.'" download>Download QR Code</a>';
            }
        ?>
        <p class="mt-5 mb-3 text-muted text-center">EGAT-CPO &copy; 2017-<?php echo date('Y');?></p>
    </form>
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
