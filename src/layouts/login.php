<?php

use yii\helpers\ArrayHelper;
use portalium\theme\Theme;
use portalium\theme\Module;
use portalium\theme\helpers\Html;
use portalium\theme\widgets\Alert;
use portalium\theme\widgets\NavBar;
use portalium\theme\bundles\AppAsset;
use portalium\theme\widgets\Breadcrumbs;
use portalium\site\models\Setting;
use portalium\site\widgets\Language;
use portalium\menu\models\Menu;
use portalium\menu\widgets\Nav;

Theme::registerAppAsset($this);

$languages  = Yii::$app->settings->getConfig('app::language');

?>
<?php $this->beginPage() ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Uğur YILDIZ, Portalium Contributors">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    
  </head>
  <body>
  <?php $this->beginBody() ?>
    <main class="form-signin w-100 m-auto">
        <?= Alert::widget() ?>
        <?= $content ?>
    </main>
<?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>