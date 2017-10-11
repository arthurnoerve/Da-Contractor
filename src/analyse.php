<?php
require_once __DIR__ . '/vendor/autoload.php';

/*
 * Gets all the variables and optinal values in a given md template.
 */
function analyse_template($template) {
    $inputs = [];

    // GET TEMPLATE AND SUBSTITUTE CONTENT
    $md = file_get_contents($template);

    preg_match_all("/{{(.*?)}}/",$md, $matches);

    foreach ($matches[1] as $match) {
        $m = explode("|",trim($match));
        $p = $m[0];
        $inputs[$p] = isset($m[1]) ?  $m[1] : "";
    }
    return $inputs;
}


$inputs = analyse_template('templates/basic.md');
print_r($inputs);

?>
