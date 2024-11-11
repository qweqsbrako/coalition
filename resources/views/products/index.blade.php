<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Inventory</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<link rel="stylesheet" href="{{ asset('css/global.css') }}">

<body>
<div class="container mt-5">
    <h2 class="mb-4">Product Inventory Form</h2>
    <form id="productForm">
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control" id="productName" name="product_name" required>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity in Stock</label>
            <input type="number" class="form-control" id="quantity" name="quantity_in_stock" required>
        </div>
        <div class="form-group">
            <label for="price">Price per Item</label>
            <input type="number" class="form-control" id="price" name="price_per_item" required step="0.01">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <h3 class="mt-5">Submitted Data</h3>
    <p>NOTE: The <strong>Quantity in Stock</strong> and <strong>Price per Item</strong> are editable. After editing, click on save button to update the record.</p>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity in Stock</th>
                <th>Price per Item</th>
                <th>Date/Time Submitted</th>
                <th>Total Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
        </tbody>
    </table>
    <div><strong>Total of Total Values:</strong> <span id="grandTotal"></span></div>
</div>

<div id="loader" style="display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
    <p>Please wait...</p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
