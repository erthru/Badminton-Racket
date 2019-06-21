<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Racket;

class RacketController extends Controller
{
    public function all()
    {
        $rackets = Racket::with(["brand"])->orderBy("id","DESC")->paginate(10);

        return $this->success($rackets);
    }

    public function show($id)
    {
        $racket = Racket::with(["brand"])->find($id);
        return $this->success($racket);
    }

    public function search(Request $request)
    {
        $rackets = Racket::with(["brand"])
        ->orWhere("name","LIKE","%".$request->query("q")."%")
        ->orWhere("balance_point","LIKE","%".$request->query("q")."%")
        ->orWhere("description","LIKE","%".$request->query("q")."%")
        ->orderBy("id","DESC")
        ->take(15)
        ->get();

        return $this->success($rackets);
    }

    public function store(Request $request)
    {
        $image_name = uniqid().".jpg";
        $request->file("image")->move("uploads",$image_name);

        $body = [
            "name" => $request->input("name"),
            "balance_point" => $request->input("balance_point"),
            "description" => $request->input("description"),
            "image" => $image_name,
            "brand_id" => $request->input("brand_id")
        ];

        $racket = Racket::create($body);
        return $this->success($racket);
    }

    public function update_image($id, Request $request)
    {
        $image_name = uniqid().".jpg";
        $request->file("image")->move("uploads",$image_name);

        $body = [
            "image" => $image_name
        ];

        $racket = Racket::find($id);

        unlink("uploads/".$racket->image);
        
        $racket->update($body);
        return $this->success($racket);
    }

    public function update($id, Request $request)
    {
        $body = [
            "name" => $request->input("name"),
            "balance_point" => $request->input("balance_point"),
            "description" => $request->input("description"),
            "brand_id" => $request->input("brand_id")
        ];

        $racket = Racket::find($id);
        $racket->update($body);

        return $this->success($racket);
    }

    public function delete($id)
    {
        $racket = Racket::find($id);

        unlink("uploads/".$racket->image);
        
        $racket->delete();
        
        return $this->deleted();
    }
}
