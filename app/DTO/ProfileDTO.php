<?php

namespace App\DTO;

use App\Services\FileManagementServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class ProfileDTO extends DataTransferObject
{
    public $name;
    public $email;
    public $image;

    public static function createFromRequest(Request $request): ProfileDTO
    {
        $imageName = null;
        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $oldImage  = Auth::user()->image ?? null;
            $imageName = (new FileManagementServices())->updateImage($file, $oldImage);
        }
        $data = [
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'image' => $imageName,
        ];
        return new self($data);
    }

    public function toArray(): array
    {
        $data = [
            'name'  => $this->name,
            'email' => $this->email,
        ];
        if ($this->image) {
            $data['image'] = $this->image;
        }
        return $data;
    }

}
