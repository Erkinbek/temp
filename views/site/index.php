<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

if (Yii::$app->session->hasFlash('result')) {
	$result = Yii::$app->session->getFlash('result');
}

?>
<div class="container">
<!-- Button trigger modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Новая запис
  </button>
  <div class="row">
    <?php $form = ActiveForm::begin(['action' => 'site/delete-items']);  ?>
    <table class="table-bordered table">
      <tr>
        <td>#</td>
        <td>Артикул</td>
        <td>Наименование комплектующие</td>
        <td>Остаток на складе</td>
        <td>Ед. изм.</td>
        <td>Групповое удаления</td>
        <td>Do something</td>
      </tr>
       <?php $i = 0; foreach ($data as $item): $i++ ?>
       <tr>
         <td><?= $i ?></td>
         <td><?= $item->articule ?></td>
         <td><?= $item->name ?></td>
         <td><?= $item->balance ?></td>
         <td><?= $item->unit ?></td>
         <td><input type="checkbox" name="id[]" value="<?= $item->id ?>"></td>
         <td>
           <a href="site/update?id=<?= $item->id ?>" class="btn btn-primary">Update</a>
           <button
             type="button"
               class="btn btn-danger"
               data-toggle="modal"
               data-target="#confirmModal"
               onclick="setID(<?= $item->id ?>)"
           ">Delete
           </button>
         </td>
       </tr>
      <?php endforeach; ?>
    </table>
    <button type="submit" class="btn-danger btn">Delete selected</button>
    <?php $form::end(); ?>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Добавит новое</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
	    <?php $form = ActiveForm::begin() ?>

      <div class="modal-body">

        <section id="tabs" class="project-tab">
          <div class="container">
            <div class="row">
              <div class="col-md-12">
                <nav>
                  <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-home-articule" data-toggle="tab" href="#nav-articule" role="tab" aria-controls="nav-articule" aria-selected="true">Артикул</a>
                    <a class="nav-item nav-link" id="nav-name-tab" data-toggle="tab" href="#nav-name" role="tab" aria-controls="nav-name" aria-selected="false">Наименование комплектующие</a>
                    <a class="nav-item nav-link" id="nav-balance-tab" data-toggle="tab" href="#nav-balance" role="tab" aria-controls="nav-balance" aria-selected="false">Остаток на складе</a>
                    <a class="nav-item nav-link" id="nav-unit-tab" data-toggle="tab" href="#nav-unit" role="tab" aria-controls="nav-unit" aria-selected="false">Ед. изм.</a>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-articule" role="tabpanel" aria-labelledby="nav-home-tab">
	                  <?= $form
	                  ->field($model, 'articule')
	                  ->textInput(['placeholder' =>"Артикул"])
	                  ->label(false) ?>
                  </div>
                  <div class="tab-pane fade" id="nav-name" role="tabpanel" aria-labelledby="nav-name-tab">
	                  <?= $form
                      ->field($model, 'name')
	                    ->textInput(['placeholder' =>"Наименование комплектующие"])
	                    ->label(false) ?>
                  </div>
                  <div class="tab-pane fade" id="nav-balance" role="tabpanel" aria-labelledby="nav-balance-tab">
	                  <?= $form
                        ->field($model, 'balance')
                        ->textInput(['placeholder' => 'Остаток на складе'])
                        ->label(false) ?>
                  </div>
                  <div class="tab-pane fade" id="nav-unit" role="tabpanel" aria-labelledby="nav-unit-tab">
	                  <?= $form
                        ->field($model, 'unit')
                        ->textInput(['placeholder' => "Ед. изм."])
                        ->label(false) ?>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Отмена</button>
        <button type="submit" class="btn btn-primary">Сохранит</button>
      </div>
	    <?php $form::end() ?>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Подвеждение</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Вы точно хотитие удалить этот запис?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет, пошутил :)</button>
        <a id="deleteButton" type="submit" class="btn btn-danger">Да конечно</a>
      </div>
    </div>
  </div>
</div>

<script>
  function setID(id) {
  	document.getElementById("deleteButton").href = "/site/delete/?id=" + id
  }
</script>

<?php if (isset($result)): ?>
  <script>
		Swal.fire({
			position: 'top-end',
			icon: '<?= $result['class'] ?>',
			title: ' <?= $result['message'] ?>',
			showConfirmButton: false,
			timer: 1500
		})
  </script>
<?php endif; ?>