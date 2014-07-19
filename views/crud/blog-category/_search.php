<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\app\BlogCategorySearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-category-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'default_title') ?>

		<?= $form->field($model, 'default_content') ?>

		<?= $form->field($model, 'slug') ?>

		<?= $form->field($model, 'rank') ?>

		<?php // echo $form->field($model, 'seo_id') ?>

		<?php // echo $form->field($model, 'created_at') ?>

		<?php // echo $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
