<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Shoes;
use OpenApi\Annotations as OA;

/**
 * Class ShoesController.
 * 
 * @author Steven <steven.422024020@civitas.ukrida.ac.id>
 */

class ShoesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/shoes",
     *     tags={"shoes"},
     *     summary="Display a listing of items",
     *     operationId="shoesIndex",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent()
     *     )
     * )
     */

    public function index()
    {
        $shoes = Shoes::all();
        return response()->json(array('message'=>'Data retrieved successfully', 'data'=>$book), 200);
    }

    /**
    * @OA\Post(
    *      path="/api/shoes",
    *      tags={"shoes"},
    *      summary="Store a newly created item",
    *      operationId="store",
    *      @OA\Response(
    *          response=400,
    *          description="Invalid input",
    *          @OA\JsonContent()
    *      ),
    *      @OA\Response(
    *          response=201,
    *          description="Successful",
    *          @OA\JsonContent()
    *      ),
    *      @OA\RequestBody(
    *          required=true,
    *          description="Request body description",
    *          @OA\JsonContent(
    *              ref="#/components/schemas/Shoes",
    *              example={
    *                  "title": "Eating Clean", 
    *                  "author": "Inge Tumiwa-Bachrens",
    *                  "publisher": "Kawan Pustaka", 
    *                  "publication_year": "2016",
    *                  "cover": "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/14821700551/33511107.jpg",
    *                  "description": "Menjadi sehat adalah impian semua orang. Makanan yang selama ini kita pikir sehat ternyata belum tentu 'sehat' bagi tubuh kita.",
    *                  "price": 85000
    *         }
    *     )
    * )
    * )
    */

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

    /**
     * @OA\Get(
     *     path="/api/shoes/{id}",
     *     tags={"shoes"},
     *     summary="Display the specified item",
     *     operationId="show",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be displayed",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */

    public function show($id)
    {
        $shoes = Shoes::findOrFail($id);
        return response()->json(array('message'=>'Data detail retrieved successfully', 'data'=>$shoes), 200);
    }

    /**
     * @OA\Put(
     *     path="/api/shoes/{id}",
     *     tags={"shoes"},
     *     summary="Update the specified item",
     *     operationId="update",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be updated",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Request body description",
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Shoes",
     *             example={
     *                 "title": "Eating Clean",
     *                 "author": "Inge Tumiwa-Bachrens",
     *                 "publisher": "Kawan Pustaka",
     *                 "publication_year": "2016",
     *                 "cover": "https://images-na.ssl-images-amazon.com/images/S/compressed.photo.goodreads.com/books/14821700551/33511107.jpg",
     *                 "description": "Menjadi sehat adalah impian semua orang. Makanan yang selama ini kita pikir sehat ternyata belum tentu 'sehat' bagi tubuh kita.",
     *                 "price": 85000
     *             }
     *         )
     *     )
     * )
     */

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

    /**
     * @OA\Delete(
     *     path="/api/shoes/{id}",
     *     tags={"shoes"},
     *     summary="Remove the specified item",
     *     operationId="destroy",
     *     @OA\Response(
     *         response=404,
     *         description="Item not found",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=409,
     *         description="Invalid input",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Successful",
     *         @OA\JsonContent()
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of item that needs to be removed",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     )
     * )
     */

    public function destroy($id)
    {
        $shoes = Shoes::findOrFail($id);
        $shoes->delete();

        return response()->json(array('message'=>'Deleted successfully', 'data'=>$shoes), 204);
    }
}
