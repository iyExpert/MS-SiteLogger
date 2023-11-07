<?php

namespace App\Http\Resources;

use App\Models\SiteLogger;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class SiteLoggerResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  Request $request
   * @return array
   */
  public function toArray($request): array
  {
    /* @var SiteLogger|self $this  */
    return [
      'id' => $this->_id,
      'title' => $this->title,
      'action' => $this->action,
      'tags' => $this->tags,
      'user_id' => $this->user_id,
      'user_name' => $this->user_name,
      'ip' => $this->ip,
      'type' => $this->type,
      'log' => $this->log,
      'date' => $this->date,
      'correlation_id' => $this->correlation_id
    ];
  }
}
