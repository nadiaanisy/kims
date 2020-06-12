<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class MainPageController extends Controller
{
    public function index()
    {
       $gallery = DB::table('gallery')
                ->select('gallery.*')
                ->orderBy('gallery.updated_at', 'DESC')
                ->paginate(16);
        return view('extends.index', compact('gallery'));
    }

}
