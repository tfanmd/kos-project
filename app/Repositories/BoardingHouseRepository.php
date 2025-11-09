<?php

namespace App\Repositories;

use App\Interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use Filament\Forms\Components\Builder;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface
{

    public function getAllBoardingHouses($search = null, $city = null, $category = null)

    {
        $query = BoardingHouse::query();

        // jika search diisi maka akan melakukan pencarian berdasarkan nama
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');    
        }

        // jika city diisi maka akan melakukan filter berdasarkan city
        if ($city) {
            $query->whereHas('city_id', function (Builder $query) use ($city) {    
            });  
        }
        
        // jika category diisi maka akan melakukan filter berdasarkan category
        if ($category) {
            $query->whereHas('category_id', function (Builder $query) use ($category) {    
            });  
        }

        return $query->get();
    }

    public function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::withCount('transactions')->orderBy('transactions_count', 'desc', 'desc')->take($limit)->get();
    }

    public function getBoardingHouseByCitySlug($slug)
    {
        return BoardingHouse::whereHas('city', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->get(); 
    }

    public function getBoardingHouseByCategorySlug($slug)
    {
        return BoardingHouse::whereHas('category', function (Builder $query) use ($slug) {
            $query->where('slug', $slug);
        })->get(); 
    }

    public function getBoardingHouseBySlug($slug)
    {
        return BoardingHouse::where('slug', $slug)->first(); 
    }


}
