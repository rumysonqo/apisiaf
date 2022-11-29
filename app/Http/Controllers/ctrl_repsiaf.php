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
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as devengado, sum(pim)-sum(devengado) as saldo, (sum(devengado)/sum(pim))*100 as ejec'))
                ->get();
        return $siaf;
    }
    public function ejec_fuente(){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_fuente, fuente, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->groupBy('cod_fuente','fuente')
                ->orderBy('cod_fuente')
                ->get();
        return $siaf;
    }

    public function ejec_generica(){
        $siaf=DB::table('rep_siaf')
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
    public function genericas(){
        $gen=mdl_repsiaf::select('cod_generica','generica')->distinct()->orderBy('cod_generica')->get('cod_generica');
        return $gen;
    }
    public function fuentes(){
        $fte=mdl_repsiaf::select('cod_fuente','fuente')->distinct()->orderBy('cod_fuente')->get('cod_fuente');
        return $fte;
    }

    public function totales_programa($prg){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as devengado, sum(pim)-sum(devengado) as saldo, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->get();
        return $siaf;
    }

    public function ejec_fuente_programa($prg){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_fuente, fuente, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->groupBy('cod_fuente','fuente')
                ->orderBy('cod_fuente')
                ->get();
        return $siaf;
    }

    public function ejec_generica_programa($prg){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_generica, generica, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(devengado) as deven, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->groupBy('cod_generica','generica')
                ->orderBy('cod_generica')
                ->get();
        return $siaf;
    }

    public function ejec_meta($prg){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_meta, meta, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(pim)-sum(certificado) as sal_cer, sum(devengado) as deven, sum(pim)-sum(devengado) as sal_dev, (sum(devengado)/sum(pim))*100 as ejec, max(meta_anual) as meta_fisica, max(avance_anual) as avance, max(avance_anual)/max(meta_anual)*100 as porc_avance'))
                ->where('cod_programa','=',$prg)
                ->groupBy('cod_meta','meta')
                ->orderBy('cod_meta')
                ->get();
        return $siaf;
    }

    public function ejec_meta_gen_fte($prg, $gen, $fte){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_meta, meta, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(pim)-sum(certificado) as sal_cer, sum(devengado) as deven, sum(pim)-sum(devengado) as sal_dev, (sum(devengado)/sum(pim))*100 as ejec, max(meta_anual) as meta_fisica, max(avance_anual) as avance, max(avance_anual)/max(meta_anual)*100 as porc_avance'))
                ->where('cod_programa','=',$prg)
                ->where('cod_generica','=',$gen)
                ->where('cod_fuente','=',$fte)
                ->groupBy('cod_meta','meta')
                ->orderBy('cod_meta')
                ->get();
        return $siaf;
    }

    public function ejec_fte_gen($fte){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_fuente, fuente, generica, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(pim)-sum(certificado) as sal_cert, sum(devengado) as deven, sum(pim)-sum(devengado) as sal_dev, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_fuente','=',$fte)
                ->groupBy('cod_fuente','fuente','generica')
                ->orderBy('cod_fuente')
                ->get();
        return $siaf;
    }

    public function ejec_prg_fte_gen($prg, $fte){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_programa, cod_fuente, fuente, generica, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(pim)-sum(certificado) as sal_cert, sum(devengado) as deven, sum(pim)-sum(devengado) as sal_dev, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->where('cod_fuente','=',$fte)
                ->groupBy('cod_programa','cod_fuente','fuente','generica')
                ->orderBy('cod_fuente')
                ->get();
        return $siaf;
    }

    public function ejec_prg_gen_fte_espec($prg,$gen,$fte){
        $siaf=DB::table('rep_siaf')
                ->select(DB::raw('cod_meta, meta, especifica, sum(pia) as pia, sum(pim) as pim, sum(certificado) as certif, sum(pim)-sum(certificado) as sal_cer, sum(devengado) as deven, sum(pim)-sum(devengado) as sal_dev, (sum(devengado)/sum(pim))*100 as ejec'))
                ->where('cod_programa','=',$prg)
                ->where('cod_generica','=',$gen)
                ->where('cod_fuente','=',$fte)
                ->groupBy('cod_meta','meta','especifica')
                ->orderBy('cod_meta')
                ->get();
        return $siaf;
    }



}
