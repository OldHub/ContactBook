<?php

namespace Modules\Contact\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Class Contacts
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $phone
 * @property Favorite $favorite
 */
class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'user_id',
    ];

    public function favorite(): HasOne
    {
        return $this->hasOne(Favorite::class);
    }
}
