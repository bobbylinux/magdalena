<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\CentroDiCosto;

class CDCController extends Controller
{


    protected $centroDiCosto;

    /**
     * Constructor for Dipendency Injection
     *
     * @return none
     *
     */
    public function __construct(CentroDiCosto $centroDiCosto) {
        $this->centroDiCosto = $centroDiCosto;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cdc = $this->centroDiCosto->orderby('c_cdc')->paginate(10);
        return view('cdc.index', compact("cdc"));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cdc.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = array(
            'c_cdc' => $request->c_cdc,
            't_sed' => $request->t_sed
        );

        $this->centroDiCosto->store($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cdc = $this->centroDiCosto->where('c_cdc','=',$id)->first();
        return view('cdc.edit',compact('cdc'));
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
