
  </div>
</div>
<?php if($script->language['dir'] == 'rtl'): ?>
<link type="text/css" href="<?php echo $script->settings['path'] ?>/clientscripts/bootstrap/css/bootstrap-rtl.min.css" rel="stylesheet" media="screen" />
<?php endif; ?>
<style type="text/css">
<?php if($script->language['dir'] == 'rtl'): ?>
html, body { direction: rtl; }
#userPanel .business .name { margin-right: 0px; margin-left: 560px; }
#userPanel .business .options, #userPanel .business .lastupdate { float: left; }
#userPanel .business .options { width: 300px }
.ui-autocomplete-loading { background-position: left center; }
  <?php if($script->detect->isMobile()): ?>
#userPanel .business .name { margin-left: 215px; margin-right: 0; }
#userPanel .business .options { float: left;  }
@media only screen and (max-width : 320px) {
	#change_language { position: absolute; left: 215px; opacity: 0.8;  }
	#userPanel .business .name { margin-left: 160px; }
}
@media only screen and (max-width : 375px) {
	#userPanel .business .name { margin-left: 160px; }
}
  <?php endif; ?>
<?php else: ?>
  <?php if($script->detect->isMobile()): ?>
#userPanel .business .name { margin-right: 215px; margin-left: 0;   }
#userPanel .business .options { float: right; }
@media only screen and (max-width : 320px) {
	#userPanel .business .name { margin-right: 160px; }
}
@media only screen and (max-width : 375px) {
	#userPanel .business .name { margin-right: 160px; }
}
  <?php endif; ?>
<?php endif; ?>
</style>
</body>
</html>