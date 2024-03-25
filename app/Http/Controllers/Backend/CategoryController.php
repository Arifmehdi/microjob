<?php

namespace App\Http\Controllers\Backend;

use App\DTO\CategoryDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\CategoryRequest;
use App\Models\Category;
use App\Models\Job;
use App\Services\FileManagementServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::query()->with([
            'children' => function ($query) {
                return $query->orderByDesc('created_at');
            },
        ])->where(['parent_id' => null])->orderByDesc('created_at')->get();
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::query()->where(['parent_id' => null])->orderByDesc('created_at')->get();
        return view('backend.category.create', compact('categories'));
    }


    public function store(CategoryRequest $request)
    {
        $categoryRequest = CategoryDTO::createFromRequest($request);
        try {
            $category = Category::query()->create($categoryRequest->toArray());
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Category Added!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Add Category!'
            ]);
        }
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit(Category $category)
    {
        $categories = Category::query()->where(['parent_id' => null])->where('id', '!=', $category->id)->orderByDesc('created_at')->get();
        return view('backend.category.edit', compact('category', 'categories'));
    }


    public function update(CategoryRequest $request, Category $category)
    {
        $categoryRequest = CategoryDTO::createFromRequest($request, $category);
        $categoryData    = $categoryRequest->toArray();
        if (!$category->is_deletable) {
            $categoryData['status'] = true;
        }
        if ($category->children()->count() > 0 && isset($categoryData['parent_id'])) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'This Category has children, SO You can\'t set parent!'
            ]);
            return redirect()->route('admin.categories.edit', $category->id);
        }
        try {
            $category->update($categoryData);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Category Updated!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Update Category!'
            ]);
        }
        return redirect()->route('admin.categories.edit', $category->id);
    }


    public function destroy(Category $category)
    {
        if (!$category->is_deletable) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Unable To Delete Category!'
            ]);
            return redirect()->route('admin.categories.index');
        }
        try {
            (new FileManagementServices())->deleteImage($category->image ?? '');
            DB::transaction(function () use ($category) {
                $default_cat = Category::query()->where(['is_deletable' => false])->first();
                if ($default_cat) {
                    Job::query()->where(['category_id' => $category->id])->update(['category_id' => $default_cat->id]);
                }
                $category->delete();
            });
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => 'Category Deleted!'
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => 'Failed To Delete Category!'
            ]);
        }
        return redirect()->route('admin.categories.index');
    }
}
