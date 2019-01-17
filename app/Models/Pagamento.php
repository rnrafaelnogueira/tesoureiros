<?php

namespace App\Models;

https://play.google.com/apps/internaltest/4699645331209567981

use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model implements TableInterface
{
    protected $table = 'pagamento';
    public $timestamps = true;
    protected $guarded = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','data_recibo','descricao', 'valor', 'mes','id_despesa','data_cadastro','ano'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#','Data','Descrição','Valor', 'Mês', 'Despesa', 'Data Cadastro'];
    }

    public function mes_join()
    {
        return $this->belongsTo(Mes::class, 'mes');
    }
    public function despesa_join()
    {
        return $this->belongsTo(Despesa::class, 'id_despesa');
    }
    
    public function sum_valor_mes($mes,$ano){
        return number_format( Pagamento::where('ano', $ano)->where('mes', $mes)->sum('valor') , 2, ',', '.');
    }

    public function sum_valor_ano($ano){
        return Pagamento::where('ano', $ano)->sum('valor');
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
            case 'Data':
                return $this->data_recibo;
            case 'Descrição':
                return $this->descricao;
            case 'Valor':
                return $this->valor;
            case 'Mês':
                return $this->mes_join()->first()->descricao;;
            case 'Despesa':
                return $this->despesa_join()->first()->nome;
            case 'Data Cadastro':
                return $this->data_cadastro;
        }
    }
}
