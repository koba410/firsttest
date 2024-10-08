<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function destroy(Request $request)
    {
        Contact::find($request->id)->delete();
        return redirect('/admin')->with('message', 'データが削除されました');
    }

}
