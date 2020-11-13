<?php

require_once(dirname(__FILE__) . '/IssuepagePluginConfig.php');
require_once( ABSPATH . 'wp-content/plugins/siejmycommon-plugin/classes/ImageRenderer.php');

class ScrollpickerRenderer {
  static $coverAspectRation = '1.3';
  function render() {
    $categoryId = IssuepagePluginConfig::$emagazineCategoryId;
    return '<aside class="scrollpicker_prnt"><div class="scrollpicker-block">'
         . $this->renderTitle()
         . $this->renderCarousel(
              $this->renderSlides($categoryId)
            . $this->renderSeeMoreSlide($categoryId)
         )
         . $this->renderDescription($categoryId)
         . '</div></aside>'
         . $this->renderStyles();
  }


  function renderTitle() {
    return '<h2 class="h6">E-czasopismo siejmy</h2>';
  }

  function renderDescription($categoryId) {
    return '<p>Podoba Ci się portal Siejmy?<br /> Zobacz nasze <strong><a href="' . get_category_link($categoryId) . '">E-czasopismo</a></strong>.'
         . ' Znajdziesz w nim poważne tematy i pogłębione analizy.</p>';
  }

  function renderCarousel($content) {
    return '<amp-inline-gallery layout="container">
      <amp-base-carousel
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
      $mediaId = get_post_thumbnail_id($post);
      $alt = 'Okładka wydania ' . $post->post_title;
      $link = get_post_permalink($post);
      $out .= $imageRenderer->renderImgByAttachmentId($mediaId, $alt, array(
        'layout' => 'responsive',
        'srcset_min_size' => 'siejmy_230',
        'default_size' => 'siejmy_230',
        'attrs' => ' on="tap:AMP.navigateTo(url=\'' . $link . '\')"'
      ));
    }
    return $out;
  }

  function renderSeeMoreSlide($categoryId) {
    $link = get_category_link($categoryId);
    return '<svg xmlns="http://www.w3.org/2000/svg" '
         . ' viewBox="0 0 100 ' . (self::$coverAspectRation*100) . '"'
         . ' on="tap:AMP.navigateTo(url=\'' . $link . '\')"'
         . '><rect width="100" height="' . (self::$coverAspectRation*100) . '" fill="#ccc" />'
         .     '<text x="16" y="24">Zobacz</text>'
         .     '<text x="16" y="40">poprzednie</text>'
         .     '<text x="16" y="56">wydania &raquo;</text>'
         . '</svg>';
  }

  function renderStyles() {
    return '<style>

    /****************************
     * Scrollpicker
     ****************************/

    .scrollpicker_prnt {
      width: 100%;
      max-width: calc(1300px - 8%);
      margin: 0 auto;
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

    .scrollpicker-block > p {
      display: block;
      text-align: center;
      box-shadow: inset 0 -7px 9px -7px rgba(0, 0, 0, 0.4);
      min-height: 3rem;
      padding-bottom: 1rem;
      margin-bottom: 0;
      color: #777;
    }

    .scrollpicker-block amp-img, .scrollpicker-block svg {
      cursor: pointer;
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
