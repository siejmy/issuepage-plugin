<?php

require_once(dirname(__FILE__) . '/../classes/IssuepagePluginConfig.php');

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
    echo render_stats_box();
}

function render_stats_box() {
  return
    ' <p><i>Pamiętaj, aby poprzedzić url pliku za pomocą \'/get\' aby były liczone pobrania. Dodatkowo usuń \'https://siejmy.pl\' z początku pliku. Url powinien zaczynać się od \'/\'. Prawidłowy format URLa: \'/get/wp-content/uploads/2020/10/SIEJMY-6.2020.pdf\'</i></p>'
    . '<strong>Siejmy licznik pobrań (aktualizowane co 5 minut): </strong>'
    . ' <iframe src="' . IssuepagePluginConfig::$statsUrl . '" title="Siejmy download stats" width="450" height="150" style="border: 1px solid blue;"></iframe>';
    /*
  <div id="statsbox">
			<pre id="statsoutput"></pre>
			<script>
				window.onload = () => {
					fetch("https://siejmy.pl/cfw/counter_stats.4wFw4W0TZ5tq9Fg5.json")
						.then((text) => resp.text())
						.then(
							(text) =>
								(document.getElementById("statsoutput").innerText = text),
						)
						.catch(
							(err) =>
								(document.getElementById("statsoutput").innerText = err.stack),
						)
				}
			</script>
    </div>';*/
}
