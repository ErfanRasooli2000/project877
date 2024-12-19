<?php

namespace Modules\Admin\AdminManagement\Admins\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminsListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->first_name . " " . $this->last_name,
            'phone_number' => $this->phone_number,
            'email' => $this->email,
            'created_at' => verta($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => verta($this->updated_at)->format('Y-m-d H:i:s'),
        ];
    }
}
