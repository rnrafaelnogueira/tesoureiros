<?php

namespace App\Models;


use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;


class OrdemServico extends Model implements TableInterface
{
    protected $table = 'ordem_servico';
    //public $timestamps = true;
    protected $guarded = [];
    public static $rules = array();
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','id_cliente','id_paciente','id_servico','id_situacao','id_grupo_kanban', 'data_entrada', 'data_previsao_entrega','quantidade', 'cor','hora_previsao_entrega','valor_unitario','valor_total','valor_padrao'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['Ações','Grupo Kanban','Situação','Data Entrada','Paciente','Cliente','Quantidade','Valor Unitário','Valor Total'];
    }

    public function cliente_join()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function paciente_join()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function servico_join()
    {
        return $this->belongsTo(Servico::class, 'id_servico');
    }

    public function situacao_join()
    {
        return $this->belongsTo(Situacao::class, 'id_situacao');
    }

    public function grupo_kanban_join()
    {
        return $this->belongsTo(GrupoKanban::class, 'id_grupo_kanban');
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
            case 'Ações':
                return '';
            case 'Cliente':
                return $this->cliente_join()->first()->nome;
            case 'Paciente':
                return $this->paciente_join()->first()->nome;
            case 'Situação':
                return $this->situacao_join()->first()->nome;
            case 'Grupo Kanban':
                return $this->grupo_kanban_join()->first()->nome;
            case 'Data Entrada':
                return $this->data_entrada;
            case 'Quantidade':
                return $this->quantidade;
            case 'Valor Unitário':
                return $this->valor_unitario;
            case 'Valor Total':
                return $this->valor_total;
        }
    }

}
