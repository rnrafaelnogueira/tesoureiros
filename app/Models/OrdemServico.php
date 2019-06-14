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
        'id','id_cliente','id_paciente','id_servico','id_situacao','id_grupo_kanban', 'data_entrada', 'data_previsao_entrega','quantidade', 'cor','hora_previsao_entrega'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Cliente','Paciente','Serviço', 'Situação', 'Endereço', 'Grupo Kanban', 'Data Entrada', 'Data Previsão Entrega','Hora Previsão de Entrega','Quantidade','Valor Unitário','Cor'];
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
            case '#':
                return $this->id;
            case 'Cliente':
                return $this->cliente_join()->first()->nome;
            case 'Paciente':
                return $this->paciente_join()->first()->nome;
            case 'Serviço':
                return $this->servico_join()->first()->nome;
            case 'Situação':
                return $this->situacao_join()->first()->nome;
            case 'Endereço':
                return $this->cliente_join()->first()->endereco;
            case 'Grupo Kanban':
                return $this->grupo_kanban_join()->first()->nome;
            case 'Data Entrada':
                return $this->data_entrada;
            case 'Data Previsão de Entrega':
                return $this->data_previsao_entrega;
            case 'Hora Previsão de Entrega':
                return $this->hora_previsao_entrega;
            case 'Quantidade':
                return $this->quantidade;
            case 'Valor Unitário':
                return $this->cliente_servico_valor_join()->first();
          
            case 'Cor':
                return $this->cor;
        }
    }

}
