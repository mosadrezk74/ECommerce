<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;



use Illuminate\Support\Facades\DB;
use Storage;
class HomeBannerController extends Controller
{
    public function index()
    {
        $cat['data']=HomeBanner::all();
       return view('Admin/HomeBanner/Homebanner',$cat);
    }


    public function  manage_homebanner(Request $request,$id='')
    {
        if($id>0)
        {
            $arr=HomeBanner::where(['id'=>$id])->get();
            
            $result['image']=$arr['0']->image;
            $result['btn_txt']=$arr['0']->btn_txt;
            $result['btn_link']=$arr['0']->btn_link;
            $result['slug']=$arr['0']->slug;
            $result['msg']=$arr['0']->msg;
            if($arr['0']->is_home==1)
            {
            $result['is_home_selected']="checked";
            }
            $result['status']=$arr['0']->status;
          
            $result['id']=$arr['0']->id;
        }
        else
        {
            $result['image']='';
            $result['btn_txt']='';
            $result['btn_link']='';
            $result['msg']='';
            $result['slug']='';
            $result['status']='';
            $result['id']='0';
        }
      
        return view('Admin/HomeBanner/manage_homebanner',$result);   
    }

   
    public function manage_homebanner_process(Request $request)
    {
        $request->validate([
            // 'name'=>'required|unique:brands,name,'.$request->post('id'), 
            'image'=>'mimes:jpg,jpeg,png'.$request->post('id'), 
        ]);

        if($request->post('id')>0){
            $model=HomeBanner::find($request->post('id'));
            $msg="Home Banner is Successfully updated";
        }else{
            $model=new HomeBanner();
            $msg="Home Banner is Successfully inserted";
        }

        if($request->hasfile('image')){

            if($request->post('id')>0)
            {
                $arrImage=DB::table('home_banners')->where(['id'=>$request->post('id')])->get();
           if(Storage::exists('/public/media/Home_Banner/'.$arrImage[0]->image)){

             Storage::delete('/public/media/Home_Banner/'.$arrImage[0]->image); 
         }
       }

            $image=$request->file('image');
            $ext=$image->extension();
            $image_name=time().'.'.$ext;
            $image->storeAs('/public/media/Home_Banner',$image_name);
            $model->image=$image_name;
        }
        
        $model->btn_txt=$request->post('btn_txt');
        $model->btn_link=$request->post('btn_link');
        $model->slug=$request->post('slug');
        $model->msg=$request->post('msg');
     
        $model->status=1;
        $model->save();
        $request->session()->flash('message',$msg);
        return redirect('admin/homebanner');
        
    }

    
    public function delete(Request $request,$id)
    {
        $data=HomeBanner::find($id);
        $data->delete();
        $request->session()->flash('message','Home Banner is successfully deleted'); 
        return redirect('admin/homebanner');
    }

    public function status(Request $request,$status,$id)
    {
        $data=HomeBanner::find($id);
        $data->status=$status;
        $data->save();
        $request->session()->flash('message','Home Banner is successfully updated'); 
        return redirect('admin/homebanner');
    }
}
