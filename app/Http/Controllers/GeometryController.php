<?php

namespace App\Http\Controllers;

use App\FarmPlace;
use Illuminate\Http\Request;

class GeometryController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $east = floatval(request()->input('east'));
        $north = floatval(request()->input('north'));
        $south = floatval(request()->input('south'));
        $west = floatval(request()->input('west'));

        return FarmPlace::where('location', 'geoWithin', [
            '$geometry' => [
                'type'        => 'Polygon',
                'coordinates' => [[
                    [$east, $north],
                    [$west, $north],
                    [$west, $south],
                    [$east, $south],
                    [$east, $north],
                ]],
            ],
        ])->get(['name', 'location', 'types']);
    }

    public function tags()
    {
        $data = collect([
            'accounting',
            'airport',
            'amusement_park',
            'aquarium',
            'art_gallery',
            'atm',
            'bakery',
            'bank',
            'bar',
            'beauty_salon',
            'bicycle_store',
            'book_store',
            'bowling_alley',
            'bus_station',
            'cafe',
            'campground',
            'car_dealer',
            'car_rental',
            'car_repair',
            'car_wash',
            'casino',
            'cemetery',
            'church',
            'city_hall',
            'clothing_store',
            'convenience_store',
            'courthouse',
            'dentist',
            'department_store',
            'doctor',
            'electrician',
            'electronics_store',
            'embassy',
            'fire_station',
            'florist',
            'funeral_home',
            'furniture_store',
            'gas_station',
            'gym',
            'hair_care',
            'hardware_store',
            'hindu_temple',
            'home_goods_store',
            'hospital',
            'insurance_agency',
            'jewelry_store',
            'laundry',
            'lawyer',
            'library',
            'liquor_store',
            'local_government_office',
            'locksmith',
            'lodging',
            'meal_delivery',
            'meal_takeaway',
            'mosque',
            'movie_rental',
            'movie_theater',
            'moving_company',
            'museum',
            'night_club',
            'painter',
            'park',
            'parking',
            'pet_store',
            'pharmacy',
            'physiotherapist',
            'plumber',
            'police',
            'post_office',
            'real_estate_agency',
            'restaurant',
            'roofing_contractor',
            'rv_park',
            'school',
            'shoe_store',
            'shopping_mall',
            'spa',
            'stadium',
            'storage',
            'store',
            'subway_station',
            'supermarket',
            'synagogue',
            'taxi_stand',
            'train_station',
            'transit_station',
            'travel_agency',
            'veterinary_care',
            'zoo',
            'administrative_area_level_1',
            'administrative_area_level_2',
            'administrative_area_level_3',
            'administrative_area_level_4',
            'administrative_area_level_5',
            'colloquial_area',
            'country',
            'establishment',
            'finance',
            'floor',
            'food',
            'general_contractor',
            'geocode',
            'health',
            'intersection',
            'locality',
            'natural_feature',
            'neighborhood',
            'place_of_worship',
            'political',
            'point_of_interest',
            'post_box',
            'postal_code',
            'postal_code_prefix',
            'postal_code_suffix',
            'postal_town',
            'premise',
            'room',
            'route',
            'street_address',
            'street_number',
            'sublocality',
            'sublocality_level_4',
            'sublocality_level_5',
            'sublocality_level_3',
            'sublocality_level_2',
            'sublocality_level_1',
            'subpremise',
            'locality',
            'sublocality',
            'postal_code',
            'country',
            'administrative_area_level_1',
            'administrative_area_level_2',
            'establishment',
            'finance',
            'food',
            'general_contractor',
            'grocery_or_supermarket',
            'health',
            'place_of_worship',
            'administrative_area_level_3',
        ]);

        $tag = request()->input('tag');
        if ($tag != null) {
            return $data->filter(function ($value, $key) use ($tag) {
                return strpos($value, $tag) !== false;
            })->values();
        }

        return $data;
    }
}
