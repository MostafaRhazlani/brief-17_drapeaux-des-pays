<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Country",
 *     required={"country_name", "capital", "population", "region", "currency", "language", "flag"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="country_name", type="string", example="Morocco"),
 *     @OA\Property(property="capital", type="string", example="Rabat"),
 *     @OA\Property(property="population", type="integer", example=37000000),
 *     @OA\Property(property="region", type="string", example="North Africa"),
 *     @OA\Property(property="currency", type="string", example="MAD"),
 *     @OA\Property(property="language", type="string", example="Arabic"),
 *     @OA\Property(property="flag", type="string", example="https://example.com/flags/morocco.png")
 * )
 */

class Country extends Model
{
    protected $guarded = [];
}
