<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.products.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'registration_date' => 'required',
            'engine_size' => 'required',
            'price' => 'required',
            'description' => 'nullable',
            'active' => 'nullable',
            'tag' => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $productRepo = new ProductRepository();
            $image = $request->file('image');
            if ($image) $request['file_name'] = $image[0]->getClientOriginalName();//get image name

            if ($product = $productRepo->store($request)){//store new product
                if ($image) {//save image of product
                    $filename = $product->id . '-' . $image[0]->getClientOriginalName();
                    if (Storage::disk('local')->putFileAs(
                        'public/images',
                        $image[0],
                        $filename
                    )) {
                        Db::commit();
                        return redirect()->route('admin.products.index')->with('success', 'Product Created Successfully');
                    };
                }
                Db::commit();
                return redirect()->route('admin.products.index')->with('success', 'Product Created Successfully');

            };
            Db::rollback();
            return redirect()->back()->with('error', 'Product was not created!');
        }catch (\Exception $exception){
            Db::rollback();
            return redirect()->back()->with('error', 'An Error Has Occurred!');
        }
    }

    public function destroy($id){
        $product = Product::findOrFail($id);

        if ($product->delete()){
            return redirect()->back()->with('success', 'Deleted Successfully');
        };

        return redirect()->back()->with('error', 'Error!!!Failed');
    }

    public function updateStatus(Request $request): JsonResponse
    {
        //update product (active or not)
        $id = $request->request->get('id');

        if ($id) {
            $product = Product::findOrFail($id);
            try {
                if ($product->active) {
                    $product->active = 0;
                } else {
                    $product->active = 1;
                }

                $product->save();
                $response = [
                    'status' => 'success',
                    'active' => $product->active
                ];
                return new JsonResponse($response);
            } catch (\Exception $exception) {
                return new JsonResponse('error');
            }
        }

        return new JsonResponse('error');
    }
}
