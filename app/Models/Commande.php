<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Commande
 * 
 * @property int $id
 * @property int $users_id
 * @property string|null $livre
 * @property int|null $livre_id
 * @property string|null $data
 * @property Carbon|null $date
 * @property string|null $myref
 * 
 * @property User $user
 *
 * @package App\Models
 */
class Commande extends Model
{
	protected $table = 'commande';
	public $timestamps = false;

	protected $casts = [
		'users_id' => 'int',
		'livre_id' => 'int',
		'date' => 'datetime'
	];

	protected $fillable = [
		'users_id',
		'livre',
		'livre_id',
		'data',
		'date',
		'myref'
	];

	public function user()
	{
		return $this->belongsTo(User::class, 'users_id');
	}
}
