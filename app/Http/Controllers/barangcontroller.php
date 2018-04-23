<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class barangcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $barang = Barang::all();
        //$date=date('Y-m-d', $barang['date']);
        
        return view('index',compact('barang','date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $barang = new Barang();
        $barang->name = $request->name;
        
        $barang->date=$request->date;
        //$format = date_format($date,"Y-m-d");
        //$barang->date = strtotime($format);
        $barang->type=$request->get('type');
        $barang->save();

        return redirect()->route('Barang.index')->with('success','Information has been added');
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
        return "test";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
       $barang = Barang::find($id);
        return view('edit',compact('barang','id'));
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
        $barang= Barang::find($id);
        $barang->name=$request->get('name');
        $barang->type=$request->get('type');
        $barang->save();
        return redirect('Barang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = barang::where('id',$id)->first();

        if ($barang != null) {
            $barang->delete();
            return redirect('Barang')->with(['message'=>'sudah didelete gan!']);
        }
        return redirect()->routes('barang')->with(['message'=>'Wrong ID!!']);
    }
}
