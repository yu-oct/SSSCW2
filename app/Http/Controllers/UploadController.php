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
             'upload' => 'file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048', // 允许上传 PDF、Word、JPEG、JPG、PNG 类型的文件，最大大小为 2048KB
         ]);
     
         if ($request->hasFile('upload') && $request->file('upload')->isValid()) {
             $upload = new Upload;
             $upload->user_id = auth()->id();
             $upload->originalName = $request->file('upload')->getClientOriginalName();
             $upload->path = $request->file('upload')->store('uploads');
             $upload->mimeType = $request->file('upload')->getMimeType();
             $upload->save();
             // 处理文档文件
             if (in_array($upload->mimeType, ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])) {
                 // 获取文档文件路径
                 $documentPath = storage_path('app/' . $upload->path);  
                 // 设置输出格式为 PNG 图像
                 $outputImagePath = storage_path('app/' . $upload->path . '.png');    
                 // 使用 unoconv 转换文档为图像
                 exec("unoconv -f png -o " . storage_path('app/') . " " . $documentPath);    
                 // 重命名生成的图像文件
                 rename($outputImagePath . '.0', $outputImagePath);
             }
     
             return view('uploads.uploadcreate', [
                 'id' => $upload->id,
                 'path' => $upload->path,
                 'originalName' => $upload->originalName,
                 'mimeType' => $upload->mimeType,
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
            'mimeType'=>$upload->mimeType]
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
