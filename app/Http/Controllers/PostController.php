<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
	/*
	 * Post一覧を表示する
	 *
	 * @param Post Postモデル
	 * @return array Postモデルリスト
	 */
	public function index(Post $post)
	{
		return view('index')->with(['posts' => $post->getPaginateByLimit()]);
	}

	/**
	 * 特定IDのpostを表示する
	 *
	 * @param Object Post 引数の$postはid=1のインスタンス
	 * @return Response post view
	 */
	public function show(Post $post)
	{
		return view('show')->with(['post' => $post]);
	}
	
	public function create(){
		return view('create');
	}
	
	public function store(Post $post, PostRequest $request)
	{
		$input = $request['post'];
		$post->fill($input)->save();
		return redirect('/posts/'. $post->id);
	}
	
	public function edit(Post $post)
	{
		return view('edit')->with(['post' => $post]);
	}
	
	public function update(Post $post, PostRequest $request)
	{
		$input = $request['post'];
		$post->fill($input)->save();
		return redirect('/posts/'. $post->id);
	}
	
	public function destroy(Post $post){
		$post->delete();
		return redirect('/');
	}
}
