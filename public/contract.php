<?php
require __DIR__ . '/../vendor/autoload.php';
setlocale(LC_ALL,'no_NO');

use \App\TemplateManager;

$dotenv = new Dotenv\Dotenv(__DIR__."/../");
$dotenv->load();

$man = new TemplateManager();


$input = $_GET;

//Make sure all null values are removed
foreach ($input as $key => $value) {
    if ( is_null($value) || $value == "" ) unset($input[$key]);
}
//Remove submit

if ( !isset($input['valid_from']) ) $input['valid_from'] = strftime("%b. %Y", strtotime("first day of +1 month"));
if ( !isset($input['valid_to']) )   $input['valid_to']   = "des. ".(int)(date("Y")+1);
$template = isset($input['template']) ? $input['template'] : "";


// HELPER FUNCTIONS
function param($thing) {
    global $input;
    if (isset($input[$thing])) {
        return $input[$thing];
    }
}
function __($thing) {
    echo param($thing);
}


// GET TEMPLATE AND SUBSTITUTE CONTENT
$md = $man->get_template($template);

$contents =  preg_replace_callback(
    "/{{(.*?)}}/",
    function ($matches) {
        $m = explode("|",trim($matches[1]));
        $p = param($m[0]);
        if ($p == "") {
            return isset($m[1]) ?  $m[1] : "";
        } else {
            return $p;
        }
    },
    $md
);


//MARKDOWN PARSER
$parsedown = new Parsedown();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400" rel="stylesheet">
        <!--<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:100,300,400" rel="stylesheet">-->

        <style media="screen">
            body {
                font-family: 'Roboto', sans-serif;

                padding-top: 3em;
                padding-left: 4em;
                padding-right: 4em;
            }
            h1 {
                font-weight: 300;
                text-align: center;
                font-size: 26px;
                margin-bottom: 0em;
                margin-top: 0em;
            }
            h2 {
                font-weight: 400;
                margin-bottom: 0 !important;
                margin-top: 2em;
                font-size: 18px;
            }
            h3 {
                font-size: 13px;
                font-weight: 400;
            }
            p {
                margin-top: 0.5em;
                font-size: 13px;
                font-weight: 300;
                line-height: 2;
            }
            ul {
                list-style: none;
                margin-left: 0;
                padding-left: 1em;
                font-size: 13px;
                font-weight: 300;
                line-height: 1.5;
            }
            ul > li:before {
                display: inline-block;
                content: "-";
                width: 1em;
                margin-left: -1em;
            }
            em {
                text-decoration: underline;
                font-style: normal;
            }
            a {
                color: black;
            }

            .signatures {
                height: 5em;
            }
            .signatures .me {
                float: left;
                width: 20%;
                height: 100%;
                border-bottom: 1px solid grey;
            }
            .signatures img {
                height: 100%;


            }
            .signatures .others {
                border-bottom: 1px solid grey;
                height: 100%;
                width: 60%;
                float:right;
                margin-right: 10%
            }

            .meta {
                margin-top: 1em;
            }
        </style>
    </head>
    <body>


        <?php echo $parsedown->text($contents);?>

        <div class="signatures">

            <div class="me">
                <?php if (file_exists('signature.png')): ?>
                    <img src="signature.png" alt="">
                <?php endif; ?>

            </div>
            <div class="others">
            </div>

        </div>
        <div class="meta">
            <p>Opprettet den: <?php echo date("d.n.Y"); ?> </p>
        </div>




    </body>
</html>
