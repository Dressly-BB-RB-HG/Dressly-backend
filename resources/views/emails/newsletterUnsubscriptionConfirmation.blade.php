<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leiratkozás Sikeres!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        .section {
            margin-bottom: 30px;
        }
        .section p {
            font-size: 14px;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Leiratkozás Sikeres, {{ $name }}!</h1>

        <div class="section">
            <p>Kedves {{ $name }}!</p>
            <p>Örömmel értesítünk, hogy sikeresen leiratkoztál hírlevelünkről.</p>
            <p>Ha meggondolnád magad, bármikor újra feliratkozhatsz a hírlevelünkre.</p>
        </div>

        <div class="footer">
            <p>Üdvözlettel,<br>A Dressly csapata</p>
        </div>
    </div>
</body>
</html>
