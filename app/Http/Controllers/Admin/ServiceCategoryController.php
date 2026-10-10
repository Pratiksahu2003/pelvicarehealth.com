<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceCategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceCategory::withCount('subcategories');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $categories = $query->ordered()->paginate(15)->withQueryString();

        return view('admin.super-admin.services.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.super-admin.services.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'card_color' => 'nullable|in:pink,rose,fuchsia,teal,purple',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'card_color' => $request->card_color ?? 'pink',
            'sort_order' => (int) ($request->sort_order ?? 0),
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service_images/categories', 'public_html');
        }

        ServiceCategory::create($data);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Service category created successfully.');
    }

    public function edit($id)
    {
        $category = ServiceCategory::findOrFail($id);
        return view('admin.super-admin.services.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ServiceCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'card_color' => 'nullable|in:pink,rose,fuchsia,teal,purple',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'short_description' => $request->short_description,
            'description' => $request->description,
            'card_color' => $request->card_color ?? 'pink',
            'sort_order' => (int) ($request->sort_order ?? 0),
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public_html')->delete($category->image);
            }
            $data['image'] = $request->file('image')->store('service_images/categories', 'public_html');
        }

        $category->update($data);

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Service category updated successfully.');
    }

    public function destroy($id)
    {
        $category = ServiceCategory::findOrFail($id);

        if ($category->image) {
            Storage::disk('public_html')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.service-categories.index')
            ->with('success', 'Service category deleted successfully.');
    }
}
