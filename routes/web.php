<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/','Auth\LoginController@showLoginForm')->name('login');
Route::get('/', function(){
    return view('welcome');
});
Route::get('test', function() {
    return view('cliente.pdf');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function() {
    // Proveedor
    Route::get('/proveedor' , 'ProveedorController@index' )->name('proveedor.index')
    ->middleware('can:proveedor.index');
    Route::get('/proveedorcrear' , 'ProveedorController@registrar')->name('proveedor.registrar')
    ->middleware('can:proveedor.registrar');
    Route::post('/proveedorcrear','ProveedorController@create')->name('proveedor.crear')
    ->middleware('can:proveedor.registrar');
    Route::get('/proveedoractualizar/{id}' , 'ProveedorController@update')->name('proveedor.update')
    ->middleware('can:proveedor.update');
    Route::get('/proveedoreliminar/{id}','ProveedorController@delete')->name('proveedor.delete')
    ->middleware('can:proveedor.delete');
    Route::get('/proveedor/pdf', 'ProveedorController@pdf')->name('proveedor.pdf')->middleware('can:proveedor.pdf');

    // Usuarios
    Route::get('usuario','UsuarioController@index')->name('usuario.index')
    ->middleware('can:usuario.index');
    Route::get('/usuariocrear' , 'UsuarioController@registrar')->name('usuario.registrar')
    ->middleware('can:usuario.registrar');
    Route::post('/usuariocrear','UsuarioController@create')->name('usuario.crear')
    ->middleware('can:usuario.registrar');
    Route::get('usuario/{id}/edit', 'UsuarioController@edit')->name('usuario.edit')
        ->middleware('can:usuario.edit');
    Route::put('usuario/{id}', 'UsuarioController@update')->name('usuario.update')
    ->middleware('can:usuario.edit');
    Route::get('/usuarios/pdf', 'UsuarioController@pdf')->name('usuario.pdf')->middleware('can:usuario.pdf');


    //Roles
    Route::get('roles', 'RoleController@index')->name('roles.index')
        ->middleware('can:roles.index');
    Route::get('roles/create', 'RoleController@create')->name('roles.create')
    ->middleware('can:roles.create');
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
    ->middleware('can:roles.create');
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
        ->middleware('can:roles.edit');
    Route::get('roles/{role}/eliminar', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('can:roles.destroy');
    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('can:roles.edit');


    // Pedido Compra
    Route::get('/pedidocompra','PedidoCompraController@index')->name('pedidoCompras.index')
    ->middleware('can:pedidoCompras.index');
    Route::get('/pedidocompra/create' ,'PedidoCompraController@registrar')->name('pedidoCompras.registrar')
    ->middleware('can:pedidoCompras.registrar');
    Route::post('/pedidocompra','PedidoCompraController@create')->name('pedidoCompras.crear')
    ->middleware('can:pedidoCompras.registrar');
    Route::get('/pedidocompraactualizar/{id}' , 'PedidoCompraController@update')->name('pedidoCompras.actualizar')
    ->middleware('can:pedidoCompras.actualizar');
    Route::get('/pedidocompraeliminar/{id}','PedidoCompraController@delete')->name('pedidoCompras.eliminar')
    ->middleware('can:pedidoCompras.eliminar');

    // Libro diario
    Route::get('/librodiario', 'LibrodiarioController@index')->name('librodiario.index')
    ->middleware('can:librodiario.index');
    Route::get('/librodiariocrear', 'LibrodiarioController@registrar')->name('librodiario.registrar')
    ->middleware('can:librodiario.registrar');
    Route::post('/librodiariocrear', 'LibrodiarioController@create')->name('librodiario.crear')
    ->middleware('can:librodiario.registrar');
    Route::get('/librodiarioactualizar/{id}', 'LibrodiarioController@update')->name('librodiario.actualizar')
    ->middleware('can:librodiario.actualizar');
    Route::get('/librodiarioeliminar/{id}', 'LibrodiarioController@delete')->name('librodiario.eliminar')
    ->middleware('can:librodiario.eliminar');

    // Libro mayor
    Route::get('/libromayor', 'LibromayorController@index')->name('libromayor.index')
    ->middleware('can:libromayor.index');
    Route::get('/libromayorcrear', 'LibromayorController@registrar')->name('libromayor.registrar')
    ->middleware('can:libromayor.registrar');
    Route::post('/libromayorcrear', 'LibromayorController@create')->name('libromayor.crear')
    ->middleware('can:libromayor.registrar');
    Route::get('/libromayoractualizar/{id}', 'LibromayorController@update')->name('libromayor.actualizar')
    ->middleware('can:libromayor.actualizar');
    Route::get('/libromayoreliminar/{id}', 'LibromayorController@delete')->name('libromayor.eliminar')
    ->middleware('can:libromayor.eliminar');

    // Asiento
    Route::get('/asiento', 'AsientoController@index')->name('asiento.index')
    ->middleware('can:asiento.index');
    Route::get('/asiento/crear', 'AsientoController@registrar')->name('asiento.registrar')
    ->middleware('can:asiento.registrar');
    Route::post('/asiento', 'AsientoController@create')->name('asiento.crear')
    ->middleware('can:asiento.registrar');
    Route::get('/asientoactualizar/{id}', 'AsientoController@update')->name('asiento.actualizar')
    ->middleware('can:asiento.actualizar');
    Route::get('/asientoeliminar/{id}', 'AsientoController@delete')->name('asiento.eliminar')
    ->middleware('can:asiento.eliminar');

    // Factura Compras
    Route::get('/facturacompra', 'FacturaCompraController@index')->name('facturacompra.index')
    ->middleware('can:facturacompra.index');
    Route::get('/facturacompra/crear', 'FacturaCompraController@registrar')->name('facturacompra.registrar')
    ->middleware('can:facturacompra.registrar');

    Route::get('/imprimircompra/{id}','FacturaCompraController@imprimir')->name('facturacompra.pdf')
    ->middleware('can:facturacompra.pdf');

    Route::post('/facturacompra', 'FacturaCompraController@create')->name('facturacompra.crear')
    ->middleware('can:facturacompra.registrar');
    Route::get('/facturacompraeliminar/{id}', 'FacturaCompraController@delete')->name('facturacompra.eliminar')
    ->middleware('can:facturacompra.eliminar');
    // file:///C:/Users/HP/AppData/Local/Temp/Sprint%232.pdf
    // Pagos Compras
    Route::get('/pagocompra', 'PagosCompraController@index')->name('pagocompra.index')
    ->middleware('can:pagocompra.index');
    Route::get('/pagocompra/crear', 'PagosCompraController@registrar')->name('pagocompra.registrar')
    ->middleware('can:pagocompra.registrar');
    Route::post('/pagocompra', 'PagosCompraController@create')->name('pagocompra.crear')
    ->middleware('can:pagocompra.registrar');
    Route::get('/pagocompraeliminar/{id}', 'PagosCompraController@delete')->name('pagocompra.eliminar')
    ->middleware('can:pagocompra.eliminar');

    // Cliente
    Route::get('/cliente', 'ClienteController@index')->name('cliente.index')
    ->middleware('can:cliente.index');
    Route::get('/cliente/crear', 'ClienteController@registrar')->name('cliente.registrar')
    ->middleware('can:cliente.registrar');
    Route::post('/cliente', 'ClienteController@create')->name('cliente.crear')
    ->middleware('can:cliente.registrar');
    Route::get('/clienteactualizar/{id}', 'ClienteController@update')->name('cliente.actualizar')
    ->middleware('can:cliente.actualizar');
    Route::get('/clienteeliminar/{id}', 'ClienteController@delete')->name('cliente.eliminar')
    ->middleware('can:cliente.eliminar');
    Route::get('/clientes/pdf', 'ClienteController@pdf')->name('cliente.pdf')->middleware('can:cliente.pdf');

    // Pedido Venta
    Route::get('/pedidoventa', 'PedidoVentaController@index')->name('pedidoventa.index')
    ->middleware('can:pedidoventa.index');
    Route::get('/pedidoventa/crear', 'PedidoVentaController@registrar')->name('pedidoventa.registrar')
    ->middleware('can:pedidoventa.registrar');
    Route::get('pedidoventa/{id}','PedidoVentaController@mostrar')->name('pedidoventa.mostrar')
    ->middleware('can:pedidoventa.mostrar');
    Route::get('/pedidosventas/pdf', 'PedidoVentaController@pdf')->name('pedidoventa.pdf')->middleware('can:pedidoventa.pdf');

    Route::post('/pedidoventa', 'PedidoVentaController@create')->name('pedidoventa.crear')
    ->middleware('can:pedidoventa.registrar');
    // Route::get('/pedidoventaactualizar/{id}', 'PedidoVentaController@update')->name('pedidoventa.actualizar')
    // ->middleware('can:pedidoventa.actualizar');
    Route::get('/pedidoventaeliminar/{id}', 'PedidoVentaController@delete')->name('pedidoventa.eliminar')
    ->middleware('can:pedidoventa.eliminar');

    // Factura Venta
    Route::get('/facturaventa', 'FacturaVentaController@index')->name('facturaventa.index')
    ->middleware('can:facturaventa.index');
    Route::get('/facturaventa/crear', 'FacturaVentaController@registrar')->name('facturaventa.registrar')
    ->middleware('can:facturaventa.registrar');

    Route::get('/imprimir/{id}','FacturaVentaController@imprimir')->name('facturaventa.pdf')
    ->middleware('can:facturaventa.pdf');

    Route::post('/facturaventa', 'FacturaVentaController@create')->name('facturaventa.crear')
    ->middleware('can:facturaventa.registrar');

    Route::get('/facturaventaeliminar/{id}', 'FacturaVentaController@delete')->name('facturaventa.eliminar')
    ->middleware('can:facturaventa.eliminar');
    Route::get('/facturasventas/pdf', 'FacturaVentaController@pdf')->name('facturaventa.pdf')->middleware('can:facturaventa.pdf');

    // Pagos Ventas
    Route::get('/pagoventa', 'PagosVentaController@index')->name('pagoventa.index')
    ->middleware('can:pagoventa.index');
    Route::get('/pagoventa/crear', 'PagosVentaController@registrar')->name('pagoventa.registrar')
    ->middleware('can:pagoventa.registrar');
    Route::post('/pagoventa', 'PagosVentaController@create')->name('pagoventa.crear')
    ->middleware('can:pagoventa.registrar');
    Route::get('/pagoventaeliminar/{id}', 'PagosVentaController@delete')->name('pagoventa.eliminar')
    ->middleware('can:pagoventa.eliminar');

    Route::get('/bitacora', 'BitacoraController@index')->name('bitacora.index')
    ->middleware('can:bitacora.index');


    // Producto
    Route::get('/producto', 'ProductoController@index')->name('productos.index')
    ->middleware('can:productos.index');
    Route::get('/producto/crear', 'ProductoController@registrar')->name('productos.registrar')
    ->middleware('can:productos.registrar');
    Route::post('/producto', 'ProductoController@create')->name('productos.crear')
    ->middleware('can:productos.registrar');
    Route::get('/productoactualizar/{id}', 'ProductoController@update')->name('productos.actualizar')
    ->middleware('can:productos.actualizar');
    Route::get('/productoeliminar/{id}', 'ProductoController@delete')->name('productos.eliminar')
    ->middleware('can:productos.eliminar');


    // Presupuesto
    Route::get('/presupuesto', 'PresupuestoController@index')->name('presupuestos.index')
    ->middleware('can:presupuestos.index');
    Route::get('/presupuesto/crear', 'PresupuestoController@registrar')->name('presupuestos.registrar')
    ->middleware('can:presupuestos.registrar');
    Route::get('presupuesto/{id}','PresupuestoController@mostrar')->name('presupuestos.mostrar')
    ->middleware('can:presupuestos.mostrar');
    Route::post('/presupuesto', 'PresupuestoController@create')->name('presupuestos.crear')
    ->middleware('can:presupuestos.registrar');
    // Route::get('/presupuestoactualizar/{id}', 'PresupuestoController@update')->name('presupuestos.actualizar')
    // ->middleware('can:presupuestos.actualizar');
    Route::get('/presupuestoeliminar/{id}', 'PresupuestoController@delete')->name('presupuestos.eliminar')
    ->middleware('can:presupuestos.eliminar');
    Route::get('presupuestopdf/{presupuesto}', 'PresupuestoController@pdf')->name('detallepresupuesto')
    ->middleware('can:detallepresupuesto');
    
});
