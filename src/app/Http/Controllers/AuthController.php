<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController as BaseAuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
    public function admin() {
        $contacts = Contact::with( 'category' )->paginate( 7 );
        $categories = Category::all();

        return view( 'admin', compact( 'contacts', 'categories' ) );
    }

    public function search( Request $request ) {
        $query = Contact::with('category');

    // キーワードが存在する場合、名前・姓・メールアドレスに対して検索
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    // 性別の検索
    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    // カテゴリの検索
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 日付の検索
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // ページネーションの適用
    $contacts = $query->paginate(7)->withQueryString();
    
    $categories = Category::all();

    return view('admin', compact('contacts', 'categories'));
    }

    public function destroy( Request $request ) {
        Auth::guard( 'web' )->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect( '/login' );
        // ログアウト後に/loginにリダイレクト
    }

    public function show( $id ) {
        $contact = Contact::with( 'category' )->findOrFail( $id );
        return response()->json( $contact );
    }
}
