<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function create($model, $status, $modelName = 'Job')
    {
        $statusText = $status ? 'Approved' : 'Rejected';
        Notification::query()->create([
            'user_id' => $model->user_id,
            'title'   => $modelName.' '.$statusText,
            'details' => 'Your '.$modelName.' ID : '.$model->id.' '.$statusText,
        ]);
    }

    public function createJobStatusNotification($job, $status)
    {
        $statusText = $status ? 'Approved' : 'Rejected';
        Notification::query()->create([
            'user_id' => $job->user_id,
            'title'   => 'Job '.$statusText,
            'details' => 'Your Job ID : '.$job->id.' '.$statusText,
        ]);
    }

    public function createReportStatus($report, $status)
    {
        $statusText = $status ? 'Approved' : 'Rejected';
        $reportText = $status ? 'Rejected' : 'Pending';
        Notification::query()->create([
            'user_id' => $report?->work?->job?->user_id,
            'title'   => 'Report '.$statusText,
            'details' => 'Your reported ID : '.$report?->id.' '.$statusText.'. So, The work is now '.$reportText,
        ]);
    }
}
