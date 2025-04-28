<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Livre
 * 
 * @property int $id
 * @property string|null $titre
 * @property float|null $annee
 * @property string|null $auteur
 * @property string|null $description
 * @property string|null $longuedescription
 * @property string|null $fichier
 * @property Carbon|null $date
 * @property float|null $prix
 * @property string|null $devise
 * @property float|null $reduction
 * @property string|null $aproposauteur
 * @property string|null $affiche
 *
 * @package App\Models
 */
class Livre extends Model
{
	protected $table = 'livre';
	public $timestamps = false;

	protected $casts = [
		'annee' => 'float',
		'date' => 'datetime',
		'prix' => 'float',
		'reduction' => 'float'
	];

	protected $fillable = [
		'titre',
		'annee',
		'auteur',
		'description',
		'longuedescription',
		'fichier',
		'date',
		'prix',
		'devise',
		'reduction',
		'aproposauteur',
		'affiche'
	];
}
