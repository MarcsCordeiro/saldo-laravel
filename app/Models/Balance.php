<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;
    
    public function deposit($value):array{
        
        $this->amount += $value;
        $deposit = $this->save();
        
        if($deposit)
            return[
            'success' => 'true',
            'message' => 'Sucesso ao carregar'
        ];
        
        return[
            'success' => 'false',
            'message' => 'Falha ao carregar'
        ];
    }
}
