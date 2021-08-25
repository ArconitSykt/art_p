<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Billboards extends Model
{
    // use HasFactory;
    public static function getBillboards() {
        return DB::table('billboards')
        ->orderBy('id_item')
        ->get();
    }
    public static function updateOrInsert($req) {
        // return $req;
        try {
            DB::table('billboards')
            ->updateOrInsert(
                [
                    'id_item' => $req->item["id_item"]??null,
                ],
                [
                    'light_item' => $req->item["light_item"],
                    'location_item' => $req->item["location_item"],
                    'make_price_item' => $req->item["make_price_item"],
                    'mount_price_item' => $req->item["mount_price_item"],
                    'name_item' => $req->item["name_item"]??"",
                    'photo_a_item' => $req->item["photo_a_item"]??"",
                    'photo_b_item' => $req->item["photo_b_item"]??"",
                    'price_item' => $req->item["price_item"]??"",
                    'tech_item' => $req->item["tech_item"]??"",
                    'type_item' => $req->item["type_item"]??"",
                    'updated_at' => date("Y-m-d H:i:s")
                ]
                
            );
        } catch (\Throwable $th) {
            return "error: ".$th;
        }
    }

    public static function deleteBillboard($req) {
        try {
           DB::table('billboards')->where('id_item', $req->item["id_item"])->delete();
           return "success";
                
        } catch (\Throwable $th) {
            return "error: ".$th;
        }
    }
}
