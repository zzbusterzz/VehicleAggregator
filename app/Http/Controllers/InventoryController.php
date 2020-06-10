<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Requests;
use App\Product;
use App\BelongsTo;
use DB;
use Image;

class InventoryController extends Controller
{
    public function addProduct(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'category' => 'required',
            'partdetails' => 'required',
            'price' => 'required',
            'image' => 'required|image|max:2048|max:160000',
            'model' => 'required',
        ]);

        $image_file = $request->image;
        $image = Image::make($image_file);
        Response::make($image->encode('jpeg'));

        $product = new Product([                        
            'name' => $request->input('name'),                                                             
            'partdetails' => $request->input('partdetails'), 
            'price' => $request->input('price'),
            'category' => $request->input('category'), 
            'image' => $image
        ]);

        $result = $product->save();
        
        
        $result = DB::table('products')
                ->select('products.id')
                ->where([
                'name' => $request->input('name'),
                'partdetails' => $request->input('partdetails'), 
                'price' => $request->input('price'),
                'category' => $request->input('category'),
            ])
            ->get();
        
        $partid = $result[0]->id;
        $userid =  $request->session()->get('user_id');   

        $str_arr = explode ("/", $request->input('brandvalues'));
        
        foreach ($str_arr as $brandids)//enter data freshly
        {
            if($request->input($brandids) == "true"){
                $belongs = new BelongsTo([                        
                    'vehiclebrand_id' => $brandids,
                    'part_id' => $partid,
                ]);
                $belongs->save();
                $belongs = null;
            }
        }

        return back()->with('info','Product Added Successfully');
    }
}
