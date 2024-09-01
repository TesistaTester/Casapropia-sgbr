<?php

use App\Http\Controllers\AdjuntoPropiedad;
use App\Http\Controllers\AdjuntoPropiedadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UrbanizacionController;
use App\Http\Controllers\ManzanoController;
use App\Http\Controllers\LoteController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\Propietario_realController;
use App\Http\Controllers\Propietario_legalController;
use App\Http\Controllers\AsignacionPrrController;
use App\Http\Controllers\AsignacionPleController;
use App\Http\Controllers\Modalidad_ventaController;
use App\Http\Controllers\EstadoPropiedadController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CaptchaTest;
use App\Http\Controllers\VentasController;
//storage
use Illuminate\Support\Facades\Storage;
//Mail
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\AdjuntoContrato;
//codigos QR
use SimpleSoftwareIO\QrCode\Facades\QrCode;

/*
--------------------------------------------------------------------------
RUTAS PUBLICAS - SITIO WEB
--------------------------------------------------------------------------
*/
//Paginas del sitio web
Route::resource('/', WebsiteController::class);

/*
--------------------------------------------------------------------------
RUTAS: AUTENTICACION
--------------------------------------------------------------------------
*/
//Formulario login de acceso
Route::get('/login', function () {
    return view('publico.admin.login', ['titulo'=>'Acceso']);
});


//Recuperar contraseña
Route::get('/reset_password', function () {
    return view('publico.admin.reset_password_validation', ['titulo'=>'Acceso']);
});

//Autenticacion
Route::get('/logout', [AuthController::class ,'logout']);
Route::post('/auth', [AuthController::class ,'autenticar']);
Route::post('/role_director', [AuthController::class ,'role_director']);

//Inicio
Route::get('/role_selector', [DashboardController::class ,'role_selector']);
Route::get('/inicio', [DashboardController::class ,'index']);

/*
----------------------------------------
* RUTAS: Urbanizaciones
----------------------------------------
*/
Route::post('/urbanizaciones/get_man_by_urb_json', [UrbanizacionController::class, 'get_manzanos_by_urbanizacion_json']);
Route::post('/urbanizaciones/{id}/store_plano_inicial', [UrbanizacionController::class, 'store_plano_inicial']);
Route::resource('/urbanizaciones', UrbanizacionController::class);

/*
----------------------------------------
* RUTAS: Ventas
----------------------------------------
*/
Route::resource('/ventas', VentasController::class);

/*
----------------------------------------
* RUTAS: Manzanos
----------------------------------------
*/
Route::post('/manzanos/get_lot_by_man_json_contratos', [ManzanoController::class, 'get_lotes_by_manzano_json_contratos']);
Route::post('/manzanos/get_lot_by_man_json', [ManzanoController::class, 'get_lotes_by_manzano_json']);
Route::get('/manzanos/nuevo/urb/{id}', [ManzanoController::class ,'nuevo_manzano_urbanizacion']);
Route::resource('/manzanos', ManzanoController::class);
/*
----------------------------------------
* RUTAS: Lotes
----------------------------------------
*/
Route::delete('/lotes/eliminar_adjunto/{id}', [AdjuntoPropiedadController::class ,'destroy']);
Route::get('/lotes/edit_adjunto/{id}', [AdjuntoPropiedadController::class ,'store_adjunto_propiedad']);
Route::post('/lotes/store_adjunto', [AdjuntoPropiedadController::class ,'store_adjunto_propiedad']);
Route::get('/lotes/{id}/nuevo_adjunto', [AdjuntoPropiedadController::class ,'nuevo_adjunto_propiedad']);
Route::post('/lotes/asignar_prr/{id}', [AsignacionPrrController::class ,'guardar_asignacion_propietario_real']);
Route::post('/lotes/editar_prr/{id}', [AsignacionPrrController::class ,'editar_asignacion_propietario_real']);
Route::post('/lotes/eliminar_apr/{id}', [AsignacionPrrController::class ,'eliminar_asignacion_propietario_real']);
Route::post('/lotes/asignar_ple/{id}', [AsignacionPleController::class ,'guardar_asignacion_propietario_legal']);
Route::post('/lotes/editar_ple/{id}', [AsignacionPleController::class ,'editar_asignacion_propietario_legal']);
Route::post('/lotes/eliminar_apl/{id}', [AsignacionPleController::class ,'eliminar_asignacion_propietario_legal']);
Route::get('/lotes/nuevo/urb/{id}', [LoteController::class ,'nuevo_lote_urbanizacion']);
Route::resource('/lotes', LoteController::class);

//Rutas para propietarios
Route::get('/propietarios', [PropietarioController::class ,'index']);
//propietarios reales
Route::post('propietarios_reales/valida_propietario', [Propietario_realController::class, 'valida_propietario']);
Route::resource('/propietarios_reales', Propietario_realController::class);
//propietarios legales
Route::post('propietarios_legales/valida_propietario', [Propietario_legalController::class, 'valida_propietario']);
Route::resource('/propietarios_legales', Propietario_legalController::class);

//modalidades de venta de propiedad
Route::get('/modalidades_venta/nuevo/lote/{id}', [Modalidad_ventaController::class ,'nueva_modalidad_venta']);
Route::resource('/modalidades_venta', Modalidad_ventaController::class);

//estados de la propiedad
Route::get('/estados/nuevo/lote/{id}', [EstadoPropiedadController::class ,'nuevo_estado']);
Route::resource('/estados', EstadoPropiedadController::class);

//clientes
Route::post('clientes/valida_persona', [ClienteController::class, 'valida_persona']);
Route::post('clientes/valida_cliente', [ClienteController::class, 'valida_cliente']);
Route::resource('clientes', ClienteController::class);

//departamentos
Route::post('departamentos/{id}/municipios', [DepartamentoController::class, 'get_municipios']);
Route::resource('departamentos', DepartamentoController::class);

//reservas
Route::get('reservas/{id}/devolucion', [ReservaController::class, 'devolucion']);
Route::get('reservas/{id}/imprimir_recibo', [ReservaController::class, 'imprimir_recibo']);
Route::post('reservas/{id}/ampliacion', [ReservaController::class, 'ampliacion']);
Route::post('reservas/{id}/registrar_descargo', [ReservaController::class, 'registrar_descargo']);
Route::post('reservas/{id}/devolucion', [ReservaController::class, 'devolucion']);
Route::resource('reservas', ReservaController::class);

//contratos
Route::resource('contratos', ContratoController::class);

//Rutas para cuentas de usuarios
Route::put('usuarios/update_password/{id}', [UsuarioController::class, 'update_password']);
Route::post('usuarios/resetear_password/{id}', [UsuarioController::class, 'resetear_password']);
Route::post('usuarios/valida_email', [UsuarioController::class, 'valida_email']);
Route::post('usuarios/valida_usuario', [UsuarioController::class, 'valida_usuario']);
Route::resource('usuarios', UsuarioController::class);


/*
---------------------------------------------------------------------------------------------------------------------
 */


//test sendmail
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from SGBR',
        'body' => 'Cuerpo del email'
    ];
   
    Mail::to('jsonspartan@hotmail.com')->send(new TestMail($details));
   
    dd("Email enviado.");
});


//Test Recaptcha Google
Route::get('gr', [CaptchaTest::class, 'index']);
Route::post('vgr', [CaptchaTest::class, 'validar']);

//Test qr code generator
Route::get('qrcode', function () {
    //El QrCode requiere habilitar extension=gd en php.ini
    return QrCode::size(300)->generate('http://www.google.com');
    // return QrCode::phoneNumber('77226426');
    // return QrCode::size(500)->email('jsonspartan@gmail.com', 'Welcome to Tutsmake!', 'This is !.');    
    //Requiere requiere Imagick
    // $image = QrCode::format('png')
    //                 ->merge('img/google-maps.png', 0.5, true)
    //                 ->size(500)->errorCorrection('H')
    //                 ->generate('A simple example of QR code!');
    // return response($image)->header('Content-type','image/png');    
});

//Test Google Cloud Storage
Route::get('/gcs', function () {
    $disk = Storage::disk('gcs');
    $disk->put('ejemplos/lista2.txt', "Saludando desde Google cloud storage");
    // $url = $disk->url('WebQEM-JUCSE04.pdf');
    // $url = $disk->temporaryUrl('WebQEM-JUCSE04.pdf', now()->addMinutes(3));
// $disk->setVisibility('WebQEM-JUCSE04.pdf', 'public');
    return "Hola GCS";
    // return 'Hello World: '.$url;
    // $disk->put('avatars/1', $fileContents);
    // $exists = $disk->exists('file.jpg');
    // $time = $disk->lastModified('file1.jpg');
    // $disk->copy('old/file1.jpg', 'new/file1.jpg');
    // $disk->move('old/file1.jpg', 'new/file1.jpg');
    // $url = $disk->url('folder/my_file.txt');
    // $url = $disk->temporaryUrl('folder/my_file.txt', now()->addMinutes(30));
    // $disk->setVisibility('folder/my_file.txt', 'public');
});
