<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\app\BlogPostContent $model
 */

$this->title = 'Blog Post Content Update ' . $model->id . '';
$this->params['breadcrumbs'][] = ['label' => 'Blog Post Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="blog-post-content-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
