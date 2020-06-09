<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Customer;
use App\ServiceProvider;
use App\Vendor;
use DB;


class VendorController extends Controller
{
    // https://www.webslesson.info/2020/01/larvel-6-store-retrieve-images-from-mysql-database.html
    function insert_image(Request $request)
    {
        $request->validate([
        'user_name'  => 'required',
        'user_image' => 'required|image|max:2048'
        ]);

        $image_file = $request->user_image;

        $image = Image::make($image_file);

        Response::make($image->encode('jpeg'));

        $form_data = array(
        'user_name'  => $request->user_name,
        'user_image' => $image
        );

        Images::create($form_data);

        return redirect()->back()->with('success', 'Image store in database successfully');
    }

    function fetch_image($image_id)
    {
        $image = Images::findOrFail($image_id);

        $image_file = Image::make($image->user_image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }
}
