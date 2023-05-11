<?php

use yii\helpers\ArrayHelper;

use portalium\theme\Theme;
use portalium\theme\helpers\Html;
use portalium\site\widgets\FlashMessage;
use portalium\theme\widgets\Breadcrumbs;
use portalium\site\widgets\Brand;
use portalium\menu\widgets\Nav;
use yii\widgets\Pjax;

Theme::registerAppAsset($this);

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
   
    <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar" class="bg-dark">
        <div class="sidebar-header bg-dark">
            <a href="<?= Yii::$app->homeUrl ?>">
                <img class="logo" src='https://mhsb.app/data/d2a49e25227dc20d55057d2d4cb49068.png'>
            </a>
            <button type="button" id="sidebarCollapse1" class="btn btn-info">
                <i class="fa fa-align-left"></i>
            </button>
        </div>
        <ul class="list-unstyled components">
            <?=Nav::widget([
                    'id' => Yii::$app->setting->getValue('theme::menu_side'),
                    'options' => ['class' => 'nav nav-pills flex-column'],
                    ]);
            ?>
        </ul>
    </nav>

    <!-- Page Content  -->
    <div id="main" class="min-vh-100 d-flex flex-column">
        <nav class="navbar navbar-expand-lg navbar-light bg-dark" id='navbar'>
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse2" class="btn btn-info mobile-show">
                        <i class="fa fa-align-left"></i>
                    </button>
                    <div class="title-desktop"><?= Html::encode($this->title) ?></div>
                    <a class="m-auto" href="<?= Yii::$app->homeUrl ?>"><img class="logo mobile-logo" src='https://mhsb.app/data/d2a49e25227dc20d55057d2d4cb49068.png'></a>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-align-justify"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto list-padding">
                            <?=Nav::widget([
                                'id' => Yii::$app->setting->getValue('theme::menu_main'),
                                'options' => ['class' => 'nav nav-pills flex-shrink-0 dropdown mobile-column direction', 'mobile-nav-style' => Yii::$app->setting->getValue('theme::mobile_direction')],
                            ])?>
                        </ul>
                    </div>
                </div>
        </nav>
        <div class="title-mobile bg-dark"><?= Html::encode($this->title) ?></div>
        <div class="content-padding">
            <nav class='bread' style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <?= Breadcrumbs::widget([
                            'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])?>
            </nav>
            <?= $content ?>
        </div>
        <footer class="footer mt-auto border">
            <p class="pull-left px-3">&copy; Portalium <?= date('Y') ?> </p>
            <p class="pull-right px-3">DigiNova</p>
        </footer>
    </div>
</div>
<?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>