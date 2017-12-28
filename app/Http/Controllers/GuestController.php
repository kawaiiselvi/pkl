<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Barang;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Laratrust\LaratrustFacade as Laratrust;

class GuestController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
    	if ($request->ajax()){
            $barangs = Barang::with(['penanggung','kategori']);
            return Datatables::of($barangs)
            ->addColumn('stock',function($barang){
                return $barang->stock;
            })
            ->addColumn('action',function($barang){
                if(Laratrust::hasRole('admin')) return '';
                return '<a class="btn btn-xs btn-primary" href="'.route('guest.barangs.borrow',$barang->id).'">Pinjam</a>';
            })
            ->addColumn('cover',function($barang){
                return view('datatable.cover', [
                    'model'     => $barang->cover ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'title','name'=>'title','title'=>'Nama Barang'])
        ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
        ->addColumn(['data'=>'amount','name'=>'amount','title'=>'Jumlah'])
        ->addColumn(['data'=>'stock','name'=>'stock','title'=>'Stok','orderable'=>false,'searchable'=>false])
        ->addColumn(['data'=>'kondisi','name'=>'kondisi','title'=>'Kondisi'])
        ->addColumn(['data'=>'kategori.nama','name'=>'kategori.nama','title'=>'Kategori'])
        ->addColumn(['data'=>'penanggung.name','name'=>'penanggung.name','title'=>'Penanggung Jawab'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('guest.index')->with(compact('html'));
    }

    public function hardware(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()){
            $barangs = Barang::with(['penanggung'])->where('kategori_id','=',1)->get();    
            return Datatables::of($barangs)
            ->addColumn('stock',function($barang){
                return $barang->stock;
            })
            ->addColumn('action',function($barang){
                if(Laratrust::hasRole('admin')) return '';
                return '<a class="btn btn-xs btn-primary" href="'.route('guest.barangs.borrow',$barang->id).'">Pinjam</a>';
            })
            ->addColumn('cover',function($barang){
                return view('datatable.cover', [
                    'model'     => $barang->cover ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'title','name'=>'title','title'=>'Nama Barang'])
        ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
        ->addColumn(['data'=>'amount','name'=>'amount','title'=>'Jumlah'])
        ->addColumn(['data'=>'stock','name'=>'stock','title'=>'Stok','orderable'=>false,'searchable'=>false])
        ->addColumn(['data'=>'kondisi','name'=>'kondisi','title'=>'Kondisi'])
        ->addColumn(['data'=>'penanggung.name','name'=>'penanggung.name','title'=>'Penanggung Jawab'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('guest.index')->with(compact('html'));
    }

    public function elektronik(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()){
            $barangs = Barang::with(['penanggung'])->where('kategori_id','=',2)->get();    
            return Datatables::of($barangs)
            ->addColumn('stock',function($barang){
                return $barang->stock;
            })
            ->addColumn('action',function($barang){
                if(Laratrust::hasRole('admin')) return '';
                return '<a class="btn btn-xs btn-primary" href="'.route('guest.barangs.borrow',$barang->id).'">Pinjam</a>';
            })
            ->addColumn('cover',function($barang){
                return view('datatable.cover', [
                    'model'     => $barang->cover ]);
            })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data'=>'title','name'=>'title','title'=>'Nama Barang'])
        ->addColumn(['data'=>'cover','name'=>'cover','title'=>'Cover'])
        ->addColumn(['data'=>'amount','name'=>'amount','title'=>'Jumlah'])
        ->addColumn(['data'=>'stock','name'=>'stock','title'=>'Stok','orderable'=>false,'searchable'=>false])
        ->addColumn(['data'=>'kondisi','name'=>'kondisi','title'=>'Kondisi'])
        ->addColumn(['data'=>'penanggung.name','name'=>'penanggung.name','title'=>'Penanggung Jawab'])
        ->addColumn(['data'=>'action','name'=>'action','title'=>'','orderable'=>false,'searchable'=>false]);
        return view('guest.index')->with(compact('html'));
    }
}
