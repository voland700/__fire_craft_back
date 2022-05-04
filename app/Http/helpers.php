<?php
if (! function_exists('file_get_content_curl')) {
    function file_get_content_curl ($url)   {
        // Throw Error if the curl function does'nt exist.
        if (!function_exists('curl_init'))
        {
            die('CURL is not installed!');
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }
}

if (! function_exists('getfolderName')) {
    function getfolderName(){
        return substr(str_shuffle("01234567890123456789"), 0, 2);
    }
}

if (! function_exists('getPrice')) {
    function getPrice($item){
        $cost['price'] = number_format($item->price, 2, '.', ' ' );
        $cost['old_price'] = null;
        $cost['discount'] = false;
        $cost['percent'] = null;
        if($item->discount->has(0)){
            $discount = $item->discount[0];
            if($discount->active == 1){
                if($item->price > 0 && $discount->type == 'percent'){
                    $cost['discount'] = true;
                    $temp = round($item->price - ($item->price / 100 * $discount->value));
                    $cost['price'] = number_format( $temp, 2, '.', ' ' );
                    $cost['old_price'] = number_format($item->price, 2, '.', ' ' );
                    $cost['percent'] = $discount->value;
                }
                if($item->price > 0 && $discount->type == 'fixed'){
                    $cost['discount'] = true;
                    $cost['price'] = number_format( round($item->price - $discount->value), 2, '.', ' ' );
                    $cost['old_price'] = number_format($item->price, 2, '.', ' ' );
                    $cost['percent'] = (int)round(100 - (($item->price - $discount->value) / $item->price)*100);
                }
                if($item->price > 0 && $discount->type == 'cost' && $item->price > $discount->value){
                    $cost['discount'] = true;
                    $cost['price'] = number_format($discount->value, 2, '.', ' ' );
                    $cost['old_price'] =  number_format($item->price, 2, '.', ' ' );
                    $cost['percent'] = (int)round((($item->price - $discount->value) / $item->price)*100);
                }
            }
        }
        $item->cost = $cost['price'];
        $item->old_price = $cost['old_price'];
        $item->is_discount = $cost['discount'];
        $item->percent = $cost['percent'];
    }
}

if (! function_exists('addDataPriceAll')) {
    function addDataPriceAll($collection){
        if($collection->isNotEmpty()){
            $collection->each(function ($item) {
                if(!$item->offers->isEmpty()){
                    $item->offers->each(function ($itemOffer){
                        $itemOffer = getPrice($itemOffer);
                    });
                }
                $item = getPrice($item);
                return $item;
            });
        }
    }
}

if (! function_exists('addDataPriceItem')) {
    function addDataPriceItem($item){
        if($item){
            getPrice($item);
            if(!$item->offers->isEmpty()){
                $item->offers->each(function ($itemOffer){
                    getPrice($itemOffer);
                });
            }
        }
    }
}

