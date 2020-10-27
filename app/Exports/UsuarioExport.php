<?php

namespace App\Exports;

use App\Usuario;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use PDO;

class UsuarioExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection


    */
    public $estado;

    public function __construct(int $estado)
    {
        $this->estado = $estado;
    }


    public function collection()
    {
        $consulta = DB::select("CALL reporte(?)",[$this->estado]);
        return collect($consulta);
    }
}
