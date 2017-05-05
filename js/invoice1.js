/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

/*
 * on chnage of the itemcode
 * parameter item_id
 * return base unit and tax depends on the item
 */
$('#salesinvoicedetails-item_code').change(function () {
itemChange($(this).val());
        $('#add-invoicee tr:last').after('\
<tr>\n\
<td><div class="form-group field-salesinvoicedetails-item_code has-success"><input type="text" id="salesinvoicedetails-item_code" class="ui-autocomplete-input form-control" name="SalesInvoiceDetails[item_code]" placeholder="Item" autocomplete="off" aria-invalid="false"><div class="help-block"></div></div></td>\n\
<td><div class="form-group field-salesinvoicedetails-qty has-success"><input type="text" id="salesinvoicedetails-qty" class="form-control" name="SalesInvoiceDetails[qty]" placeholder="Qty" aria-invalid="false"><div class="help-block"></div></div></td>\n\
<td><input type="text" value="" placeholder="UOM" class="form-control" id="sales-uom" name="sales-uom" readonly=""></td>\n\
<td><div class="form-group field-salesinvoicedetails-rate has-success"><input type="text" id="salesinvoicedetails-rate" class="form-control" name="SalesInvoiceDetails[rate]" placeholder="RATE" aria-invalid="false"><div class="help-block"></div></div></td>\n\
<td><div class="form-group field-salesinvoicedetails-discount_percentage has-success"><input type="text" id="salesinvoicedetails-discount_percentage" class="form-control" name="SalesInvoiceDetails[discount_percentage]" placeholder="Discount %" aria-invalid="false"><div class="help-block"></div></div></td>\n\
<td><div class="form-group field-salesinvoicedetails-discount_amount has-success"><input type="text" id="salesinvoicedetails-discount_amount" class="form-control" name="SalesInvoiceDetails[discount_amount]" placeholder="Discount Amount" aria-invalid="false"><div class="help-block"></div></div></td>\n\
<td><div class="form-group field-salesinvoicedetails-tax_percentage has-success"><input type="text" id="salesinvoicedetails-tax_percentage" class="form-control" name="SalesInvoiceDetails[tax_percentage]" readonly="" placeholder="Tax" aria-invalid="false"><div class="help-block"></div></div></td>\n\
<td><div class="form-group field-salesinvoicedetails-line_total has-success"><input type="text" id="salesinvoicedetails-line_total" class="form-control" name="SalesInvoiceDetails[line_total]" placeholder="Amount" aria-invalid="false"><div class="help-block"></div></div></td>\n\
</tr>');
        });
        /*
         * on keyup of the quantity
         * @parameter quantity,UOM
         * @return total amount
         */
        $('#salesinvoicedetails-qty').keyup(function () {
var qty = $('#salesinvoicedetails-qty').val();
        var tax_type = $('#tax-type').val();
        var rate = $('#salesinvoicedetails-rate').val();
        var discount_amount = $('#salesinvoicedetails-discount_amount').val();
        var tax = $('#salesinvoicedetails-tax_percentage').val();
        if (qty != "" && rate != "") {
totalAmount(qty, tax_type, rate, discount_amount, tax);
        }
});
        /*
         * on keyup of the quantity
         * @parameter quantity,rate
         * @return total amount
         */

        $('#salesinvoicedetails-discount_percentage').keyup(function () {
var qty = $('#salesinvoicedetails-qty').val();
        var rate = $('#salesinvoicedetails-rate').val();
        var tax_type = $('#tax-type').val();
        var tax = $('#salesinvoicedetails-tax_percentage').val();
        var percentage = $('#salesinvoicedetails-discount_percentage').val();
        if (qty != "" && rate != "") {
var amount = qty * rate;
        var discount_amount = (amount * percentage) / 100;
        $('#salesinvoicedetails-discount_amount').val(discount_amount);
        totalAmount(qty, tax_type, rate, discount_amount, tax);
        }

});
        /*
         * on keyup of the quantity
         * @parameter quantity,rate
         * @return total amount
         */

        $('#salesinvoicedetails-discount_amount').keyup(function () {
var qty = $('#salesinvoicedetails-qty').val();
        var rate = $('#salesinvoicedetails-rate').val();
        var tax_type = $('#tax-type').val();
        var tax = $('#salesinvoicedetails-tax_percentage').val();
        var discount_amount = $('#salesinvoicedetails-discount_amount').val();
        if (qty != "" && rate != "") {
totalAmount(qty, tax_type, rate, discount_amount, tax);
        }

});
});
        function totalAmount(qty, tax_type, rate, discount_amount, tax) {
        if (tax_type == 1) {
        var tax_amount = tax;
        } else {
        var total = (qty * rate) - discount_amount;
                var tax_amount = (total * tax) / 100;
        }

        var grand_total = (qty * rate) + tax_amount - discount_amount;
                $('#salesinvoicedetails-line_total').val(grand_total);
        }

function itemChange(item_id) {

$.ajax({
type: 'POST',
        cache: false,
        async: false,
        data: {item_id: item_id},
        url: homeUrl + 'sales/sales-ajax/item-details',
        success: function (data) {
        var res = $.parseJSON(data);
                $("#sales-uom").val(res.result[0]);
                $("#salesinvoicedetails-tax_percentage").val(res.result[1]);
                $("#tax-type").val(res.result[3]);
                if (res.result[0] != "" && res.result[2] != "") {
        Rate(res.result[2]);
        }
        }
});
}

function Rate(base_unit) {

$.ajax({
type: 'POST',
        cache: false,
        async: false,
        data: {base_unit: base_unit},
        url: homeUrl + 'sales/sales-ajax/rate',
        success: function (data) {
        $("#salesinvoicedetails-rate").val(data);
        }
});
}

