<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::with("produit")->get();
        return response()->json(["status"=>"success","information"=>$categories]);
    }

    
    public function store(Request $request)
    {
        try {
            $validator= Validator::make($request->json()->all(),[
                "nom"=>"required|unique:categorie,nom",
                "icone"=> "required|max:20",
            ],[
                "nom.unique"=> "ce nom existe deja",
            ]);
            $validator->validate();
            $categorie = new Categorie();
            $categorie->nom =  $request->json("nom");
            $categorie->icone =  $request->json("icone");
            $categorie->save();
            //ajout d'un Log
            Log::info("la categorie $categorie->nom a ete ajouté");
            return response()->json(["status"=>"success","information"=>$categorie]);

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
            $categorie = Categorie::findOrFail($id)->with("produit");
               // $categorie = Categories::where("id", $id)
    
                return response()->json($categorie, 200);
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
            
            $categorie = Categorie::findOrfail($id);
            $categorie->nom =  $request->json("nom");
            $categorie->icone =  $request->json("icone", 200);
            $categorie->save();
    
            return response()->json($categorie, 200);
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
            $categorie = Categorie::findOrfail($id);
            $categorie->delete();
            return response()->json("Categorie supprimée avec succès", 200);

        } catch (ValidationException $e) {
            return response()->json("Categorie supprimée avec succès", 200);
        }
       
    }
}








