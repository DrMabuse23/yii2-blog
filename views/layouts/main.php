<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrap">
    <?php
    NavBar::begin(
        [
            'brandLabel' => 'My Company',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]
    );
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = [
            'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
            'url' => ['/site/logout'],
            'linkOptions' => ['data-method' => 'post']
        ];
        $menuItems[] = [
            'label' => 'Blog',
            'items' => [
                [
                    'label' => 'Category',
                    'url' => \yii\helpers\Url::to(['crud/category'])
                ],
                [
                    'label' => 'Post',
                    'url' => \yii\helpers\Url::to(['crud/post'])
                ],
                [
                    'label' => 'Post-Content',
                    'url' => \yii\helpers\Url::to(['crud/post-content'])
                ],
                [
                    'label' => 'Seo',
                    'url' => \yii\helpers\Url::to(['crud/seo'])
                ],
                [
                    'label' => 'Comment',
                    'url' => \yii\helpers\Url::to(['crud/comment'])
                ],

            ]
        ];
    }
    echo Nav::widget(
        [
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]
    );
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget(
            [
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]
        ) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
