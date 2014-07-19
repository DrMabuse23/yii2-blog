<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var drmabuse\blog\models\app\PostContent $model
 */

$this->title = 'Post Content Update ' . $model->id . '';
$this->params['breadcrumbs'][] = ['label' => 'Post Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="post-content-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
