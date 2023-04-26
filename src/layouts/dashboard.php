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

    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow d-flex" style="background-color: #000000 !important;">
        <nav class="navbar navbar-expand-lg navbar-light h-100 p-0 col-md-8 w-100">
            <div class="container-fluid h-100 p-0">
                <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                	<span class="navbar-toggler-icon color-filter"></span>
                </button>
                <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 d-flex ms-auto ms-md-0 justify-content-center" style="color:white" href="<?=Yii::$app->homeUrl?>">
                    <?=Brand::widget(['title' => true, 'options' => ['height' => '30px']])?>
                </a>
                <div class="px-4 text-light col-md-3 col-lg-2 me-0 px-3 fs-6 d-flex justify-content-center mt-1 mb-1 d-none d-md-block d-lg-block">
                    <?=Html::encode($this->title)?>
                </div>
                <button class="navbar-toggler collapsed ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon color-filter"></span>
                </button>
                <div class="navbar-collapse collapse justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <?=Nav::widget([
                        'id' => Yii::$app->setting->getValue('menu::main'),
                        'options' => ['class' => 'nav nav-pills flex-shrink-0 dropdown mobile-column justify-content-center'],
                        ])?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block text-bg-dark collapse">
                    <div class="position-sticky pt-2 sidebar-sticky">
                    <?=Nav::widget([
                        'id' => Yii::$app->setting->getValue('menu::side'),
                        'options' => ['class' => 'nav nav-pills flex-column'],
                        ]);
                    ?>
                </div>
            </nav>
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 d-flex justify-content-center align-items-center border-top border-secondary d-md-none d-lg-none title">
                <?=Html::encode($this->title)?>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <?= Breadcrumbs::widget([
                        'links' => !empty($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])?>
                    </nav>
                </div>
                <?php

                    Pjax::begin([
                        'id' => 'pjax-flash-message',
                    ]);

                ?>
                    <?= FlashMessage::widget([
                        'autoDismiss' => true,
                    ]) ?>
                <?php Pjax::end(); ?>
                <?= $content ?>

            </main>
        </div>
    </div>
    <footer class="footer">
        <p class="pull-left px-3">&copy; Portalium <?= date('Y') ?> </p>
        <p class="pull-right px-3">DigiNova</p>
    </footer>
<?php $this->endBody() ?>
  </body>
</html>
<?php $this->endPage() ?>