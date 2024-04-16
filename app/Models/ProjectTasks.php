<?php

namespace App\Models;

use App\Models\Directories\TaskTypes;
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
 * @property string $stage
 * @property integer $type_id
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon $deleted_at
 *
 * @property-read Projects $project
 * @property-read User $responsible
 * @property-read User $creator
 * @property-read TaskTypes $taskType
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
        'responsible_id',
        'creator_id',
        'stage',
        'type_id'
    ];

    const STAGE_TODO = 'todo';
    const STAGE_IN_PROGRESS = 'inprogress';
    const STAGE_DONE = 'done';

    const STAGES = [
        self::STAGE_TODO => 'Ожидает выполнения',
        self::STAGE_IN_PROGRESS => 'В процессе выполнения',
        self::STAGE_DONE => 'Завершена'
    ];

    public function project(): HasOne
    {
        return $this->hasOne(Projects::class, 'id', 'project_id');
    }

    public function responsible(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'responsible_id')
            ->select('id', 'name', 'email');
    }

    public function creator(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id')
            ->select('id', 'name', 'email');
    }

    public function taskType(): HasOne
    {
        return $this->hasOne(TaskTypes::class, 'id', 'type_id')
            ->select('id', 'display_name', 'hex_color');
    }

    public function trackedTime(): HasMany
    {
        return $this->hasMany(TaskTracker::class, 'task_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d.m.Y');
    }
}
