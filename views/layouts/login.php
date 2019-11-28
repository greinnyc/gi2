<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;
$bundle = yiister\gentelella\assets\Asset::register($this);
//$assetIco      = AppAsset::register($this);
//$baseUrlIco    = $assetIco->baseUrl;

AppAsset::register($this);

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  
    <style>
        body {
            background-image:    url("<?=Url::to( '@web/img/image_01.png' )?>");  
            background-size:     cover;                      /* <------ */
            background-repeat:   no-repeat;
            background-position: center center;              /* optional, center the image */
            overflow-y: hidden;
        }

        .has-error .help-block{
            color: #fff;
            text-shadow:none;
        }
       
        fieldset.scheduler-border {
            border: none;
            color: #fff;
            padding: 0 1.4em 1.4em 1.4em !important;
            margin: 0 0 1.5em 0 !important;
            -webkit-box-shadow:  0px 0px 0px 0px #000;
                    box-shadow:  0px 0px 0px 0px #000;
        }

        legend.scheduler-border {
            font-size: 1.2em !important;
            font-weight: bold !important;
            text-align: left !important;
        }

    </style>    
</head>

<body  >
<?php $this->beginBody(); ?>
<div class="container body">
    <div class="main_container">
        <?= $content ?>
    </div>

</div>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
