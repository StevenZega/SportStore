<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use App\Models\Shoes;
use OpenApi\Annotations as OA;

class ShoesController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/shoes",
     *     tags={"shoes"},
     *     summary="Display a listing of items",
     *     operationId="shoesIndex",
     *     @OA\Response(response=200, description="successful operation", @OA\JsonContent()),
     *     @OA\Parameter(name="_page", in="query", required=true, @OA\Schema(type="integer", example=1)),
     *     @OA\Parameter(name="_limit", in="query", required=true, @OA\Schema(type="integer", example=10)),
     *     @OA\Parameter(name="_search", in="query", required=false, @OA\Schema(type="string")),
     *     @OA\Parameter(name="_type", in="query", required=false, @OA\Schema(type="string")),
     *     @OA\Parameter(name="_sort_by", in="query", required=false, @OA\Schema(type="string", example="latest"))
     * )
     */
    public function index(Request $request)
    {
        try {
            $data['filter'] = $request->all();
            $page = @$data['filter']['_page'] = (@$data['filter']['_page'] ? intval($data['filter']['_page']) : 1);
            $limit = @$data['filter']['_limit'] = (@$data['filter']['_limit'] ? intval($data['filter']['_limit']) : 1000);
            $offset = ($page ? ($page - 1) * $limit : 0);

            $data['products'] = Shoes::whereRaw('1 = 1');

            if ($request->get('_search')) {
                $keyword = strtolower($request->get('_search'));
                $data['products'] = $data['products']->whereRaw('(LOWER(name) LIKE "%' . $keyword . '%" OR LOWER(brand) LIKE "%' . $keyword . '%")');
            }

            if ($request->get('_type')) {
                $data['products'] = $data['products']->whereRaw('LOWER(type) = "' . strtolower($request->get('_type')) . '"');
            }

            if ($request->get('_sort_by')) {
                switch ($request->get('_sort_by')) {
                    default:
                    case 'latest_added':
                        $data['products'] = $data['products']->orderBy('created_at', 'DESC');
                        break;
                    case 'title_asc':
                        $data['products'] = $data['products']->orderBy('name', 'ASC');
                        break;
                    case 'title_desc':
                        $data['products'] = $data['products']->orderBy('name', 'DESC');
                        break;
                    case 'price_asc':
                        $data['products'] = $data['products']->orderBy('price', 'ASC');
                        break;
                    case 'price_desc':
                        $data['products'] = $data['products']->orderBy('price', 'DESC');
                        break;
                }
            }

            $data['products_count_total'] = $data['products']->count();
            $data['products'] = ($limit == 0 && $offset == 0) ? $data['products'] : $data['products']->limit($limit)->offset($offset);
            $data['products'] = $data['products']->get()->map(function ($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->name, // <-- inilah fix-nya
                    'cover' => $item->cover,
                    'price' => $item->price,
                    'brand' => $item->brand,
                    'type' => $item->type,
                ];
            });
            $data['products_count_start'] = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + 1);
            $data['products_count_end'] = ($data['products_count_total'] == 0 ? 0 : (($page - 1) * $limit) + sizeof($data['products']));

            return response()->json($data, 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data : {$exception->getMessage()}");
        }
    }

    /**
     * @OA\Post(
     *     path="/api/shoes",
     *     tags={"shoes"},
     *     summary="Store a newly created item",
     *     operationId="store",
     *     @OA\Response(response=400, description="Invalid input", @OA\JsonContent()),
     *     @OA\Response(response=201, description="Successful", @OA\JsonContent()),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             ref="#/components/schemas/Shoes",
     *             example={
     *                 "name": "Adidas UltraBoost",
     *                 "brand": "Adidas",
     *                 "type": "Shoes",
     *                 "cover": "https://example.com/ultraboost.jpg",
     *                 "price": 1200000
     *             }
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $data = $request->json()->all();
            $validator = Validator::make($data, [
                'name' => 'required|unique:shoes',
                'brand' => 'required|max:100',
            ]);

            if ($validator->fails()) {
                throw new HttpException(400, $validator->errors()->first());
            }

            $shoes = new Shoes;
            $shoes->fill($request->all());
            $shoes->created_by = \Auth::user()->id;
            $shoes->save();

            return response()->json(['message' => 'Saved successfully', 'data' => $shoes], 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    public function show($id)
    {
        $shoes = Shoes::findOrFail($id);
        return response()->json(['message' => 'Data detail retrieved successfully', 'data' => $shoes], 200);
    }

    public function update(Request $request, $id)
    {
        if (!$id) {
            throw new HttpException(400, "Invalid id");
        }

        $shoes = Shoes::find($id);
        if (!$shoes) {
            throw new HttpException(404, "Item not found");
        }

        try {
            $shoes->fill($request->all());
            $shoes->updated_by = \Auth::user()->id;
            $shoes->save();

            return response()->json(['message' => 'Updated successfully', 'data' => $shoes], 200);
        } catch (\Exception $exception) {
            throw new HttpException(400, "Invalid data - {$exception->getMessage()}");
        }
    }

    public function destroy($id)
    {
        $shoes = Shoes::findOrFail($id);
        $shoes->deleted_by = \Auth::user()->id;
        $shoes->save();
        $shoes->delete();

        return response()->json(['message' => 'Deleted successfully', 'data' => $shoes], 204);
    }
}
