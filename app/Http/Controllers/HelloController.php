<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Person;

class HelloController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $sort = $request->sort;
        $items = Person::orderBy($sort, 'asc')->simplePaginate(5);
        $param = ['items' => $items, 'sort' => $sort, 'user' => $user];
        return view('hello.index', $param);

        // $items = DB::select('select * from people');
        // return view('hello.index', ['items' => $items]);
    }

    public function ses_get(Request $request){
        $sesdata = $request->session()->get('msg');
        return view('hello.session', ['session_data' => $sesdata]);
    }

    public function ses_put(Request $request){
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('hello/session');
    }
}
