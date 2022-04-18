<?php

namespace Modules\Contact\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Favorite
 * @package Modules\Favorite\Models
 *
 * @property int $id
 * @property int $contact_id
 *
 * @property Contact $contact
 */
class Favorite extends Model
{
    public $timestamps = false;

    public $table = 'contact_favorites';

    protected $fillable = [
        'contact_id',
    ];

    public function contact(): BelongsTo
    {
        return $this->belongsTo(Contact::class);
    }
}
