<?php

namespace App\DTO;

use App\Models\Category;
use App\Services\FileManagementServices;
use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class CategoryDTO extends DataTransferObject
{
    public $name;
    public $parent_id;
    public $min_cost_per_work;
    public $description;
    public $status;
    public $image;

    public static function createFromRequest(Request $request, Category $category = null): CategoryDTO
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $oldImage  = ($category && $category->image) ? $category->image : null;
            $imageName = (new FileManagementServices())->updateImage($file, $oldImage);
        }

        $data = [
            'name'              => $request->input('name'),
            'parent_id'         => $request->input('parent_id'),
            'min_cost_per_work' => $request->input('min_cost_per_work'),
            'description'       => $request->input('description'),
            'status'            => $request->filled('status'),
            'image'             => $imageName,
        ];
        return new self($data);
    }

    public function toArray(): array
    {
        $data = [
            'name'              => $this->name,
            'parent_id'         => $this->parent_id,
            'min_cost_per_work' => $this->min_cost_per_work,
            'description'       => $this->description,
            'status'            => $this->status,
        ];
        if ($this->image) {
            $data['image'] = $this->image;
        }
        return $data;
    }
}
