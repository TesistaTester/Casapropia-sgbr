<!DOCTYPE html>
<html>
<head>
    <title>Casa Propia</title>
</head>
<body>
    <h3>
        Bienvenid@ {{$nombreCompleto}}, tu cuenta de usuario ha sido creada exitosamente. <br>
        Ingresa al sistema con el siguiente usuario y contraseña.
    </h3>
    <p>USUARIO: <b>{{$email}}</b></p>
    <p>CONTRASEÑA: <b>{{$password}}</b></p>
    <p>NOTA IMPORTANTE: La contraseña actual tiene una vigencia de 10 días. Te recomendamos renovarlo en tu primer ingreso y no compartirlo con otros, los accesos son personales.</p>
    <p>EXITOS!</p>
</body>
</html>