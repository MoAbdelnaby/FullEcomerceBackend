<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MallsDatatable;
use Illuminate\Http\Request;
use App\model\Mall;
use Storage;

class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallsDatatable $mall)
    {
       return $mall->render('admin.malls.index', ['title'=>trans('admin.malls')]);
    }

    /**

     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.malls.create', ['title'=>trans('admin.add')]);
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
            'country_id'  =>'required|numeric',
            'contact_name'=>'sometimes|nullable|string',
            'icon'        =>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'name_ar'        =>trans('admin.mall_name_ar'),
            'name_en'        =>trans('admin.mall_name_en'),
            'facebook'       =>trans('admin.facebook'),
            'twitter'        =>trans('admin.twitter'),
            'website'        =>trans('admin.website'),
            'country_id'     =>trans('admin.country_id'),
            'email'          =>trans('admin.email'),
            'mobile'         =>trans('admin.mobile'),
            'address'        =>trans('admin.address'),
            'lng'            =>trans('admin.lng'),
            'lat'            =>trans('admin.lat'),
            'contact_name'   =>trans('admin.contact_name'),
            'icon'           =>trans('admin.mall_icon'),
        ]);

         if(request()->hasFile('icon'))
        {
            
            $data['icon'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'icon',
                'path'=>'malls',             //folder
                'upload_type'=>'single',
                'delete_file'=>'', // helper function

            ]);
        }

        Mall::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('malls'));
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
        $mall = Mall::find($id);
        return view('admin.malls.edit',['title'=>trans('admin.edit'),'mall'=>$mall]);
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
            'country_id'  =>'required|numeric',
            'contact_name'=>'sometimes|nullable|string',
            'icon'        =>'sometimes|nullable|'.v_image(),
         
        ], [],[

            'name_ar'        =>trans('admin.mall_name_ar'),
            'name_en'        =>trans('admin.mall_name_en'),
            'facebook'       =>trans('admin.facebook'),
            'twitter'        =>trans('admin.twitter'),
            'website'        =>trans('admin.website'),
            'country_id'     =>trans('admin.country_id'),
            'email'          =>trans('admin.email'),
            'mobile'         =>trans('admin.mobile'),
            'address'        =>trans('admin.address'),
            'lng'            =>trans('admin.lng'),
            'lat'            =>trans('admin.lat'),
            'contact_name'   =>trans('admin.contact_name'),
            'icon'           =>trans('admin.mall_icon'),
        ]);

    
         if(request()->hasFile('icon'))
        {
            
            $data['icon'] = up()->upload([      // upload method in Upload.php controller
                'file'=>'icon',
                'path'=>'malls',             //folder
                'upload_type'=>'single',
                'delete_file'=>Mall::find($id)->icon, // helper function

            ]);
        }

        Mall::where('id', $id)->update($data);
        session()->flash('success', trans('admin.record_updated'));
        return redirect(aurl('malls'));

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mall = Mall::find($id);
        Storage::delete($mall->icon);
        $mall->delete();
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('malls'));
    }

    public function multidelete() {
        if(is_array(request('item')))
        {
            foreach (request('item') as $id)
            {
                $mall = Mall::find($id);
                Storage::delete($mall->icon);
                 $mall->delete();
            }
        } else {
            $mall = Mall::find(request('item'));
            Storage::delete($mall->icon);
            $mall->delete();
        }
        session()->flash('success', trans('admin.record_deleted'));
        return redirect(aurl('malls'));
    }
}
