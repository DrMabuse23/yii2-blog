<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var drmabuse\blog\models\app\PostSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="post-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'default_title') ?>

		<?= $form->field($model, 'slug') ?>

		<?= $form->field($model, 'tags') ?>

		<?= $form->field($model, 'status') ?>

		<?php // echo $form->field($model, 'css_class') ?>

		<?php // echo $form->field($model, 'readmore_length') ?>

		<?php // echo $form->field($model, 'author_id') ?>

		<?php // echo $form->field($model, 'seo_id') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
