<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ProductsDatatable;
use Illuminate\Http\Request;
use App\model\Product;
use Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductsDatatable $product)
    {
       return $product ->render('admin.products.index', ['title'=>trans('admin.products')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
  
        $data = $this->validate(request(),

        [
            'country_name_ar'=>'required',
            'country_name_en'=>'required',
            'mob'=>'required',
            'code'=>'required',
            'logo'=>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'country_name_ar'=>trans('admin.country_name_ar'),
            'country_name_en'=>trans('admin.country_name_en'),
            'mob'=>trans('admin.mob'),
            'code'=>trans('admin.code'),
            'logo'=>trans('admin.logo'),
        ]);

         if(request()->hasFile('logo'))
        {
            
            $data['logo'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'logo',
                'path'=>'products',             //folder
                'upload_type'=>'single',
                'delete_file'=>'', // helper function

            ]);
        }

        Product::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('products'));
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
        $product  = Product::find($id);
        return view('admin.products.product',['title'=>trans('admin.create_or_edit_product',['title'=>$product->title]),'product '=>$product ]);
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
    $data = $this->validate(request(),

        [
            'country_name_ar'=>'required',
            'country_name_en'=>'required',
            'mob'=>'required',
            'code'=>'required',
            'logo'=>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'country_name_ar'=>trans('admin.country_name_ar'),
            'country_name_en'=>trans('admin.country_name_en'),
            'mob'=>trans('admin.mob'),
            'code'=>trans('admin.code'),
            'logo'=>trans('admin.logo'),
        ]);

         if(request()->hasFile('logo'))
        {
            
            $data['logo'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'logo',
                'path'=>'products',             //folder
                'upload_type'=>'single',
                'delete_file'=>Product::find($id)->logo, // helper function

            ]);
        }

        Product::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_updated'));
        return redirect(aurl('products'));

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        Storage::delete($product->logo);
        $product->delete();
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('products'));
    }

    public function multidelete() {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id)
            {
                $product = Product::find($id);
                Storage::delete($product->logo);
                 $product->delete();
            }
        } else {
            $product = Product::find(request('item'));
            Storage::delete($product->logo);
            $product->delete();
        }
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('products'));
    }
}
