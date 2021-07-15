<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SettingsController extends Controller
{
    public function __construct()
    {
        
    }

    public function index()
    {
        return view('settings.index');
    }
    public function users()
    {
        
    }
    public function groups()
    {
        return view('settings.groups.index');
    }
    public function tags()
    {
        return view('settings.tags');
    }
}
