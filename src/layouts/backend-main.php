<?php

use portalium\theme\Theme;
use portalium\theme\Module;
use yii\helpers\ArrayHelper;
use portalium\menu\models\Menu;

use portalium\theme\helpers\Html;
use portalium\site\models\Setting;
use portalium\theme\widgets\Alert;
use portalium\theme\widgets\NavBar;
use portalium\theme\bundles\AppAsset;
use portalium\theme\widgets\Breadcrumbs;
use portalium\menu\widgets\Nav;

Theme::registerAppAsset($this);

$settings   = ArrayHelper::map(Setting::find()->asArray()->all(),'name','value');
$languages  = json_decode(Setting::findOne(['name' => 'app::language'])->config,true);

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
<?php
    NavBar::begin([
        'brandLabel' => Html::img(Yii::$app->request->baseUrl.'/data/'.strval(Html::encode($settings['page::logo'])),['height' => '30px']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);

    $menuItems [] = ['label' => Module::t('Home'), 'url' => ['/site/home']];

    if(!Yii::$app->user->isGuest){
        $menuItems [] = [
            'label' => Module::t('Menu'),
            'url' => ['/menu']
        ];
        $menuItems [] = [
            'label' => Module::t('Users'),
            'url' => ['#'],
            'items' => [
                ['label' => Module::t('Users'), 'url' => ['/user']],
                ['label' => Module::t('Groups'), 'url' => ['/user/group']],
                ['label' => Module::t('Import'), 'url' => ['/user/import']],
                ['label' => Module::t('Roles'), 'url' => ['/user/auth/role']],
                ['label' => Module::t('Permissions'), 'url' => ['/user/auth/permission']],

            ]
        ];
        $menuItems [] = [
            'label' => Module::t('Settings'),
            'url' => ['/site/setting']
        ];
    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = [
            'label' => Module::t('Login'),
            'url' => ['/site/auth/login']
        ];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/auth/logout'], 'post')
            . Html::submitButton(
                Module::t('Logout'). ' (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }

    $langItems = [];

    foreach ($languages as $key => $value){
        $langItems[] = [
            'label' => Module::t($value),
            'url' => ['/site/home/lang','lang' => $key]
        ];
    }

    $menuItems[] = [
        'label' => Module::t($languages[Yii::$app->language]),
        'url' => ['/site/home/lang','lang' => Yii::$app->language],
        'items' => $langItems,
    ];

    echo Nav::widget([
        'model' => Menu::find()->limit(1)->one(),
    ]);

    NavBar::end();
?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
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
