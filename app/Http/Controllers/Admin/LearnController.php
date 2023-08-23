<?php

namespace App\Http\Controllers\Admin;

use App\Models\Learn;
use App\Models\Category;
use App\Models\LearnAttachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AttachmentController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreCategoryRequest;

class LearnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function index(Request $request)
    {

        $learn = DB::table('learn')
            ->join('categories', 'learn.category_id', '=', 'categories.id')
            ->select('learn.*','categories.title as category_title')
            ->get();

        $attachments = LearnAttachment::where('learn_id')->get();

        return view('admin.learn.index', compact('learn', "attachments"));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        return view('admin.learn.create', compact('categories'));
    }

    /**
     * Store a newly edit resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function edit(Learn $learn)
    {
        $categories = Category::all();
        $attachments = LearnAttachment::where("learn_id", $learn->id)->get();

        return view('admin.learn.edit', compact('categories', 'attachments', 'learn'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file_path = "learn/category";

        $attachments = new AttachmentController;

        $learn_id = Learn::create($request->all())->id;

        if( $request->hasFile("files")) {

            $files = $attachments->multipleUpload($request->file('files'), $file_path);

            foreach($files as $file){
                LearnAttachment::create([
                    'learn_id' => $learn_id,
                    'filename' => $file['filename'],
                    'file_url' => $file['file_path']
                ]);
            }
        }

        return redirect()->route('admin.learn.create');
    }


    public function show( $id ) {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoryRequest $request, Learn $learn)
    {
        $attachments = new AttachmentController;
        $file_path   = "learn/cateogry";

        $learn->update($request->all());

        if( $request->hasFile("files") ) {

            $files = $attachments->multipleUpload($request->file('files'), $file_path);

            $collection = LearnAttachment::where('learn_id',$learn->id)->get(['id']);
            LearnAttachment::destroy($collection->toArray());

            foreach($files as $file) {
                LearnAttachment::create([
                    'learn_id' => $learn->id,
                    'filename' => $file['filename'],
                    'file_url' => $file['file_path']
                ]);
            }
        }

        return redirect('/admin/learn/'.$learn->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function destroy(Learn $learn)
     {
         if (! Gate::allows('category_delete')) {
             return abort(401);
         }

         $collection = LearnAttachment::where('learn_id',$learn->id)->get(['id']);
         $collectFiles = LearnAttachment::where('learn_id',$learn->id)->get(['file_url']);

         Storage::delete($collectFiles->toArray());

         LearnAttachment::destroy($collection->toArray());

         $learn->find($learn->id)->delete();


         return redirect()->route('admin.learn.index');
     }

    public function viewProductLearn(Request $request) {

        $productLearn = DB::table('learn')
            ->where('category_id', '=', '0')
            ->first();
        $productLearnId  = $productLearn->id?? 0;
        $attachments = LearnAttachment::where('learn_id', $productLearnId)->get();
        return view('admin.learn.product', compact('productLearn', 'attachments'));
    }

    public function storeProductLearn(Request $request) {

        $attachments = new AttachmentController;
        $productLearn = Learn::where('category_id', '=', '0')->first();
        $file_path = "learn/products";

        if( $productLearn ) {
            $productLearn->delete();
        }

        $learn_id = Learn::create([
            'category_id'   => 0,
            'title'         => $request->title,
            'content'       => $request->content,
            'resolved_num'  => $request->resolved_num,
            'received_num'  => $request->received_num,
            'response_time' => $request->response_time,
        ])->id;

        if( $request->hasFile("files")) {

            $files = $attachments->multipleUpload($request->file('files'), $file_path);

            $collection = LearnAttachment::where('learn_id',$productLearn->id)->get(['id']);
            LearnAttachment::destroy($collection->toArray());

            foreach($files as $file){
                LearnAttachment::create([
                    'learn_id' => $learn_id,
                    'filename' => $file['filename'],
                    'file_url' => $file['file_path']
                ]);
            }
        }

        return redirect()->action([LearnController::class, 'viewProductLearn']);
    }
}
