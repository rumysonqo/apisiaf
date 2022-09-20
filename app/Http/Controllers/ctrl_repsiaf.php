<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mdl_repsiaf;

class ctrl_repsiaf extends Controller
{
    //
    public function mostrar_todo(){
        $siaf=mdl_repsiaf::limit(100)->get();
        return $siaf;
    }
    public function totales(){
        $siaf=DB::table('repsiaf')
                ->select(DB::raw('sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as devengado, sum(pim)-sum(devengado) as saldo, (sum(devengado)/sum(pim))*100 as ejec'))
                ->get();
        return $siaf;
    }
    public function ejec_fuente(){
        $siaf=DB::table('repsiaf')
                ->select(DB::raw('cod_fuente, fuente, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->groupBy('cod_fuente','fuente')
                ->orderBy('cod_fuente')
                ->get();
        return $siaf;
    }

    public function ejec_generica(){
        $siaf=DB::table('repsiaf')
                ->select(DB::raw('cod_generica, generica, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->groupBy('cod_generica','generica')
                ->orderBy('cod_generica')
                ->get();
        return $siaf;
    }

    public function programas(){
        $progs=mdl_repsiaf::select('cod_programa','programa')->distinct()->orderBy('cod_programa')->get('cod_programa');
        return $progs;
    }
    public function totales_programa($prg){
        $siaf=DB::table('repsiaf')
                ->select(DB::raw('sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as devengado, sum(pim)-sum(devengado) as saldo, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->get();
        return $siaf;
    }

    public function ejec_fuente_programa($prg){
        $siaf=DB::table('repsiaf')
                ->select(DB::raw('cod_fuente, fuente, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->groupBy('cod_fuente','fuente')
                ->orderBy('cod_fuente')
                ->get();
        return $siaf;
    }

    public function ejec_generica_programa($prg){
        $siaf=DB::table('repsiaf')
                ->select(DB::raw('cod_generica, generica, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->groupBy('cod_generica','generica')
                ->orderBy('cod_generica')
                ->get();
        return $siaf;
    }

}
