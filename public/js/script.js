$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    loadTableData();

    $('#productForm').submit(function (event) {
        event.preventDefault();
        $('#loader').show();

        let formData = {
            product_name: $('#productName').val(),
            quantity_in_stock: parseInt($('#quantity').val()),
            price_per_item: parseFloat($('#price').val())
        };

        $.post('/store', formData, function (data) {
            $('#productForm')[0].reset(); 
            loadTableData();
        }).always(function () {
            $('#loader').hide();
        });
    });

    function loadTableData() {
        $('#loader').show();

        $.getJSON('/load-data', function (data) {
            let tableBody = '';
            let grandTotal = 0;

            data.forEach(item => {
                tableBody += `<tr data-id="${item.id}">
                    <td contenteditable="true">${item.product_name}</td>
                    <td contenteditable="true">${item.quantity_in_stock}</td>
                    <td contenteditable="true">${item.price_per_item}</td>
                    <td>${item.datetime_submitted}</td>
                    <td>${item.total_value}</td>
                    <td><button class="btn btn-sm btn-primary save-btn">Update</button></td>
                </tr>`;
                grandTotal += parseFloat(item.total_value);
            });

            $('#productTableBody').html(tableBody);
            $('#grandTotal').text(grandTotal.toFixed(2));

            $('.save-btn').click(function () {
                const row = $(this).closest('tr');
                const id = row.data('id');

                const updatedData = {
                    product_name: row.find('td:eq(0)').text(),
                    quantity_in_stock: parseInt(row.find('td:eq(1)').text()),
                    price_per_item: parseFloat(row.find('td:eq(2)').text())
                };
                $('#loader').show();

                $.post(`/update/${id}`, updatedData, function () {
                    loadTableData();
                }).always(function () {
                    $('#loader').hide();
                });
            });
        }).always(function () {
            $('#loader').hide();
        });
    }
});
