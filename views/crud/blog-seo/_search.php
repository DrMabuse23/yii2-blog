<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var drmabuse\blog\models\app\BlogSeoSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-seo-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'default_title') ?>

		<?= $form->field($model, 'default_keywords') ?>

		<?= $form->field($model, 'default_description') ?>

		<?= $form->field($model, 'default_meta_json') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
