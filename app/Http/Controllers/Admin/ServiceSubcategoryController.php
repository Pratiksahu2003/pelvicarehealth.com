<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ServiceSubcategoryController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceSubcategory::with('serviceCategory');

        if ($request->filled('category')) {
            $query->where('service_category_id', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->where('is_active', true);
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        $subcategories = $query->ordered()->paginate(15)->withQueryString();
        $categories = ServiceCategory::ordered()->get();

        return view('admin.super-admin.services.subcategories.index', compact('subcategories', 'categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::ordered()->get();
        return view('admin.super-admin.services.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // HTML from TinyMCE
            'image' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $category = ServiceCategory::findOrFail($request->service_category_id);
        $slug = Str::slug($request->name);

        $data = [
            'service_category_id' => $category->id,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'sort_order' => (int) ($request->sort_order ?? 0),
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('service_images/subcategories', 'public_html');
        }

        ServiceSubcategory::create($data);

        return redirect()->route('admin.service-subcategories.index')
            ->with('success', 'Service subcategory created successfully.');
    }

    public function edit($id)
    {
        $subcategory = ServiceSubcategory::findOrFail($id);
        $categories = ServiceCategory::ordered()->get();
        return view('admin.super-admin.services.subcategories.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = ServiceSubcategory::findOrFail($id);

        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // HTML from TinyMCE
            'image' => 'nullable|image|max:2048',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $data = [
            'service_category_id' => $request->service_category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'sort_order' => (int) ($request->sort_order ?? 0),
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('image')) {
            if ($subcategory->image) {
                Storage::disk('public_html')->delete($subcategory->image);
            }
            $data['image'] = $request->file('image')->store('service_images/subcategories', 'public_html');
        }

        $subcategory->update($data);

        return redirect()->route('admin.service-subcategories.index')
            ->with('success', 'Service subcategory updated successfully.');
    }

    public function destroy($id)
    {
        $subcategory = ServiceSubcategory::findOrFail($id);

        if ($subcategory->image) {
            Storage::disk('public_html')->delete($subcategory->image);
        }

        $subcategory->delete();

        return redirect()->route('admin.service-subcategories.index')
            ->with('success', 'Service subcategory deleted successfully.');
    }
}
