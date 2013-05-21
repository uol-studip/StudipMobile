<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1, initial-scale=1, user-scalable=no">

    <title>Stud.IP Mobile</title>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/vendor/jquery.mobile/studip.min.css" />
    <link rel="stylesheet" href="<?= $plugin_path ?>/public/stylesheets/mobile.css" />
    <link rel="stylesheet"  href="<?= $plugin_path ?>/public/stylesheets/jquery.swipeButton.css" />
    <link rel="apple-touch-icon" href="<?= $plugin_path ?>/public/images/quickdial/ios.png" type="image/gif" />

    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>

    <!-- MAP-->
    <script src="http://maps.google.com/maps/api/js?sensor=true" type="text/javascript"></script>
    <script src="<?= $plugin_path ?>/public/vendor/map/jquery.ui.map.full.min.js" type="text/javascript"></script>
    <!-- END MAP-->

    <script src="<?= $plugin_path ?>/public/javascripts/custom.js"></script>
    <!-- CUSTOM END -->
    <script src="<?= $plugin_path ?>/public/vendor/mustache/jquery.mustache.js"></script>
    <script src="<?= $plugin_path ?>/public/vendor/date/date.js"></script>
    <script src="<?= $plugin_path ?>/public/javascripts/jquery.swipeButton.min.js"></script>
    <script src="<?= $plugin_path ?>/public/javascripts/side_menu.min.js"></script>
    <script>
      var STUDIP = STUDIP || {};
      STUDIP.ABSOLUTE_URI_STUDIP = "<?= $GLOBALS['ABSOLUTE_URI_STUDIP'] ?>";

      //register, cause external link like class="externallink" data-ajax="false" not work for android standard browser
      $('a.externallink').bind( 'tap', function(){ window.location = this.href; } );

        $(document).ready(function() {

                // attach the plugin to an element
                $('#swipeMe li').swipeDelete({
                        btnTheme: 'f',
                        click: function(e){
                                e.preventDefault();
                                var url = $(e.target).attr('href');
                                $(this).parents('li').remove();
                                $.post(url, function(data) {
                                        console.log(data);
                                });
                        }
                });

        });
    </script>

    <style>
      /* TODO put this into external CSS stylesheets */
      body.calendar .ui-page {
        background: url('<?= $plugin_path ?>/public/images/rag.jpg');
      }
    </style>

  </head>
  <body class="<?= $body_class ?>">
    <?= $content_for_layout ?>
  </body>
</html>
