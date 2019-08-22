<?php /* Template Name: Landing Page */ ?>

<?php get_header(); ?>

			<div id="content" class="cf">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php get_template_part( 'parts/header', 'custom' ); ?>
        
        <div class="fishing-pages section cf">
          <div class="page-blocks-wrapper">
          <?php $args = array(
                  'include' => '6,8,10,12'
          ); 
          $pages = get_pages($args);
          foreach ( $pages as $page ) {
            $image_array = wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), 'full' );
            $image = $image_array[0];
            ?>
            <div class="page-block" style="background-image: url('<?php echo $image; ?>');">
              <a href="<?php echo get_page_link( $page->ID ); ?>">
                <div class="overlay mobile-hide"></div>
                <img class="mobile-show" src="<?php echo $image; ?>" />
                <div class="page-block-contents">
                  <h2><?php echo $page->post_title; ?></h2>
                  <p>Location: <strong><?php echo get_field('location',$page->ID); ?></strong></p>
                  <p>Situation: <strong><?php echo get_field('situation',$page->ID); ?></strong></p>
                  <button class="white-btn mobile-show">View More</button>
                </div>
              </a>
            </div>
          <?php } ?>
          </div>
          <div class="mobile-show page-nav-wrap">
            <div class="page-blocks-nav-mobile">
            <?php $args = array(
                    'include' => '6,8,10,12'
            ); 
            $pages = get_pages($args);
            foreach ( $pages as $page ) {
            ?>
              <div class="page-block-mobile">
                <span><?php echo $page->post_title; ?></span>
              </div>
            <?php } ?>
            </div>
          </div>
        </div>
        <div id="product-anchors" class="section cf">
          <div id="products" class="anchor"></div>
          <div class="wrap cf">
            
            <?php if( have_rows('product_row') ): ?>
              <ul class="product-anchor-list">

              <?php while( have_rows('product_row') ): the_row(); 
                $post_object = get_sub_field('product_anchor');
                $post = $post_object;
                setup_postdata($post);
                $outlinedImage = get_field('menu_outlined_image');
                ?>
                <li>
                  <a href="#<?php echo $post->post_name; ?>"><span class="anchor-image"><img src="<?php echo $outlinedImage['sizes']['medium']; ?>" /></span><span><strong><?php the_title(); ?></strong></span><span><?php echo get_field('title_description'); ?></span></a>
                </li>
              <?php wp_reset_postdata(); endwhile; ?>

              </ul>
            <?php endif; ?>
            
          </div>
        </div>
        
        <?php get_template_part( 'parts/product', 'rows' ); ?>
        
        <?php endwhile; endif; ?>
        
			</div>


<?php get_footer(); ?>
