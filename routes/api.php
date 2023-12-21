<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//routes categorie
    Route::get("categorie", [CategorieController::class, "show"]);
    Route::put("categorie/{id}", [CategorieController::class, "update"]);
    Route::post("categorie", [CategorieController::class, "index"]);
    Route::get("categorie/{id}", [CategorieController::class, "store"]);
    Route::delete("categorie/{id}", [CategorieController::class, "destroy"]);

//route produit
    Route::get("produit", [ProduitController::class, "show"]);
    Route::put("produit/{id}", [ProduitController::class, "update"]);
    Route::post("produit", [ProduitController::class, "index"]);
    Route::get("produit/{id}", [ProduitController::class, "store"]);
    Route::delete("produit/{id}", [ProduitController::class, "destroy"]);
    
//route panier

Route::get("panier", [panierController::class, "show"]);
    Route::put("panier/{id}", [panierController::class, "update"]);
    Route::post("panier", [panierController::class, "index"]);
    Route::get("panier/{id}", [panierController::class, "store"]);
    Route::delete("panier/{id}", [panierController::class, "destroy"]);


