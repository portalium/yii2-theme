<?php

use portalium\theme\Theme;
use portalium\theme\helpers\Html;
use portalium\theme\widgets\Alert;


Theme::registerAppAsset($this);

$languages  = Yii::$app->setting->getConfig('app::language');

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