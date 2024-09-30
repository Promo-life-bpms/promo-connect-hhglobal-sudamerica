<?php

namespace App\Models\Catalogo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'exchange_rates';

    protected $connection = 'mysql_catalogo';

    protected $fillable = ['currency_from','currency_to', 'rate'];


}
