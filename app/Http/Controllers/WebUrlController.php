<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebUrl;
use App\User;
use Auth;
use Session;

class WebUrlController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $allUrls = WebUrl::all();
        return view('pages.weburl.all-urls',['title' => 'All Request', 'allUrls' => $allUrls]);
    }

    public function my_url(){
        $id = Auth::user()->id;

        $urls = WebUrl::where('user_id', $id)->where('status',1)->get();

        return view('pages.weburl.myweb',['urls' => $urls, 'title'=>'My Web']);
    }


    public function submit_new_url(Request $request){

        $this->validate($request, [
            'url' => 'required|unique:web_urls'
        ],[
            'url.required' => 'URL is required field.',
            'url.unique' => 'This domain has alredy submitted'
        ]);

        $id = Auth::user()->id;
        
        // create random string
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $content = '';
        for ($i = 0; $i < 40; $i++) {
            $content .= $characters[rand(0, $charactersLength - 1)];
        }
        
        $data = array(
            'user_id' => $id,
            'url' => $request->input('url'),
            'verification_key' => $content,
            'created_at' => date('Y-m-d')
        );

        $result = WebUrl::create($data);
        if ($result) {
            // $content = Session::get('newDomainId');
            Session::flash('success', 'New Domain Submitted.');
            return redirect()->back();
        } else {
            Session::flash('errors', 'New URL submission failed.');
            return redirect()->back();
        }
    }

    public function edit_url(Request $request){

        $id = $request->input('urlid');
        $url = $request->input('url');

        $result = WebUrl::where('id', $id)->update(['updated_at' => date('Y-m-d'), 'url' => $url]);

        if($result){
            Session::flash('success', 'Update Successful');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Update failed.');
            return redirect()->back();
        }
    }

    public function destroy_url($id){
        $data = WebUrl::findOrFail($id);

        $result = $data->delete();

        if($result){
            Session::flash('success', 'Delete Successful.');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Delete failed.');
            return redirect()->back();
        }
    }

    public function verify_url($id){
        $webUrl = WebUrl::findOrFail($id);

        if (strpos($webUrl->url, "https://") !== false){
            if(@ file_get_contents($webUrl->url.'/verify.txt')){
                $fileLocation = $webUrl->url.'/verify.txt';
                if(!is_null($fileLocation)){
                    $file = fopen ($fileLocation, "r");
                    while(!feof($file)) {
                        $contents = fgets($file);
                    }
                    if($webUrl->verification_key === $contents){
                        return redirect()->back()->with(['data' => $webUrl->id]);
                    }else{
                        Session::flash('message', 'There is no .txt file which has contain the same name and key that our system has generated.');
                        return redirect()->back();
                    }
                }else{
                    Session::flash('message', 'There is no .txt file which has contain the same name and key that our system has generated.');
                    return redirect()->back();
                }
            }else{
                Session::flash('message', 'There is no .txt file which has contain the same name and key that our system has generated.');
                return redirect()->back();
            }
        }else{
            if('https://'.$webUrl->url){
                if(@ file_get_contents('https://'.$webUrl->url.'/verify.txt')){
                    $fileLocation = 'https://'.$webUrl->url.'/verify.txt';
                    if(!is_null($fileLocation)){
                        $file = fopen ($fileLocation, "r");
                        while(!feof($file)) {
                            $contents = fgets($file);
                        }
                        if($webUrl->verification_key === $contents){
                            return redirect()->back()->with(['data' => $webUrl->id]);
                        }else{
                            Session::flash('message', '1. There is no .txt file which has contain the same name and key that our system has generated.');
                            return redirect()->back();
                        }
                    }else{
                        Session::flash('message', '2. There is no .txt file which has contain the same name and key that our system has generated.');
                        return redirect()->back();
                    }
                }else{
                    Session::flash('message', '3. There is no .txt file which has contain the same name and key that our system has generated.');
                    return redirect()->back();
                }
            }
            else{
                Session::flash('message', 'There is no .txt file which has contain the same name and key that our system has generated.');
                return redirect()->back();
            }      
        }
    }


    public function download_txt_file($id){

        $content = WebUrl::findOrFail($id);
        
        
        // create file
        $filename = "verify.txt";
        #...
        $f = fopen($filename, 'w');
        fwrite($f, $content->verification_key);
        fclose($f);
        /*
        // download file
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Length: ". filesize("$filename").";");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/octet-stream; "); 
        header("Content-Transfer-Encoding: binary");

        readfile($filename);
        */
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($filename));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filename));
        readfile($filename);
        exit;        
    }

    public function pending_requests(){
        $urls = WebUrl::where('verification_status', 'pending')->where('status',1)->with('user')->orderBy('id', 'DESC')->get();

        return view('pages.weburl.pending-requests',['urls' => $urls, 'title'=>'Pending Requests']);
    }
    
    public function verification_confirmation(Request $request){
        
        $id = $request->input('urlid');

        $result = WebUrl::where('id', $id)->update(['verified_by' => Auth::user()->id,'verification_date' => date('Y-m-d'), 'verification_status' => 'verified']);

        if($result){
            Session::flash('success', 'Request Approved');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Failed.');
            return redirect()->back();
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $adminId = Auth::user()->id;
        $adminName = User::findOrFail($adminId);

        $result = WebUrl::where('id', $id)->update(['verified_by' => $adminName->name,'verification_date' => date('Y-m-d'), 'verification_status' => 'approved']);

        if($result){
            Session::flash('success', 'Request Approved');
            return redirect()->back();
        }else{
            Session::flash('errors', 'Failed.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
