<?php

namespace App\Models;


use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model implements TableInterface
{
    protected $table = 'receita';
    public $timestamps = true;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','id_user', 'valor', 'mes','tipo_receita'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Membro', 'Valor', 'Mês', 'Tipo Receita'];
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
            case '#':
                return $this->id;
            case 'Membro':
                return $this->id_user;
            case 'Valor':
                return $this->valor;
            case 'Mês':
                return $this->mes;
            case 'Tipo Receita':
                return $this->tipo_receita;
        }
    }
}
