<section class="instagramFeed">
	<div class="instagramFeed__heading">
		<h2 class="ssfood__secHeading" style="margin: 100px 0 50px"><?php _e('Follow us on Instagram @supersonicfood', 'codestick'); ?></h2>
	</div>
	<?php
	echo do_shortcode('[elfsight_instagram_feed id="1"]');
	// if($lang == 'pl-PL'){
	// 	echo do_shortcode('[elfsight_instagram_feed id="1"]');
	// }elseif($lang == 'de-DE'){
	// 	echo do_shortcode('[elfsight_instagram_feed id="2"]');
	// }else{
	// 	echo do_shortcode('[elfsight_instagram_feed id="3"]');
	// }
	?>
</section>