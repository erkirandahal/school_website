<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Frontend\DocumentTypeRequest;

use App\Models\Frontend\DocumentType;

use App\Managers\CommonDataManager;
use App\Managers\Frontend\DocumentTypeManager;

use Sentinel;
use DB;
use File;
use Str;

class DocumentTypeController extends Controller
{
 protected $documentTypeManager;
 protected $commonDataManager;

 function __construct(
    DocumentTypeManager $documentTypeManager,
    CommonDataManager $commonDataManager,
)
 {
    $this->documentTypeManager = $documentTypeManager;
    $this->commonDataManager = $commonDataManager;
}

public function index()
{
    try {
        if (request()->ajax()) {
         $setting = defaultSetting();
         $params = request()->only('title');
         $document_types = $this->documentTypeManager->all($params,$setting->per_page);
         return  view('site_modules.document_types.replace_index',compact('document_types'));
     }


     if(Sentinel::hasAccess('document-types.index')){

        $setting = defaultSetting();
        $params['title'] = null;
        $document_types = $this->documentTypeManager->all($params,$setting->per_page);
        return view('site_modules.document_types.index',compact('document_types'));
    }

    return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');

} catch (Exception $e) {
    return redirect()->back()->with('error','Oops, Something went wrong!!!');
}
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{

    try {

        if(Sentinel::hasAccess('document-types.create')){

            $data['setting'] = defaultSetting();

            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            return view('site_modules.document_types.create',compact('data'));
        } else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }


    } catch (Exception $e) {
        return redirect()->route('document-types.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(DocumentTypeRequest $request)
{

    try {

        if(Sentinel::hasAccess('document-types.store')){
            DB::beginTransaction();
            $documentTypeDetails = $request->only('title', 'title_ne', 'order','status');
            $documentTypeDetails['slug'] = Str::slug($request->title);

            if($request->hasFile('image')){
                $file = $request->image;
                $folder = 'uploads/document_types/';
                $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);
                $documentTypeDetails['image'] = $fileName;
            }

            $document_type = DocumentType::create($documentTypeDetails);
            DB::commit();
            return redirect()->route('document-types.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('document-types.index')->with('error','Oops! Something went wrong.');
    }
}
/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{

    try {

        if(Sentinel::hasAccess('document-types.view')){
            $document_type = DocumentType::find($id);
            return view('site_modules.document_types.view',compact('banner'));
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        return redirect()->route('document-types.index')->with('error','Oops! Something went wrong.');
    }
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($document_type_id)
{

    try {

        if(Sentinel::hasAccess('document-types.edit')){

            $data['setting'] = defaultSetting();

            $data['publish_options'] = $this->commonDataManager->publishStatusDropdown();
            $document_type = DocumentType::find($document_type_id);
            return view('site_modules.document_types.edit',compact('data','document_type'));
        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }


    } catch (Exception $e) {
        return redirect()->route('document-types.index')->with('error','Oops! Something went wrong.');
    }

}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(DocumentTypeRequest $request, $id)
{

    try {

        if(Sentinel::hasAccess('document-types.update')){
            DB::beginTransaction();
            $documentTypeDetails = $request->only('title','title_ne','status','order');
            $documentTypeDetails['slug'] = Str::slug($request->title);

            $document_type = DocumentType::find($id);

            $document_type->update($documentTypeDetails);

            if($request->hasFile('image')){
                $file = $request->image;
                $folder = 'uploads/document_types/';
                $fileName = 'image-'.random_int(0, 9999999999).'.'.$file->getClientOriginalExtension();
                $file->move($folder,$fileName);

                $old_image = $document_type->image;

                $document_type->update(['image'=>$fileName]);

                // Remove  old file
                $oldFilePath = public_path('uploads/document_types/'.$old_image);
                if (File::exists($oldFilePath)) {
                    File::delete($oldFilePath);
                }
            }

            DB::commit();

            return redirect()->route('document-types.index')->with('success','Operation Successfull');
        }

        return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->route('document-types.index')->with('error','Oops! Something went wrong.');
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

    try {

        if(Sentinel::hasAccess('document-types.delete')){
            $document_type = DocumentType::find($id);

            // Remove  old file
            $oldPath = public_path('uploads/document_types/'.$document_type->image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $document_type->delete();
            return redirect()->route('document-types.index')->with('success','Operation Successfull');

        }else{
            return redirect()->route('dashboard')->with('error','Oops! Permissions denied.');
        }

    } catch (Exception $e) {
        return redirect()->route('document-types.index')->with('error','Oops! Something went wrong.');
    }
}

}
