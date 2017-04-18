<tr class="filter" id="item-row-<?= $next_row_id++ ?>">

    <td>
        <div class="form-group field-salesinvoicedetails-item_code has-success">

            <select id="salesinvoicedetails-item-code-<?= $next_row_id++ ?>" class="form-control salesinvoicedetails-item_code" name="SalesInvoiceDetailsItem[<?= $next_row_id++ ?>]" aria-invalid="false">
                <option value="">-Item-</option>
                <?php foreach ($items as $value) { ?>
                    <option value="<?= $value ?>"><?= $value ?></option>
                <?php }
                ?>
            </select>

            <div class="help-block"></div>
        </div>
        <?php // $form->field($model, 'item_code')->dropDownList(ArrayHelper::map(ItemMaster::findAll(['status' => 1]), 'id', 'SKU'), ['prompt' => '-Item-'])->label(false);   ?>
    </td>
    <td>
        <div class="form-group field-salesinvoicedetails-qty has-success">

            <input type="number" id="salesinvoicedetails-qty-<?= $next_row_id++ ?>" class="form-control salesinvoicedetails-qty" name="SalesInvoiceDetailsQty[<?= $next_row_id++ ?>]" placeholder="Qty" min="1" aria-invalid="false">

            <div class="help-block"></div>
        </div>
    </td>
<input type="hidden" value="" placeholder="" class="form-control" id="tax-type-<?= $next_row_id++ ?>" name="tax-type[<?= $next_row_id++ ?>]" readonly/>
<td>
    <input type="text" value="" placeholder="UOM" class="form-control" id="sales-uom-1" name="sales-uom[<?= $next_row_id++ ?>]" readonly/>
    <?php // $form->field($model, 'item_name')->textInput(['placeholder' => 'UOM'])->label(false)        ?>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-rate has-success">

        <input type="text" id="salesinvoicedetails-rate-<?= $next_row_id++ ?>" class="form-control salesinvoicedetails-rate" name="SalesInvoiceDetailsRate[<?= $next_row_id++ ?>]" placeholder="RATE" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-discount_percentage has-success">

        <input type="text" id="salesinvoicedetails-discount_percentage-<?= $next_row_id++ ?>" class="form-control salesinvoicedetails-discount_percentage" name="SalesInvoiceDetailsDiscount[<?= $next_row_id++ ?>]" placeholder="Discount %" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-discount_amount has-success">

        <input type="text" id="salesinvoicedetails-discount_amount-<?= $next_row_id++ ?>" class="form-control salesinvoicedetails-discount_amount" name="SalesInvoiceDetailsAmount[<?= $next_row_id++ ?>]" placeholder="Discount Amount" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-tax_percentage has-success">

        <input type="text" id="salesinvoicedetails-tax_percentage-<?= $next_row_id++ ?>" class="form-control salesinvoicedetails-tax_percentage" name="SalesInvoiceDetailsTaxPercentage[<?= $next_row_id++ ?>]" readonly="" placeholder="Tax" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-line_total has-success">

        <input type="text" id="salesinvoicedetails-line_total-<?= $next_row_id++ ?>" class="form-control salesinvoicedetails-line_total" name="SalesInvoiceDetailsLineTotal[<?= $next_row_id++ ?>]" placeholder="Amount" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <?= Html::submitButton($model->isNewRecord ? 'Add' : 'Update', ['class' => 'btn btn-success', 'name' => 'add']) ?>
</td>


</tr>