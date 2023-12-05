<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\PdfToImage\Pdf;
use Illuminate\Support\Str;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use App\Policies\AdminUserPolicy;
use App\Policies\UploadPolicy;
use Illuminate\Support\Facades\Gate;

class UploadController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadindex()
    {
       // justify user's role and permission of view
        if (auth()->user()->isAdmin()) {
            $uploads = Upload::all();
        } else {
            $uploads = Upload::where('user_id', auth()->id())->get();
        }

        return view('uploads.uploadindex', compact('uploads'));
}
       


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function uploadcreate()
    {
    return view('uploads.uploadcreate');
}
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 

     public function uploadstore(Request $request)
{
    $validated = $request->validate([
        'upload' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
        $upload = new Upload;
        $upload->user_id = auth()->id();
        $upload->title = $request->input('title');
        $upload->description = $request->input('description');
        $upload->originalName = $request->file('upload')->getClientOriginalName();
        $upload->path = $request->file('upload')->store('uploads');
        $upload->mimeType = $request->file('upload')->getMimeType();
        $upload->save();
        return view('uploads.uploadcreate', [
            'id' => $upload->id,
            'path' => $upload->path,
            'originalName' => $upload->originalName,
            'mimeType' => $upload->mimeType,
            'title' => $upload -> title,
            'description' => $upload -> description,
            
        ]);
    } else {
        return redirect()->back();
    }
}

    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function uploadshow(Upload $upload,$originalName='')
    {
    
        $this->authorize('show', $upload);
        $upload = Upload::findOrFail($upload->id);
        return response()->file(storage_path() . '/app/' . $upload->path);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function uploadedit(Upload $upload)
    {
        $this->authorize('edit', $upload);
        return view('uploads.uploadedit',
            ['id'=>$upload->id,
            'path'=>$upload->path,
            'originalName'=>$upload->originalName,
            'mimeType'=>$upload->mimeType,
            'title'=>$upload->title,
            'description'=>$upload->description,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function uploadupdate(Request $request, Upload $upload)
{
    
    $this->authorize('update', $upload);
    $validated = $request->validate([
        'upload' => 'file|mimes:pdf,image|max:2048', // 数据验证validation
    ]);

    $upload = Upload::findOrFail($upload->id);
    Storage::delete($upload->path);
    $upload->originalName = $request->file('upload')->getClientOriginalName();
    $upload->path = $request->file('upload')->store('uploads');
    $upload->mimeType = $request->file('upload')->getClientMimeType();
    $upload->title = $request->file('upload')->store('uploads');
    $upload->description = $request->file('upload')->store('uploads');
    $upload->save();

    return back();

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Upload  $upload
     * @return \Illuminate\Http\Response
     */
    public function uploaddestroy(Upload $upload)
    {

        // 使用 'delete' 动作进行授权检查
    $this->authorize('delete', $upload);
    // 找到上传记录
    $upload = Upload::findOrFail($upload->id);

    // 删除存储中的文件
    Storage::delete($upload->path);

    // 删除数据库中的记录
    $upload->delete();
        return back()->with(['operation'=>'deleted', 'id'=>$upload->id]);
    }
}
