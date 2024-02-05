<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Invoice;
use App\Models\Doc;
use App\Models\User;
use App\Models\ImageMeta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{

    /*
     * Home Index
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function index()
    {
        return view('index');
    }

    /*
     * About
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function about()
    {
        return view('about');
    }

    /*
     * Services
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function services()
    {
        return view('services');
    }

    /*
     * Contact
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function contact()
    {
        return view('contact');
    }

    /*
     * Gallery
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function gallery()
    {
        $images = ImageMeta::all();
        return view('gallery', compact('images'));
    }

    /*
     * Dashboard
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function dashboard()
    {
        return view('pages.dashboard');
    }



    /*
     * Documents
     * @return \Illuminate\Contracts\Support\Renderable
     *
     */
    public function documents()
    {
        // Get all docs for the user
        $docs = Doc::where('user_id', auth()->user()->id)->get();
        return view('pages.documents.index', compact('docs'));
    }


    /*
     * Lessons
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function lessonsShow()
    {
        dd('lessons');
//        return view('pages.lessons');
    }

    /*
     * Lessons Complete
     * @return \Illuminate\Contracts\Support\Renderable
     * */
    public function lessonsComplete(Request $request)
    {
        // todo - add validation
        //  - add validation for id, make sure model exists

        if ($request->id) {
            $lesson = Lesson::find($request->id);
            if (!$lesson) {
                return response()->json([
                    'success' => false,
                    'message' => 'Lesson not found',
                ]);
            }
            $lesson->completed = !$lesson->completed;
            $lesson->save();
        }

        // return json
        return response()->json([
            'success' => true,
            'message' => 'Lesson Completed',
            'lesson' => $lesson,
        ]);
    }
}

