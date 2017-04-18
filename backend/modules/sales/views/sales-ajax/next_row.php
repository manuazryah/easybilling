<tr class="filter" id="item-row-<?= $next ?>">

    <td>
        <div class="form-group field-salesinvoicedetails-item_code has-success">

            <select id="salesinvoicedetails-item-code-<?= $next ?>" class="form-control salesinvoicedetails-item_code" name="SalesInvoiceDetailsItem[<?= $next ?>]" aria-invalid="false">
                <option value="">-Item-</option>
                <?php foreach ($items as $value) { ?>
                    <option value="<?= $value->SKU ?>"><?= $value->SKU ?></option>
                <?php }
                ?>
            </select>

            <div class="help-block"></div>
        </div>
        <?php // $form->field($model, 'item_code')->dropDownList(ArrayHelper::map(ItemMaster::findAll(['status' => 1]), 'id', 'SKU'), ['prompt' => '-Item-'])->label(false);   ?>
    </td>
    <td>
        <div class="form-group field-salesinvoicedetails-qty has-success">

            <input type="text" id="salesinvoicedetails-qty-<?= $next ?>" class="form-control salesinvoicedetails-qty" name="SalesInvoiceDetailsQty[<?= $next ?>]" placeholder="Qty" aria-invalid="false">

            <div class="help-block"></div>
        </div>
    </td>
<input type="hidden" value="" placeholder="" class="form-control" id="tax-type-<?= $next ?>" name="tax-type" readonly/>
<td>
    <input type="text" value="" placeholder="UOM" class="form-control" id="sales-uom-<?= $next ?>" name="sales-uom[<?= $next ?>]" readonly/>
    <?php // $form->field($model, 'item_name')->textInput(['placeholder' => 'UOM'])->label(false)        ?>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-rate has-success">

        <input type="text" id="salesinvoicedetails-rate-<?= $next ?>" class="form-control salesinvoicedetails-rate" name="SalesInvoiceDetailsRate[<?= $next ?>]" placeholder="RATE" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-discount_percentage has-success">

        <input type="text" id="salesinvoicedetails-discount_percentage-<?= $next ?>" class="form-control salesinvoicedetails-discount_percentage" name="SalesInvoiceDetailsDiscount[<?= $next ?>]" placeholder="Discount %" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-discount_amount has-success">

        <input type="text" id="salesinvoicedetails-discount_amount-<?= $next ?>" class="form-control salesinvoicedetails-discount_amount" name="SalesInvoiceDetailsAmount[<?= $next ?>]" placeholder="Discount Amount" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-tax_percentage has-success">

        <input type="text" id="salesinvoicedetails-tax_percentage-<?= $next ?>" class="form-control salesinvoicedetails-tax_percentage" name="SalesInvoiceDetailsTaxPercentage[<?= $next ?>]" readonly="" placeholder="Tax" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <div class="form-group field-salesinvoicedetails-line_total has-success">

        <input type="text" id="salesinvoicedetails-line_total-<?= $next ?>" class="form-control salesinvoicedetails-line_total" name="SalesInvoiceDetailsLineTotal[<?= $next ?>]" placeholder="Amount" aria-invalid="false">

        <div class="help-block"></div>
    </div>
</td>
<td>
    <a id="del" class="" ><i class="fa fa-trash-o sales-invoice-delete"></i></a>
</td>
</tr>