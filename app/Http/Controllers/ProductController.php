<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = auth()->user()->products;
        return view('products.index', compact('products'));
    }

    public function store(Request $request){

        $data = $request->validate([
            'name'=>'required',
            'amount'=>'required',
            'image'=>'',
            'qty'=>'required',
            'code'=>''
        ]);
        
        if($request->has('image')){
            $data['image'] = $data['image']->store('/public/product');
        }else {
            unset($data['image']);
        }

        toast('Product was added!', 'success');
        $p = auth()->user()->products()->create($data);

        if($request->code != null){
            $p->code = $request->code;
        }else {
            $p->code = 'P-'.Str::padLeft($p->id, 6,'0');
        }
        $p->save();

        return back();
        
    }

    public function destroy($id){
        auth()->user()->products()->findOrFail($id)->delete();
        toast('Product was removed','success');
        return back();
    }

    public function show($id){
        $product = auth()->user()->products()->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function update(Request $request, $id){
        $product = auth()->user()->products()->findOrFail($id);

        $data = $request->validate([
            'name'=>'required',
            'amount'=>'required',
            'image'=>'',
            'qty'=>'required'
        ]);

        if($data['image']){
            $data['image'] = $data['image']->store('/public/product');
        }else {
            unset($data['image']);
        }
        $product->update($data);
        toast('Product was updated!', 'success');
        return view('products.show', compact('product'));
    }
}
