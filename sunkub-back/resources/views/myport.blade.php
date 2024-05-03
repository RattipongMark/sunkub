<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Port Information</h1>
    <p>User Broker: {{ $port->user_broker }}</p>
    <p>Password: {{ $port->password }}</p>

    <h1>User Information</h1>
    <p>First Name: {{ $user->fname }}</p>
    <p>Last Name: {{ $user->lname }}</p>
    <p>Email: {{ $user->email }}</p>
</body>
</html>