<?php
namespace App;

use Knp\Snappy\Pdf;


class TemplateManager {

    public function __construct() {
        $this->snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
        $this->snappy->setOption('disable-javascript', true);

    }

    public function analyse_template($template) {
        $inputs = [];
        $md = $this->get_template($template);

        preg_match_all("/{{(.*?)}}/",$md, $matches);

        foreach ($matches[1] as $match) {
            $m = explode("|",trim($match));
            $p = $m[0];
            $inputs[$p] = isset($m[1]) ?  $m[1] : "";
        }
        return $inputs;
    }

    public function list_templates() {
        $files = glob(__DIR__."/../../templates/*.md");

        return array_map(function($e) {
            return ucfirst(basename($e,'.md'));
        },$files);
    }

    public function get_template($template) {
        return file_get_contents(__DIR__."/../../templates/".$template.".md");
    }

    public function generate_pdf($data) {
        $url = getenv("BASE_URL")."/contract.php?".http_build_query($data);

        return  $this->snappy->getOutput( $url );
    }
    public function generate_html($data) {
        $url = getenv("BASE_URL")."/contract.php?".http_build_query($data);

        return  file_get_contents($url);
    }



}
