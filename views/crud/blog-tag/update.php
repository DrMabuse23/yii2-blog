<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\app\BlogTag $model
 */

$this->title = 'Blog Tag Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Blog Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="blog-tag-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
