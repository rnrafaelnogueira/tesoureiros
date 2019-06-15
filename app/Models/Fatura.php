<?php

namespace App\Models;


use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;


class Fatura extends Model implements TableInterface
{
    protected $table = 'fatura';
    //public $timestamps = true;
    protected $guarded = [];
public static $rules = array();
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','id_cliente','referencia', 'data_geracao','enviada','baixada'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Cliente','Referência','Data Geração', 'Enviada', 'Baixada'];
    }

    public function cliente_join()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
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
            case 'Cliente':
                return $this->cliente_join()->first()->nome;
            case 'Referência':
                return $this->referencia;
            case 'Data Geração':
                return $this->data_geracao;
            case 'Enviada':
                return $this->enviada;
            case 'Baixada':
                return $this->baixada;
        }
    }

}
