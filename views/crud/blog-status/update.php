<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var drmabuse\blog\models\app\BlogStatus $model
 */

$this->title = 'Blog Status Update ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Blog Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="blog-status-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
