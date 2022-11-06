<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Storage;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::latest()->paginate(10)->withQueryString();
        $data = [
            'articles'  => $articles,
        ];
        return view('pages.admin.articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $data = [
            'categories'  => $categories,
        ];
        return view('pages.admin.articles.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $featured_image = null;
        $featured_name  = null;
        if ($request->file('featured_image')) {
            $storage = Firebase::storage()->getBucket("hikliksports.appspot.com");
            $image = $request->file('featured_image');

            // * Logic Point            

            $tempfolder = public_path('firebase-featured_image') . '/';
            $file      = time() . '-' . $image->getClientOriginalName();
            if ($image->move($tempfolder, $file)) {
                $uploadedfile = fopen($tempfolder . $file, 'r');
                $storage->upload($uploadedfile, ['name' =>  $file]);
                unlink($tempfolder . $file);
            }
            $featured_image = "https://firebasestorage.googleapis.com/v0/b/" . $storage->name() . "/o/" . $file . "?alt=media";
            $featured_name  = $storage->object($file)->name();
        }

        Article::create([
            'title'             =>  $request->title,
            'author'            =>  $request->author,
            'category_id'       =>  $request->category_id,
            'featured_image'    =>  $featured_image,
            'featured_name'     =>  $featured_name,
            'content'           =>  $request->content,
        ]);
        return redirect()->to(route('articles.index'))->with('success', 'Article Has been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [
            'article' => Article::findOrFail($id),
        ];

        return view('pages.admin.articles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $article = Article::findOrFail($id);
        $data = [
            'categories'  => $categories,
            'article'  => $article,
        ];
        return view('pages.admin.articles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, $id)
    {

        $article = Article::findOrFail($id);

        $featured_image = $article->featured_image;
        $featured_name  = $article->featured_name;
        if ($request->file('featured_image')) {
            $storage = Firebase::storage()->getBucket("hikliksports.appspot.com");
            $image = $request->file('featured_image');

            //* Logic Point            

            $tempfolder = public_path('firebase-featured_image') . '/';
            $file      = time() . '-' . $image->getClientOriginalName();
            if ($image->move($tempfolder, $file)) {
                $uploadedfile = fopen($tempfolder . $file, 'r');
                $storage->upload($uploadedfile, ['name' =>  $file]);
                unlink($tempfolder . $file);
            }

            $storage->object($article->featured_name)->delete();
            $featured_image = "https://firebasestorage.googleapis.com/v0/b/" . $storage->name() . "/o/" . $file . "?alt=media";
            $featured_name  = $storage->object($file)->name();
        }
        $article->update([
            'title'             =>  $request->title,
            'author'            =>  $request->author,
            'category_id'       =>  $request->category_id,
            'featured_image'    =>  $featured_image,
            'featured_name'     =>  $featured_name,
            'content'           =>  $request->content,
        ]);
        return redirect()->to(route('articles.index'))->with('success', 'Article Has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $storage = Firebase::storage()->getBucket("hikliksports.appspot.com");

        // * Logic Point            

        $storage->object($article->featured_name)->delete();
        $article->delete();
        return redirect()->to(route('articles.index'))->with('success', 'Article Has been deleted!');;
    }
}
