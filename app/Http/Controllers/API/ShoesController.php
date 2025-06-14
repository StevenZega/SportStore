<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Shoes;

class ShoesController extends Controller
{
    public function index()
    {
        $shoes = Shoes::all();
        return response()->json(array('message'=>'Data retrieved successfully', 'data'=>$book), 200);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title'  =>  'required|unique:shoes',
                'author'  =>  'required|max:100',
            ]);
            if ($validator->fails()) {
                throw new HttpException(400, $validator->message()->first());
            }
            $shoes = new Shoes;
            $shoes->fill($request->all())->save();
            return response()->json(array('message'=>'Saved successfully', 'data'=>$shoes), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exceptiom->getMessage()}");
        }
    }

    public function show($id)
    {
        $shoes = Shoes::findOrFail($id);
        return response()->json(array('message'=>'Data detail retrieved successfully', 'data'=>$shoes), 200);
    }

    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }
        $shoes = Shoes::find($id);
        if(!$shoes){
            throw new HttpException(404, "Item not found");
        }

        try {
            $shoes->fill($request->all())->save();
            return response()->json(array('message'=>'Updated successfully', 'data'=>$shoes), 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exceptiom->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $shoes = Shoes::findOrFail($id);
        $shoes->delete();

        return response()->json(array('message'=>'Deleted successfully', 'data'=>$shoes), 204);
    }
}
