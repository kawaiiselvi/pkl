<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;
use App\Penanggung;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\BorrowLog;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BarangException;

class BarangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()){
            $barangs = Barang::with(['penanggung','kategori']);      
            return Datatables::of($barangs)
            ->addColumn('action',function($barang){
                return view('datatable._action', [
                    'model'     => $barang,
                    'form_url'  => route('barangs.destroy',$barang->id),
                    'edit_url'  => route('barangs.edit',$barang->id),
                    'confirm_message' => 'Yakin Ingin Menghapus '.$barang->title.' ?' ]);
            })
            ->addColumn('cover',function($barang){
                return view('datatable.cover', [
                    'model'     => $barang->cover ]);
            })
            ->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'title','name'=>'title','title'=>'Judul'])
        ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
        ->addColumn(['data'=>'amount','name'=>'amount','title'=>'Jumlah'])
        ->addColumn(['data'=>'stock','name'=>'stock','title'=>'Stok'])
        ->addColumn(['data'=>'kondisi','name'=>'kondisi','title'=>'Kondisi'])
        ->addColumn(['data'=>'kategori.nama','name'=>'kategori.nama','title'=>'Kategori'])
        ->addColumn(['data'=>'penanggung.name','name'=>'penanggung.name','title'=>'Penanggung Jawab'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('barangs.index')->with(compact('html'));
    }

    public function hardware(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()){
            $barangs = Barang::with(['penanggung'])->where('kategori_id','=',1)->get();      
            return Datatables::of($barangs)
            ->addColumn('action',function($barang){
                return view('datatable._action', [
                    'model'     => $barang,
                    'form_url'  => route('barangs.destroy',$barang->id),
                    'edit_url'  => route('barangs.edit',$barang->id),
                    'confirm_message' => 'Yakin Ingin Menghapus '.$barang->title.' ?' ]);
            })
            ->addColumn('cover',function($barang){
                return view('datatable.cover', [
                    'model'     => $barang->cover ]);
            })
            ->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'title','name'=>'title','title'=>'Judul'])
        ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
        ->addColumn(['data'=>'amount','name'=>'amount','title'=>'Jumlah'])
        ->addColumn(['data'=>'stock','name'=>'stock','title'=>'Stok'])
        ->addColumn(['data'=>'kategori','name'=>'kategori','title'=>'Kategori'])
        ->addColumn(['data'=>'penanggung.name','name'=>'penanggung.name','title'=>'Penanggung Jawab'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('barangs.index')->with(compact('html'));
    }

    public function elektronik(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()){
            $barangs = Barang::with(['penanggung'])->where('kategori_id','=',2)->get();      
            return Datatables::of($barangs)
            ->addColumn('action',function($barang){
                return view('datatable._action', [
                    'model'     => $barang,
                    'form_url'  => route('barangs.destroy',$barang->id),
                    'edit_url'  => route('barangs.edit',$barang->id),
                    'confirm_message' => 'Yakin Ingin Menghapus '.$barang->title.' ?' ]);
            })
            ->addColumn('cover',function($barang){
                return view('datatable.cover', [
                    'model'     => $barang->cover ]);
            })
            ->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'title','name'=>'title','title'=>'Judul'])
        ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
        ->addColumn(['data'=>'amount','name'=>'amount','title'=>'Jumlah'])
        ->addColumn(['data'=>'stock','name'=>'stock','title'=>'Stok'])
        ->addColumn(['data'=>'kondisi','name'=>'kondisi','title'=>'Kondisi'])
        ->addColumn(['data'=>'penanggung.name','name'=>'penanggung.name','title'=>'Penanggung Jawab'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('barangs.index')->with(compact('html'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBarangRequest $request)
    {
        $barang = new Barang;
        $barang->title = $request->title;
        $barang->amount = $request->amount;
        $barang->stock = $request->amount;
        $barang->kondisi = $request->kondisi;
        $barang->kategori_id = $request->kategori_id;
        $barang->penanggung_id = $request->penanggung_id;
        $barang->save();

        if($request->hasFile('cover'))
        {
            $uploaded_cover=$request->file('cover');
            $extension=$uploaded_cover->getClientOriginalExtension();
            $filename=md5(time()).'.'.$extension;
            $destinationPath=public_path().DIRECTORY_SEPARATOR.'img';
            $uploaded_cover->move($destinationPath, $filename);
            $barang->cover=$filename;
            $barang->save();
        }

        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan $barang->title"]);
        
        return redirect()->route('barangs.index');
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
        $barang=Barang::find($id);
        return view('barangs.edit')->with(compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBarangRequest $request, $id)
    { 
        $barang = Barang::find($id);
        if (!$barang->update($request->all())) return redirect()->back();
        if($request->hasFile('cover'))
        {
            $filename=null;
            $uploaded_cover=$request->file('cover');
            $extension=$uploaded_cover->getClientOriginalExtension();
            $filename=md5(time()).'.'.$extension;
            $destinationPath=public_path().DIRECTORY_SEPARATOR.'img';
            $uploaded_cover->move($destinationPath, $filename);
            if($barang->cover)
            {
                $old_cover=$barang->cover;
                $filepath=public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$barang->cover;
                try {
                    File::delete($filepath);
                } catch(FileNotFoundException $e) {

                }
            }
            $barang->cover=$filename;
            $barang->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Menyimpan $barang->title"]);
        return redirect()->route('barangs.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang=Barang::find($id);
        $cover=$barang->cover;
        if(!$barang->delete()) return redirect()->back();
        if($cover)
        {
            $old_cover=$barang->cover;
            $filepath=public_path().DIRECTORY_SEPARATOR.'img'.DIRECTORY_SEPARATOR.$barang->cover;
            try {
                File::delete($filepath);
            } catch(FileNotFoundException $e) {

            }
        }
        
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Barang Berhasil Dihapus"]);
        return redirect()->route('barangs.index');
    }

    public function borrow($id)
    {
        try {
            $barang=Barang::findOrFail($id);
            Auth::user()->borrow($barang);
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Meminjam $barang->title" ]);
        } catch(BarangException $e) {
            Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>$e->getMessage() ]);
        } catch(FileNotFoundException $e) {
            Session::flash("flash_notification", [
            "level"=>"danger",
            "message"=>"Barang Tidak Ditemukan" ]);
        }
        return redirect('/');
    }

    public function returnBack($barang_id)
    {
        $borrowLog = BorrowLog::where('user_id', Auth::user()->id)
        ->where('barang_id',$barang_id)
        ->where('is_returned',0)
        ->first();

        if ($borrowLog)
        {
            $borrowLog->is_returned=true;
            $borrowLog->save();

            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil Mengembalikan ".$borrowLog->barang->title ]);
        }
        return redirect('/home');
    }
}
