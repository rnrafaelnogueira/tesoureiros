<?php

namespace App\Models;


use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model implements TableInterface
{
    protected $table = 'despesa';
    public $timestamps = true;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','nome','id_user','id_categoria','valor_fixo', 'data_recibo','mes','ano'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['Nome', 'Categoria'];
    }

    public function user_join()
    {
        return $this->belongsTo(\App\User::class, 'id_user');
    }
    public function categoria_join()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function sum_valor_categoria($categoria,$mes,$ano){
        return number_format( Despesa::where('ano', $ano)->where('mes', $mes)->where('id_categoria',$categoria)->sum('valor_fixo') , 2, ',', '.');
    }

    public function sum_valor_categoria_anual($categoria,$ano){
        return number_format( Despesa::where('ano', $ano)->where('id_categoria',$categoria)->sum('valor_fixo') , 2, ',', '.');
    }


    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header){
            case 'Nome':
                return $this->nome;
            case 'Categoria':
                return $this->categoria_join()->first()->nome;
        }
    }
}
