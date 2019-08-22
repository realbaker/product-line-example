<?php get_header(); ?>

			<div id="content" class="cf">
        
        <?php if (have_posts()) : while (have_posts()) : the_post(); global $post; ?>

        <?php get_template_part( 'parts/header', 'custom' ); ?>
        
        <?php 
        $quote = get_field('quote_text');
        $quoteBy = get_field('quote_credit_name');
        $quoteByTitle = get_field('quote_credit_title');
        if($quote) { ?>
          <div class="page-quote section cf">
            <div class="wrap cf">
              <div class="page-quote-text">
                <p>&#8220;<?php echo $quote; ?>&#8221;</p>
                <span class="quote-credit"><?php if($quoteBy){echo '<strong>- '.$quoteBy.'</strong>';} ?><?php if($quoteByTitle) echo ', '.$quoteByTitle; ?></span>
              </div>
            </div>
          </div>
        <?php } ?>
        
        <?php
        $page_video_youtube = get_field('youtube_embed_code');
        $page_video_poster_image = get_field('page_video_poster_image');
        $page_video_file_mp4 = get_field('page_video_file_mp4');
        $page_video_file_ogv = get_field('page_video_file_ogv');
        $page_video_file_webm = get_field('page_video_file_webm');
        if($page_video_youtube){ ?>
        <div class="page-video section cf">
          <img id="button-with-iframe" class="video-play-button" src="<?php echo get_template_directory_uri(); ?>/library/images/video-play-button-solid.png" />
          <div class="video-responsive">
            <?php echo $page_video_youtube; ?>
          </div>
        </div>
        <script type="text/javascript">
          var tag = document.createElement('script');
          tag.src = "https://www.youtube.com/iframe_api";
          var firstScriptTag = document.getElementsByTagName('script')[0];
          firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
          
          var player;
          function onYouTubeIframeAPIReady() {
            player = new YT.Player('video', {
              events: {
                'onReady': onPlayerReady
              }
            });
          }
          
          function onPlayerReady(event) {
            var playButton = document.getElementById("button-with-iframe");
            playButton.addEventListener("click", function() {
              event.target.playVideo();
              setTimeout(function(){ playButton.style.display = "none"; }, 800);
            });
          }

        </script>
        <?php } elseif($page_video_file_mp4 || $page_video_file_ogv || $page_video_file_webm) { ?> 
        <div class="page-video section cf" style="background-image: url('<?php echo $page_video_poster_image['url']; ?>');">
          <img id="button-with-poster" class="video-play-button" src="<?php echo get_template_directory_uri(); ?>/library/images/video-play-button.png" />
          <video poster="<?php echo $page_video_poster_image['url']; ?>" class="fullscreen-bg-video" playsinline>
            <?php if($page_video_file_mp4) { ?><source src="<?php echo $page_video_file_mp4; ?>" type="video/mp4"><?php } ?>
            <?php if($page_video_file_ogv) { ?><source src="<?php echo $page_video_file_ogv; ?>" type="video/ogg"><?php } ?>
            <?php if($page_video_file_webm) { ?><source src="<?php echo $page_video_file_webm; ?>" type="video/webm"><?php } ?>
          </video>
        </div>
        <?php } ?>
        <?php $text_blurb = get_field('text_blurb');
        if($text_blurb){ ?>
          <div class="section text-blurb cf">
            <div class="wrap cf">
              <?php echo $text_blurb; ?>
            </div>
          </div>
        <?php } ?>
        
        <?php
        if( have_rows('grid_layouts') ):
        
          echo '<div class="photo-grid-container section cf mobile-hide">';
            echo '<div class="wrap cf">';
        
          while ( have_rows('grid_layouts') ) : the_row();

              if( get_row_layout() == 'three_images_2_left_1_right' ):

              $topLeftImg = get_sub_field('top_left_image');
              $bottomLeftImg = get_sub_field('bottom_left_image');
              $rightImg = get_sub_field('right_image');
            ?>
            <div class="grid-onethird-twothirds grid-wrapper">
              <div class="grid-onethird">
                <img src="<?php echo $topLeftImg['sizes']['grid-one-third']; ?>" />
                <img class="align-bottom" src="<?php echo $bottomLeftImg['sizes']['grid-one-third']; ?>" />
              </div>
              <div class="grid-twothirds">
                <img src="<?php echo $rightImg['sizes']['grid-two-thirds']; ?>" />
              </div>
            </div>
            <?php
            elseif( get_row_layout() == 'two_images_third_left_twothirds_right' ):   

              $leftThirdImg = get_sub_field('left_third_image');
              $rightImg = get_sub_field('right_image');
            ?>
            <div class="grid-onethird-twothirds grid-wrapper">
              <div class="grid-onethird grid-onethird-tall">
                <img src="<?php echo $leftThirdImg['sizes']['grid-one-third-tall']; ?>" />
              </div>
              <div class="grid-twothirds">
                <img src="<?php echo $rightImg['sizes']['grid-two-thirds']; ?>" />
              </div>
            </div>
            <?php
            elseif( get_row_layout() == 'two_images_twothirds_left_third_right' ):   

              $leftImg = get_sub_field('left_image');
              $rightThirdImg = get_sub_field('right_third_image');
            ?>
            <div class="grid-twothirds-onethird grid-wrapper">
              <div class="grid-twothirds">
                <img src="<?php echo $leftImg['sizes']['grid-two-thirds']; ?>" />
              </div>
              <div class="grid-onethird grid-onethird-tall">
                <img src="<?php echo $rightThirdImg['sizes']['grid-one-third-tall']; ?>" />
              </div>
            </div>
            <?php
            elseif( get_row_layout() == 'two_images_half' ): 

              $leftHalfImg = get_sub_field('left_half_image');
              $rightHalfImg = get_sub_field('right_half_image');
            ?>
            <div class="grid-halves grid-wrapper">
              <div class="grid-onehalf">
                <img src="<?php echo $leftHalfImg['sizes']['grid-one-half']; ?>" />
              </div>
              <div class="grid-onehalf">
                <img src="<?php echo $rightHalfImg['sizes']['grid-one-half']; ?>" />
              </div>
            </div>
            <?php
            endif;

          endwhile;
          
            echo '</div>';
          echo '</div>';

        endif;
        
        if( have_rows('grid_layouts') ):
          echo '<div id="mobile-grid-images"><div class="mobile-grid-slider wrap cf mobile-show">'; 
          while ( have_rows('grid_layouts') ) : the_row(); 
            if( get_row_layout() == 'three_images_2_left_1_right' ): 
              $topLeftImg = get_sub_field('top_left_image');
              $bottomLeftImg = get_sub_field('bottom_left_image');
              $rightImg = get_sub_field('right_image'); ?>
              <div><img src="<?php echo $topLeftImg['sizes']['grid-mobile']; ?>" /></div>
              <div><img src="<?php echo $bottomLeftImg['sizes']['grid-mobile']; ?>" /></div>
              <div><img src="<?php echo $rightImg['sizes']['grid-mobile']; ?>" /></div>
            <?php
            elseif( get_row_layout() == 'two_images_half' ): 
              $leftHalfImg = get_sub_field('left_half_image');
              $rightHalfImg = get_sub_field('right_half_image');?>
              <div><img src="<?php echo $leftHalfImg['sizes']['grid-mobile']; ?>" /></div>
              <div><img src="<?php echo $rightHalfImg['sizes']['grid-mobile']; ?>" /></div>
            <?php
            elseif( get_row_layout() == 'two_images_third_left_twothirds_right' ): 
              $leftThirdImg = get_sub_field('left_third_image');
              $rightImg = get_sub_field('right_image');?>
              <div><img src="<?php echo $leftThirdImg['sizes']['grid-mobile']; ?>" /></div>
              <div><img src="<?php echo $rightImg['sizes']['grid-mobile']; ?>" /></div>
            <?php
            elseif( get_row_layout() == 'two_images_twothirds_left_third_right' ): 
              $leftImg = get_sub_field('left_image');
              $rightThirdImg = get_sub_field('right_third_image');?>
              <div><img src="<?php echo $leftImg['sizes']['grid-mobile']; ?>" /></div>
              <div><img src="<?php echo $rightThirdImg['sizes']['grid-mobile']; ?>" /></div>
            <?php
            endif;
            
        
          endwhile;
          
          echo '</div></div>';
        endif;
        ?>
        
        <?php get_template_part( 'parts/product', 'rows' ); ?>
        
        <div class="fishing-pages section cf">
          <div class="page-blocks-wrapper">
          <?php
          $currentPage = get_the_ID();
          $args = array(
            'exclude' => $currentPage.', 2, 426',
            'sort_column' => 'menu_order'
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
            <?php 
            $currentPage = get_the_ID();
            $args = array(
              'exclude' => $currentPage.', 2, 426',
              'sort_column' => 'menu_order'
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
        
        <?php endwhile; endif; ?>
        
			</div>


<?php get_footer(); ?>