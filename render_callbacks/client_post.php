<?php
require_once(dirname(__FILE__) . '/util/ImageRenderer.php');
require_once(dirname(__FILE__) . '/util/TimeAgoRengerer.php');

function siejmy_issuepage_client_post_render_callback( $block_attributes, $content ) {
    $post_id =$block_attributes['postId'];

    $out = '<div class="tablopost">';
          if(empty($post_id)) {
            $out .= '<span>Wybierz numer ID wpisu edytorze strony</span>';
          }
          else {
            $out .= renderPost($post_id);
          }
        $out .= '</div>';
        return  $out;
}

function renderPost($post_id) {
    $post = get_post($post_id);
    if (empty($post)) {
      return '<span>Wpis "' . $post_id . '" nie istnieje</span>';
    }

    return renderPostContent($post);

    return '' . renderImg($post) . '';
  }

  function renderPostContent($post) {
    $permalink = get_permalink($post);
    $mediaId     = get_post_thumbnail_id($post);
    $alt = $post->post_title;
    $imgRenderer = new ImageRenderer();

    $postHeroStyles = '<style>#posthero_'. $post->ID .' { background-image: url(' . $imgRenderer->getFallbackDataSrc($mediaId) . '); }</style>';
    return '
    <a class="featpost_a" href="' . $permalink . '" id="posthero_'. $post->ID .'">
        ' . $imgRenderer->renderImgByAttachmentId($mediaId, $alt) . '
        <div class="caption">
          ' . renderTag($post) . '
          <h3>' . $post->post_title . '</h3>
          <div class="subline">
            <span class="author">' . getAuthorName($post) . '</span>
            ' . TimeAgoRengerer::getTimeAgoKatoPL($post, ' &nbsp;◉') . '
          </div>
        </div>
      </a>
      ' . $postHeroStyles;
  }

  function renderTag($post) {
    $mainCategoryName = getMainCategoryName($post);
    if(empty($mainCategoryName)) {
      return '';
    }
    return '<div class="tag">' . $mainCategoryName . '</div>';
  }

  function getMainCategoryName($post) {
    $categories = get_the_category($post->ID);
    if(count($categories) == 0) {
      return '';
    }
    return $categories[0]->name;
  }

  function getAuthorName($post) {
    return get_the_author_meta('display_name', $post->post_author);
  }
