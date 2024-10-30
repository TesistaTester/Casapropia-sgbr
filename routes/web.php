<?php

use App\Http\Controllers\AdjuntoPropiedad;
use App\Http\Controllers\AdjuntoPropiedadController;
use App\Http\Controllers\AdjuntoUrbanizacion;
use App\Http\Controllers\AdjuntoUrbanizacionController;
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
})->name('login');


//Recuperar contraseña
Route::get('/reset_password', function () {
    return view('publico.admin.reset_password_validation', ['titulo'=>'Acceso']);
});

//Autenticacion
Route::get('/logout', [AuthController::class ,'logout']);
Route::post('/auth', [AuthController::class ,'autenticar']);
Route::post('/role_director', [AuthController::class ,'role_director'])->middleware('auth');
Route::get('/role_selector', [DashboardController::class ,'role_selector'])->middleware('auth');

//Inicio
Route::get('/inicio', [DashboardController::class ,'index'])->middleware('auth');

/*
----------------------------------------
* RUTAS: Urbanizaciones
----------------------------------------
*/
Route::delete('/urbanizaciones/eliminar_adjunto/{id}', [AdjuntoUrbanizacionController::class ,'destroy'])->middleware('auth');
Route::get('/urbanizaciones/edit_adjunto/{id}', [AdjuntoUrbanizacionController::class ,'store_adjunto_urbanizacion'])->middleware('auth');
Route::post('/urbanizaciones/store_adjunto', [AdjuntoUrbanizacionController::class ,'store_adjunto_urbanizacion'])->middleware('auth');
Route::get('/urbanizaciones/{id}/nuevo_adjunto', [AdjuntoUrbanizacionController::class ,'nuevo_adjunto_urbanizacion'])->middleware('auth');
Route::post('/urbanizaciones/get_man_by_urb_json', [UrbanizacionController::class, 'get_manzanos_by_urbanizacion_json'])->middleware('auth');
Route::post('/urbanizaciones/{id}/store_plano_inicial', [UrbanizacionController::class, 'store_plano_inicial'])->middleware('auth');
Route::resource('/urbanizaciones', UrbanizacionController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: Ventas
----------------------------------------
*/
Route::resource('/ventas', VentasController::class)->middleware('auth');

/*
----------------------------------------
* RUTAS: Manzanos
----------------------------------------
*/
Route::post('/manzanos/get_lot_by_man_json_contratos', [ManzanoController::class, 'get_lotes_by_manzano_json_contratos'])->middleware('auth');
Route::post('/manzanos/get_lot_by_man_json', [ManzanoController::class, 'get_lotes_by_manzano_json'])->middleware('auth');
Route::get('/manzanos/nuevo/urb/{id}', [ManzanoController::class ,'nuevo_manzano_urbanizacion'])->middleware('auth');
Route::resource('/manzanos', ManzanoController::class)->middleware('auth');
/*
----------------------------------------
* RUTAS: Lotes
----------------------------------------
*/
Route::delete('/lotes/eliminar_adjunto/{id}', [AdjuntoPropiedadController::class ,'destroy'])->middleware('auth');
Route::get('/lotes/edit_adjunto/{id}', [AdjuntoPropiedadController::class ,'store_adjunto_propiedad'])->middleware('auth');
Route::post('/lotes/store_adjunto', [AdjuntoPropiedadController::class ,'store_adjunto_propiedad'])->middleware('auth');
Route::get('/lotes/{id}/nuevo_adjunto', [AdjuntoPropiedadController::class ,'nuevo_adjunto_propiedad'])->middleware('auth');
Route::post('/lotes/asignar_prr/{id}', [AsignacionPrrController::class ,'guardar_asignacion_propietario_real'])->middleware('auth');
Route::post('/lotes/editar_prr/{id}', [AsignacionPrrController::class ,'editar_asignacion_propietario_real'])->middleware('auth');
Route::post('/lotes/eliminar_apr/{id}', [AsignacionPrrController::class ,'eliminar_asignacion_propietario_real'])->middleware('auth');
Route::post('/lotes/asignar_ple/{id}', [AsignacionPleController::class ,'guardar_asignacion_propietario_legal'])->middleware('auth');
Route::post('/lotes/editar_ple/{id}', [AsignacionPleController::class ,'editar_asignacion_propietario_legal'])->middleware('auth');
Route::post('/lotes/eliminar_apl/{id}', [AsignacionPleController::class ,'eliminar_asignacion_propietario_legal'])->middleware('auth');
Route::get('/lotes/nuevo/urb/{id}', [LoteController::class ,'nuevo_lote_urbanizacion'])->middleware('auth');
Route::resource('/lotes', LoteController::class)->middleware('auth');

//Rutas para propietarios
Route::get('/propietarios', [PropietarioController::class ,'index'])->middleware('auth');
//propietarios reales
Route::post('propietarios_reales/valida_propietario', [Propietario_realController::class, 'valida_propietario'])->middleware('auth');
Route::resource('/propietarios_reales', Propietario_realController::class)->middleware('auth');
//propietarios legales
Route::post('propietarios_legales/valida_propietario', [Propietario_legalController::class, 'valida_propietario'])->middleware('auth');
Route::resource('/propietarios_legales', Propietario_legalController::class)->middleware('auth');

//modalidades de venta de propiedad
Route::get('/modalidades_venta/nuevo/lote/{id}', [Modalidad_ventaController::class ,'nueva_modalidad_venta'])->middleware('auth');
Route::resource('/modalidades_venta', Modalidad_ventaController::class)->middleware('auth');

//estados de la propiedad
Route::get('/estados/nuevo/lote/{id}', [EstadoPropiedadController::class ,'nuevo_estado'])->middleware('auth');
Route::resource('/estados', EstadoPropiedadController::class)->middleware('auth');

//clientes
Route::post('clientes/valida_persona', [ClienteController::class, 'valida_persona'])->middleware('auth');
Route::post('clientes/valida_cliente', [ClienteController::class, 'valida_cliente'])->middleware('auth');
Route::resource('clientes', ClienteController::class)->middleware('auth');

//departamentos
Route::post('departamentos/{id}/municipios', [DepartamentoController::class, 'get_municipios'])->middleware('auth');
Route::resource('departamentos', DepartamentoController::class)->middleware('auth');

//reservas
Route::get('reservas/{id}/devolucion', [ReservaController::class, 'devolucion'])->middleware('auth');
Route::get('reservas/{id}/imprimir_recibo', [ReservaController::class, 'imprimir_recibo'])->middleware('auth');
Route::post('reservas/{id}/ampliacion', [ReservaController::class, 'ampliacion'])->middleware('auth');
Route::post('reservas/{id}/registrar_descargo', [ReservaController::class, 'registrar_descargo'])->middleware('auth');
Route::post('reservas/{id}/devolucion', [ReservaController::class, 'devolucion'])->middleware('auth');
Route::resource('reservas', ReservaController::class);

//contratos
Route::post('contratos/{id}/store_adjunto', [ContratoController::class, 'store_adjunto'])->middleware('auth');
Route::get('contratos/{id}/nuevo_adjunto', [ContratoController::class, 'nuevo_adjunto'])->middleware('auth');
Route::get('contratos/{id}/adjuntos', [ContratoController::class, 'adjuntos'])->middleware('auth');
Route::get('contratos/{id}/plan_pago', [ContratoController::class, 'plan_pago'])->middleware('auth');
Route::get('contratos/{id}/redaccion', [ContratoController::class, 'redaccion'])->middleware('auth');
Route::resource('contratos', ContratoController::class)->middleware('auth');

//Rutas para cuentas de usuarios
Route::put('usuarios/update_password/{id}', [UsuarioController::class, 'update_password'])->middleware('auth');
Route::post('usuarios/resetear_password/{id}', [UsuarioController::class, 'resetear_password'])->middleware('auth');
Route::post('usuarios/valida_email', [UsuarioController::class, 'valida_email'])->middleware('auth');
Route::post('usuarios/valida_usuario', [UsuarioController::class, 'valida_usuario'])->middleware('auth');
Route::resource('usuarios', UsuarioController::class)->middleware('auth');


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
