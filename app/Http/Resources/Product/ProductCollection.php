<?php

namespace App\Http\Resources\Product;
//using resource instead of collection
//use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Resources\Json\Resource;

//class ProductCollection extends ResourceCollection
class ProductCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     *
     * eapi
     * API resource/transformer
     */
    public function toArray($request)
    {
       // return parent::toArray($request);
        return [
            'name' => $this->name,
            'totalPrice' => round(( 1 - ($this->discount/100)) * $this->price, 2),
            'rating' => $this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count()) : 'No rating yet',
            'discount' => $this->discount,
            'href' => [
                'link' => route('products.show', $this->id)
            ]
        ];
    }
}
