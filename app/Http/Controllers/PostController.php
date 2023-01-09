<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Auth;
use Inertia\Inertia;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts=Post::paginate(10);
        /*
        ->through(function($posts){
            return [
                'id' => $posts->id,
                'title' => $posts->title
            ];
        });
        */

        return Inertia::render('Posts/Index',['posts'=>$posts]);
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=DB::table('categories')->select('id','title')->get();
        return Inertia::render('Posts/Create',['categories'=>$categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request  $request)
    {
        //
        $post=$request->validate([
            'title'=>'required|max:255',
            'image'=>'required|image|mimes:jpg,png,jpeg,gif,svg|max:10284',
            'content'=>'required',
            'category'=>'required'
        ]);

        Post::create([
            'title'=>$post['title'],
            'content'=>$post['content'],
            'image'=>$post['image']->store('public/images'),
            'category_id'=>$post['category'],
            'user_id'=>Auth::user()->id
        ]);

        //return Redirect('/users');
        return redirect()->route('posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post=Post::find($id);
        return view('posts.show',['post'=>$post]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $selected='selected';
        $categories=DB::table('categories')->get();
        return view('posts.edit',[
            'post'=>$post,
            'categories'=>$categories,
            'selected'=>$selected
        ]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        
        $validated= empty($request->image) ?
    
        $validated=$request->validate([
            'title'=>'required|max:255',
            'content'=>'required',
            'category'=>'required'
        ])
        :

        $validated=$request->validate([
            'title'=>'required|max:255',
            'image'=>'required|mimes:jpg,png,jpeg,gif,svg|max:10284',
            'content'=>'required',
            'category'=>'required'
        ]);


     
        $post=Post::find($id);
        if(empty($request->image) ){
            $post->category_id=$validated['category'];
            $post->content=$validated['content'];
            $post->title=$validated['title'];
            $post->save();
            return redirect()->route('posts.index');
        }else{
            try{

                Storage::delete($validated['image']);
                
                $post->category_id=$validated['category'];
                $post->content=$validated['content'];
                $post->title=$validated['title'];
                $post->image=$validated['image']->store('public/images');
                $post->save();
                return redirect()->route('posts.index');
        }catch(\Exception $e){
            return 'an error occured';
            //session()->flash('message', 'Error! Post not delete');
        }
        }

        //
      
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
        try{

            DB::beginTransaction();
                $post = Post::find($id);
                $post->delete();
            DB::commit();
            
            Storage::delete($post->image);
            session()->flash('message', 'Post deleted successfully');
        }catch(\Exception $e){
            DB::rollBack();
            session()->flash('message', 'Error! Post not delete');
        }

    }

}
