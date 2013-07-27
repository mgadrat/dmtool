<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <title>DM Tool</title>

  <link rel="stylesheet" href="assets/css/vendor/foundation.css" />
  <script src="assets/js/vendor/custom.modernizr.js"></script>

</head>
<body>

	<div class="row">
		<div class="large-12 columns">
			<h2>Welcome to DM Tools</h2>
			<p>This is version 0.0.0.1</p>
			<hr />
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<div id="content">
        <?php if(!empty($message)): ?>
        <div id="message" class="alert-box <?php echo $message_type; ?>">
          <?php echo $message; ?>
        </div>
        <?php endif; ?>
        <?php if(!empty($output)): ?>
        <div id="output">
          <?php echo $output; ?>
        </div>
        <?php endif; ?>
				Backbone Application will be here
			</div>
		</div>
	</div>

  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? 'assets/js/vendor/zepto' : 'assets/js/vendor/jquery') +
  '.js><\/script>')
  </script>
  
  <script src="assets/js/vendor/foundation/foundation.min.js"></script>
  <script src="assets/js/vendor/underscore.min.js"></script>
  <script src="assets/js/vendor/handlebar.js"></script>
  <script src="assets/js/vendor/backbone.min.js"></script>
  <!--
  <script src="assets/js/vendor/foundation/foundation.js"></script>
  <script src="assets/js/vendor/foundation/foundation.alerts.js"></script>
  <script src="assets/js/vendor/foundation/foundation.clearing.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.cookie.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.dropdown.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.forms.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.joyride.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.magellan.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.orbit.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.reveal.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.section.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.tooltips.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.topbar.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.interchange.js"></script>  
  <script src="assets/js/vendor/foundation/foundation.placeholder.js"></script>  
  -->
  <script>
    $(document).foundation();
  </script>
</body>
</html>
