<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

</head>
<body>
 <h3>Password Reset Email</h3>
 <a href="http://localhost:3000/reset/{{$data}}">Click here to reset you password</a>
 <h4>Code : {{$data}}</h4>
<p>If you didnt make this request, kindy ignore it.</p>
</body>
</html>
