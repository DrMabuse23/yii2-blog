<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var common\models\app\BlogPostLookupCategory $model
 */

$this->title = 'Blog Post Lookup Category Update ' . $model->category_id . '';
$this->params['breadcrumbs'][] = ['label' => 'Blog Post Lookup Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->category_id, 'url' => ['view', 'category_id' => $model->category_id, 'post_id' => $model->post_id]];
$this->params['breadcrumbs'][] = 'Edit';
?>
<div class="blog-post-lookup-category-update">

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span> View', ['view', 'category_id' => $model->category_id, 'post_id' => $model->post_id], ['class' => 'btn btn-info']) ?>
    </p>

	<?php echo $this->render('_form', [
		'model' => $model,
	]); ?>

</div>
