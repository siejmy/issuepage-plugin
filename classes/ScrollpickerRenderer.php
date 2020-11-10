<?php

require_once(dirname(__FILE__) . '/IssuepagePluginConfig.php');
require_once( ABSPATH . 'wp-content/plugins/siejmycommon-plugin/classes/ImageRenderer.php');

class ScrollpickerRenderer {
  function render() {
    $categoryId = IssuepagePluginConfig::$emagazineCategoryId;
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
        layout="responsive"
        height="2"
        width="3"
        snap-align="center"
        loop="true"
        visible-count="1.7"
      >'
      . $content
      .'</amp-base-carousel></amp-inline-gallery>';
  }

  function renderSlides($categoryId) {
    $aspectRatio = '1.3';
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
        'layout' => 'responsive',
        'srcset_min_size' => 'siejmy_230',
        'default_size' => 'siejmy_230',
        'caption' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 ' . $aspectRatio . '"></svg>'
      )) . '</div>';
    }
    return $out;
  }

  function renderSeeMoreSlide($categoryId) {
    $aspectRatio = '1.3';
    return '<div class="slide see-more-slide"><a href="' . get_category_link($categoryId) . '" class="imglink">'
      . '<p>Zobacz<br /> poprzednie<br /> wydania &raquo;</p>'
      . '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1 ' . $aspectRatio . '"></svg>'
      . '</a></div>';
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
      display: block;
      position: relative;
    }

    .scrollpicker-block .slide .imglink {
      display: block;
      position: relative;
      height: inherit;
      width: min-content;
      margin: 0 auto;
    }

    .scrollpicker-block .slide .imglink > svg {
      height: 100%;
      width: auto;
    }

    .scrollpicker-block .slide .imglink amp-img, .scrollpicker-block .slide .imglink > p {
      display: block;
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }

    .scrollpicker-block  .slide .imglink amp-img img {
      object-fit: cover;
    }

    .scrollpicker-block .see-more-slide p {
      margin: 0;
      display: block;
      background: #ccc;
      color: #555;
      padding: 2rem;
    }

    .scrollpicker-block .see-more-slide a:hover p {
      text-decoration: underline;
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

    .scrollpicker-block .see-more-slide .imglink::after {
      display: none;
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

    /* They block accidentally clicking cover while wanting to click prev/next buttons */
    .scrollpicker-block::after, .scrollpicker-block::before {
      content: "";
      position: absolute;
      right: 0;
      width: 25%;
      top: 37.5%;
      bottom: 27.5%;
    }

    @media (min-width: 768px) {
      .scrollpicker-block::after, .scrollpicker-block::before {
        width: 15%;
      }
    }

    .scrollpicker-block::before {
      left: 0;
      right: auto;
      z-index: 1;
    }
    </style>';
  }
}
