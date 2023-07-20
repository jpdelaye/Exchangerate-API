<?php

namespace App\Models;

use App\Models\BaseModel;

class CryptocurrenciesModel extends BaseModel
{
    protected $table      = 'cryptocurrency';
    protected $primaryKey = 'id';

    // protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    // protected $useSoftDeletes = false;
    
    protected $allowedFields =    ['codeID', 'symbol',	'price_usd',	'price_mxn',	'percent_change_24h', 'percent_change_1h',	'platform',	'token_address',	'name',		'last_updated']	
;
 

    
  
  
   
}