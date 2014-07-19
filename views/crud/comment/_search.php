<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var drmabuse\blog\models\app\CommentSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="comment-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'content') ?>

		<?= $form->field($model, 'status') ?>

		<?= $form->field($model, 'create_time') ?>

		<?= $form->field($model, 'author') ?>

		<?php // echo $form->field($model, 'email') ?>

		<?php // echo $form->field($model, 'url') ?>

		<?php // echo $form->field($model, 'post_id') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
