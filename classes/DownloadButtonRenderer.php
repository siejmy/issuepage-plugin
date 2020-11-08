<?php

class DownloadButtonRenderer {
  function renderForPost($post) {
    $downloadUrl = get_post_meta($post->ID, 'issuepage_download_url');
    if(empty($downloadUrl) || !isset($downloadUrl[0])) return '';

    return '<p class="issuepage-downloadbtn"><a href="' . $downloadUrl[0] . '">Pobierz PDF</a></p>';
  }
}
