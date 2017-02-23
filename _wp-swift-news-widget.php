<article id="wp-swift-news-widget" class="row widget widget_meta">
	<?php if ($title): ?>
		<h6><?php echo $title; ?></h6>
		<div class="line"></div>
	<?php endif;
	$post_type='post';
	if (!$posts_per_page) {
		$posts_per_page=4;
	}
	if ($post_type && $posts_per_page):

		$args = array( 
		    'post_type' => $post_type, 
		    'posts_per_page' => $posts_per_page, 
		    'category_name' => 'news',
		);
		global $wp_query;
		$wp_query = new WP_Query($args);
		if ( have_posts() ) :
			?>

				<?php
			    while ( have_posts() ) : the_post();   

			        ?>
			            <div>
			            	<h5 class="news-title"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h5>
			            	<div class="date">
				            	<span class="date-time"><?php echo get_the_time(); ?></span>
				            	<span class="date-day"><?php echo the_date('d M Y'); ?></span>
			            	</div>
			            	<div class="entry-content"><?php the_excerpt(); ?></div>
			            </div>
			            
			        <?php 
			    endwhile; 
				?>

			<?php    
		endif; // End have_posts() check.	
	endif; // End $post_type && $posts_per_page check.	?>

	<?php if ($message): ?>
		<div class="message"><?php echo $message ?></div>
	<?php endif; ?>
</article>


