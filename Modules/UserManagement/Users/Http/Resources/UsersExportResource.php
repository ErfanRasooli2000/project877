<?php

namespace Modules\UserManagement\Users\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UsersExportResource extends JsonResource
{
    public static $headers = [
        'شناسه',
        'نام',
        'نام خانوادگی',
        'شماره موبایل',
        'ایمیل',
        'تاریخ ایجاد',
        'تاریخ به روز رسانی',
    ];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'شناسه' => $this->id,
            'نام' => $this->first_name,
            'نام خانوادگی' => $this->last_name,
            'شماره موبایل' => $this->phone_number,
            'ایمیل' => $this->email,
            'تاریخ ایجاد' => verta($this->created_at)->format('Y-m-d H:i:s'),
            'تاریخ به روز رسانی' => verta($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
