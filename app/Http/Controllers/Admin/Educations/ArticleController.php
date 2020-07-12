<?php

namespace App\Http\Controllers\Admin\Educations;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
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
        $articles = Article::orderBy('created_at', 'DESC')->paginate();

        return view('admin.educations.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'ASC')->get();

        return view('admin.educations.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:4',
            'content' => 'required',
            'picture' => 'nullable|max:2048|mimes:jpg,jpeg,png'
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->slug = Str::slug($request->title);
        $article->content = $request->content;
        $article->save();

        $article_id = $article->id;

        $categories = $request->category_id;
        if (is_array($categories) && count($categories) > 0)
        {
            foreach ($categories as $category) {
                $article->article_category()->attach($category);
            }
        }

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            $article->addMediaFromRequest('picture')
                ->toMediaCollection('article_pictures');
        }

        return redirect()
            ->to(route('articles.show', $article_id))
            ->withSuccess('Berhasil menambahkan artikel baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('admin.educations.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        $categories = Category::orderBy('name', 'ASC')->get();
        $articleCategories = [];

        foreach ($article->article_category()->get() as $category) {
            $articleCategories[] = $category->id;
        }

        return view('admin.educations.articles.edit', compact('article', 'categories', 'articleCategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|min:4',
            'content' => 'required',
            'picture' => 'nullable|mimes:jpg,jpeg,png'
        ]);

        $article->title = $request->title;
        $article->slug = ($request->slug == '') ? Str::slug($request->title) : $request->slug;
        $article->content = $request->content;
        $article->save();

        $article->article_category()->detach();
        $categories = $request->category_id;
        if (is_array($categories) && count($categories) > 0)
        {
            foreach ($categories as $category) {
                $article->article_category()->attach($category);
            }
        }

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            if (isset($article->media[0])) {
                $article->media[0]->delete();
            }

            $article->addMediaFromRequest('picture')
                ->toMediaCollection('article_pictures');
        }

        return redirect()
            ->to(route('articles.show', $article->id))
            ->withSuccess('Berhasil memperbarui artikel');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        if (isset($article->media[0])) {
            $article->media[0]->delete();
        }

        $article->delete();

        return redirect()
            ->to(route('articles.index'))
            ->withSuccess('Berhasil menghapus artikel');
    }
}
