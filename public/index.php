<?php
require __DIR__ . '/../vendor/autoload.php';

use \App\TemplateManager;

$man = new TemplateManager();

if (false ) {
    $man = new TemplateManager();


    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . $params['company'] . '.pdf"');

    echo $man->generate_pdf($params);
}


function __($thing) {
    echo $thing;
}

?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Da Contractor</title>

        <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css"/>
        <!--<link rel="stylesheet" type="text/css" href="style.css"/>-->

        <style media="screen">
            .jumbotron  h1 {
                font-weight: 100;
                margin-bottom: 0;
                font-size: 6em;
            }
            .jumbotron  h2 {
                font-weight: 100;
                margin-top: 0;
                font-size: 2em;
            }
            a {
                color: black;
            }
            a:hover {
                color: black;
            }
        </style>
    </head>
    <body>

        <div class="jumbotron text-center">
            <h1>"Da Contractor"</h1>
            <h2>Managing contracts since 2017</h2>
        </div>

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">

                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php foreach (glob(__DIR__."/../templates/*.md") as $filename):
                            $name = basename($filename,'.md');
                            $name_show = str_replace(['_','-'], ' ',$name); ?>

                            <div class="panel panel-default" >
                                <div class="panel-heading" role="tab">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php __($name); ?>" aria-expanded="false" aria-controls="collapse-<?php __($name); ?>">
                                        <h4 class="panel-title">
                                            <?php __(ucfirst($name_show)); ?>
                                        </h4>
                                    </a>
                                </div>


                                <div id="collapse-<?php __($name); ?>" class="panel-collapse collapse" role="tabpanel" >
                                    <div class="panel-body">
                                        <form class="" action="pdf.php" method="get">
                                        <?php foreach( $man->analyse_template($name) as $field => $default ):
                                            $field_show = str_replace(['_','-'], ' ',$field);   ?>

                                            <input class="form-control" type="text" name="<?php __($field); ?>" value="" placeholder="<?php __(ucfirst($field_show) . ($default ? " (".$default.")" : "")); ?>">  </br>

                                        <?php endforeach; ?>
                                            <input type="hidden" name="template" value="<?php __($name); ?>">
                                            <input class="btn btn-success" type="submit" name="submit" value="Create the PDF">
                                        </form>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                        </div>
                </div>
            </div>

        </div>


        <script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="bower_components/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>



    </body>
</html>
