<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üdvözöljük a Dressly webshopban!</title>
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
        <h1>Üdvözöljük a Dressly Webshopban, {{ $name }}!</h1>

        <!-- Üdvözlő szöveg -->
        <div class="section">
            <p>Kedves {{ $name }}!</p>
            <p>Örömmel értesítünk, hogy a regisztrációd sikeresen megtörtént!</p>
            <p>Mostantól hozzáférhetsz az összes legújabb termékünkhöz, exkluzív ajánlatainkhoz, és vásárolhatsz a webshopunkban. Minden tőlünk telhetőt megteszünk annak érdekében, hogy a vásárlásod élmény legyen!</p>
        </div>

        <!-- Előnyök és tippek -->
        <div class="section">
            <h2>Miért válaszd a Dressly webshopot?</h2>
            <ul>
                <li>Széles választék a legújabb divat szerint</li>
                <li>Hozzáférés exkluzív ajánlatokhoz és kedvezményekhez</li>
                <li>Gyors szállítás és egyszerű visszaküldési lehetőségek</li>
            </ul>
        </div>

        <!-- Kapcsolat -->
        <div class="section">
            <p>Ha bármilyen kérdésed van a regisztrációval vagy vásárlásoddal kapcsolatban, kérjük, keresd fel ügyfélszolgálatunkat az alábbi elérhetőségeken:</p>
            <p>Email: <a href="mailto:support@dressly.hu">support@dressly.hu</a></p>
        </div>

        <div class="footer">
            <p>Viszontlátásra és köszönjük, hogy minket választottál!</p>
            <p>Üdvözlettel,<br>A Dressly csapata</p>
        </div>
    </div>
</body>
</html>
