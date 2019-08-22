<div class="product-rows section cf">
<?php if( have_rows('product_row') ): $i = 1; ?>

  <?php while( have_rows('product_row') ): the_row(); 
    $rowDesign = get_sub_field('row_design');
    $post_object = get_sub_field('product_anchor');
    $post = $post_object;
    setup_postdata($post);
    $productPNG = get_field('transparent_png');
    $productLink = get_field('product_link', $post->ID);
    $productLinkSalt = get_field('product_link_salt', $post->ID);
    $lifestyleImage = get_field('lifestyle_image');
    $lifestyleImageMobile = get_field('mobile_lifestyle_image');
    ?>
    <div class="product-row cf row-<?php echo $i; ?><?php if($rowDesign == 'dark'){echo ' texture';} if($rowDesign == 'lifestyle'){echo ' lifestyle';} ?>" <?php if($rowDesign == 'lifestyle'){echo 'style="background-image:url('.$lifestyleImage['url'].');"';} ?>>
      <?php if($rowDesign == 'lifestyle'){?>
      <div class="overlay" style="<?php if($lifestyleImageMobile){echo 'background-image:url('. $lifestyleImageMobile['url'].');';}else{echo 'background-image:url('.$lifestyleImage['url'].');background-size:cover;';}?>"></div>
      <?php } ?>
      <div id="<?php echo $post->post_name; ?>" class="anchor cf"></div>
      <div class="wrap cf product-row-content">
        <?php if($rowDesign == 'dark'){ ?>
          <div class="product-image"><img src="<?php echo $productPNG['sizes']['large']; ?>" /></div>
        <?php } ?>
        <div class="product-overview">
          <h2><?php the_title(); ?></h2>
          <span><?php echo get_field('title_description'); ?></span>
          <?php 
          $quote = get_field('quote_text');
          $quoteBy = get_field('quote_credit_name');
          $quoteByTitle = get_field('quote_credit_title');
          if($quote) { ?>
            <div class="product-quote-text">
              <p>&#8220;<?php echo $quote; ?>&#8221;</p>
              <span class="quote-credit"><?php if($quoteBy){echo '<strong>- '.$quoteBy.'</strong>';} ?><?php if($quoteByTitle) echo ', '.$quoteByTitle; ?></span>
            </div>
          <?php } ?>
          <a href="<?php echo $productLink; ?>" target="_blank" class="orange-btn">Buy Fresh</a>
          <?php if($productLinkSalt):?>
            <a href="<?php echo $productLinkSalt; ?>" target="_blank" class="orange-btn">Buy Salt</a>
          <?php endif; ?>
          <?php $productName = get_the_title(); ?>
          <a href="#more-<?php echo $post->post_name; ?>" class="white-btn product-toggle" title="<?php echo $productName; ?>">Show More</a>
        </div>
      </div>
      <div id="more-<?php echo $post->post_name; ?>" class="wrap cf show-more-content">
        <a href="#<?php echo $post->post_name; ?>" class="show-more-close"><i class="fa fa-times" aria-hidden="true"></i></a>
        <div class="product-details">
          <div class="product-details-left">
            <h3><?php the_title(); ?></h3>
            <span><?php echo get_field('title_description'); ?></span>
            <?php the_content(); ?>
            <?php
            if( have_rows('drop_section_layout') ):
              while ( have_rows('drop_section_layout') ) : the_row();

                if( get_row_layout() == 'image_thumbnails' ):
                  $counter = 0;
                  while(has_sub_field('product_thumbnail')):
                    $counter++;
                  endwhile;
                  if( have_rows('product_thumbnail') ):?>
                    <div class="product-thumbs-wrap thumbs-<?php echo $counter; ?>">
                      <ul class="product-thumbs thumbs-<?php echo $counter; ?>">
                      <?php 
                        while ( have_rows('product_thumbnail') ) : the_row();
                        $image = get_sub_field('thumbnail_image');
                        $imgWidth = $image['width']/2;
                        if($image) {
                          echo '<li><img src="' . $image['url'] . '" alt="' . $image['alt'] . '" width="'.$imgWidth.'" /></li>'; 
                        }
                      endwhile; ?>
                      </ul>
                      <?php
                      $buyButton = get_sub_field('buy_button');
                      $buttonValue = $buyButton['value'];
                      $buttonLabel = $buyButton['label'];

                      ?>
                      <div class="extra-shop-button"><a href="<?php if($buttonValue == "fresh"){echo $productLink;} elseif($buttonValue == "salt"){echo $productLinkSalt;} ?>" target="_blank" class="orange-btn"><?php echo $buttonLabel; ?></a></div>
                    </div>
                <?php endif;
                endif;

                if( get_row_layout() == 'additional_features_list'):
                  echo '<h4>'.get_sub_field('feature_list_title').'</h4>';
                  if( have_rows('product_feature_list')):
                    echo '<ol class="additional-features square-numbers">';
                    while ( have_rows('product_feature_list') ) : the_row();
                      echo '<li>'.get_sub_field('additional_feature_text').'</li>';
                    endwhile;
                    echo '</ol>';
                  endif;
                endif;
              endwhile;
            endif;
            ?>
          </div>

          <?php
          if( have_rows('drop_section_layout') ):
            while ( have_rows('drop_section_layout') ) : the_row();

              if( get_row_layout() == 'product_functions' ):
                $functionCounter = 0;
                while(has_sub_field('function_blocks')):
                  $functionCounter++;
                endwhile;
                echo '<div class="product-details-right">';
                if( have_rows('function_blocks') ): ?>
                  <ul class="product-features features-<?php echo $functionCounter; ?>">
                  <?php 
                    while ( have_rows('function_blocks') ) : the_row();
                    $functionImg = get_sub_field('function_image');
                    $functionImgWidth = $functionImg['width']/2;
                    echo '<li><img src="' . $functionImg['url'] . '" alt="' . $functionImg['alt'] . '" width="'.$functionImgWidth.'" /></li>';
                  endwhile;
                  echo '</ul>';
                endif;
                echo '</div>';
              endif;

              if( get_row_layout() == 'product_drawing' ):
                $drawingImg = get_sub_field('drawing_image');
                $drawingImgWidth = $drawingImg['width']/2;
                echo '<div class="product-details-right drawing-img-wrap"><img src="' . $drawingImg['url'] . '" alt="' . $drawingImg['alt'] . '" width="'.$drawingImgWidth.'" /></div>';
              endif;

            endwhile;
          endif;
          ?>

        </div>
        <!--<div class="show-less-ribbon tablet-show"><a href="#<?php //echo $post->post_name; ?>">Show Less</a></div>-->
      </div>
    </div>
  <?php $i++; wp_reset_postdata(); endwhile; ?>

<?php endif; ?>
</div>