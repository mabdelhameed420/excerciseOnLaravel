<?php 

namespace App\Traits;

Trait OfferTraits {

    function saveImage($photo,$path){
            $file_extension = $photo->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $photo->move(public_path($path), $file_name);
            return $file_name;
    }
}