<?php

class IssueHeroRenderer {
  function __construct() {
    require_once(dirname(__FILE__) . '/IssuepagePluginConfig.php');
    require_once( ABSPATH . 'wp-content/plugins/siejmycommon-plugin/classes/ImageRenderer.php');
  }

  function renderNewest() {
    $categoryId = IssuepagePluginConfig::$emagazineCategoryId;
    $opts = array(
      'cat' => $categoryId,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'numberposts' => 1,
    );
    $posts = get_posts($opts);
    if(count($posts) == 0) {
      return '<!-- IssueHeroRenderer: no posts in the specified category -->';
    }
    $post = $posts[0];
    return $this->renderPost($post);
  }

  function renderPost($post) {
    return '<div class="issue-hero">'
         . $this->renderContent($post)
         . $this->renderImg($post)
         . '</div>';
  }

  function renderImg($post) {
    $mediaId     = get_post_thumbnail_id($post);
    $imgRenderer = new ImageRenderer();
    $alt = $post->post_title;
    return
        '<a class="imglink" id="' . $this->getHeroId($post) . '" href="' . get_permalink($post) . '">'
      .   $imgRenderer->renderImgByAttachmentId($mediaId, $alt)
      . '</a>'
      . $this->getHeroPreloadingBgStyles($imgRenderer, $post, $mediaId);
  }

  function renderContent($post) {
    return '<p>' . $post->post_content . '</p>';
  }

  function getHeroPreloadingBgStyles($imgRenderer, $post, $mediaId) {
    return '<style>#' . $this->getHeroId($post) . ' { background-image: url(' . $imgRenderer->getFallbackDataSrc($mediaId) . '); }</style>';
  }
}
