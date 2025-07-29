<?php

namespace App\Http\Controllers;

use App\Models\RecordChat;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RecordChatController extends Controller
{
    /**
     * Store a newly created resource in storage via API.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'chat' => 'required|string',
        ]);

        $recordChat = RecordChat::create([
            'chat' => $request->chat,
        ]);

        return response()->json([
            'message' => 'Chat recorded successfully.',
            'data' => $recordChat,
        ], 201);
    }

    /**
     * Display a listing of the resource for the web.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $recordChats = RecordChat::latest()->paginate(15);
        return view('admin.chat.index', compact('recordChats'));
    }

    /**
     * Generate and download a PDF report of all chat records.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadPdf()
    {
        $recordChats = RecordChat::all();
        // Pastikan Anda telah menginstal barryvdh/laravel-dompdf
        $pdf = Pdf::loadView('admin.chat.pdf', compact('recordChats'));
        return $pdf->download('record-chats-report.pdf');
    }
}
