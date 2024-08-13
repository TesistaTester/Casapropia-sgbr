<!DOCTYPE html>
<html>
<head>
    <title>Casa Propia</title>
</head>
<body>
    <h3>
        Hola {{$nombreCompleto}}, la contraseña de tu cuenta de usuario ha sido reestablecida por vía administrativa.<br>
        Ingresa al sistema con el siguiente usuario y contraseña.
    </h3>
    <p>USUARIO: <b>{{$email}}</b></p>
    <p>CONTRASEÑA: <b>{{$password}}</b></p>
    <p>NOTA IMPORTANTE: Las contraseñas tienen 60 dias para expirar. Recuerda renovarlo desde tu perfil periodicamente y no lo compartas con otros, los accesos son personales.</p>
    <p>QUE TENGAS BUEN DIA!</p>
</body>
</html>