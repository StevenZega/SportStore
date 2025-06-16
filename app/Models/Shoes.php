<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use OpenApi\Annotations as OA;

/** 
* Class Shoes
*
* @author Steven <steven.422024020@civitas.ukrida.ac.id>
*
* @OA\Schema(
*     description="Shoes model",
*     title="Shoes model",
*     required={"title", "author"},
*     @OA\Xml(
*         name="Shoes"
*     )
* )
*/

class Shoes extends Model
{
    use SoftDeletes;

    protected $table = 'shoes';

    protected $fillable = [
        'type',
        'price',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }
}
