<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Spatie\DataTransferObject\DataTransferObject;

class UserDTO extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;
    public $image;
    public $age;
    public $about;
    public $status;
    public $is_deletable;
    public $is_admin;
    public $balance;

    public static function createFromRequest(Request $request): UserDTO
    {
        $data = [
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'balance'      => $request->input('balance'),
            'password'     => $request->filled('password') ? bcrypt($request->input('password')) : '',
            'is_deletable' => true,
            'status'       => $request->filled('status'),
            'is_admin'     => $request->filled('is_admin'),
        ];
        return new self($data);
    }

    public function toArray(): array
    {
        $data = [
            'name'         => $this->name,
            'email'        => $this->email,
            'is_deletable' => $this->is_deletable,
            'status'       => $this->status,
            'is_admin'     => $this->is_admin,
        ];
        if ($this->balance) {
            $data['balance'] = $this->balance;
        }
        if ($this->password) {
            $data['password'] = $this->password;
        }
        return $data;
    }
}
