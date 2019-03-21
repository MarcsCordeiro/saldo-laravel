<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    public $timestamps = false;
    
    public function deposit($value):array{
        $totalBefore = $this->amount ? $this->amount : 0;
        $this->amount += $value;
        $deposit = $this->save();
        
        $historic = auth()->user()->historics()->create([
           'type'           => 'I',
            'amount'        => $value, 
            'total_before'  => $totalBefore, 
            'total_after'   => $this->amount, 
            'date'          => date('Ymd'),
        ]);
        
        if($deposit && $historic)
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
