<?php

namespace App\Http\Controllers;

use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceCategory::active()->with(['activeSubcategories'])->ordered();

        // Filter by specialization (backend_tags) when provided
        $specialization = $request->get('specialization');
        if ($specialization && $specialization !== 'all') {
            $query->whereJsonContains('backend_tags', $specialization);
        }

        $categories = $query->get();

        // Build unique specializations list for filter dropdown (from all active categories)
        $allCategories = ServiceCategory::active()->get();
        $specializations = [];
        foreach ($allCategories as $cat) {
            if (is_array($cat->backend_tags)) {
                foreach ($cat->backend_tags as $tag) {
                    if ($tag && !in_array($tag, $specializations, true)) {
                        $specializations[] = $tag;
                    }
                }
            }
        }
        sort($specializations);

        return view('services', compact('categories', 'specializations', 'specialization'));
    }

    public function show(string $slug)
    {
        $category = ServiceCategory::where('slug', $slug)
            ->active()
            ->with(['activeSubcategories'])
            ->firstOrFail();

        return view('service-show', compact('category'));
    }

    public function showSubservice(string $categorySlug, string $subcategorySlug)
    {
        $category = ServiceCategory::where('slug', $categorySlug)->active()->firstOrFail();

        $subcategory = ServiceSubcategory::where('service_category_id', $category->id)
            ->where('slug', $subcategorySlug)
            ->active()
            ->firstOrFail();

        return view('subservice-show', compact('category', 'subcategory'));
    }
}
