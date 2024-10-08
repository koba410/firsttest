<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\Contact;
use App\Models\Category;

class ExportController extends Controller
{
    public function export(Request $request) {
    $query = Contact::with('category');

    // 検索条件の適用
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('last_name', 'like', '%' . $request->keyword . '%')
              ->orWhere('email', 'like', '%' . $request->keyword . '%');
        });
    }

    if ($request->filled('gender')) {
        $query->where('gender', $request->gender);
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->get();

    $csvData = [];
    $csvData[] = ['ID', '名前', '性別', 'メールアドレス', 'カテゴリ', '作成日'];
    foreach ($contacts as $contact) {
        $csvData[] = [
            $contact->id,
            $contact->first_name . ' ' . $contact->last_name,
            $contact->gender,
            $contact->email,
            $contact->category->content ?? 'なし',
            $contact->created_at->format('Y-m-d'),
        ];
    }

    $filename = 'contacts_export_' . date('Ymd_His') . '.csv';
    $headers = [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => "attachment; filename=\"$filename\"",
    ];

    $callback = function() use ($csvData) {
        $file = fopen('php://output', 'w');
        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    };

    return Response::stream($callback, 200, $headers);
}

}
