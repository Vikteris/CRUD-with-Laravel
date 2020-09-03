<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogPostController extends Controller
{

    // READ ALL OPERACIJA
    public function index()
    {
        return view('blogposts', ['posts' => \App\Blogpost::all()]);
        // $posts = DB::table('blogposts')->orderBy('created_at', 'desc')->get();
        // return view('blogposts', ['posts' => $posts]);
    }

    public function show($id)
    {
        //vieno įrašo pasiekimas pagal ID. http://localhost/posts/11 <- tada tikslus url nurodo duombazėje esančios eilutes info pagal tos eilutes ID

        // return \App\Blogpost::find($id);

        return view('blogpost', ['post' => \App\Blogpost::find($id)]);

        // foreach ($this->blogPosts as $blogPost) {
        //     if ($blogPost['id'] == $id) {
        //         return $blogPost;
        //     }
        // }
    }


    // CREATE OPERACIJA
    public function store(Request $request)
    {

        $this->validate($request, [
            // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
            // galime pažiūrėti, kas bus jei bus neteisingas
            'title' => 'required|unique:blogposts,title|max:7',
            'text' => 'required',
        ]);

        $pb = new \App\Blogpost();
        $pb->title = $request['title'];
        $pb->text = $request['text'];

        // // primityvi validacija irgi gali būti taip padaryta iššaukti klaidai
        // if ($pb->title == NULL or $pb->text == NULL)
        //     return redirect('/posts')->with('status_error', 'Post was not created!');

        return ($pb->save() !== 1) ?
            redirect('/posts')->with('status_success', 'Post created!') :
            redirect('/posts')->with('status_error', 'Post was not created!');
    }

    //DELETE OPERACIJA

    public function destroy($id)
    {
        \App\Blogpost::destroy($id);
        return redirect('/posts')->with('status_success', 'Post deleted!');
    }

    // UPDATE OPERACIJA

    public function update($id, Request $request)
    {
        // [Dėmesio] validacijoje unique turi būti nurodytas teisingas lentelės pavadinimas!
        // galime pažiūrėti, kas bus jei bus neteisingas
        $this->validate($request, [
            'title' => 'required|unique:blogposts,title,' . $id . ',id|max:7',
            'text' => 'required',
        ]);
        $bp = \App\Blogpost::find($id);
        $bp->title = $request['title'];
        $bp->text = $request['text'];
        return ($bp->save() !== 1) ?
            redirect('/posts/' . $id)->with('status_success', 'Post updated!') :
            redirect('/posts/' . $id)->with('status_error', 'Post was not updated!');
    }

    // COMMENTS SAVING OPERATION
    public function storePostComment($id, Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
        ]);
        $bp = \App\Blogpost::find($id);
        $cm = new \App\Comment();
        $cm->text = $request['text'];
        $bp->comments()->save($cm);
        return redirect()->back()->with('status_success', 'Comment added!');
    }
}
