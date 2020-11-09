<?php
function siejmy_issuepage_scrollpicker_render_callback( $block_attributes, $content ) {
    require_once( ABSPATH . 'wp-content/plugins/siejmycommon-plugin/classes/ScrollpickerRenderer.php');
    $renderer = new ScrollpickerRenderer();
    return $renderer->render();
}
