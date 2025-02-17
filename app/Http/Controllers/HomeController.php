<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Document;


class HomeController extends Controller
{
    public function index()
    {
        $documents = Document::all();

        return view('dashboard', compact('documents'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
