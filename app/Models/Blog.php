<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Blog
 * 
 * @property int $id
 * @property int $categorieblog_id
 * @property string|null $titre
 * @property string|null $description
 * @property string|null $text
 * @property string|null $image
 * @property string|null $fichier
 * @property Carbon|null $date
 * @property int|null $view
 * @property int|null $dl
 * 
 * @property Categorieblog $categorieblog
 *
 * @package App\Models
 */
class Blog extends Model
{
	protected $table = 'blog';
	public $timestamps = false;

	protected $casts = [
		'categorieblog_id' => 'int',
		'date' => 'datetime',
		'view' => 'int',
		'dl' => 'int'
	];

	protected $fillable = [
		'categorieblog_id',
		'titre',
		'description',
		'text',
		'image',
		'fichier',
		'date',
		'view',
		'dl'
	];

	public function categorieblog()
	{
		return $this->belongsTo(Categorieblog::class);
	}
}
