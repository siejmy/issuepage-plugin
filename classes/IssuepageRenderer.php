<?php

require_once(dirname(__FILE__) . '/DownloadButtonRenderer.php');

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
    $btnRenderer = new DownloadButtonRenderer();
    return '<div class="issuepage-content">'
              . $this->renderIssueNo($post)
              . '<h1>' . $post->post_title . '</h1>'
              . $btnRenderer->renderForPost($post)
              . $post->post_content
         . '</div>';
  }

  function getHeroPreloadingBgStyles($imgRenderer, $post, $mediaId) {
    return '<style>#' . $this->getHeroId($post) . ' { background-image: url(' . $imgRenderer->getFallbackDataSrc($mediaId) . '); }</style>';
  }

  function renderIssueNo($post) {
    $issuepage_issue_no = get_post_meta($post->ID, 'issuepage_issue_no');
    if(empty($issuepage_issue_no) || !isset($issuepage_issue_no[0])) return '';
    $text = $issuepage_issue_no[0];
    return '<h2 class="supertitle h6">' . $text . '</h2>';
  }

  function getHeroId($post) {
    return 'posthero_' . $post->ID;
  }
}
