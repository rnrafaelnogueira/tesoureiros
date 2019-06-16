<?php

namespace App\Models;


use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class FaturaOrdemServico extends Model implements TableInterface
{
    protected $table = 'fatura_ordem_servico';
    public $timestamps = true;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','id_fatura','id_ordem_servico'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Fatura','Ordem Servico'];
    }

    public function fatura_join()
    {
        return $this->belongsTo(Fatura::class, 'id_fatura');
    }

    public function ordem_servico_join()
    {
        return $this->belongsTo(OrdemServico::class, 'id_ordem_servico');
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
            case 'Fatura':
                return $this->fatura_join()->first()->nome;
            case 'Ordem Serviço':
                return $this->ordem_servico_join()->first()->nome;
        }
    }
}
