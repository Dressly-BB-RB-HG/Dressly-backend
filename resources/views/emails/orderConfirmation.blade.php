<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendelés Visszaigazolás</title>
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
        h2 {
            color: #333;
        }
        .section {
            margin-bottom: 30px;
        }
        .section p {
            font-size: 14px;
            line-height: 1.6;
        }
        .order-summary {
            width: 100%;
            border-collapse: collapse;
        }
        .order-summary th, .order-summary td {
            border: 1px solid #ddd;
            padding: 8px 12px;
            text-align: left;
        }
        .order-summary th {
            background-color: #f2f2f2;
            color: #333;
        }
        .total {
            font-weight: bold;
            font-size: 16px;
            text-align: right;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #888;
        }
        .footer a {
            color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Rendelés Visszaigazolás</h1>

        <!-- Személyes adatok -->
        <div class="section">
            <h2>Személyes Adatok</h2>
            <p><strong>Teljes név:</strong> {{ $user->k_nev }} {{ $user->v_nev }}</p>
            <p><strong>Email cím:</strong> {{ $user->email }}</p>
            <p><strong>Szállítási cím: </strong></p>
            <p>{{ $user->varos }}, {{ $user->kerulet }} {{ $user->utca }} {{ $user->hazszam }}</p>
        </div>

        <!-- Kosár tartalom -->
        <div class="section">
            <h2>Rendelés Tartalma</h2>
            <table class="order-summary">
                <thead>
                    <tr>
                        <th>Termék</th>
                        <th>Mennyiség</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kosar as $item)
                        <tr>
                            <td>{{ $item->termek }}</td>
                            <td>{{ $item->mennyiseg }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Összesítés -->
        <div class="section">
            <p class="total">A rendelés teljes összege:  Ft</p>
        </div>

        <div class="footer">
            <p>Ha kérdése van a rendelésével kapcsolatban, kérjük, lépjen kapcsolatba ügyfélszolgálatunkkal.</p>
            <p>Viszontlátásra és köszönjük, hogy nálunk vásárolt!</p>
        </div>
    </div>
</body>
</html>
