<?php

$bandeau_message = get_option('bandeau_message');


if (!empty($bandeau_message)) {
    echo '<div class="headerTop"><p class="textBandeau">' . esc_html($bandeau_message) . '</p></div>';
}
?>
