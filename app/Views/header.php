<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta http-equiv="Expires" content="Thursday, 25-Nov-20 00:00:00 GMT">
    <meta http-equiv="Last-Modified" content="Saturday, 5-Sep-20 14:33:00 GMT">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">

    <meta charset="utf-8">
    <meta http-equiv="X-Frame-Options" content="allow-from https://www.youtube.com/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?= csrf_hash(); ?>" >

    <!-- Primary Meta Tags -->
    <title>Luka$ para Emprender</title>
    <meta name="title" content="...">
    <meta name="description" content="...">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://default.com/">
    <meta property="og:title" content="...">
    <meta property="og:description" content="...">
    <meta property="og:image" content="<?= base_url('img/default.jpg');?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://default.com/">
    <meta property="twitter:title" content="...">
    <meta property="twitter:description" content="...">
    <meta property="twitter:image" content="<?= base_url('img/default.jpg');?>">

    <!-- Icon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('img/icons/dideco_logo.png');?>">
    
		<!-- Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('dist/bootstrap-5.1.3/css/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('dist/fontawesome-6.0.0/css/all.css?v=0.1');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('dist/magnificpopup-1.1.0/magnific-popup.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/animate.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/hover.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/dashboard.css');?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('css/styles.css?v=1.98');?>">

    <!-- Scripts -->
    <script type="text/javascript" src="<?= base_url('js/jquery-3.6.0.js'); ?>"></script>
    <script>
      WebFontConfig = {
        google: {
          families: ['Passion One:300,700', 'Poppins:300,500,700']
        }
      };

      (function(d) {
        var wf = d.createElement('script'), s = d.scripts[0];
        wf.src = "<?= base_url('js/webfont.js'); ?>";
        wf.async = true;
        s.parentNode.insertBefore(wf, s);
      })(document);

      /*
      function preloadFont(fontName) {
        let font = new FontFace(fontName, 'url(fonts/' + fontName + ')');
        font.load().then(function(loadedFont) {
          document.fonts.add(loadedFont);
        });
      }
      */
    </script>
  </head>
