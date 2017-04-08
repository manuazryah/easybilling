<?php

use yii\helpers\Html;
?>


<div class="form-group field-<?= $id ?>">
        <label class="control-label" for=""><?= $model->getAttributeLabel($field_name); ?></label>
        <input type="text" id="<?= $id ?>" class="form-control" name="<?= $name ?>" maxlength="15" aria-invalid="false">
        <div id="autofill-<?= $id ?>"></div>

        <div class="help-block"></div>
</div>
<input type="hidden" name="table_name" value="<?= $table_name ?>" id="table_name"/>
<script>
        $("document").ready(function () {
                $('#<?php echo $id ?>').blur(function () {
                        var data_id = $(this).val();
                        $.ajax({
                                type: 'POST',
                                cache: false,
                                data: {data_id: data_id, table_name: "<?= $table_name ?>", id: "<?= $id ?>"},
                                url: '<?= Yii::$app->homeUrl; ?>ajax/dropdown-data',
                                success: function (data) {
                                        $("#<?php echo 'autofill-' . $id ?>").html(data);
                                }
                        });
                });
                $('#autofill-list-item').click(function () {
                        $("#<?php echo 'autofill-' . $id ?>").val(this.value);
                });
        });
</script>

