<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * عرض الفئة المحددة مع التصنيفات الفرعية والمنتجات المرتبطة بها
     */
    public function showCategory(Request $request)
    {
        $categoryId = $request->input('category_id');

        // Fetch the category with the passed ID along with its subcategories
        $categories = Category::with('subcategories')->where('id', $categoryId)->get();

        // Fetch the subcategories linked to the category
        $subcategories = Subcategory::where('category_id', $categoryId)->get();

        // Fetch the items linked to the fetched subcategories where status is approved
        $items = Item::whereIn('subcategory_id', $subcategories->pluck('id'))
            ->where('status', 'approved')
            ->get();

        // Pass the data to the view

        return view('category', compact('items', 'categories', 'subcategories'));
    }


    // public function showItems($id)
    // {
    //     // الحصول على الفئة المختارة بناءً على الـ ID
    //     $category = Category::findOrFail($id);
    //     $subcategories = $category->subcategories;
    //     // جلب العناصر المرتبطة بهذه الفئة فقط
    //     $items = Item::whereIn('subcategory_id', $subcategories->pluck('id'))
    //         ->where('status', 'approved')
    //         ->get();
    //     // تمرير الفئة والعناصر إلى العرض
    //     return view('category', compact('category',  'items'));
    // }




    /**
     * عرض قائمة الفئات الرئيسية والفرعية.
     */
    public function index(Request $request)
    {
        // جلب الفئات مع التصنيفات الفرعية
        $categories = Category::with('subcategories')->get();

        // استلام البيانات من نموذج البحث
        $keyword = $request->input('keyword');
        $categoryId = $request->input('category');
        $location = $request->input('address');

        // بدء استعلام العناصر
        $query = Item::query();

        // فلترة بناءً على الكلمة المفتاحية في العنوان أو الوصف
        if ($keyword) {
            $query->where('title', 'LIKE', '%' . $keyword . '%')
                ->orWhere('description', 'LIKE', '%' . $keyword . '%');
        }

        // فلترة بناءً على التصنيف إذا تم اختياره
        if ($categoryId) {
            // الحصول على التصنيفات الفرعية بناءً على الفئة المختارة
            $subcategories = Subcategory::where('category_id', $categoryId)->pluck('id');
            $query->whereIn('subcategory_id', $subcategories);
        }

        // فلترة بناءً على الموقع إذا تم اختياره
        if ($location) {
            $query->where('address', 'LIKE', '%' . $location . '%');
        }

        // جلب العناصر التي تم الموافقة عليها فقط
        $items = $query->where('status', 'approved')->get();

        // تمرير البيانات إلى الواجهة
        return view('category', compact('categories', 'items'));
    }



    /**
     * عرض نموذج إنشاء إعلان جديد.
     */
    public function create()
    {
        // جلب جميع الفئات الرئيسية والفرعية
        $categories = Category::with('subcategories')->get();

        // إرسال الفئات الرئيسية والفرعية إلى الـ view الخاص بإنشاء الإعلان
        return view('postad', compact('categories'));
    }

    /**
     * تخزين الإعلان الجديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        // معالجة بيانات الإدخال وتخزين الإعلان الجديد
        // يجب عليك إضافة المنطق الخاص بحفظ الإعلان هنا
    }

    /**
     * عرض تفاصيل فئة محددة.
     */
    public function show(string $id)
    {
        // جلب التصنيف المحدد مع المنتجات الخاصة به
        $category = Category::with('subcategories')->findOrFail($id);

        // عرض البيانات
        return view('category', compact('category'));
    }

    /**
     * عرض نموذج تعديل الفئة المحددة.
     */
    public function edit(string $id)
    {
        // عرض نموذج التعديل للفئة
        $category = Category::findOrFail($id);

        return view('category.edit', compact('category'));
    }

    /**
     * تحديث الفئة المحددة في قاعدة البيانات.
     */
    public function update(Request $request, string $id)
    {
        // منطق التحديث للفئة المحددة
        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * حذف الفئة المحددة من قاعدة البيانات.
     */
    public function destroy(string $id)
    {
        // حذف الفئة
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categories.index');
    }
    public function searchForm()
    {
        // Fetch all categories from the database
        $categories = Category::all();

        // Define static locations (or fetch from DB if locations are dynamic)
        $locations = [
            'Amman',
            'Irbid',
            'Salt',
            'Ajloun',
            'Aqaba',
            'Ma\'an',
            'Madaba',
            'Zarqa\'a',
            'Almafraq',
            'Altafila',
            'Alkarak',
            'Jarash'
        ];

        return view('search', compact('categories', 'locations'));
    }
    public function search(Request $request)
    {
        // Retrieve search inputs
        $keyword = $request->input('keyword');
        $subcategoryId = $request->input('subcategory');
        $location = $request->input('address');

        // Query items based on the filters
        $query = Item::query();

        // Filter by keyword in title or description
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('description', 'LIKE', '%' . $keyword . '%');
            });
        }

        // Filter by subcategory
        if ($subcategoryId) {
            $query->where('subcategory_id', $subcategoryId);
        }

        // Filter by location (address is in the 'users' table)
        if ($location) {
            $query->whereHas('TheUser', function ($q) use ($location) {
                $q->where('address', 'LIKE', '%' . $location . '%');
            });
        }

        // Get the filtered items
        $items = $query->get();

        // Retrieve all categories and subcategories for the category page
        $categories = Category::with('subcategories')->get();

        // Return the filtered items to the category view
        return view('category', compact('items', 'categories'));
    }
    public function displayCategories(Request $request)
    {

        $query = Item::query();

        // البحث عن العناصر باستخدام عنوان العنصر
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // فرز العناصر بناءً على الاختيار (الأحدث أو الشعبية)
        if ($request->has('sort')) {
            if ($request->sort == 'newest') {
                $query->orderBy('created_at', 'desc'); // عرض الأحدث أولاً
            } elseif ($request->sort == 'popular') {
                // هنا يمكنك تنفيذ منطق عرض العناصر الأكثر شعبية (حسب عدد المشاهدات أو التقييم)
                $query->orderBy('views', 'desc'); // على سبيل المثال
            }
        } else {
            // الفرز الافتراضي
            $query->orderBy('created_at', 'desc'); // الافتراضي الأحدث أولاً
        }

        $items = $query->get();
        $categories = Category::with('subcategories.items')->get();

        return view('category', compact('items', 'categories'));
    }
}
