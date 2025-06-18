<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\SearchHistory;

class SearchController extends Controller
{
    //Save the request and redirect to the product page with results
    public function search(Request $request)
    {
        $search = $request->input('search');
        
        if (!$search) {
            return redirect()->back()->with('error', 'Enter and search!');
        }

        // Save search history in session
        $history = session()->get('search_history', []);
        array_unshift($history, $search);
        $history = array_unique($history);
        $history = array_slice($history, 0, 5);
        session()->put('search_history', $history);

        // Save search history in DB if user is logged in
        if (Auth::check()) {
            SearchHistory::create([
                'user_id' => Auth::id(),
                'query' => $search,
            ]);

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
    if (Auth::check()) {
        $history = SearchHistory::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->limit(10)
                    ->get();
        } else {
            $sessionHistory = session()->get('search_history', []);
        
        
            $history = collect($sessionHistory)->map(function($query) {
            return (object)[
                'query' => $query,
                'created_at' => null,
                ];
            });
        }

        return view('search.history', compact('history'));
    }

}
