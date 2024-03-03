<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index()
	{
		return Inertia::render('Posts/Index', [
			'posts' => Post::all()->map(function ($post) {
				return [
					'id' => $post->id,
					'name' => $post->name,
					'content' => $post->content,
				];
			})
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		return Inertia::render('Posts/Create');
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request)
	{
		// 
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Post $post)
	{
		// 
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Post $post)
	{
		// 
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Post $post)
	{
		// 
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Post $post)
	{
		// 
	}
}
