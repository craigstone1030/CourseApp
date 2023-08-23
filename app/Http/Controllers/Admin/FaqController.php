<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::orderBy('id', 'DESC')->get();
        return view("admin.faqs.index" , compact("faqs"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            if($request->editId > 0) {
                $faq = Faq::find($request->editId)->first();
                $faq->update($request->all());
            } else {
                Faq::create($request->all());
            }

            return $this->renderHtml();
        } catch (\Throwable $th) {
            return false;
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
        Faq::find($id)->delete();
        return $this->renderHtml();
    }

    public function renderHtml() {
        $faqs = Faq::orderBy('id', 'DESC')->get();
        $html = view('admin.faqs.items', compact("faqs"))->render();
        return $html;
    }

    public function viewFAQs() {
        $faqs = Faq::orderBy('id', 'DESC')->get();
        return view("faq" , compact("faqs"));
    }

}
