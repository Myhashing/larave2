<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ImageController extends Controller
{
    public function index(){
        $images = Image::paginate(10);
        return view('images-list')->with('images',$images);
    }
    public function create(){
        return view('add-new-image');
    }

    public function show($id){
        $image = Image::find($id);
        return view('image-detail')->with('image',$image);
    }
    public function edit($id){
        $image = Image::find($id);
        return view('edit-image')->with('image',$image);
    }
    public function store(Request $request){
        // Validation //
        $validation = Validator::make($request->all(), [
            'caption'     => 'required|regex:/^[A-Za-z ]+$/',
            'description' => 'required',
            'userfile'     => 'required|image|mimes:jpeg,png|min:1|max:25000'
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors() );
        }

        $image = new Image;

        // upload the image //
        $file = $request->file('userfile');
        $destination_path = 'uploads/';
        $filename = str_random(6).'_'.$file->getClientOriginalName();
        $file->move($destination_path, $filename);

        // save image data into database //
        $image->file = $destination_path . $filename;
        $image->caption = $request->input('caption');
        $image->description = $request->input('description');
        $image->product_id = $request->product_id;
        $image->save();
        /*TODO fix the redirect url after store image*/
        $url="/products/".$request->product_id;
        return redirect($url);
    }
    public function update(Request $request, $id)
    {
        // Validation //
        $validation = Validator::make($request->all(), [
            'caption'     => 'required|regex:/^[A-Za-z ]+$/',
            'description' => 'required',
            'userfile'    => 'sometimes|image|mimes:jpeg,png|min:1|max:250'
        ]);

        // Check if it fails //
        if( $validation->fails() ){
            return redirect()->back()->withInput()
                ->with('errors', $validation->errors() );
        }

        // Process valid data & go to success page //
        $image = Image::find($id);

        // if user choose a file, replace the old one //
        if( $request->hasFile('userfile') ){
            $file = $request->file('userfile');
            $destination_path = 'uploads/';
            $filename = str_random(6).'_'.$file->getClientOriginalName();
            $file->move($destination_path, $filename);
            $image->file = $destination_path . $filename;
        }

        // replace old data with new data from the submitted form //
        $image->caption = $request->input('caption');
        $image->description = $request->input('description');
        $image->save();

        return redirect('/')->with('message','You just updated an image!');
    }
    public function destroy($id)
    {
        $image = Image::find($id);
        $image->delete();
        return redirect('/')->with('message','You just uploaded an image!');
    }
}
