<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller {
    public function index() {
        $categories = Category::all();

        return view( 'index', compact( 'categories' ) );
    }

    public function confirm( ContactRequest $request ) {
        $category = Category::find( $request->input( 'category_id' ) );
        $name = $request->input( 'first_name' ).' '.$request->input( 'last_name' );
        $phone = $request->input( 'phone1' ) . '-' . $request->input( 'phone2' ) . '-' . $request->input( 'phone3' );
        $tell = $request->input( 'phone1' ).''.$request->input( 'phone2' ).''.$request->input( 'phone3' );

        $genders = [
            1 => '男性',
            2 => '女性',
            3 => 'その他'
        ];
        $gender_name = $genders[ $request->input( 'gender' ) ];

        $contact = $request->only( [ 'first_name', 'last_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail' ] );
        return view( 'confirm', compact( 'category', 'name', 'phone', 'tell', 'contact', 'gender_name' ) );
    }

    public function store( Request $request ) {
        $contact = $request->only( [ 'category_id', 'first_name', 'last_name', 'gender', 'email', 'tell', 'address', 'building',  'detail' ] );
        Contact::create( $contact );
        return view( 'thanks' );
    }

    public function show() {
        return view( 'thanks' );
    }
}
