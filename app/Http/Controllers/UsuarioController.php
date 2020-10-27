<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usuario;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app',['usuarios' => Usuario::all()]);
    }


    public function read_usuarios(Request $request,$estado)
    {
        $usarios = DB::select("CALL read_usuarios (?,?)",[$estado,$request->usuario]);
        return response()->json(['status' => "success", 'data' => $usarios]);
    }

    public function update_estado(Request $request)
    {
        return $request->estado;
    }


    public function createPDF($estado) {
        $data =  DB::select("CALL reporte (?)",[$estado]);
        view()->share('usuarios',$data);
        $pdf = PDF::loadView('pdf_view', $data);
        return $pdf->download('pdf_file.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $fecha = explode('/',$request->fecha_creacion);
        $fecha = $fecha[2].'-'.$fecha[0].'-'.$fecha[1];

        $fecha_actual = strtotime(date("d-m-Y"));
        $fecha_entrada = strtotime($fecha);

        $msm = "";
        $estado  = "";

        if($fecha_actual > $fecha_entrada)
        {
            return response()->json(['status' => "error", 'alert' => 'la fecha seleccionada no puede ser menor a la actual']);
        }else if ( $fecha_actual == $fecha_entrada ){
            $usarios = DB::select("CALL insert_usuario (?,?,?)",[$request->name_usuario,'1',$fecha]);
            if ( $usarios[0]->response == 0 ) {
                return response()->json(['status' => "error", 'alert' => 'El usuario ya se encuentra registrado']);
            } else {
                return response()->json(['status' => "success", 'alert' => 'El usuario se registro correctamente']);
            }

        }else if ( $fecha_actual < $fecha_entrada ) {
            $usarios = DB::select("CALL insert_usuario (?,?,?)",[$request->name_usuario,'0',$fecha]);
            if ( $usarios[0]->response == 0 ) {
                return response()->json(['status' => "error", 'alert' => 'El usuario ya se encuentra registrado']);
            } else {
                return response()->json(['status' => "success", 'alert' => 'El usuario se registro correctamente']);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        foreach ( $request->ids as $id_usuario) DB::select("CALL update_estado (?,?)",[$id_usuario,$id]);
        return response()->json(['status' => "success"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $usarios = DB::select("CALL update_usuario (?,?)",[$request->name_usuario_editar,$id]);
        if ( $usarios[0]->response == 0 )
            return response()->json(['status' => "error", 'alert' => 'El usuario ya se encuentra registrado']);
        else
            return response()->json(['status' => "success", 'alert' => 'El usuario se modifico correctamente']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
