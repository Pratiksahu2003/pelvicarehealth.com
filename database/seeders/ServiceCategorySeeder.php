<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use App\Models\ServiceSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bladder conditions',
                'short_description' => 'Assessment and treatment for bladder-related concerns.',
                'card_color' => 'pink',
                'sort_order' => 1,
                'subcategories' => [
                    'Stress urinary incontinence',
                    'Urge incontinence',
                    'Overactive bladder',
                    'Nocturia',
                    'Incomplete emptying',
                ],
            ],
            [
                'name' => 'Bowel conditions',
                'short_description' => 'Support for bowel and digestive pelvic health.',
                'card_color' => 'rose',
                'sort_order' => 2,
                'subcategories' => [
                    'Dyssynergic defecation',
                    'Fecal incontinence',
                    'Gas incontinence',
                    'Painful defecation',
                ],
            ],
            [
                'name' => 'Pelvic pain conditions',
                'short_description' => 'Chronic pelvic pain management and support.',
                'card_color' => 'fuchsia',
                'sort_order' => 3,
                'subcategories' => [
                    'Vulvodynia',
                    'Pudendal neuralgia',
                    'Myofascial pelvic pain',
                    'Coccyx pain',
                ],
            ],
            [
                'name' => 'Pregnancy & postnatal',
                'short_description' => 'Prenatal and postpartum pelvic health care.',
                'card_color' => 'teal',
                'sort_order' => 4,
                'subcategories' => [
                    'Pelvic girdle pain',
                    'Diastasis recti',
                    'Perineal scar',
                    'Preparation for labour',
                ],
            ],
        ];

        foreach ($categories as $index => $catData) {
            $subs = $catData['subcategories'];
            unset($catData['subcategories']);

            $category = ServiceCategory::create([
                'name' => $catData['name'],
                'slug' => Str::slug($catData['name']),
                'short_description' => $catData['short_description'],
                'card_color' => $catData['card_color'],
                'sort_order' => $catData['sort_order'],
                'is_active' => true,
            ]);

            foreach ($subs as $i => $subName) {
                ServiceSubcategory::create([
                    'service_category_id' => $category->id,
                    'name' => $subName,
                    'slug' => Str::slug($subName),
                    'sort_order' => $i + 1,
                    'is_active' => true,
                ]);
            }
        }
    }
}
