<?php

namespace App\Services;

use App\Models\Category;
use App\Models\City;
use App\Models\House;

class HouseService
{
    /**
     * Get latest cities and categories
     */
    public function getCategoriesAndCities(): array
    {
        return [
            'categories' => Category::latest()->get(),
            'cities' => City::latest()->get(),
        ];
    }

    /**
     * Search Houses by filters (City, Category)
     */
    public function searchHouses(array $filters): array
    {
        $query = House::query();

        if (! empty($filters['city'])) {
            $query->where('city_id', $filters['city']);
        }
        if (! empty($filters['category'])) {
            $query->where('category_id', $filters['category']);
        }

        $houses = $query->get();
        $city = City::findOrFail($filters['city'] ?? null);
        $category = Category::findOrFail($filters['category'] ?? null);

        return compact(
            'houses',
            'city',
            'category',
        );
    }

    /**
     * Get house details (used in show House page)
     */
    public function getHouseDetails(House $house): House|array
    {
        $house->load(['photos', 'facilities', 'facilities.facility']);

        return $house;
    }
}
