<?php

declare(strict_types=1);


namespace App\Http\Controllers\Adverts;


use App\Entity\Adverts\Advert\Advert;
use App\Entity\Adverts\Category;
use App\Entity\Region;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class AdvertController extends Controller
{
    public function index(Region $region = null, Category $category = null)
    {
        $query = Advert::active()->with(['category', 'region'])->orderByDesc('published_at');

        if ($category) {
            $query->forCategory($category);
        }

        if ($region) {
            $query->forRegion($region);
        }

        $region = $region
            ? $region->children()->orderBy('name')->getModels()
            : Region::roots()->orderBy('name')->getModels();

        $categories = $category
            ? $category->children()->defaultOrder()->getModels()
            : Category::whereIsRoot()->defaultOrder()->getModels();

        $adverts = $query->paginate(20);

        return view('adverts.index', compact('category', 'region', 'categories', 'region', 'adverts'));
    }

    public function show(Advert $advert)
    {
        if (!($advert->isActive() || \Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return view('adverts.show', compact('advert'));
    }

    public function phone(Advert $advert): string
    {
        if (!($advert->isActive() || Gate::allows('show-advert', $advert))) {
            abort(403);
        }

        return $advert->user->phone;
    }
}
