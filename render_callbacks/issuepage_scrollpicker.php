<?php
function siejmy_issuepage_scrollpicker_render_callback( $block_attributes, $content ) {
    require_once( dirname(__FILE__) . '/../classes/ScrollpickerRenderer.php');
    $renderer = new ScrollpickerRenderer();
    return $renderer->render();
}
