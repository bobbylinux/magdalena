<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Voto extends BaseModel
{
    protected $table = "ts001_voti";


    protected $primaryKey = 'c_vot';

    /**
     * The function for store in database from view
     *
     * @data array
     */
    public function store($data)
    {
        $this->c_soc = $data['c_soc'];
        $this->c_soc_vot = $data['c_soc_vot'];
        $this->d_vot = $data['d_vot'];
        $this->c_rif = $data['c_rif'];
        self::save();
    }


    public function getVotiPerSocio($codiceSocio, $dataRif)
    {
        return $this->where('c_rif', '=', $dataRif)->where('c_soc', '=', $codiceSocio)->get();
    }

    public function getClassifica($dataRif)
    {
        return DB::table('ts001_voti')->join('ta001_soci', 'ts001_voti.c_soc_vot', '=', 'ta001_soci.c_soc')->join('ts002_dat_rif', 'ts002_dat_rif.c_rif', '=', 'ts001_voti.c_rif')->where('ts001_voti.c_rif', '=', $dataRif)->groupby("c_bdg","t_cgn","t_nom")->select(array("c_bdg","t_cgn","t_nom",DB::raw('COUNT(ts001_voti.c_soc_vot) as voti')))->orderby("voti","desc")->orderby("t_cgn")->orderby("t_nom")->paginate(10);
    }

    public function getVotanti($dataRif) {
        return DB::table('ta001_soci')->leftJoin('ts001_voti','ts001_voti.c_soc','=','ta001_soci.c_soc')->select(array(DB::raw('count(distinct ta001_soci.c_soc) as totali'),DB::raw('getVotantiTotali('.$dataRif.') as votanti'),DB::raw('getAstenutiTotali('.$dataRif.') as astenuti')))->first();
    }
    public function getVotantiPerCDC($dataRif) {
        return DB::table('ta001_soci')->join('ta003_cdc', 'ta003_cdc.c_cdc', '=', 'ta001_soci.c_cdc')->leftJoin('ts001_voti','ts001_voti.c_soc','=','ta001_soci.c_soc')->groupby("ta003_cdc.c_cdc","ta003_cdc.t_sed")->select(array("ta003_cdc.c_cdc","ta003_cdc.t_sed",DB::raw('count(distinct ta001_soci.c_soc) as totali'),DB::raw('getVotantiPerCDC('.$dataRif.',ta003_cdc.c_cdc) as votanti'),DB::raw('getAstenutiPerCDC('.$dataRif.',ta003_cdc.c_cdc) as astenuti')))->orderby("ta003_cdc.t_sed")->paginate(10);
    }

    public function getVotantiPerSede($dataRif) {
        return DB::table('ta001_soci')->join('ta002_sedi', 'ta002_sedi.c_sed', '=', 'ta001_soci.c_sed')->leftJoin('ts001_voti','ts001_voti.c_soc','=','ta001_soci.c_soc')->groupby("ta002_sedi.c_sed","ta002_sedi.t_sed")->select(array("ta002_sedi.c_sed","ta002_sedi.t_sed",DB::raw('count(distinct ta001_soci.c_soc) as totali'),DB::raw('getVotantiPerSede('.$dataRif.',ta002_sedi.c_sed) as votanti'),DB::raw('getAstenutiPerSede('.$dataRif.',ta002_sedi.c_sed) as astenuti')))->orderby("ta002_sedi.t_sed")->paginate(10);
    }

    public function searchVotantiPerCDC($dataRif, $key) {
        return DB::table('ta001_soci')->join('ta003_cdc', 'ta003_cdc.c_cdc', '=', 'ta001_soci.c_cdc')->leftJoin('ts001_voti','ts001_voti.c_soc','=','ta001_soci.c_soc')->where('ta003_cdc.c_cdc','ilike',$key)->orWhere('ta003_cdc.t_sed','ilike', $key)->groupby("ta003_cdc.c_cdc","ta003_cdc.t_sed")->select(array("ta003_cdc.c_cdc","ta003_cdc.t_sed",DB::raw('count(distinct ta001_soci.c_soc) as totali'),DB::raw('getVotantiPerCDC('.$dataRif.',ta003_cdc.c_cdc) as votanti'),DB::raw('getAstenutiPerCDC('.$dataRif.',ta003_cdc.c_cdc) as astenuti')))->orderby("ta003_cdc.t_sed")->paginate(10);
    }
}
