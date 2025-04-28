<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Categorieblog
 * 
 * @property int $id
 * @property string|null $categorie
 * 
 * @property Collection|Blog[] $blogs
 *
 * @package App\Models
 */
class Categorieblog extends Model
{
	protected $table = 'categorieblog';
	public $timestamps = false;

	protected $fillable = [
		'categorie'
	];

	public function blogs()
	{
		return $this->hasMany(Blog::class);
	}
}
