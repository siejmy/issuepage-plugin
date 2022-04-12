<?php
class IssuepageModel {
  private $config = array();
  function __construct($config) {
    $this->config = $config;
  }

  function getNewestIssues($count) {
    $opts = array(
      'cat' => $this->config['emagazineCategoryID'],
      'orderby'          => 'date',
      'order'            => 'DESC',
      'numberposts' => $count,
    );
    $posts = get_posts($opts);
    return array_map(function ($post) { return $this->getPostModel($post); }, $posts);
  }

  function getPostModel($post) {
    return array(
      'post' => $post,
      'readmoreURL' => get_permalink($post),
      'downloadURL' => $this->getDownloadURLForPost($post),
      'coverImageMediaID' => get_post_thumbnail_id($post),
    );
  }

  function getDownloadURLForPost($post) {
    $downloadUrl = get_post_meta($post->ID, 'issuepage_download_url');
    if(empty($downloadUrl) || !isset($downloadUrl[0])) return '';
    return $downloadUrl[0];
  }
}
?>
