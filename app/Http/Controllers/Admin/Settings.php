<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Setting;
use Storage;

class Settings extends Controller
{
    
    public function setting () {
    	return view('admin.settings', ['title'=>trans('admin.settings')]);
    }

    public function setting_save () {

    $data = $this->validate(request(),
     			[
     				'logo' => v_image(),
                    'icon' => v_image(),
                    'status' => '',
                    'email' => '',
                    'main_lang' => '',
                    'keywords' => '',
                    'description' => '',
                    'message_maintenance' => '',
                    'sitename_ar' => '',
     				'sitename_en' => '',
     			],[] ,[

     				'logo'=>trans('admin.logo'),
     				'icon'=>trans('admin.icon')
     			]);

    	if(request()->hasFile('logo'))
    	{
    		
     		$data['logo'] = up()->upload([ 		// upload method in Upload.php controller
     			'file'=>'logo',
     			'path'=>'settings', 			//folder
     			'upload_type'=>'single',
     			'delete_file'=>setting()->logo, // helper function

     		]);
    	}

    	if(request()->hasFile('icon'))
    	{
    		$data['icon'] = up()->upload([ 		// upload method in Upload.php controller
     			'file'=>'icon',
     			'path'=>'settings', 			//folder
     			'upload_type'=>'single',
     			'delete_file'=>setting()->icon, // helper function

     		]);
    	}

    	Setting::orderBy('id', 'desc')->update($data);
    	Session()->flash('success',trans('admin.record_updated'));
    	return redirect(aurl('settings'));
    }
}
