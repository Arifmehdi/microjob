<?php

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class ProveNoteDTO extends DataTransferObject
{
    public $text;
    public $user_id;
    public $work_id;

    public static function createFromRequest(Request $request): ProveNoteDTO
    {
        return new self([
            'user_id' => Auth::id(),
            'work_id' => $request->input('prove_id'),
            'text'    => $request->input('message'),
        ]);
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'work_id' => $this->work_id,
            'text'    => $this->text,
        ];
    }
}
