<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class PetController extends Controller
{
    var $rp = 5;

    public function index()
    {
        $pets = Pet::paginate($this->rp);

        return view('pet/index', compact('pets'));
    }

    public function search(Request $request)
    {
        $query = $request->q;

        if ($query) {
            $pets = Pet::where('code', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->paginate($this->rp);
        } else $pets = Pet::paginate($this->rp);

        foreach ($pets as $pet) {
            if (empty($pet->image_url)) {
                $pet->image_url = 'default_image_path';
            }
        }

        return view('pet/index', compact('pets'));
    }

    public function edit($id = null)
    {
        $categories = Category::pluck('name', 'id')->prepend('Select item', '');

        if ($id) {
            $pet = Pet::find($id);

            if ($pet) {
                return view('pet.edit')
                    ->with('pet', $pet)
                    ->with('categories', $categories);
            } else {
                return redirect('/pet')->with('error', 'Pet not found.');
            }
        } else {
            return view('pet.add')
                ->with('categories', $categories);
        }
    }

    public function update(Request $request)
    {
        $rules = [
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'image' => 'nullable|image|mimes:png|max:2048',
        ];

        $messages = [
            'required' => 'Please fill in information :attribute completely',
            'numeric' => 'Please fill in information :attribute to be a number',
            'image' => 'file :attribute Must be an image file',
            'mimes' => 'file :attribute Must be a file type :values only',
            'max' => 'file :attribute Must not exceed :max kilobytes.',
        ];

        $id = $request->id;
        $temp = [
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ];

        $validator = Validator::make($temp, $rules, $messages);

        if ($validator->fails()) {
            return redirect('pet/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $pet = Pet::find($id);
        $pet->code = $request->code;
        $pet->name = $request->name;
        $pet->category_id = $request->category_id;
        $pet->price = $request->price;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $upload_to = 'upload/images';
            $relative_path = $upload_to . '/' . $file->getClientOriginalName();
            $absolute_path = public_path($upload_to);
            $file->move($absolute_path, $file->getClientOriginalName());

            Image::make(public_path($relative_path))->resize(350, 350)->save();
            $pet->image_url = $relative_path;
        }

        $pet->save();

        return redirect('pet')
            ->with('ok', true)
            ->with('msg', 'Data has been recorded successfully.');
    }

    public function insert(Request $request)
    {
        $rules = [
            'code' => 'required',
            'name' => 'required',
            'category_id' => 'required|numeric',
            'price' => 'numeric',
            'image' => 'nullable|image|mimes:png|max:2048',
        ];

        $messages = [
            'required' => 'Please fill in information :attribute completely',
            'numeric' => 'Please fill in information :attribute to be a number',
            'image' => 'file :attribute Must be an image file',
            'mimes' => 'file :attribute Must be a file type :values only',
            'max' => 'file :attribute Must not exceed :max kilobytes.',
        ];

        $id = $request->id;
        $temp = [
            'code' => $request->code,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
        ];

        $validator = Validator::make($temp, $rules, $messages);

        if ($validator->fails()) {
            return redirect('pet/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $pets = new Pet();
        $pets->code = $request->code;
        $pets->name = $request->name;
        $pets->category_id = $request->category_id;
        $pets->price = $request->price;

        if ($request->hasFile('image')) {

            $file = $request->file('image');
            $upload_to = 'upload/images';
            $relative_path = $upload_to . '/' . $file->getClientOriginalName();
            $absolute_path = public_path($upload_to);
            $file->move($absolute_path, $file->getClientOriginalName());

            Image::make(public_path($relative_path))->resize(350, 350)->save();
            $pets->image_url = $relative_path;
        }

        $pets->save();

        return redirect('pet')
            ->with('ok', true)
            ->with('msg', 'Information added successfully');
    }

    public function remove($id)
    {

        Pet::find($id)->delete();

        return redirect('pet')
            ->with('ok', true)
            ->with('msg', 'Successfully deleted data');
    }
}
