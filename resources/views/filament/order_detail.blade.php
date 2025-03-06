<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Voucher #1</title>
    <style>
        .voucher {
            width: 600px;
            margin: 20px auto;
            border: 2px dashed #333;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .header {
            text-align: center;
            border-bottom: 1px solid #333;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
            margin-bottom: 20px;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="voucher">
        <div class="header">
            <h1>Order Voucher</h1>
            <h3>Order #1</h3>
        </div>

        <div class="details-grid">
            <div>
                <strong>Date:</strong> March 03, 2025 15:15:45<br>
                <strong>Status:</strong> Pending<br>
                <strong>Payment Method:</strong> Cash on Delivery
            </div>
            <div>
                <strong>Order ID:</strong> 1<br>
                <strong>Shop ID:</strong> 3<br>
                <strong>Customer ID:</strong> 1
            </div>
        </div>

        <table class="items-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample order descriptions -->
                <tr>
                    <td>Sample Product 1</td>
                    <td>2</td>
                    <td>$250.00</td>
                    <td>$500.00</td>
                </tr>
                <tr>
                    <td>Sample Product 2</td>
                    <td>1</td>
                    <td>$170.00</td>
                    <td>$170.00</td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            Total Amount: NRs.{{ $order->total_amount }}
        </div>
    </div>
</body>

</html>
