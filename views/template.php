<?php $panelId = uniqid('panel-') ?>

<div class="tpy-template glowing-border">
    <?php
    \yii\jui\Draggable::begin(
                      [
                          'clientOptions' => ['grid' => [50, 20]],
                      ]
    );
    ?>
    <div id="<?= $panelId ?>" class="panel panel-default">
        <?php \yii\widgets\ActiveForm::begin() ?>

        <?= \yii\helpers\Html::hiddenInput('tid', $id) ?>

        <div class="panel-heading">
            <button type="button" class="close" data-dismiss="panel" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit
                <small><?= $id ?></small>
            </h4>
        </div>
        <div class="panel-body">

                <?php foreach ($model->attributes AS $attribute => $value): ?>
                    <div class="form-group">
                        <label for="<?= $attribute ?>" class="col-sm-2 control-label">
                            <?= $attribute ?>
                        </label>

                        <div class="col-sm-10">
                            <?= \yii\helpers\Html::textInput($attribute) ?>
                        </div>
                    </div>
                <?php endforeach; ?>

        </div>
        <div class="panel-footer text-center">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary">Save</button>
        </div>
        <?php \yii\widgets\ActiveForm::end() ?>
    </div>
    <?php
    \yii\jui\Draggable::end();
    ?>

    <div class="output" data-toggle="panel" data-target="#<?= $panelId ?>">
        <?= $content ?>
    </div>

</div>

