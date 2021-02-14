<?php

class DownloadButtonRenderer {
  function renderForPost($post) {
    $downloadUrl = $this->getDownloadUrlForPost($post);
    if(empty($downloadUrl)) return '';

    return '<p class="issuepage-downloadbtn"><a href="' . $downloadUrl . '">Pobierz PDF</a></p>';
  }

  function getDownloadUrlForPost($post) {
    $downloadUrl = get_post_meta($post->ID, 'issuepage_download_url');
    if(empty($downloadUrl) || !isset($downloadUrl[0])) return '';
    return $downloadUrl[0];
  }
}
