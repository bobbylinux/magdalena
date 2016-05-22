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
        /*
            select c_bdg, t_cgn, t_nom, count(1)
            from ts001_voti
            inner join ta001_soci
            on ts001_voti.c_soc_vot = ta001_soci.c_soc
            inner join ts002_dat_rif
            on ts001_voti.c_rif = ts002_dat_rif.c_rif
            where ts001_voti.c_rif = 1
            group by c_bdg, t_cgn, t_nom;
        */
        return DB::table('ts001_voti')->join('ta001_soci', 'ts001_voti.c_soc_vot', '=', 'ta001_soci.c_soc')->join('ts002_dat_rif', 'ts002_dat_rif.c_rif', '=', 'ts001_voti.c_rif')->where('ts001_voti.c_rif', '=', $dataRif)->groupby("c_bdg","t_cgn","t_nom")->select(array("c_bdg","t_cgn","t_nom",DB::raw('COUNT(ts001_voti.c_soc_vot) as voti')))->orderby("voti","desc")->orderby("t_cgn")->orderby("t_nom")->get();
    }

    public function getVotantiPerCDC($dataRif) {
        /*
            select ta003_cdc.c_cdc, ta003_cdc.t_sed, count(distinct ta001_soci.c_soc) as totali, getVotantiPerCDC(1,ta003_cdc.c_cdc) as votanti, getAstenutiPerCDC(1,ta003_cdc.c_cdc) as astenuti
            from ta001_soci
            inner join ta003_cdc
            on ta001_soci.c_cdc = ta003_cdc.c_cdc
            left join ts001_voti
            on ta001_soci.c_soc = ts001_voti.c_soc
            group by ta003_cdc.c_cdc, ta003_cdc.t_sed
            order by c_cdc ;
         */
        return DB::table('ta001_soci')->join('ta003_cdc', 'ta003_cdc.c_cdc', '=', 'ta001_soci.c_cdc')->leftJoin('ts001_voti','ts001_voti.c_soc','=','ta001_soci.c_soc')->groupby("ta003_cdc.c_cdc","ta003_cdc.t_sed")->select(array("ta003_cdc.c_cdc","ta003_cdc.t_sed",DB::raw('count(distinct ta001_soci.c_soc) as totali'),DB::raw('getVotantiPerCDC(1,ta003_cdc.c_cdc) as votanti'),DB::raw('getAstenutiPerCDC(1,ta003_cdc.c_cdc) as astenuti')))->orderby("ta003_cdc.t_sed")->orderby("t_sed")->get();
    }

}
