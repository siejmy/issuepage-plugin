<?php

function issuepage_metabox_html( $post ) {
  $issuepage_download_url = get_post_meta( $post->ID, 'issuepage_download_url', true );
  $issuepage_issue_no = get_post_meta( $post->ID, 'issuepage_issue_no', true );

    ?><p>
    <label for="issuepage_download_url">Url pobierania numeru</label>
    <input
      name="issuepage_download_url"
      id="issuepage_download_url"
      type="text"
      value="<?php echo($issuepage_download_url) ?>"
    />
    <label for="issuepage_issue_no">Numer i miesiąc wydania (tekst wyświetlany nad tytułem)</label>
    <input
      name="issuepage_issue_no"
      id="issuepage_issue_no"
      type="text"
      value="<?php echo($issuepage_issue_no) ?>"
    />
</p>
    <?php
}
