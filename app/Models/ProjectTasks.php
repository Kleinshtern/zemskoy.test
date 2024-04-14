<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @namespace App\Models
 * @class ProjectTasks
 *
 * @property-read integer $id
 * @property integer $project_id
 * @property string $title
 * @property string $description
 * @property integer $responsible_id
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon $deleted_at
 *
 * @property-read Projects $project
 * @property-read User $responsible
 * @property-read TaskTracker $trackedTime
 */
class ProjectTasks extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'project_tasks';
    protected $guarded = ['id'];
    protected $fillable = [
        'project_id',
        'title',
        'description',
        'responsible_id'
    ];

    public function project(): HasOne
    {
        return $this->hasOne(Projects::class, 'id', 'project_id');
    }

    public function responsible(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'responsible_id');
    }

    public function trackedTime(): HasMany
    {
        return $this->hasMany(TaskTracker::class, 'task_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d.m.Y H:i:s');
    }
}
