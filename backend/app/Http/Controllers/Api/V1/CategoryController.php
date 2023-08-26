<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoryResource;
use App\Models\Category;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:80'
        ]);

        if($validator->fails()){
            return $this->error('Dado inválido', $validator->errors(), 422);
        }

        $created = null;

        try {
            $created = Category::create($validator->validated());
        } catch (\Throwable $th) {
            return $this->error($th->getMessage(), [], 500);
        }

        if(!$created){
            return $this->error('Algo de errado ocorreu', [], 400);
        }

        return $this->response('Cadastrado com sucesso!', 200, new CategoryResource($created));
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
