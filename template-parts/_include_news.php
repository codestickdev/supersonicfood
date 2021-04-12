<article id="post-<?php the_ID(); ?>" class="blogPost">
	<div class="blogPost__thumb">
		<a href="<?php the_permalink(); ?>">
			<img src="<?php echo get_the_post_thumbnail_url(); ?>"/>
		</a>
	</div>
	<div class="blogPost__content">
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="date"><?php echo get_the_date('j F Y'); ?></p>
		<p>
			<?php
			$text = strip_shortcodes( $post->post_content );
			$text = apply_filters( 'the_content', $text );
			$text = str_replace(']]>', ']]&gt;', $text);
			$excerpt_length = apply_filters( 'excerpt_length', 35 );
			$excerpt_more = apply_filters( 'excerpt_more', '...' );
			$text = wp_trim_words( $text, $excerpt_length, $excerpt_more );

			echo $text;
			?>
		</p>
	</div>
</article>