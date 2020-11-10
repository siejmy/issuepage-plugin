<?php

require_once(dirname(__FILE__) . '/IssuepagePluginConfig.php');
require_once( ABSPATH . 'wp-content/plugins/siejmycommon-plugin/classes/ImageRenderer.php');

class ScrollpickerRenderer {
  function render() {
    $categoryId = 2;
    return '<div class="scrollpicker_prnt"><div class="scrollpicker-block">'
         . $this->renderTitle()
         . $this->renderCarousel(
              $this->renderSlides($categoryId)
            . $this->renderSeeMoreSlide($categoryId)
         )
         . '<div class="bottom-shadow-line"></div>'
         . '</div></div>'
         . $this->renderStyles();
  }


  function renderTitle() {
    return '<h2 class="h6">E-czasopismo siejmy</h2>';
  }

  function renderCarousel($content) {
    return '<amp-inline-gallery layout="container">
      <amp-base-carousel
        id="scrollpicker"
        class="gallery"
        layout="fixed-height"
        height="200"
        snap-align="center"
        loop="true"
        visible-count="(max-width: 400px) 1.7, (max-width: 520px) 1.9, 3.1"
      >'
      . $content
      .'</amp-base-carousel></amp-inline-gallery>';
  }

  function renderSlides($categoryId) {
    $opts = array(
      'cat' => $categoryId,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'numberposts' => 7,
    );
    $issuePosts = get_posts($opts);
    $imageRenderer = new ImageRenderer();
    $out = '';
    foreach($issuePosts as $post) {
      $out .= '<div class="slide">' . $imageRenderer->renderImageHero(array(
        'elementId' => 'imghero_' . $post->ID,
        'mediaId' => get_post_thumbnail_id($post),
        'cssClass' => 'imglink',
        'href' => get_post_permalink($post),
        'alt' => $post->post_title,
        'height' => '200',
        'width' => '',
        'layout' => 'fixed',
        'srcset_min_size' => 'siejmy_230',
        'default_size' => 'siejmy_230',
        'layoutMode' => 'auto-width',
      )) . '</div>';
    }
    return $out;
  }

  function renderSeeMoreSlide($categoryId) {
    return '<div class="slide see-more-slide" style="height: 200px"><p><a href="' . get_category_link($categoryId) . '">Zobacz<br /> poprzednie<br /> wydania &raquo;</a></p></div>';
  }

  function renderStyles() {
    return '<style>

    /****************************
     * Scrollpicker
     ****************************/

    .scrollpicker_prnt {
      width: 100%;
    }

    .scrollpicker-block {
      width: 100%;
      box-sizing: border-box;
      margin-bottom: 4%;
      box-shadow: inset 0 7px 9px -7px rgba(0, 0, 0, 0.4);
      background: #eee;
      position: relative;
    }

    .scrollpicker-block h2 {
      padding-top: 2rem;
      margin-bottom: 1rem;
      text-align: center;
      text-transform: uppercase;
      color: #555;
      letter-spacing: 0.75px;
    }

    .scrollpicker-block .bottom-shadow-line {
      box-shadow: inset 0 -7px 9px -7px rgba(0, 0, 0, 0.4);
      height: 3rem;
    }

    .scrollpicker-block .slide {
    }

    .scrollpicker-block .slide .imglink {
      display: block;
      width: min-content;
      height: 200px;
      margin: 0 auto;
    }

    .scrollpicker-block .slide .imglink amp-img {
      display: block;
    }

    /*.scrollpicker-block  .slide .imglink amp-img img {
      object-fit: contain;
    }*/

    .scrollpicker-block .see-more-slide {
      width: 100%;
      padding-top: 10px;
    }

    .scrollpicker-block .see-more-slide p {
      width: 77%;
      margin: 0 auto;
      display: block;
      height: 200px;
      background: #ccc;
      color: #555;
      padding: 2rem;
    }

    .scrollpicker-block .imglink::after {
      content: "Zobacz ☞";
      display: block;
      position: absolute;
      bottom: -5px;
      right: 7%;
      background: rgba(0, 0, 0, 0.6);
      color: white;
      font-size: 12px;
      line-height: 12px;
      padding: 3px;
    }

    @media (min-width: 768px) {
      .scrollpicker_prnt {
        max-width: 1300px;
        margin: 0 auto;
        margin-bottom: 4%;
        padding-left: 4%;
        padding-right: 4%;
      }
    }

    </style>';
  }
}
