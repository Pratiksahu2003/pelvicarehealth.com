<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $featuredDoctors = Cache::remember('home.featured_doctors', 900, function () {
                return $this->loadFeaturedDoctors();
            });
        } catch (\Throwable) {
            $featuredDoctors = $this->loadFeaturedDoctors();
        }

        $categoryIds = collect();
        $subcategoryIds = collect();
        foreach ($featuredDoctors as $doctor) {
            $profile = $doctor->doctorProfile;
            if (! $profile) {
                continue;
            }
            $categoryIds = $categoryIds->merge($profile->service_category_ids ?? []);
            $subcategoryIds = $subcategoryIds->merge($profile->service_subcategory_ids ?? []);
        }

        $uniqueCategoryIds = $categoryIds->unique()->filter()->values();
        $uniqueSubcategoryIds = $subcategoryIds->unique()->filter()->values();

        $categoriesById = $uniqueCategoryIds->isEmpty()
            ? collect()
            : ServiceCategory::query()->whereIn('id', $uniqueCategoryIds)->ordered()->get()->keyBy('id');

        $subcategoriesById = $uniqueSubcategoryIds->isEmpty()
            ? collect()
            : ServiceSubcategory::query()->whereIn('id', $uniqueSubcategoryIds)->ordered()->get()->keyBy('id');

        try {
            $serviceCategories = Cache::remember('home.service_categories', 3600, function () {
                return $this->loadHomeServiceCategories();
            });
        } catch (\Throwable) {
            $serviceCategories = $this->loadHomeServiceCategories();
        }

        return view('home', compact(
            'featuredDoctors',
            'serviceCategories',
            'categoriesById',
            'subcategoriesById'
        ));
    }

    private function loadFeaturedDoctors()
    {
        return User::query()
            ->where('role', 'admin')
            ->whereHas('doctorProfile', function ($q) {
                $q->where('verification_status', 'approved')
                    ->where('profile_completed', true)
                    ->where('is_featured', true)
                    ->whereNotNull('slug');
            })
            ->with('doctorProfile')
            ->latest('updated_at')
            ->limit(10)
            ->get();
    }

    private function loadHomeServiceCategories()
    {
        return ServiceCategory::active()
            ->with(['activeSubcategories'])
            ->ordered()
            ->limit(6)
            ->get();
    }
    
    public function services()
    {
        return view('services');
    }
    
    public function treatments()
    {
        return view('treatments');
    }
    
    public function about()
    {
        return view('about');
    }
    
    public function contact()
    {
        return view('contact');
    }

    public function faq()
    {
        return view('faq');
    }
}

