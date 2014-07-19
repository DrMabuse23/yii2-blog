<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var common\models\app\BlogAuthorSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="blog-author-search">

	<?php $form = ActiveForm::begin([
		'action' => ['index'],
		'method' => 'get',
	]); ?>

		<?= $form->field($model, 'id') ?>

		<?= $form->field($model, 'name') ?>

		<?= $form->field($model, 'slug') ?>

		<?= $form->field($model, 'created_at') ?>

		<?= $form->field($model, 'updated_at') ?>

		<div class="form-group">
			<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
			<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
		</div>

	<?php ActiveForm::end(); ?>

</div>
