<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndicateurController;
use App\Http\Controllers\MesureController;





// Page d'accueil : redirige vers dashboard ou login
Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Pages accessibles publiquement
Route::get('/statistiques', fn() => view('statistiques.dashboard'))->name('statistiques');
Route::get('/activites', fn() => view('activites.index1'))->name('activites');



// Page des activites

Route::get('/structures', function () {
    return view('activites.structures');
});

Route::get('/structures', function () {
    return view('activites.structures');
});

Route::get('/taches', function () {
    return view('activites.taches');
});

Route::get('/rapports2', function () {
    return view('activites.rapport2');
});

// Routes accessibles uniquement aux utilisateurs authentifiés
Route::middleware('auth')->group(function () {

    Route::middleware(['auth'])->group(function () {
        // Route nommée 'interface1' pour les vues existantes
        Route::get('/interface1', fn() => view('interface1'))->name('interface1');
    
        // Route nommée 'dashboard' utilisée lors de la redirection à l'accueil
        Route::get('/dashboard', fn() => redirect()->route('interface1'))->name('dashboard');
    });

    
    // Statistiques > sous-pages
    Route::get('/mesures', [MesureController::class, 'index'])->name('mesures');
    Route::get('/zones', fn() => view('statistiques.zones'))->name('zones');
    Route::get('/rapports', fn() => view('statistiques.rapports'))->name('rapports');
    Route::get('/alertes', fn() => view('statistiques.alertes'))->name('alertes');
    Route::get('/indicateurs', [IndicateurController::class, 'index'])->name('indicateurs.index');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/administration', [AdminController::class, 'administration'])->name('administration');
    });

    // Profil utilisateur
    Route::get('/profil', [UserController::class, 'show'])->name('profile.show');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes Admin (gérées par un middleware auth ici)
    Route::prefix('admin')->middleware('auth')->group(function () {
        // Utilisateurs (avec noms explicites et cohérents)
        Route::get('/users', [UserController::class, 'index'])->name('admin.users');
        Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
        

        Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
            Route::resource('users', UserController::class);
            Route::get('users-export', [UserController::class, 'export'])->name('users.export');
        });

    

        // Autres pages admin
        Route::view('/sources', 'admin.sources')->name('admin.sources');
        Route::view('/categories', 'admin.categories')->name('admin.categories');
        Route::view('/config', 'admin.config')->name('admin.config');
        Route::view('/logs', 'admin.logs')->name('admin.logs');
    });
});

// Auth scaffolding (login, register, etc.)
require __DIR__.'/auth.php';


//route indicateur import et autres
Route::post('/indicateurs/import', [IndicateurController::class, 'import'])->name('indicateurs.import');
Route::post('/indicateurs', [IndicateurController::class, 'store'])->name('indicateurs.store');
Route::get('/indicateurs', [IndicateurController::class, 'index'])->name('indicateurs.index');
Route::get('/indicateurs/{id}/edit', [IndicateurController::class, 'edit'])->name('indicateurs.edit');
Route::post('/indicateurs/{id}/valider', [IndicateurController::class, 'valider'])->name('indicateurs.valider');
Route::resource('indicateurs', IndicateurController::class);

//route mesures import et autres
Route::post('/mesures/import', [MesureController::class, 'import'])->name('mesures.import');
Route::post('/mesures/indicateurs', [MesureController::class, 'storeIndicateur'])->name('mesures.indicateurs.store');
Route::post('/mesures/import', [MesureController::class, 'import'])->name('mesures.import');
Route::get('/mesures/{id}/edit', [MesureController::class, 'edit'])->name('mesures.edit');
Route::post('/mesures/{id}/valider', [MesureController::class, 'valider'])->name('mesures.valider');
Route::put('/mesures/{id}', [MesureController::class, 'update'])->name('mesures.update');






