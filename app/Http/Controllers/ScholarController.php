<?php

namespace App\Http\Controllers;

use App\Http\Resources\ScholarCollection;
use App\Http\Resources\ScholarResource;
use App\Models\Scholar;
use Illuminate\Http\Request;

class ScholarController extends Controller
{
    public function index()
    {
        return new ScholarCollection(Scholar::orderBy('id', 'DESC')->paginate(10));
    }
    public function search($field, $query)
    {
        return new ScholarCollection(Scholar::where($field, 'LIKE', "%$query%")->latest()->paginate(10));
    }

    public function store(Request $request)
    {
        $scholar = new Scholar();
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $file = time().'.'.$ext;
            $image->storeAs('public/scholar', $file);
            $scholar->image = $file;
        }
        $scholar->name = $request->name;
        $scholar->email = $request->email;
        $scholar->phone = $request->phone;
        $scholar->address = $request->address;
        $scholar->total_Slp = $request->total_Slp;
        $scholar->save();
    }

    public function show(Scholar $scholar)
    {
        return new ScholarResource($scholar);
    }


    public function update(Request $request, Scholar $scholar)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->extension();
            $file = time().'.'.$ext;
            $image->storeAs('public/scholar', $file);
            $scholar->image = $file;
        }
        $scholar->name = $request->name;
        $scholar->email = $request->email;
        $scholar->phone = $request->phone;
        $scholar->address = $request->address;
        $scholar->total_Slp = $request->total_Slp;
        $scholar->save();
        
        return new ScholarResource($scholar);
    }

    public function destroy(Scholar $scholar)
    {
        $scholar->delete();
        
        return new ScholarResource($scholar);
    }
}
