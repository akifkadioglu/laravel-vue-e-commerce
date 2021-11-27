<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', "A'dan Z'ye Buldum") }}</title>
</head>

<body>
    <h1>Hoş Geldin {{$details->name}}</h1>
    <p>Alışveriş yapmak için aktivasyon kodunu çalıştırmanız gerekmektedir.</p>
    <p>aktivasyon kodunu aktifleştirmek için <a href="http://127.0.0.1:8000/api/editactivation/{{$details->activation_code}}">Tıklayınız</a> </p>
</body>

</html>
