<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\mdl_repsiaf;

class ctrl_repsiaf extends Controller
{
    //
    public function mostrar_todo(){
        $kits=mdl_repsiaf::limit(100)->get();
        return $kits;
    }
    public function totales(){
        $kits=DB::table('repsiaf')
                ->select(DB::raw('sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as devengado, sum(pim)-sum(devengado) as saldo, (sum(devengado)/sum(pim))*100 as ejec'))
                ->get();
        return $kits;
    }
    public function ejec_fuente(){
        $kits=DB::table('repsiaf')
                ->select(DB::raw('cod_fuente, fuente, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->groupBy('cod_fuente','fuente')
                ->orderBy('cod_fuente')
                ->get();
        return $kits;
    }

}
