<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\models\category;
use App\Models\Learn;
use App\Models\LearnAttachment;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $pagename = "product";
        $learn = Learn::where("category_id", 0)->first();
        $learn_id = $learn->id ?? 0;
        $attachments = LearnAttachment::where("learn_id" ,'=' , $learn_id)->get();
        $categories =  Category::where('published', 1)->latest()->get();
        return view('products.index', compact("learn","categories", "pagename", "attachments"));
    }


    public function showcategory($category_id)
    {
        $pagename = "subcategory";
        $learn = Learn::where("category_id", $category_id)->first();
        $learn_id = $learn->id ?? 0;
        $attachments = LearnAttachment::where("learn_id" ,'=' , $learn_id)->get();
        $category      =  Category::where("id", $category_id)->first();
        $subcategories =  Category::where('published', 1)->where("parent_id", $category_id)->get();
        return view('products.subcategory', compact('subcategories', 'category' ,'pagename', 'learn', 'attachments'));
    }
}
