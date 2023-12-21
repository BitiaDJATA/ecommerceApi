<?php

namespace App\Http\Controllers;

use App\Models\Panier;
use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class PanierController extends Controller
{
    public function index()
    {
        $panier = Panier::all();
        
    }

    
    public function store(Request $request)
    {
        try {
            $validator= Validator::make($request->json()->all(),[]);
            $validator->validate();
            $panier = new Panier();
            $panier->is_commande =  $request->json("is_command");
            $panier->etat_commande =  $request->json("etat_commande");
            $panier->prix =  $request->json("prix");
            $panier->quantite=  $request->json("quantite");
        
            $panier->save();
            Log::info("le panier a ete ajouté");
            return response()->json($panier, 200);

        } catch (ValidationException $e) {
             //log::error($e->serialize($e->validator->errors() ));
             return response()->json($e->validator->errors());
            }
            catch (\Exception $e) {
                //Log::alert($e);
                return response()->json($e);
        }
    }


    public function add(Request $request, $productId)
    {
        $produit = Produit::find($productId);

        if (!$produit) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $cart = $request->session()->get('cart', []);
        $cart[$productId] = [
            'name' => $produit->nom,
            'price' => $produit->prix,
            // Ajoutez d'autres informations du produit selon vos besoins
        ];
        $request->session()->put('cart', $cart);

        return response()->json(['message' => 'Product added to cart successfully']);
    }


    public function remove(Request $request, $produitId)
    {
        $cart = $request->session()->get('cart', []);

        if (array_key_exists($produitId, $cart)) {
            unset($cart[$produitId]);
            $request->session()->put('cart', $cart);

            return response()->json(['message' => 'Product removed from cart successfully']);
        } else {
            return response()->json(['error' => 'Product not found in the cart'], 404);
        }
    }


    public function total()
    {
        $panier = session()->get('panier', []);

        // Initialiser le prix total à zéro
        $total = 0;

        // Itérer sur les produits dans le panier
        foreach ($panier as $product) {
            $total += $product['prix']; // Ajoutez le prix du produit au total
        }

        return $total;
    }

   
    public function show( $id)
    {
        try {
            $panier = Panier::findOrFail("id",$id);
               // $categorie = Categories::where("id", $id)
    
                return response()->json($panier, 200);
            } catch (ValidationException $e) {
                
                return response()->json($e->validator->errors());
            }
            catch (\Exception $e) {
                
                return response()->json("aucune donnée n'a été retrouvée",404);
            }
    }

   
    public function update(Request $request,$id)
    {
        try {
            $panier = Panier::findOrfail($id);
            $panier->is_commande =  $request->json("is_command");
            $panier->etat_commande =  $request->json("etat_commande");
            $panier->prix =  $request->json("prix");
            $panier->quantite=  $request->json("quantite");
            $panier->save();
    
            return response()->json($panier, 200);
        } catch (ValidationException $e) {
            
            return response()->json($e->validator->errors());
        }
        catch (\Exception $e) {
           
            return response()->json("vous ne pouvez pas modifier cet element",404);
        }
    }
//diminuer et aug la qt
   
    public function destroy($id)
    {
        try {
            $panier = Panier::findOrfail($id);
            $panier->delete();
            return response()->json("ce panier a ete supprimée avec succès", 200);

        } catch (ValidationException $e) {
            return response()->json(" ce panier n'a pas pu etre supprimée ", 404);
        }
       
    }
}
