<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;

class SubcategoryController extends Controller
{
    // public function showSubcategoryItems($subcategoryId)
    // {
    //     // البحث عن الفئة الفرعية بناءً على الـ ID
    //     $subcategory = Subcategory::findOrFail($subcategoryId);

    //     // جلب العناصر المرتبطة بهذه الفئة الفرعية
    //     $items = $subcategory->items;

    //     // تمرير البيانات إلى نفس الـ View الذي يحتوي على قائمة الفئات
    //     return view('category', compact('items', 'subcategory'));
    // }
}
