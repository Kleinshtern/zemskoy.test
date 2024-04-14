<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Console\View\Components\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @namespace App\Models
 * @class Projects
 *
 * @property-read integer $id
 * @property string $title
 * @property string $description
 * @property string $img
 * @property integer $creator_id
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon $deleted_at
 *
 * @property-read User $creator
 * @property-read ProjectTasks $tasks
 */
class Projects extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'projects';
    protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'description',
        'img',
        'creator_id'
    ];

    public function creator() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'creator_id');
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(ProjectTasks::class, 'project_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('d.m.Y H:i:s');
    }
}
