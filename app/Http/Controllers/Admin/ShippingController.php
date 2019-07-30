<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingDatatable;
use Illuminate\Http\Request;
use App\model\Shipping;
use Storage;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDatatable $shipping)
    {
       return $shipping->render('admin.shipping.index', ['title'=>trans('admin.shipping')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.create', ['title'=>trans('admin.add')]);
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
            'name_ar'     =>'required',
            'name_en'     =>'required',
            'lng'         =>'sometimes|nullable',
            'lat'         =>'sometimes|nullable',
            'user_id'     =>'sometimes|numeric',
            'icon'        =>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'name_ar'        =>trans('admin.shipping_name_ar'),
            'name_en'        =>trans('admin.shipping_name_en'),
            'lng'            =>trans('admin.lng'),
            'lat'            =>trans('admin.lat'),
            'user_id'        =>trans('admin.owner_id'),
            'icon'           =>trans('admin.shipping_icon'),
        ]);

         if(request()->hasFile('icon'))
        {
            
            $data['icon'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'icon',
                'path'=>'shipping',             //folder
                'upload_type'=>'single',
                'delete_file'=>'', // helper function

            ]);
        }

        Shipping::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('shipping'));
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
        $shipping = Shipping::find($id);
        return view('admin.shipping.edit',['title'=>trans('admin.edit'),'shipping'=>$shipping]);
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
            'name_ar'     =>'required',
            'name_en'     =>'required',
            'lng'         =>'sometimes|nullable',
            'lat'         =>'sometimes|nullable',
            'user_id'     =>'sometimes|numeric',
            'icon'        =>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'name_ar'        =>trans('admin.shipping_name_ar'),
            'name_en'        =>trans('admin.shipping_name_en'),
            'lng'            =>trans('admin.lng'),
            'lat'            =>trans('admin.lat'),
            'user_id'        =>trans('admin.owner_id'),
            'icon'           =>trans('admin.shipping_icon'),
        ]);

    
         if(request()->hasFile('icon'))
        {
            
            $data['icon'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'icon',
                'path'=>'shipping',             //folder
                'upload_type'=>'single',
                'delete_file'=>Shipping::find($id)->icon, // helper function

            ]);
        }

        Shipping::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_updated'));
        return redirect(aurl('shipping'));

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping = Shipping::find($id);
        Storage::delete($shipping->icon);
        $shipping->delete();
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('shipping'));
    }

    public function multidelete() {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id)
            {
                $shipping = Shipping::find($id);
                Storage::delete($shipping->icon);
                 $shipping->delete();
            }
        } else {
            $shipping = Shipping::find(request('item'));
            Storage::delete($shipping->icon);
            $shipping->delete();
        }
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('shipping'));
    }
}
