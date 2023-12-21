<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProduitController extends Controller
{
    public function index()
    {
        $produit = Produit::with("categorie")->get();
    }

    
    public function store(Request $request)
    {
        try {
            $validator= Validator::make($request->json()->all(),[
                "nom"=>"required|unique:produits,nom",
                "description"=> "required|max:20",
            ],[
                "nom.unique"=> "ce nom existe deja",
            ]);
            $validator->validate();
            $produit = new Produit();
            $produit->nom =  $request->json("nom");
            $produit->description =  $request->json("description");
            $produit->prix =  $request->json("prix");
            $produit->slug=  $request->json("slug");
            $produit->image=  $request->json("image");
            $produit->visible =  $request->json("visible");
            $produit->save();
            Log::info("le produit $produit->nom a ete ajouté");
            return response()->json($produit, 200);

        } catch (ValidationException $e) {
             //log::error($e->serialize($e->validator->errors() ));
             return response()->json($e->validator->errors());
            }
            catch (\Exception $e) {
                //Log::alert($e);
                return response()->json($e);
        }
    }

   
    public function show( $id)
    {
        try {
            $produit = Produit::findOrFail("id",$id)->with("categorie");
               // $categorie = Categories::where("id", $id)
    
                return response()->json($produit, 200);
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
            $produit = Produit::findOrfail($id);
            $produit->nom =  $request->json("nom");
            $produit->description =  $request->json("description", 200);
            $produit->prix=  $request->json("prix");
            $produit->slug =  $request->json("slug");
            $produit->image =  $request->json("image");
            $produit->visible =  $request->json("visible");
            $produit->save();
    
            return response()->json($produit, 200);
        } catch (ValidationException $e) {
            
            return response()->json($e->validator->errors());
        }
        catch (\Exception $e) {
           
            return response()->json("vous ne pouvez pas modifier cet element",404);
        }
    }

   
    public function destroy($id)
    {
        try {
            $produit = Produit::findOrfail($id);
            $produit->delete();
            return response()->json("produit supprimée avec succès", 200);

        } catch (ValidationException $e) {
            return response()->json("produit n'a pas pu etresupprimée avec succès", 200);
        }
       
    }
}


