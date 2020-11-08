<?php

class IssuepageRenderer {
  function __construct() {
    require_once( ABSPATH . 'wp-content/plugins/siejmycommon-plugin/classes/ImageRenderer.php');
  }

  function renderPost($post) {
    return $this->renderImg($post)
         . $this->renderContent($post);
  }

  function renderImg($post) {
    $mediaId     = get_post_thumbnail_id($post);
    $imgRenderer = new ImageRenderer();
    $alt = $post->post_title;
    return
        '<div class="issuepage-img" id="' . $this->getHeroId($post) . '">'
      .   $imgRenderer->renderImgByAttachmentId($mediaId, $alt)
      . '</div>'
      . $this->getHeroPreloadingBgStyles($imgRenderer, $post, $mediaId);
  }

  function renderContent($post) {
    return '<div class="issuepage-content">'
              . '<h1>' . $post->post_title . '</h1>'
              . $post->post_content
         . '</div>';
  }

  function getHeroPreloadingBgStyles($imgRenderer, $post, $mediaId) {
    return '<style>#' . $this->getHeroId($post) . ' { background-image: url(' . $imgRenderer->getFallbackDataSrc($mediaId) . '); }</style>';
  }

  function getHeroId($post) {
    return 'posthero_' . $post->ID;
  }
}
