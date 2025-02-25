<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Request Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: #ff9900;
            color: #ffffff;
            text-align: center;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            font-size: 16px;
            line-height: 1.5;
            color: #333;
        }
        .footer {
            text-align: center;
            padding: 15px;
            font-size: 14px;
            color: #777;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 15px;
            background: #ff9900;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">New Shop Request</div>
        <div class="content">
            <p>Hello Admin,</p>
            <p>You have received a new shop request from <strong>{{ $data['name'] }}</strong>.</p>
            <p><strong>Shop Name:</strong> {{ $data['shop_name'] }}</p>
            <p><strong>Contact:</strong> {{ $data['contact'] }}</p>
            <p><strong>Address:</strong> {{ $data['address'] }}</p>
            <p>Please review the request and take necessary action.</p>
            <a href="{{ $data['review_link'] }}" class="button">Review Request</a>
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} CODE IT | All rights reserved.
        </div>
    </div>
</body>
</html>
