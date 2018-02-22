/**
 * Сохранение информации о продукте
 */
function setProducts()
{
    var product = {
        'product_id': $('#product_id').val(),
        'product_name': $('#product_name').val(),
        'product_code': $('#product_code').val(),
        'product_quantity': $('#product_quantity').val(),
        'product_price': $('#product_price').val()
    };

    $.ajax({
        type: "POST",
        url: "/products/set-product",
        // async: false,
        data: product,
        error: function (data) {
            alert("Ошибка при внесении информации о товаре");
        },
        success: function (data) {
            updateProductsList(data);

            $('#modal').modal('hide');
        }
    });
}

/**
 * Добавление котнрагента
 */
function setCounterparty()
{
    var counterparty = {
        'counterparty_type': $('#counterparty_type').val(),
        'counterparty_id': $('#counterparty_id').val(),
        'counterparty_name': $('#counterparty_name').val(),
        'counterparty_tel': $('#counterparty_tel').val(),
        'counterparty_email': $('#counterparty_email').val()
    }

    $.ajax({
        type: "POST",
        url: "/counterparty/set-counterparty",
        // async: false,
        data: counterparty,
        error: function (data) {
            alert("Ошибка при внесении информации о контрагенте");
        },
        success: function (data) {
            updateCounterpartyList(data);

            $('#modal').modal('hide');

        }
    });
}

/**
 * Редактирование продукта
 */
function editProduct(id)
{
    $.ajax({
        type: "POST",
        url: "/products/edit-product",
        // async: false,
        data: {
            id: id
        },
        error: function (data) {
            alert("Ошибка при редактировании товара");
        },
        success: function (data) {
            $('#product_id').val(data.id);
            $('#product_name').val(data.name);
            $('#product_quantity').val(data.quantity);
            $('#product_price').val(data.price);

        }
    });
}

/**
 * Редактирование контрагента
 */
function editCounterparty(id)
{
    $.ajax({
        type: "POST",
        url: "/counterparty/edit-counterparty",
        // async: false,
        data: {
            id: id
        },
        error: function (data) {
            alert("Ошибка при редактировании контрагента");
        },
        success: function (data) {
            $('#counterparty_id').val(data.id);
            $('#counterparty_name').val(data.name);
            $('#counterparty_type').val(data.type);
            $('#counterparty_tel').val(data.tel);
            $('#counterparty_email').val(data.email);

        }
    });
}

/**
 * Удаление продукта
 */
function delProduct(id)
{
    $.ajax({
        type: "POST",
        url: "/products/del-product",
        // async: false,
        data: {
            id: id,
        },
        error: function (data) {
            alert("Ошибка при удалении товара");
        },
        success: function (data) {
            updateProductsList(data);
        }
    });
}

/**
 * Удаление контрагента
 */
function delCounterparty(id)
{
    $.ajax({
        type: "POST",
        url: "/counterparty/del-counterparty",
        // async: false,
        data: {
            id: id,
        },
        error: function (data) {
            alert("Ошибка при удалении товара");
        },
        success: function (data) {
            updateCounterpartyList(data);
        }
    });
}

/**
 * Обновление списка всех продуктов для формирования таблицы товаров
 */
function updateProductsList(data)
{
    $('#all-product-tab').empty();
    // console.log(data);
    $.each(data, function(i, item) {

        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.name + '</td>'
            + '<td>' + item.quantity + '</td>'
            + '<td>' + item.price + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="editProduct( ' + item.id + ')">'
                    + '<i class="fa fa-pencil" aria-hidden="true"></i>'
                + '</a>'
                + '<a class="col-md-offset-3" href="#" onclick="delProduct( ' + item.id + ')">'
                    + '<i class="fa fa-trash-o fa-lg"></i>'
                + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-product-tab').append(stringTab);
    });
}

/**
 * Обновление списка контрагентов
 */
function updateCounterpartyList(data)
{
    $('#all-counterparty-tab').empty();

    $.each(data, function(i, item) {
        var itemType = ''
        item.type == 1 ? itemType = '<td class="btn-danger">Покупатель</td>' : '';
        item.type == 2 ? itemType = '<td class="btn-success">Поставщик</td>' : '';

        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + itemType
            + '<td>' + item.name + '</td>'
            + '<td>' + item.tel + '</td>'
            + '<td>' + item.email + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="editCounterparty( ' + item.id + ')">'
            + '<i class="fa fa-pencil" aria-hidden="true"></i>'
            + '</a>'
            + '<a class="col-md-offset-3" href="#" onclick="delCounterparty( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-counterparty-tab').append(stringTab);
    });
}

/**
 * Очистка модального окна продуктов
 */
function clearProductModal()
{
    $('#product_id').val('');
    $('#product_name').val('');
    $('#product_quantity').val('');
    $('#product_price').val('');
}

/**
 * очистка модального окна в контрагентах
 */
function clearCounterpartyModal()
{
    $('#counterparty_type').val('');
    $('#counterparty_id').val('');
    $('#counterparty_name').val('');
    $('#counterparty_tel').val('');
    $('#counterparty_email').val('');
}

/**
 * очистка модального окна в Расходной накладной
 */
function clearOutgoingModal()
{
    $('#outgoing_payment_order_id').val('');
    $('#outgoing_payment_order_date').val('');
    $('#outgoing_payment_order_quantity').val(0);
    $('#outgoing_payment_order_summa').val(0);
    $('#invoice-tab').empty();
}

/**
 * очистка модального окна в приходной накладной
 */
function clearIncomingModal()
{
    $('#incoming_payment_order_id').val('');
    $('#incoming_payment_order_date').val('');
    $('#incoming_payment_order_quantity').val(0);
    $('#incoming_payment_order_summa').val(0);
    $('#invoice-tab').empty();
}

/**
 * Получение списка всех товаров
 */
function getAllProduct()
{
    $.ajax({
        type: "POST",
        url: "/products/get-all-products",
        // async: false,
        // data: product,
        error: function (data) {
            alert("Ошибка при получении информации о всех товарах");
        },
        success: function (data) {
            updateProductsListInModal(data);
        }
    });
}

/**
 * Получение списка всех товаров
 */
function getAllProductOutgoing()
{
    $.ajax({
        type: "POST",
        url: "/products/get-all-products",
        error: function (data) {
            alert("Ошибка при получении информации о всех товарах");
        },
        success: function (data) {
            updateProductsListInModalOutgoing(data);
        }
    });
}

/**
 * Обновление таблицы с товарами в модальном окне в приходной накладной
 */
function updateProductsListInModal(data)
{
    $('#all-product-tab').empty();
    // console.log(data);
    $.each(data, function(i, item) {

        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.name + '</td>'
            + '<td>' + item.quantity + '</td>'
            + '<td>' + item.price + '</td>'
            + '<td class="text-center">'
            + '<a href="#" onclick="addProductIncomingOrder( ' + item.id + ')">'
            + '<i class="fa fa-plus fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-product-tab').append(stringTab);
    });
}

/**
 * Обновление таблицы с товарами в модальном окне в Расходной накладной
 */
function updateProductsListInModalOutgoing(data)
{
    $('#all-product-tab').empty();
    // console.log(data);
    $.each(data, function(i, item) {

        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.name + '</td>'
            + '<td>' + item.quantity + '</td>'
            + '<td>' + item.price + '</td>'
            + '<td class="text-center">'
            + '<a href="#" onclick="addProductOutgoingOrder( ' + item.id + ')">'
            + '<i class="fa fa-plus fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-product-tab').append(stringTab);
    });
}

/**
 * Добавление товара в приходную накладную
 */
function addProductIncomingOrder(id)
{
    $.ajax({
        type: "POST",
        url: "/incoming-payment-order/add-product-incoming",
        data : {
            product_id: id,
            order_id: $('#incoming_payment_order_id').val(),
            counterparty_id: $('#counterparty_id').val(),
            incoming_payment_order_quantity: $('#incoming_payment_order_quantity').val(),
            incoming_payment_order_summa: $('#incoming_payment_order_summa').val(),
        },
        error: function (data) {
            alert("Ошибка при добавлении товара в приходную накладную");
        },
        success: function (data) {
            // console.log(data);
            updateInvoice(data);
        }
    });
}

/**
 * Добавление товара в Расходную накладную
 */
function addProductOutgoingOrder(id)
{
    $.ajax({
        type: "POST",
        url: "/outgoing-payment-order/add-product-outgoing",
        data : {
            product_id: id,
            order_id: $('#outgoing_payment_order_id').val(),
            counterparty_id: $('#counterparty_id').val(),
            outgoing_payment_order_quantity: $('#outgoing_payment_order_quantity').val(),
            outgoing_payment_order_summa: $('#outgoing_payment_order_summa').val(),
        },
        error: function (data) {
            alert("Ошибка при добавлении товара в Расходную накладную");
        },
        success: function (data) {
            // console.log(data);
            updateInvoiceOutgoing(data);

        }
    });
}

/**
 * Удаление товара из приходной накладной
 */
function delProductIncomingOrder(id) {
    $.ajax({
        type: "POST",
        url: "/incoming-payment-order/del-product-incoming",
        data: {
            product_id:id,
            order_id: $('#incoming_payment_order_id').val(),
        },
        error: function (data) {
            alert("Ошибка при удалении товара delProductIncomingOrder()");
        },
        success: function (data) {
            updateInvoice(data);
        }
    });
}

/**
 * Удаление товара из приходной накладной
 */
function delProductOutgoingOrder(id) {
    $.ajax({
        type: "POST",
        url: "/outgoing-payment-order/del-product-outgoing",
        data: {
            product_id:id,
            order_id: $('#outgoing_payment_order_id').val(),
        },
        error: function (data) {
            alert("Ошибка при удалении товара delProductOutgoingOrder()");
        },
        success: function (data) {
            updateInvoiceOutgoing(data);
        }
    });
}

/**
 * Обновление списка товаров в таблице приходной накладной
 */
function updateInvoice(data)
{
    $('#invoice-tab').empty();
    // console.log(data);
    $("#incoming_payment_order_quantity").val(data.quantity);
    $("#incoming_payment_order_summa").val(data.sum);
    $.each(data.relation_invoice_incoming, function(i, item) {
        if($('#incoming_payment_order_id').val() == '') {
            $('#incoming_payment_order_id').val(item.incoming_payment_order_id);
        }
        console.log(item);
        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.relation_product.name + '</td>'
            + '<td>' + item.quantity + '</td>'
            + '<td>' + item.price + '</td>'
            + '<td class="text-center">'
            + '<a href="#" onclick="delProductIncomingOrder( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#invoice-tab').append(stringTab);
    });
}

/**
 * Обновление списка товаров в таблице Расходной накладной
 */
function updateInvoiceOutgoing(data)
{
    $('#invoice-tab').empty();
    $("#outgoing_payment_order_quantity").val(data.quantity);
    $("#outgoing_payment_order_summa").val(data.sum);
    $.each(data.relation_invoice_outgoing, function(i, item) {
        if($('#outgoing_payment_order_id').val() == '') {
            $('#outgoing_payment_order_id').val(item.outgoing_payment_order_id);
        }
        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.relation_product.name + '</td>'
            + '<td>' + item.quantity + '</td>'
            + '<td>' + item.price + '</td>'
            + '<td class="text-center">'
            + '<a href="#" onclick="delProductOutgoingOrder( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#invoice-tab').append(stringTab);
    });
}

/**
 * Получение списка товаров в приходной накладной по ID накладной
 */
function getOrderById(id)
{
    $.ajax({
        type: "POST",
        url: "/incoming-payment-order/get-incoming-order",
        data: { id:id},
        error: function (data) {
            console.log('Ошибка в getOrderById()');
        },
        success: function (data) {
        }
    });
}

/**
 * Редактирование приходной накладной
 */
function editIncomingOrder(id) {
    $.ajax({
        type: "POST",
        url: "/incoming-payment-order/get-incoming-order",
        data: { id:id},
        error: function (data) {
            console.log('Ошибка в editIncomingOrder()');
        },
        success: function (data) {
            $('#incoming_payment_order_id').val(data.id);
            $('#counterparty_id').val(data.counterparty_id);
            $('#incoming_payment_order_date').val(data.updated_at);
           /* $('#incoming_payment_order_quantity').val(data.quantity);
            $('#incoming_payment_order_summa').val(data.sum);*/
            updateInvoice(data);
        }
    });
}

/**
 * Редактирование Расходной накладной
 */
function editOutgoingOrder(id) {
    $.ajax({
        type: "POST",
        url: "/outgoing-payment-order/get-outgoing-order",
        data: { id:id},
        error: function (data) {
            console.log('Ошибка в editOutgoingOrder()');
            console.log(data);

        },
        success: function (data) {
            $('#outgoing_payment_order_id').val(data.id);
            $('#counterparty_id').val(data.counterparty_id);
            $('#outgoing_payment_order_date').val(data.updated_at);
            updateInvoiceOutgoing(data);
        }
    });
}

/**
 * Сохранение прихордной накладной
 */
function setIncomingOrder() {
    var data = {
        order_id: $('#incoming_payment_order_id').val(),
        counterparty_id: $('#counterparty_id').val(),
        order_date: $('#incoming_payment_order_date').val(),
        quantity: $('#incoming_payment_order_quantity').val(),
        summa: $('#incoming_payment_order_summa').val(),
    }

    $.ajax({
        type: "POST",
        url: '/incoming-payment-order/set-incoming-payment-order',
        data: data,
        error: function (data) {
            alert("Ошибка при сохранении расходной накладной setIncomingOrder()");
        },
        success: function (data) {
            $('#modal').modal('hide');
            getAllIncomingOrders();
        }
    });
}

/**
 * Сохранение Расходной накладной
 */
function setOutgoingOrder() {
    var data = {
        order_id: $('#outgoing_payment_order_id').val(),
        counterparty_id: $('#counterparty_id').val(),
        order_date: $('#outgoing_payment_order_date').val(),
        quantity: $('#outgoing_payment_order_quantity').val(),
        summa: $('#outgoing_payment_order_summa').val(),
    }

    $.ajax({
        type: "POST",
        url: '/outgoing-payment-order/set-outgoing-payment-order',
        data: data,
        error: function (data) {
            alert("Ошибка при сохранении расходной накладной setOutgoingOrder()");
        },
        success: function (data) {
            $('#modal').modal('hide');
            getAllOutgoingOrders();
        }
    });
}

/**
 * Удаление приходной наклданой
 */
function delIncomingOrder(id)
{
    $.ajax({
        type: "POST",
        url: '/incoming-payment-order/del-incoming-payment-order',
        data: { id:id },
        error: function (data) {
            alert("Ошбка при удалении приходной накладной");
        },
        success: function (data) {
            getAllIncomingOrders();
        }
    });
}

/**
 * Удаление Расходной наклданой
 */
function delOutgoingOrder(id)
{
    $.ajax({
        type: "POST",
        url: '/outgoing-payment-order/del-outgoing-payment-order',
        data: { id:id },
        error: function (data) {
            alert("Ошбка при удалении Расходной накладной");
        },
        success: function (data) {
            getAllOutgoingOrders();
        }
    });
}

/**
 * Получение/обновление списка приходных накладных и вывод их в таблице
 */
function getAllIncomingOrders() {
    $.ajax({
        type: "POST",
        url: "/incoming-payment-order/get-all-incoming-orders",
        error: function (data) {
            alert("Ошибка при формировании таблицы приходных накладных");
        },
        success: function (data) {
            $('#all-incoming-tab').empty();

            $.each(data, function (i, item) {
                var stringTab = '<tr>'
                    + '<td>' + item.id + '</td>'
                    + '<td>' + item.updated_at + '</td>'
                    + '<td>' + item.relation_counterparty.name + '</td>'
                    + '<td>' + item.quantity + '</td>'
                    + '<td>' + item.sum + '</td>'
                    + '<td class="text-center">'
                    + '<a href="#modal"  data-toggle="modal" onclick="editIncomingOrder( ' + item.id + ')">'
                    + '<i class="fa fa-pencil" aria-hidden="true"></i>'
                    + '</a>'
                    + '<a class="col-md-offset-3" href="#" onclick="delIncomingOrder( ' + item.id + ')">'
                    + '<i class="fa fa-trash-o fa-lg"></i>'
                    + '</a>'
                    + '</td>'
                    + '</tr>';

                $('#all-incoming-tab').append(stringTab);
            });
        }
    });
}

/**
 * Получение/обновление списка приходных накладных и вывод их в таблице
 */
function getAllOutgoingOrders() {
    $.ajax({
        type: "POST",
        url: "/outgoing-payment-order/get-all-outgoing-orders",
        error: function (data) {
            alert("Ошибка при формировании таблицы Расходных накладных");
        },
        success: function (data) {
            $('#all-outgoing-tab').empty();

            $.each(data, function (i, item) {
                var stringTab = '<tr>'
                    + '<td>' + item.id + '</td>'
                    + '<td>' + item.updated_at + '</td>'
                    + '<td>' + item.relation_counterparty.name + '</td>'
                    + '<td>' + item.quantity + '</td>'
                    + '<td>' + item.sum + '</td>'
                    + '<td class="text-center">'
                    + '<a href="#modal"  data-toggle="modal" onclick="editOutgoingOrder( ' + item.id + ')">'
                    + '<i class="fa fa-pencil" aria-hidden="true"></i>'
                    + '</a>'
                    + '<a class="col-md-offset-3" href="#" onclick="delOutgoingOrder( ' + item.id + ')">'
                    + '<i class="fa fa-trash-o fa-lg"></i>'
                    + '</a>'
                    + '</td>'
                    + '</tr>';

                $('#all-outgoing-tab').append(stringTab);
            });
        }
    });
}

/**
 * Формирование отчета за период
 */
function getReport()
{
    var date_start = $('#date_start').val();
    var date_end = $('#date_end').val();

    $.ajax({
        type: "POST",
        url: '/reports/get-report',
        data: {
            date_start: date_start,
            date_end: date_end,
        },
        error: function (data) {
            console.log("Ошибка при получении отчета за период getReport()");
        },
        success: function (data) {
            updateReportsList(data);
        }
    });
}

/**
 * Обновление списка отчетов
 */
function updateReportsList(data) {
    $('#all-report-tab').empty();
    $.each(data, function(i, item){
        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td>' + item.name + '</td>'
            + '<td>' + item.perion + '</td>'
            + '<td>' + item.sum + '</td>'
            + '<td class="text-center">'
            + '<a class="col-md-offset-3" href="#" onclick="viewReport( ' + item.id + ')">'
            + '<i class="fa fa-eye fa-lg"></i>'
            + '</a>'
            + '<a class="col-md-offset-3" href="#" onclick="delReport( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg"></i>'
            + '</a>'
            + '</td>'
            + '</tr>';

        $('#all-report-tab').append(stringTab);
    });
}



