<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ManuFactsDatatable;
use Illuminate\Http\Request;
use App\model\Manufacturers;
use Storage;

class manufactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManuFactsDatatable $manufact)
    {
       return $manufact->render('admin.manufacturers.index', ['title'=>trans('admin.manufacturers')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacturers.create', ['title'=>trans('admin.add')]);
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
            'facebook'    =>'sometimes|nullable|url',
            'twitter'     =>'sometimes|nullable|url',
            'website'     =>'sometimes|nullable|url',
            'lng'         =>'sometimes|nullable',
            'lat'         =>'sometimes|nullable',
            'address'     =>'sometimes|nullable',
            'mobile'      =>'sometimes|numeric',
            'email'       =>'sometimes|email',
            'contact_name'=>'sometimes|nullable|string',
            'icon'        =>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'name_ar'        =>trans('admin.manfact_name_ar'),
            'name_en'        =>trans('admin.manfact_name_en'),
            'facebook'       =>trans('admin.facebook'),
            'twitter'        =>trans('admin.twitter'),
            'website'        =>trans('admin.website'),
            'email'          =>trans('admin.email'),
            'mobile'         =>trans('admin.mobile'),
            'address'        =>trans('admin.address'),
            'lng'            =>trans('admin.lng'),
            'lat'            =>trans('admin.lat'),
            'contact_name'   =>trans('admin.contact_name'),
            'icon'           =>trans('admin.manfact_icon'),
        ]);

         if(request()->hasFile('icon'))
        {
            
            $data['icon'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'icon',
                'path'=>'manufacturers',             //folder
                'upload_type'=>'single',
                'delete_file'=>'', // helper function

            ]);
        }

        Manufacturers::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('manufacturers'));
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
        $manufact = Manufacturers::find($id);
        return view('admin.manufacturers.edit',['title'=>trans('admin.edit'),'manufact'=>$manufact]);
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
            'facebook'    =>'sometimes|nullable|url',
            'twitter'     =>'sometimes|nullable|url',
            'website'     =>'sometimes|nullable|url',
            'lng'         =>'sometimes|nullable',
            'lat'         =>'sometimes|nullable',
            'address'     =>'sometimes|nullable',
            'mobile'      =>'sometimes|numeric',
            'email'       =>'sometimes|email',
            'contact_name'=>'sometimes|nullable|string',
            'icon'        =>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'name_ar'        =>trans('admin.manfact_name_ar'),
            'name_en'        =>trans('admin.manfact_name_en'),
            'facebook'       =>trans('admin.facebook'),
            'twitter'        =>trans('admin.twitter'),
            'website'        =>trans('admin.website'),
            'email'          =>trans('admin.email'),
            'mobile'         =>trans('admin.mobile'),
            'address'        =>trans('admin.address'),
            'lng'            =>trans('admin.lng'),
            'lat'            =>trans('admin.lat'),
            'contact_name'   =>trans('admin.contact_name'),
            'icon'           =>trans('admin.manfact_icon'),
        ]);

    
         if(request()->hasFile('icon'))
        {
            
            $data['icon'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'icon',
                'path'=>'manufacturers',             //folder
                'upload_type'=>'single',
                'delete_file'=>Manufacturers::find($id)->icon, // helper function

            ]);
        }

        Manufacturers::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_updated'));
        return redirect(aurl('manufacturers'));

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufacturers = Manufacturers::find($id);
        Storage::delete($manufacturers->icon);
        $manufacturers->delete();
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('manufacturers'));
    }

    public function multidelete() {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id)
            {
                $manufacturers = Manufacturers::find($id);
                Storage::delete($manufacturers->icon);
                 $manufacturers->delete();
            }
        } else {
            $manufacturers = Manufacturers::find(request('item'));
            Storage::delete($manufacturers->icon);
            $manufacturers->delete();
        }
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('manufacturers'));
    }
}
