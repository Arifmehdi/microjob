<?php

namespace App\DTO;

use App\Models\Job;
use App\Services\FileManagementServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\DataTransferObject\DataTransferObject;

class JobDTO extends DataTransferObject {
    public $user_id;
    public $category_id;
    public $title;
    public $proof_details;
    public $num_of_worker;
    public $per_worker_amount;
    public $num_of_screenshot;
    public $estimated_day;
    public $estimated_cost;
    public $status;
    public $is_approved;
    public $image;
    public $steps;

    public static function createFromRequest( Request $request, Job $job = null ): JobDTO {
        $imageName = null;
        if ( $request->hasFile( 'image' ) ) {
            $file      = $request->file( 'image' );
            $oldImage  = ( $job && $job->image ) ? $job->image : null;
            $imageName = ( new FileManagementServices() )->updateImage( $file, $oldImage );
        }
        $workerCost     = floatval( $request->input( 'per_worker_amount' ) ) * floatval( $request->input( 'num_of_worker' ) );
        $screenshotCost = floatval( $request->input( 'num_of_screenshot' ) ) * floatval( ! empty( get_setting( 'screenshot_amount' ) ) ? get_setting( 'screenshot_amount' ) : 1 );

        $data           = [
            'user_id'           => Auth::id(),
            'category_id'       => $request->filled( 'category' ) ? $request->input( 'category' ) : $request->input( 'parent_category' ),
            'title'             => $request->input( 'title' ),
            'proof_details'     => $request->input( 'proof_details' ),
            'num_of_worker'     => $request->input( 'num_of_worker' ),
            'per_worker_amount' => $request->input( 'per_worker_amount' ),
            'num_of_screenshot' => $request->input( 'num_of_screenshot' ),
            'estimated_day'     => $request->input( 'estimated_day' ),
            'estimated_cost'    => floatval( $workerCost ) + floatval( $screenshotCost ),
            'status'            => $request->filled( 'status' ),
            'is_approved'       => null,
            'image'             => $imageName,
            'steps'             => $request->input( 'steps' )
        ];
        return new self( $data );
    }

    public function toArray(): array {
        $data = [
            'user_id'           => $this->user_id,
            'category_id'       => $this->category_id,
            'title'             => $this->title,
            'proof_details'     => $this->proof_details,
            'num_of_worker'     => $this->num_of_worker,
            'per_worker_amount' => $this->per_worker_amount,
            'num_of_screenshot' => $this->num_of_screenshot,
            'estimated_day'     => $this->estimated_day,
            'estimated_cost'    => $this->estimated_cost,
            'status'            => $this->status,
            'is_approved'       => $this->is_approved,
        ];
        if ( $this->image ) {
            $data['image'] = $this->image;
        }

        return $data;
    }
}
