<?php
$customHeader = get_field('custom_page_header');
$customTitle = get_field('custom_page_title');
$customSubtitle = get_field('custom_page_subtitle');
$headerBg = get_field('header_background_image');
$bgVideo = get_field('header_background_video');
$video_webm = get_field('header_background_video_webm');
$video_mp4 = get_field('header_background_video_mp4');
$video_ogv = get_field('header_background_video_ogv');
$videoModal = get_field('header_video_modal');
$modalVideoId = get_field('header_video_modal_youtube');
$modalButton = get_field('header_video_modal_button_text');
$mobileImg = get_field('mobile_header_image');

if($customHeader && in_array('yes', $customHeader)) :
?>
<div class="custom-header section cf" <?php if($headerBg && !$bgVideo) { echo 'style="background-image:url('.$headerBg['url'].');"'; } ?>>
  <div class="overlay"></div>
  <?php if($bgVideo && in_array('yes', $bgVideo)) : ?>  
    <video loop muted autoplay poster="<?php //if($headerBg) { echo $headerBg['url']; } ?>" class="fullscreen-bg-video">
      <?php if($video_webm) { ?><source src="<?php echo $video_webm; ?>" type="video/webm"><?php } ?>
      <?php if($video_mp4) { ?><source src="<?php echo $video_mp4; ?>" type="video/mp4"><?php } ?>
      <?php if($video_ogv) { ?><source src="<?php echo $video_ogv; ?>" type="video/ogg"><?php } ?>
    </video>
  <?php endif; ?>
  <?php if($mobileImg) : ?>
    <img class="mobile-hero tablet-show" src="<?php echo $mobileImg['url']; ?>" />
  <?php else : ?>
    <img class="mobile-hero tablet-show" src="<?php echo $headerBg['url']; ?>" />
  <?php endif; ?>
    <div class="header-content">
      <div class="wrap cf">
        <h1><?php if($customTitle){echo $customTitle;} else{the_title();} ?></h1>
        <?php if(is_front_page() || is_page('426')) { 
          if($customSubtitle){echo '<p class="subtitle">'.$customSubtitle.'</p>';}
        } else { ?>
          <p class="subtitle">Location: <strong><?php echo get_field('location'); ?></strong></p>
          <p class="subtitle">Situation: <strong><?php echo get_field('situation'); ?></strong></p>
        <?php } ?>
      <?php if($videoModal && in_array('yes', $videoModal)) : ?>
        <button class="launch-video white-btn" href="http://www.youtube.com/watch?v=<?php echo $modalVideoId; ?>"><?php echo $modalButton; ?></button>
      <?php endif; ?>
      </div>
    </div>
  <script type="text/javascript">
    jQuery(document).ready(function($){
      $('.launch-video.white-btn').click(function() {
        fbq('track', 'ViewContent');
      });
    });
  </script>
</div>
<?php else : ?>

<div class="wrap cf">
  <header class="article-header">
    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
  </header> <?php // end article header ?>
</div>
<?php endif; ?>