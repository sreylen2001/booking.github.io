<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body style="margin: 100px">
    <h1>You have requested to reset your password.</h1>
    <br>
    <p>We can not simply send your old password. A unique link to reset your password 
        has been generated for you. To reset your password, click on following link 
        and follow the instructions.
    </p>
    
    <h1 style="padding: 10px;"> 
        <a href="http://127.0.0.1:8000/api/reset-password/{{$token}}">Click here to reset password.</a>
    </h1>
    <p><br>iBooking,</p>
    <p><br>Best regard,</p>
</body>
</html>