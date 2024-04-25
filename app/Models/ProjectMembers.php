<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @namespace App\Models
 * @class ProjectMembers
 *
 * @property-read integer $id
 * @property integer $project_id
 * @property integer $member_id
 * @property string $member_type
 *
 * @property-read Projects $project
 * @property-read User $user
 * @property-read string $member_type_name
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon $deleted_at
 */
class ProjectMembers extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'project_members';
    protected $guarded = ['id'];
    protected $fillable = [
        'project_id',
        'user_id',
        'member_type'
    ];
    protected $appends = [
        'member_type_name',
        'avatar_image'
    ];

    const TYPE_ADMIN = 'admin';
    const TYPE_EXECUTOR = 'executor';
    const TYPE_QA = 'qa';

    const TYPES = [
        self::TYPE_ADMIN => 'Администратор проекта',
        self::TYPE_EXECUTOR => 'Исполнитель',
        self::TYPE_QA => 'QA-инженер',
    ];

    const AVATARS_PATHS = [
        self::TYPE_ADMIN => '/img/admin.png',
        self::TYPE_EXECUTOR => '/img/executor.png',
        self::TYPE_QA => '/img/qa.png',
    ];

    public function memberTypeName() : Attribute
    {
        return new Attribute(
            get: fn() => self::TYPES[$this->member_type] ?? "Неизвестная роль"
        );
    }

    public function avatarImage() : Attribute
    {
        return new Attribute(
            get: fn() => self::AVATARS_PATHS[$this->member_type] ?? "/img/avatar.png"
        );
    }

    public function project() : HasOne
    {
        return $this->hasOne(Projects::class, 'id', 'project_id');
    }

    public function user() : HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function createMember($values, $project)
    {
        $member = self::create([
            'project_id' => $project->id,
            'user_id' => $values['user_id'],
            'member_type' => ProjectMembers::TYPE_EXECUTOR,
        ]);
        $member->load('user');

        return $member;
    }
}
