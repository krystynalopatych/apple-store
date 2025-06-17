<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //Save the request and redirect to the product page with results
    public function search(Request $request)
    {
        $search = $request->input('search');

        //Save the search history in the session
        $history = session()->get('search_history', []);
        array_unshift($history, $search);
        $history = array_unique($history); // remove duplicates
        $history = array_slice($history, 0, 5); // maximum 5 entries
        session()->put('search_history', $history);

        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {

                return redirect()->route('admin.products.index', ['search' => $search]);
            } else {
                
                return redirect()->route('products.index', ['search' => $search]);
            }
        }
    
        return redirect()->route('products.index', ['search' => $search]);
    }

    // Display search history
    public function history()
    {
        $history = session()->get('search_history', []);
        return view('search.history', compact('history'));
    }
}
