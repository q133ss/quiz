<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $questions = Question::orderBy('order', 'ASC')->get();
        return view('home', compact('questions'));
    }

    public function updateOrder(Request $request) {
        foreach ($request->item as $index => $item_id) {
            Question::where('id', $item_id)->update(['order' => $index]);
        }
        return response('Сортировка обновлена успешно', 200);
    }

    public function requests()
    {
        $requests = \App\Models\Request::orderBy('created_at', 'DESC')->get();
        return view('requests', compact('requests'));
    }

    public function requestShow(string $id)
    {
        $item = \App\Models\Request::findOrFail($id);
        return view('request', compact('item'));
    }
}
