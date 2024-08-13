=======
# SISTEMA DE GESTION DE BIENES RAICES CASA PROPIA
## Instalación

Crear la base de datos en PostgreSQL con el nombre especificado en la variable DB_DATABASE del archivo .env, luego ejecutar el comando:

```
php artisan migrate
```

Para rellenar datos iniciales:

```
php artisan db:seed
```

Para ejecutar el sistema en modo local:
```
php artisan serve
```

Para ejecutar el sistema en modo IP:
```
php artisan serve --host=192.168.1.7
```

Para enlazar el storage de los archivos, ejecutar el comando:
```
php artisan storage:link
```
Este comando debe ser ejecutado solamente si el enlace con el storage publico está roto.  

Para ejecutar el comando de notificaciones con tareas programadas
```
php artisan schedule:run
```

Modificar la frecuencia del comando (tarea programada) en el archivo app/console/kernel.php

Para revisar el listado de comandos en cola, y tambien verificar el tiempo

```
php artisan schedule:list
```
