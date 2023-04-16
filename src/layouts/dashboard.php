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

    <header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color: #000000 !important; height: 56px !important;">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="<?= Yii::$app->homeUrl ?>">
            <?= Brand::widget(['options' => ['height' => '30px']]) ?> 
        </a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="w-100 px-4 text-light">
            <?= Html::encode($this->title) ?>
        </div>
        <?= Nav::widget([
            'id' => Yii::$app->setting->getValue('theme::main_menu'),
            'options' => ['class' => 'nav nav-pills flex-shrink-0 dropdown']
        ]) ?>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block text-bg-dark ">
                <div class="position-sticky pt-4 sidebar-sticky">
                    <?= Nav::widget([
                            'id' => Yii::$app->setting->getValue('theme::side_menu'),
                            'options' => ['class' => 'nav nav-pills flex-column']
                        ]); 
                    ?>
                </div>
            </nav>
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