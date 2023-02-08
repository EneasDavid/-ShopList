<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'categoria',
        'limiteLista',
        'valorTotal',
        'quantidadeItem',
        'porcetagemLimite',
        'finaizada',
        'participantes'
    ];
    protected $casts = ['participantes'=>'array'];

    public function user(){
        return $this->belongsTo('App\Models\User');
        //belonsTO = Pertecem a alguém; logo um usuario só vai poder pertencer a um evente
    }
    public function users(){
        return $this->belongsToMany('App\Models\User');
    }
}
