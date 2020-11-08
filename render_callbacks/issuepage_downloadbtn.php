<?php
require_once(dirname(__FILE__) . '/util/ImageRenderer.php');

function siejmy_issuepage_downloadbtn_render_callback( $block_attributes, $content ) {
    $post_id =$block_attributes['postId'];

    return '<div class="downloadbtn"><a href="/">(Pobierz tekst)</a></div>';
}
