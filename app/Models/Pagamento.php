<?php

namespace App\Models;


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
        'id', 'valor', 'mes','id_despesa','data_cadastro'
    ];


    /**
     * A list of headers to be used when a table is displayed
     *
     * @return array
     */
    public function getTableHeaders()
    {
        return ['#', 'Valor','Mês','Despesa','Data'];
    }

    public function mes_join()
    {
        return $this->belongsTo(Mes::class, 'mes');
    }
    public function despesa_join()
    {
        return $this->belongsTo(Despesa::class, 'id_despesa');
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
            case 'Valor':
                return $this->valor;
            case 'Mês':
                return $this->mes_join()->first()->descricao;
            case 'Despesa':
                return $this->despesa_join()->first()->nome;
            case 'Data':
                return $this->data_cadastro;
        }
    }
}
