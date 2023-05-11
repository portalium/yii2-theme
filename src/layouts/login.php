<?php


use yii\helpers\ArrayHelper;

use portalium\theme\Theme;
use portalium\theme\Module;
use portalium\theme\helpers\Html;
use portalium\site\models\Setting;
use portalium\site\widgets\Brand;
use portalium\site\widgets\FlashMessage;
use portalium\theme\widgets\NavBar;
use portalium\theme\bundles\AppAsset;
use portalium\theme\widgets\Breadcrumbs;
use portalium\menu\widgets\Nav;
use portalium\menu\models\Menu;

Theme::registerAppAsset($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <div class="container">

        <?php NavBar::begin([
            'brandLabel' => Brand::widget(['options' => ['height' => '30px']]),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg fixed-top navbar-dark pt-0 pb-0',
                'style' => 'background-color: #000000 !important; height: 56px !important;',
            ],
        ]);?>

        <?= Nav::widget([
            'id' => Yii::$app->setting->getValue('theme::menu_main'),
            'options' => ['class' => 'navbar-nav ms-auto']
        ]) ?>

        <?php NavBar::end(); ?>

        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">

            <?= Breadcrumbs::widget([
                'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ])?>

        </nav>

        <?= FlashMessage::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Portalium <?= date('Y') ?></p>
        <p class="pull-right">DigiNova</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
