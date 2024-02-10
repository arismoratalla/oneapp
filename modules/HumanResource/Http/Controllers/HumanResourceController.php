<?php
namespace Modules\HumanResource\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HumanResourceController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('HumanResource/Pages/Index', [
            'message' => 'Welcome to HR Module!!', 
        ]);
    }
}
