<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use App\Shop\Entity\Merchandise;
use Illuminate\Support\Facades\Mail;

class MerchandiseController extends Controller
{
    public function MerchandiseCreateProcess() {

        $product_data = [
            "status" => "C",
            "name" => "商品名稱",
            "name_en" => "product name",
            "introduction" => "商品介紹",
            "introduction_en" => "product introduction",
            "photo" => "",
            "price" => 0,
            "remain_count" => 0,
        ];

        $Merchandise = Merchandise::create($product_data);

        return redirect("/merchandise/". $Merchandise->id . "/edit");
    }
    public function MerchandiseItemEditPage ($merchandise_id) 
    {
        $merchandise = Merchandise::where("id", $merchandise_id);
        if($merchandise -> count() === 0) {
            return redirect("/");
        } else {
            $merchandise = $merchandise -> first();
        }
        $binding = [
            "title" => "編輯商品",
            "merchandise" => $merchandise,
        ];
        return view("merchandise.edit", $binding);
    }
}