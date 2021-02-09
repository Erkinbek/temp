<?php
use yii\widgets\ActiveForm;
?>

<?php
$form = ActiveForm::begin() ?>
<div class="modal-body">
	<?= $form->field($model, 'articule') ?>
	<?= $form->field($model, 'name') ?>
	<?= $form->field($model, 'balance') ?>
	<?= $form->field($model, 'unit') ?>
</div>
<div class="modal-footer">
	<a href="/" class="btn badge-info">Отмена</a>
	<button type="submit" class="btn btn-success">Сохранит</button>
</div>
<?php $form::end() ?>
