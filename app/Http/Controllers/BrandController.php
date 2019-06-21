<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function all()
    {
        $brands = Brand::orderBy("id","DESC")->paginate(10);
        return $this->success($brands);
    }

    public function show($id)
    {
        $brand = Brand::find($id);
        return $this->success($brand);
    }

    public function all_by_name()
    {
        $brands = Brand::orderBy("name","ASC")->get();
        return $this->success($brands);
    }

    public function search(Request $request)
    {
        $brands = Brand::where("name","LIKE","%".$request->query("q")."%")
        ->orderBy("id","DESC")
        ->take(15)
        ->get();

        return $this->success($brands);
    }

    public function store(Request $request)
    {
        $body = [
            "name" => $request->input("name")
        ];

        $brand = Brand::create($body);
        return $this->success($brand);
    }

    public function update($id, Request $request)
    {
        $body = [
            "name" => $request->input("name")
        ];

        $brand = Brand::find($id);
        $brand->update($body);

        return $this->success($brand);
    }

    public function delete($id)
    {
        $brand = Brand::find($id);
        $brand->delete();

        return $this->deleted();
    }
}
