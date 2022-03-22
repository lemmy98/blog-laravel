<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorearticleRequest;
use App\Models\article;
use App\Notifications\ArticleCreatedNotification;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();

            //$articles = article::all(); //get all articles from articles
            $articles = $user -> articles;
            return response()->json($articles);
        }catch(\Exception $exception) {
            logger($exception);
            return response()->json("An error occured", 400);
        }

    }

    public function store(StorearticleRequest $request)
    {
        try {
            $data = $request->validated();
            $user = $request->user();
            $data["user_id"] = $user->id; //ets logged user id
            $article = article::create($data);
            if($article) {
                $user->notify(new ArticleCreatedNotification($user, $article));
            }
            return response()->json($article);
        }catch (\Exception $exception){
            logger($exception);
            return response()->json("An error occurred", 400);
        };
    }

    public function show($id)
    {
        try {
            $article = article::where("id", $id)->first();
            if(!$article){
                return response()->json("Article does not exist with id $id", 400);
            }
            return response()->json($article);
        }catch (\Exception $exception){
            logger($exception);
            return response()->json("An error occured", 400);
        };
    }

    public function update(Request $request, $id)
    {
//
        $data = $request->validate([
            "title" => "required",
            "body" => "required",
            "published_at" => "required",
        ]);

        try {
            $article = article::where("id", $id)->first();
            if(!$article){
                return response()->json("Article does not exist with id $id", 400);
            }
            $article->update($data);
            return response()->json($article);
        }catch (\Exception $exception){
            logger($exception);
            return response()->json("An error occured", 400);
        };
    }

    public function destroy($id)
    {
        try {
            $article = article::where("id", $id)->first();
            if(!$article){
                return response()->json("Article does not exist with id $id", 400);
            }
            $article->delete();
            return response()->json("article deleted");
        }catch (\Exception $exception){
            logger($exception);
            return response()->json("An error occured", 400);
        };
    }
}
