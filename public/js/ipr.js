/**
 * Сохранение информации о продукте
 */
function setProducts()
{
    var product = {
        'product_id': $('#product_id').val(),
        'product_name': $('#product_name').val(),
        'product_quantity': $('#product_quantity').val(),
        'product_code': $('#product_code').val(),
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
 * Просмотр товара
 * @param id
 */
function getProduct(id)
{
    this.editProduct(id);
    /*var inp = $("#form_product input");
    $.each(inp, function(i, x){
        $(inp[i]).prop({disabled:'disabled'});
    })*/
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
            var datas = new Array();
            var price = new Array();
            $.each(data.product_prices, function (i, item) {
                price[i] = item.price;
            })
            datas = {
                name: data.product_info.name,
                data: price,
            }

            // заполнение данных по товару
            $('#product_id').val(data.product_info.id);
            $('#product_name').val(data.product_info.name);
            $('#product_code').val(data.product_info.code);
            $('#product_quantity').val(data.product_info.quantity);
            $('#product_price').val(data.product_price);

            // отрисовка графика изменения цены
            setChart('Изменение цен на товар', 'динамика', 'Цена', datas);

        }
    });
}

/**
 * Просмотр контрагента
 * @param id
 */
function getCounterparty(id)
{
    this.editCounterparty(id);
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
            // заполнение данных по Контрагенту
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
            // обновление спика товаров
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
            + '<td class="text-left">' + item.name + '</td>'
            + '<td class="small-display">' + item.code + '</td>'
            + '<td class="small-display">' + item.quantity + '</td>'
            + '<td class="small-display">' + item.price + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="getProduct(' + item.id + ')">'
                    + '<i class="fa fa-eye" aria-hidden="true"></i>'
                + '</a>' + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="editProduct( ' + item.id + ')">'
                    + '<i class="fa fa-pencil" aria-hidden="true"></i>'
                + '</a>' + '</td>'
            + '<td class="text-center"><a href="#" onclick="delProduct( ' + item.id + ')">'
                    + '<i class="fa fa-trash-o fa-lg red"></i>'
                + '</a>' + '</td>'
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
            + '<td class="small-display">' + item.tel + '</td>'
            + '<td class="small-display">' + item.email + '</td>'
            + '<td class="text-center"><a href="" data-toggle="" onclick="getCounterparty( \' + item.id + \')">'
            + '<i class="fa fa-eye" aria-hidden="true"></i>'
            + '</a>' + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="editCounterparty( ' + item.id + ')">'
            + '<i class="fa fa-pencil" aria-hidden="true"></i>'
            + '</a>' + '</td>'
            + '<td class="text-center"><a href="#" onclick="delCounterparty( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg red"></i>'
            + '</a>' + '</td>'
            + '</tr>';

        $('#all-counterparty-tab').append(stringTab);
    });
}

/**
 * Очистка модального окна продуктов
 */
function clearProductModal()
{
    // document.getElementById('form_product').reset();
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
    $('#btn-viewpdf').attr('href', '');
    $('#btn-downloadpdf').attr('href', '');
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
 * Получение информации о приходной накладной
 * @param id
 */
function getIncomingOrder(id) {
    this.editIncomingOrder(id);
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
            // для экспорта в PDF
            $('#btn-viewpdf').attr('href', '/incoming-payment-order/incoming-to-pdf/' + data.id);
            $('#btn-downloadpdf').attr('href', '/incoming-payment-order/incoming-load-pdf/' + data.id);
           /* $('#incoming_payment_order_quantity').val(data.quantity);
            $('#incoming_payment_order_summa').val(data.sum);*/
            updateInvoice(data);
            $('#modal').modal('show');
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
            $('#btn-viewpdf').attr('href', '/outgoing-payment-order/outgoing-to-pdf/' + data.id);
            $('#btn-downloadpdf').attr('href', '/outgoing-payment-order/outgoing-load-pdf/' + data.id);
            updateInvoiceOutgoing(data);
            $('#modal').modal('show');
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
 * Получение информации о расходной наклданой
 * @param id
 */
function getOutgoingOrder(id)
{
    this.editOutgoingOrder(id);
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
            updateIncomingList(data);
        }
    });
}

/**
 * Обновление таблицы приходных накладных
 * @param data
 */
function updateIncomingList(data)
{
    $('#all-incoming-tab').empty();

    $.each(data, function (i, item) {
        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td class="small-display">' + item.updated_at + '</td>'
            + '<td>' + item.relation_counterparty.name + '</td>'
            + '<td class="small-display text-center">' + item.quantity + '</td>'
            + '<td class="small-display text-center">' + item.sum + '</td>'
            + '<td class="text-center"><a href="#" onclick="getIncomingOrder( ' + item.id + ')">'
            + '<i class="fa fa-eye" aria-hidden="true"></i>'
            + '</a>' + '</td>'
            + '<td class="text-center"><a href="#" onclick="editIncomingOrder( ' + item.id + ')">'
            + '<i class="fa fa-pencil" aria-hidden="true"></i>'
            + '</a>' + '</td>'
            + '<td class="text-center"><a href="#" onclick="delIncomingOrder( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg red"></i>'
            + '</a>' + '</td>'
            + '</tr>';

        $('#all-incoming-tab').append(stringTab);
    });
}

/**
 * Получение/обновление списка расходных накладных и вывод их в таблице
 */
function getAllOutgoingOrders() {
    $.ajax({
        type: "POST",
        url: "/outgoing-payment-order/get-all-outgoing-orders",
        error: function (data) {
            alert("Ошибка при формировании таблицы Расходных накладных");
        },
        success: function (data) {
            updateOutgoingList(data);
        }
    });
}

/**
 * Обновление таблицы расходных накладных
 * @param data
 */
function updateOutgoingList(data) {
    $('#all-outgoing-tab').empty();

    $.each(data, function (i, item) {
        var stringTab = '<tr>'
            + '<td>' + item.id + '</td>'
            + '<td class="small-display">' + item.updated_at + '</td>'
            + '<td>' + item.relation_counterparty.name + '</td>'
            + '<td class="small-display text-center">' + item.quantity + '</td>'
            + '<td class="small-display text-center">' + item.sum + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="getOutgoingOrder( ' + item.id + ')">'
            + '<i class="fa fa-eye" aria-hidden="true"></i>'
            + '</a>' + '</td>'
            + '<td class="text-center"><a href="#modal" data-toggle="modal" onclick="editOutgoingOrder( ' + item.id + ')">'
            + '<i class="fa fa-pencil" aria-hidden="true"></i>'
            + '</a>' + '</td>'
            + '<td class="text-center"><a href="#" onclick="delOutgoingOrder( ' + item.id + ')">'
            + '<i class="fa fa-trash-o fa-lg red"></i>'
            + '</a>' + '</td>'
            + '</tr>';

        $('#all-outgoing-tab').append(stringTab);
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

/**
 * посик по таблицам на страницах
 */
function searchFunction() {
    // определяем страницу, на которой отрабатывает поиск
    let controller = location.pathname;
    $.ajax({
        type: "post",
        url: controller + '/search',
        data: {
            search: $("#search-table").val(),
        },
        cache: false,
        error: function (data) {
            console.log(data);
            console.log("Ошибка поиска");
        },
        success: function(data){
            console.log("Успешный поиск - " + data);
            if($("#search-table").val() != ''){
                $('#pagination').hide();
            } else {
                $('#pagination').show();
            }
            // если страница на которой отрабаывает поиск - Контрагенты,
            if(controller == "/counterparty") {
                // то обновляем таблицу контрагентов
                updateCounterpartyList(data.data);

            // если страница Товары
            } else if(controller == "/products"){
                // то обновляем таблицу товаров
                updateProductsList(data.data);

            // если страница приходных накладных
            } else if(controller == "/incoming-payment-order"){
                // то обновляем таблицу приходных накладных
                updateIncomingList(data.data);

            // если страница расходных накладных
            } else if (controller == "/outgoing-payment-order"){
                // то обновляем таблицу расходных накладных
                updateOutgoingList(data.data);
            }
        }
    });
}

function getSearchFunction() {
    $.ajax({
        type: "get",
        url: '/storage/search',
        data: {
            search: $("#search-table").val(),
        },
        cache: false,
        error: function (data) {
            console.log(data);
            console.log("Ошибка поиска");
        },
        success: function(data){
            console.log("Успешный поиск - " + data);
            updateProductsList(data.products.data);
            $("#pagin").appendTo(data.render);
        }
    });
}

/**
 * Выбор компаниив настройках
 * @param id
 */
function setCompany(id)
{
    $.ajax({
        type: "POST",
        url: "/setting/company/set",
        data: { id: id },
        error: function (data) {
            console.log(data);
            alert('Ошибка выбора компании!');
        },
        success: function (data) {
            console.log('Компания изменена');
        }
    });
}

/**
 * Построение графика
 */
function setChart(title, subtitle, yAxis, data)
{
    Highcharts.chart('container', {

        title: {
            text: title
        },

        subtitle: {
            text: subtitle
        },

        yAxis: {
            title: {
                text: 'Цена'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },

        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 1
            }
        },

        series: [data, /*{
            name: 'Manufacturing',
            data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
        }, {
            name: 'Sales & Distribution',
            data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
        }, {
            name: 'Project Development',
            data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
        }, {
            name: 'Other',
            data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
        }*/],

        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }

    });
}

// Добавляет форму для добавления информации о компании
function addCompany()
{
    // проверяет есть ли на странице уже открытаю форма добавления компании
    if($("#new_comp").length > 0){
        return alert("Для добавления новой компании сохраните изменения!");
    }
    let str = "<div id='new_comp' class='col-md-6 company-block'>" +
    "                                        <div class='col-md-12 company-item company-item-new'>" +
    "                                            <div class='row'>" +
    "                                                <div class='col-md-8 col-xs-8 descripton-company'>" +
    "                                                    <div class='row'>" +
    "                                                        <div class='col-md-12'>" +
    "                                                            <h2><input id='company-name' placeholder='Наименование компании'></h2>" +
    "                                                        </div>" +
    "                                                    </div>" +
    "                                                </div>" +
    "                                                <div class='col-md-4 col-xs-4 company-logo'>" +
    "                                                    <h2>" +
    "                                                    <img src='../../img/company-logo/company1.png' alt=''>" +
    "                                                    </h2>" +
    "                                                </div>" +
    "                                                <div class='col-md-12'>" +
    "                                                    <div class='row'>" +
    "                                                        <div class='col-md-12'>" +
    "                                                            <input id='company-full-name' class='bold uppercase company-full-name' type='text' value='' placeholder='Полное наименование  '>" +
    "                                                        </div>" +
    "                                                    </div>" +
    "                                                    <div class='row'>" +
    "                                                        <div class='col-md-12'>" +
    "                                                            <label for='version' class='bold'>ОКПО:</label>" +
    "                                                            <input id='company-okpo' type='text' value='14457036'>" +
    "                                                        </div>" +
    "                                                    </div>" +
    "                                                    <div class='row'>" +
    "                                                        <div class='col-md-12'>" +
    "                                                            <label for='company-acc' class='bold'>Р.С.:</label>" +
    "                                                            <input id='company-acc' type='text' value='26005040677843'>" +
    "                                                        </div>" +
    "                                                    </div>" +
    "                                                    <div class='row'>" +
    "                                                        <div class='col-md-12'>" +
    "                                                            <label for='company_adress' class='bold'>Ардрес юридический:</label>" +
    "                                                            <input id='company_adress' type='text' value='г.Днепр, ул.Набережная Победы, 32'>" +
    "                                                        </div>" +
    "                                                    </div>" +
    "                                                    <div class='row'>" +
    "                                                        <div class='col-md-12'>" +
    "                                                            <label for='company-tel' class='bold'>Контакты:</label>" +
    "                                                            <input id='company-tel' type='text' value='+380930121000'>" +
    "                                                        </div>" +
    "                                                    </div>" +
    "                                                </div>" +
    "                                                <div class='col-md-12 control-block'>\n" +
    "                                                    <button type='button' class='btn btn-oval btn-success' onclick='setCompany(1)'>Выбрать</button>" +
    "                                                    <span><span class='center save-company' onclick='saveCompany()'><i class='fa fa-floppy-o'></i> Сохранить</span></span>" +
    "                                                    <button type='button' class='btn btn-oval btn-danger'>Удалить</button>" +
    "                                                </div> \n" +
    "                                            </div>\n" +
    "                                        </div>\n" +
    "                                    </div>";
    $("#company .all-company-block").prepend(str);
}

/**
 * сохраняет изменения по компании
 */
function saveCompany() {
    /*if($("#new_comp").length > 0){
        $("#new_comp").find(".company-item").removeAttr('style');
        $("#new_comp").removeAttr('id');
    }*/
    let data = {
        company_name: $("#company-name").val(),
        company_full_name: $("#company-full-name").val(),
        company_okpo: $("#company-okpo").val(),
        company_acc: $("#company-acc").val(),
        company_adress: $("#company_adress").val(),
        company_tel: $("#company-tel").val(),
    };
    $.ajax({
       type: "POST",
       url: '/setting/company/save',
       data: data,
       error: function (data) {
           alert('Ошибка при сохранении компании');
       },
        success: function (data) {
            if($("#new_comp").length > 0){
                $("#new_comp").find(".company-item").removeAttr('style');
                $("#new_comp").removeAttr('id');
            }
        }
    });
}

function delRelCompany(id) {
    $.ajax({
        type: "POST",
        url: "/users/del-relation-company",
        data: {id:id},
        error: function (data) {
            alert("Ошибка при удалении компании!");
        },
        success: function (data) {
            if (data == 0) {
                console.log(data);
                $("div[data-companyid=" + id + "]").remove();
                alert("Компания успешно удалена");
            } else {
                alert(data);
            }
        }
    });
}

// Открытие модального окна в настройках, оповещение для выбора предприятия
$(document).ready(function() {
    // console.log(1);
    if($("#mes").length > 0) {
        $("#modal").modal('show');
    }

    // Modal opens
// document.body.classList.add('modal-open');

// Modal closes
// document.body.classList.remove('modal-closed');
});


/**
 * Открытие модального окна в товарах через VUE
 */
let product = new Vue({
  el: '.container',
  data: {
      modalShow: false,
      name: '',
      code: '',
      quantity: '',
      price: '',
  },
  methods: {
      showItem: function (id) {
          $than = this;
          axios.post('/products/edit-product', {
              id: id,
          }).then(function (response) {
              $than.name = response.data.product_info.name;
              $than.code = response.data.product_info.code;
              $than.quantity = response.data.product_info.quantity;
              $than.price = response.data.product_info.price;

              console.log('Удачный ответ: ');
              console.log(response.data);
          })
              .catch(function (error) {
                  console.log("Ошибка: ");
                  console.log(error);
              });

          return this.modalShow = true;
      },
  },
});

/**
 * Просмотр товара через VUE
 */

