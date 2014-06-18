<?php if (isset($_GET['iuox_zone']) && $_GET['iuox_zone'] != ''): ?>
<script type="text/javascript" src="http://assets.investmentu.com/root/js/investmentu/iuox.js"></script>

<div class="modal fade" id="url_popup_ad" tabindex="-1" role="dialog" aria-labelledby="url_popup_ad_label" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="text-align:center">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin:-15px -10px 0 0">&times;</button>
				<?php if($_GET['iuox_zone'] != 'test'): ?>
					<script type='text/javascript'><!--//<![CDATA[
						iuox.display(<?= $_GET['iuox_zone'] ?>);
					//]]>--></script>
				<?php else: ?>
					<a href="#"><img src="http://placehold.it/560x355" /></a>
				<?php endif ?>
			
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery(document).ready(function() {jQuery('#url_popup_ad').modal('show');});
</script>
<?php endif ?>
