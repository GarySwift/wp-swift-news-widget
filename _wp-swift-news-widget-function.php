<?php
/*
Plugin Name:       WP Swift: News Widget
Description:       A widget that shows latest school news
Version:           1.0.0
Author:            Gary Swift
License:           GPL-2.0+
Text Domain:       wp-swift-news-widget
*/
 
class WP_Swift_News_Widget extends WP_Widget {
 
    public function __construct() {
     
        parent::__construct(
            'wp_swift_news_widget',
            __( 'WP Swift: News Widget', 'wp-swift-news-widget' ),
            array(
                'classname'   => 'wp_swift_news_widget',
                'description' => __( 'A widget that shows latest school news.', 'wp-swift-news-widget' )
                )
        );
       
        load_plugin_textdomain( 'wp-swift-news-widget', false, basename( dirname( __FILE__ ) ) . '/languages' );
       
    }
 
    /**  
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget( $args, $instance ) {    
         
        extract( $args );
         

        $title='';
        // $post_type='';
        $posts_per_page = '';        
        $message='';
        if (isset($instance['title'])) {
          $title = apply_filters( 'widget_title', $instance['title'] );
        }
        // if (isset($instance['post_type'])) {
        //   $post_type = $instance['post_type'];
        // }
        if (isset($instance['posts_per_page'])) {
          $posts_per_page = $instance['posts_per_page'];
        }
        if (isset($instance['message'])) {
          $message = $instance['message'];
        }
    
        include( plugin_dir_path( __FILE__ ) . '_wp-swift-news-widget.php');
    }
 
  
    /**
      * Sanitize widget form values as they are saved.
      *
      * @see WP_Widget::update()
      *
      * @param array $new_instance Values just sent to be saved.
      * @param array $old_instance Previously saved values from database.
      *
      * @return array Updated safe values to be saved.
      */
    public function update( $new_instance, $old_instance ) {        
         
        $instance = $old_instance;
         
        $instance['title'] = strip_tags( $new_instance['title'] );
        // $instance['post_type'] = strip_tags( $new_instance['post_type'] );
        $instance['posts_per_page'] = strip_tags( $new_instance['posts_per_page'] );
        $instance['message'] = strip_tags( $new_instance['message'] );
         
        return $instance;
         
    }
  
    /**
      * Back-end widget form.
      *
      * @see WP_Widget::form()
      *
      * @param array $instance Previously saved values from database.
      */
    public function form( $instance ) { 
        $show_form=true;   
        $title='';
        // $post_type='';
        $posts_per_page = '';
        $message='';

        if (isset($instance['title'])) {
          $title = esc_attr( $instance['title'] );
        }
        // if (isset($instance['post_type'])) {
        //   $post_type = esc_attr( $instance['post_type'] );
        // }
        if (isset($instance['posts_per_page'])) {
          $posts_per_page = esc_attr( $instance['posts_per_page'] );
        }
        if (isset($instance['message'])) {
          $message = esc_attr( $instance['message'] );
        }
        
        ?>
        <p>A widget that shows all school class links.</p>
        <?php if ($show_form): ?>
          <p>
              <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label> 
              <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
          </p>
      <?php /*
          <p>
              <label for="<?php echo $this->get_field_id('post_type'); ?>"><?php _e('Post Type (lowercase slug):'); ?></label> 
              <input class="widefat" id="<?php echo $this->get_field_id('post_type'); ?>" name="<?php echo $this->get_field_name('post_type'); ?>" type="text" value="<?php echo $post_type; ?>" />
          </p>
          */ ?>
          <p>
              <label for="<?php echo $this->get_field_id('posts_per_page'); ?>"><?php _e('Posts Per Page (Number):'); ?></label> 
              <input class="widefat" id="<?php echo $this->get_field_id('posts_per_page'); ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" type="number" max="30" value="<?php echo $posts_per_page; ?>" />
          </p>          
          <p>
              <label for="<?php echo $this->get_field_id('message'); ?>"><?php _e('Simple Message'); ?></label> 
              <textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('message'); ?>" name="<?php echo $this->get_field_name('message'); ?>"><?php echo $message; ?></textarea>
          </p>          
        <?php endif ?>

     
    <?php 
    }
     
}
 
/* Register the widget */
add_action( 'widgets_init', function(){
     register_widget( 'WP_Swift_News_Widget' );
});