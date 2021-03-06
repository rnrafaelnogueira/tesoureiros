<?php

namespace App\Models;


use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class ClienteServicoValor extends Model implements TableInterface
{
    protected $table = 'cliente_servico_valor';
    public $timestamps = true;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','id_cliente','id_servico','valor'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Cliente','Serviço', 'Valor'];
    }

    public function cliente_join()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function servico_join()
    {
        return $this->belongsTo(Servico::class, 'id_servico');
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
            case 'Serviço':
                return $this->servico_join()->first()->nome;
            case 'Valor':
                return $this->valor;
        }
    }
}
