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
    $(document).on('change', '.salesinvoicedetails-item_code', function () {
//    $('.salesinvoicedetails-item_code').change(function () {
        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
        var next_row_id = $('#next_item_id').val();
        itemChange($(this).val(), current_row_id, next_row_id);
    });
    /*
     * on keyup of the quantity
     * @parameter quantity,UOM
     * @return total amount
     */
    $(document).on('keyup mouseup', '.salesinvoicedetails-qty', function () {
//    $('.salesinvoicedetails-qty').keyup(function () {
        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
        var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
        var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
        if (qty != "" && rate != "") {
            lineTotalAmount(current_row_id);
        }
    });
    /*
     * on keyup of the quantity
     * @parameter quantity,rate
     * @return total amount
     */
    $(document).on('keyup', '.salesinvoicedetails-discount_percentage', function () {
//    $('.salesinvoicedetails-discount_percentage').keyup(function () {
        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
        var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
        var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
        var tax_type = $('#tax-type-' + current_row_id).val();
        var tax = $('#salesinvoicedetails-tax_percentage-' + current_row_id).val();
        var percentage = $('#salesinvoicedetails-discount_percentage-' + current_row_id).val();
        if (qty != "" && rate != "") {
            var amount = qty * rate;
            var discount_amount = (amount * percentage) / 100;
            $('#salesinvoicedetails-discount_amount-' + current_row_id).val(discount_amount);
            lineTotalAmount(current_row_id);
        }

    });
    /*
     * on keyup of the quantity
     * @parameter quantity,rate
     * @return total amount
     */
    $(document).on('keyup', '.salesinvoicedetails-discount_amount', function () {
//$('.salesinvoicedetails-discount_amount').keyup(function () {
        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
        var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
        var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
        if (qty != "" && rate != "") {
            lineTotalAmount(current_row_id);
        }

    });

    /*
     * on keyup of the rate
     * @parameter quantity,rate
     * @return total amount
     */
    $(document).on('keyup', '.salesinvoicedetails-rate', function () {
//$('.salesinvoicedetails-discount_amount').keyup(function () {
        var current_row_id = $(this).attr('id').match(/\d+/); // 123456
        var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
        var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
        if (qty != "" && rate != "") {
            lineTotalAmount(current_row_id);
        }

    });

    $(document).on('keyup', '#cash_amount', function () {
        balanceCalculation();
    });
    $(document).on('keyup', '#card_amount', function () {
        balanceCalculation();
    });
    $(document).on('keyup', '#round_of', function () {
        balanceCalculation();
    });

    $('#add-invoicee').on('click', '#del', function () {
        var bid = this.id; // button ID 
        var trid = $(this).closest('tr').attr('id'); // table row ID 
        $(this).closest('tr').remove();
        calculateSubtotal();
    });

});

function balanceCalculation() {
    var order_amount = $('#order_sub_total').val();
    if (order_amount && order_amount != "") {
        var cash_amount = $('#cash_amount').val();
        var card_amount = $('#card_amount').val();
        var round_of_amount = $('#round_of').val();
        if (!cash_amount && cash_amount == '') {
            cash_amount = 0;
        }
        if (!card_amount && card_amount == '') {
            card_amount = 0;
        }
        if (!round_of_amount && round_of_amount == '') {
            round_of_amount = 0;
        }
        var order_balance = order_amount - (parseFloat(cash_amount) + parseFloat(card_amount) + parseFloat(round_of_amount));
        $('#payed_amount').val(parseFloat(cash_amount) + parseFloat(card_amount) + parseFloat(round_of_amount));
        $('#balance').val(order_balance);
    }
}

function itemChange(item_id, current_row_id, next_row_id) {
    var next = parseInt(next_row_id) + 1;
    $("#next_item_id").val(next);
    $.ajax({
        type: 'POST',
        cache: false,
        async: false,
        data: {item_id: item_id, next_row_id: next_row_id},
        url: homeUrl + 'sales/sales-ajax/item-details',
        success: function (data) {
            var res = $.parseJSON(data);
            console.log(res);
            $('#sales-uom-' + current_row_id).val(res.result['UOM']);
            $('#salesinvoicedetails-tax_percentage-' + current_row_id).val(res.result['tax-amount']);
            $('#tax-type-' + current_row_id).val(res.result['tax_type']);
            $('#salesinvoicedetails-qty-' + current_row_id).val(1);
            $("#salesinvoicedetails-rate-" + current_row_id).val(res.result['item_rate']);
//            if (res.result['UOM'] != "" && res.result['base_unit'] != "") {
//                Rate(res.result['base_unit'], current_row_id);
//            }
            if ($('#salesinvoicedetails-qty-' + current_row_id).val() != "" && $("#salesinvoicedetails-rate-" + current_row_id).val() != "") {
                lineTotalAmount(current_row_id);
            }
            $('#add-invoicee tr:last').after(res.result['next_row_html']);
            $('.salesinvoicedetails-qty').attr('type', 'number');
            $('.salesinvoicedetails-qty').attr('min', 1);
        }
    });
}


function Rate(base_unit, current_row_id) {

    $.ajax({
        type: 'POST',
        cache: false,
        async: false,
        data: {base_unit: base_unit},
        url: homeUrl + 'sales/sales-ajax/rate',
        success: function (data) {
            $("#salesinvoicedetails-rate-" + current_row_id).val(data);
        }
    });
}

function lineTotalAmount(current_row_id) {
    var qty = $('#salesinvoicedetails-qty-' + current_row_id).val();
    var tax_type = $('#tax-type-' + current_row_id).val();
    var rate = $('#salesinvoicedetails-rate-' + current_row_id).val();
    var discount_amount = $('#salesinvoicedetails-discount_amount-' + current_row_id).val();
    var tax = $('#salesinvoicedetails-tax_percentage-' + current_row_id).val();
    if (qty != "" && rate != "") {
        if (tax_type == 1) {
            var tax_amount = tax;
        } else {
            var total = (qty * rate) - discount_amount;
            var tax_amount = (total * tax) / 100;
        }

        var grand_total = (qty * rate) + tax_amount - discount_amount;
        $('#salesinvoicedetails-line_total-' + current_row_id).val(grand_total);
        calculateSubtotal();
    }
}
function calculateSubtotal() {
    var row_count = $('#next_item_id').val();
    var sub_total = 0;
    var tax_sub_total = 0;
    var order_sub_total = 0;
    for (i = 1; i <= row_count; i++) {
        var qty = $('#salesinvoicedetails-qty-' + i).val();
        var tax_type = $('#tax-type-' + i).val();
        var rate = $('#salesinvoicedetails-rate-' + i).val();
        var discount_amount = $('#salesinvoicedetails-discount_amount-' + i).val();

        var tax = $('#salesinvoicedetails-tax_percentage-' + i).val();
        if (qty && qty != "" && rate && rate != "") {

            if (tax_type == 1) {
                var tax_amount = tax;
            } else {
                var total = (qty * rate) - discount_amount;
                var tax_amount = (total * tax) / 100;
            }

            var grand_total = (qty * rate) + tax_amount - discount_amount;
            $('#salesinvoicedetails-line_total-' + i).val(grand_total);
            sub_total = parseFloat(sub_total) + parseFloat(total);
            tax_sub_total = parseFloat(tax_sub_total) + parseFloat(tax_amount);
            order_sub_total = parseFloat(order_sub_total) + parseFloat(grand_total);
        }

    }
    $('#sub_total').val(parseFloat(sub_total));
    $('#tax_sub_total').val(parseFloat(tax_sub_total));
    $('#order_sub_total').val(parseFloat(order_sub_total));
    $('#salesinvoicemaster-amount').val(parseFloat(sub_total));
}

